<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Capabilities\User;

use Heritage\Capabilities\Attributes\Authorize;
use Heritage\Capabilities\Capability;
use Heritage\Outcomes\Outcome;
use Throwable;
use Ugarit\Artifacts\Users\Contracts\Repositories\User\UserRepositoryInterface;
use Ugarit\Artifacts\Users\Enums\User\Capabilities\DestroyUserResult;
use Ugarit\Artifacts\Users\Models\User;
use Ugarit\Artifacts\Users\Outcomes\User\UserOutcome;
use Ugarit\Artifacts\Users\Parcels\User\Capabilities\DestroyUserParcel;

/**
 * Deletes a User (permanently with `force`).
 */
#[Authorize('delete', User::class)]
class DestroyUserCapability extends Capability
{
    /**
     * @param  UserRepositoryInterface  $users  Data access for this capability.
     */
    public function __construct(protected UserRepositoryInterface $users)
    {
        // Resolved by the container and promoted to $this->users.
    }

    /**
     * Execute the capability business logic.
     *
     * The parameter type declares the accepted Parcel; a nullable type also accepts no input.
     * Throw a CapabilityException to fail with displayable errors without reporting.
     *
     * @param  DestroyUserParcel  $data  The input parcel.
     */
    protected function perform(DestroyUserParcel $data): Outcome
    {
        return $this->users->destroy($data)
            ? UserOutcome::fromResult(DestroyUserResult::SUCCESS, $data->getModel())
            : UserOutcome::fromResult(DestroyUserResult::FAILED);
    }

    /**
     * Build the outcome returned when perform() throws; unexpected exceptions are already reported.
     *
     * @param  Throwable  $e  The exception raised by perform().
     */
    protected function failed(Throwable $e): Outcome
    {
        return UserOutcome::fromResult(DestroyUserResult::FAILED);
    }
}
