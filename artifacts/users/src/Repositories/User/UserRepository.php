<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Repositories\User;

use Heritage\Repositories\ModelRepository;
use Ugarit\Artifacts\Users\Contracts\Repositories\User\UserRepositoryInterface;
use Ugarit\Artifacts\Users\Models\User;

/**
 * Persistence of User records.
 *
 * Override query() to eager-load relations on every read, and add filter{Name}() methods to
 * change how browse() applies a filter.
 *
 * @extends ModelRepository<User>
 */
class UserRepository extends ModelRepository implements UserRepositoryInterface
{
    /**
     * Create a new repository instance.
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * Determine if a user exists with the given username.
     */
    public function existsByUsername(string $username): bool
    {
        return $this->model->newQuery()->where('username', $username)->exists();
    }

    /**
     * Find a user by username.
     */
    public function findByUsername(string $username): ?User
    {
        return $this->model->newQuery()->where('username', $username)->first();
    }
}
