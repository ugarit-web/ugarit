<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Contracts\Repositories\User;

use Heritage\Contracts\Repositories\ModelRepositoryInterface;
use Ugarit\Artifacts\Users\Models\User;

/**
 * Repository contract of User, injected into its capabilities and bound to
 * UserRepository by convention.
 *
 * @extends ModelRepositoryInterface<User>
 */
interface UserRepositoryInterface extends ModelRepositoryInterface
{
    /**
     * Determine if a user exists with the given username.
     */
    public function existsByUsername(string $username): bool;

    /**
     * Find a user by username.
     */
    public function findByUsername(string $username): ?User;
}
