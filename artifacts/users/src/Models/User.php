<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Models;

use Heritage\Database\Eloquent\Factories\HasFactory;
use Heritage\Foundation\Auth\User as Authenticatable;
use Heritage\Notifications\Notifiable;
use Ugarit\Artifacts\Users\Database\Factories\UserFactory;

/**
 * Eloquent model representing an application user in the Ugarit Ecosystem.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Heritage\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Heritage\Support\Carbon|null $created_at
 * @property \Heritage\Support\Carbon|null $updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Create a new factory instance for the model.
     */
    protected static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
