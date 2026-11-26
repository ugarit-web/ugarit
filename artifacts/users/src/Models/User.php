<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Models;

use Heritage\Auth\Notifications\VerifyEmail;
use Heritage\Contracts\Auth\MustVerifyEmail;
use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Database\Eloquent\Relations\BelongsTo;
use Heritage\Database\Eloquent\Relations\HasMany;
use Heritage\Database\Eloquent\Relations\HasOne;
use Heritage\Foundation\Auth\User as Authenticatable;
use Heritage\Notifications\Notifiable;
use Heritage\Support\Carbon;
use Ugarit\Artifacts\Authentication\Models\Credential;
use Ugarit\Artifacts\Authentication\Models\LoginAudit;
use Ugarit\Artifacts\Authentication\Models\Password;
use Ugarit\Artifacts\Identity\Models\Entity;
use Ugarit\Artifacts\Users\Database\Factories\UserFactory;
use Ugarit\Fortify\Contracts\PasskeyUser;
use Ugarit\Fortify\PasskeyAuthenticatable;
use Ugarit\Fortify\TwoFactorAuthenticatable;
use Ugarit\Passkeys\Passkey;

/**
 * Eloquent model representing an individual human user in the unified entity system.
 *
 * @property int $entity_id
 * @property string $username
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Entity $entity
 * @property-read Password|null $currentPassword
 */
class User extends Authenticatable implements MustVerifyEmail, PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'entity_id';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Mass-assignable attributes.
     *
     * @var list<string>
     */
    protected $fillable = [
        'entity_id',
        'username',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * Attributes hidden from serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    /**
     * The unified entity record this user account belongs to.
     *
     * @return BelongsTo<Entity, $this>
     */
    public function entity(): BelongsTo
    {
        return $this->belongsTo(Entity::class, 'entity_id', 'id');
    }

    /**
     * The central password records associated with this user.
     *
     * @return HasMany<Password, $this>
     */
    public function passwords(): HasMany
    {
        return $this->hasMany(Password::class, 'user_id', 'entity_id')->latest('id');
    }

    /**
     * The currently active password record managed centrally.
     *
     * @return HasOne<Password, $this>
     */
    public function currentPassword(): HasOne
    {
        return $this->hasOne(Password::class, 'user_id', 'entity_id')
            ->where('is_current', true);
    }

    /**
     * Credentials registered for this user (OAuth, WebAuthn, API tokens).
     *
     * @return HasMany<Credential, $this>
     */
    public function credentials(): HasMany
    {
        return $this->hasMany(Credential::class, 'user_id', 'entity_id');
    }

    /**
     * Passkeys registered for WebAuthn authentication.
     */
    public function passkeys(): HasMany
    {
        return $this->hasMany(Passkey::class, 'user_id', 'entity_id');
    }

    /**
     * Historical login audit logs for this user account.
     *
     * @return HasMany<LoginAudit, $this>
     */
    public function loginAudits(): HasMany
    {
        return $this->hasMany(LoginAudit::class, 'user_id', 'entity_id')->latest('id');
    }

    /**
     * Get the password hash for authentication from the central password manager.
     */
    public function getAuthPassword(): ?string
    {
        return $this->currentPassword?->hash;
    }

    /**
     * Set a new active password through the central password manager with anti-reuse protection.
     *
     * @param  array<string, mixed>  $options
     */
    public function setPassword(string $plainText, array $options = []): Password
    {
        $password = Password::setPassword($this, $plainText, $options);

        // Invalidate cached relation states so subsequent reads pull the fresh record
        $this->unsetRelation('currentPassword');
        $this->unsetRelation('passwords');

        return $password;
    }

    /**
     * Verify the supplied plain-text password against the user's active password.
     */
    public function verifyPassword(string $plainText): bool
    {
        return Password::verify($this, $plainText);
    }

    /**
     * Check if a candidate password matches any recent historical password.
     */
    public function isPasswordReused(string $plainText, int $limit = 5): bool
    {
        return Password::isReused($this, $plainText, $limit);
    }

    /**
     * Get the user's primary email address from the entity's contacts.
     */
    public function primaryEmail(): ?string
    {
        return $this->entity?->contacts()
            ->where('is_primary', true)
            ->latest('id')
            ->value('contact_value')
            ?? $this->entity?->contacts()
                ->latest('id')
                ->value('contact_value');
    }

    /**
     * Get the user's primary email address attribute for framework compatibility.
     */
    public function getEmailAttribute(): ?string
    {
        return $this->primaryEmail();
    }

    /**
     * Get the user's display name attribute for framework and UI presentation.
     */
    public function getNameAttribute(): ?string
    {
        return $this->entity?->actors()->first()?->display_name ?? $this->username;
    }

    /**
     * Get the email verification timestamp attribute for framework and testing compatibility.
     *
     * @return mixed
     */
    public function getEmailVerifiedAtAttribute()
    {
        $contact = $this->entity?->contacts()
            ->where('is_primary', true)
            ->first();

        return $contact && $contact->is_verified
            ? ($contact->updated_at ?? Carbon::now())
            : null;
    }

    /**
     * Get the user's primary identifier attribute for framework and route parameter compatibility.
     */
    public function getIdAttribute(): int
    {
        return (int) $this->entity_id;
    }

    /**
     * Get the active password hash attribute for framework and testing compatibility.
     */
    public function getPasswordAttribute(): ?string
    {
        return $this->relationLoaded('currentPassword') && $this->currentPassword
            ? $this->currentPassword->hash
            : $this->currentPassword()->value('hash');
    }

    /**
     * Get the e-mail address where password reset links are sent.
     */
    public function getEmailForPasswordReset(): ?string
    {
        return $this->email;
    }

    /**
     * Determine if the user has verified their email address.
     */
    public function hasVerifiedEmail(): bool
    {
        return (bool) $this->entity?->contacts()
            ->where('is_primary', true)
            ->value('is_verified');
    }

    /**
     * Mark the given user's email as verified.
     */
    public function markEmailAsVerified(): bool
    {
        $contact = $this->entity?->contacts()
            ->where('is_primary', true)
            ->first();

        if ($contact) {
            $contact->is_verified = true;
            $contact->save();

            return true;
        }

        return false;
    }

    /**
     * Mark the given user's email as unverified.
     */
    public function markEmailAsUnverified(): bool
    {
        $contact = $this->entity?->contacts()
            ->where('is_primary', true)
            ->first();

        if ($contact) {
            $contact->is_verified = false;
            $contact->save();

            return true;
        }

        return false;
    }

    /**
     * Send the email verification notification.
     */
    public function sendEmailVerificationNotification(): void
    {
        $this->notify(new VerifyEmail);
    }

    /**
     * Get the email address that should be used for verification.
     */
    public function getEmailForVerification(): string
    {
        return (string) $this->email;
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
