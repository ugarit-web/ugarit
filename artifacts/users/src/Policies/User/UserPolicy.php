<?php

namespace Ugarit\Artifacts\Users\Policies\User;

use Heritage\Contracts\Auth\Actor;
use Ugarit\Artifacts\Users\Models\User;

/**
 * Who may do what with User records: the abilities its capabilities declare with #[Authorize].
 *
 * Every ability is granted until it is restricted here.
 */
class UserPolicy
{
    /**
     * List User records.
     */
    public function viewAny(Actor $actor): bool
    {
        return true;
    }

    /**
     * View a User.
     */
    public function view(Actor $actor, User $model): bool
    {
        return true;
    }

    /**
     * Create a User.
     */
    public function create(Actor $actor): bool
    {
        return true;
    }

    /**
     * Update a User.
     */
    public function update(Actor $actor, User $model): bool
    {
        return true;
    }

    /**
     * Save a User: create it, or update the given one.
     */
    public function save(Actor $actor, ?User $model = null): bool
    {
        return $model === null ? $this->create($actor) : $this->update($actor, $model);
    }

    /**
     * Delete a User.
     */
    public function delete(Actor $actor, User $model): bool
    {
        return true;
    }

    /**
     * Restore a soft-deleted User.
     */
    public function restore(Actor $actor, User $model): bool
    {
        return true;
    }

    /**
     * Permanently delete a User.
     */
    public function forceDelete(Actor $actor, User $model): bool
    {
        return true;
    }
}
