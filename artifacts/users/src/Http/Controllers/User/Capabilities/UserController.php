<?php

namespace Ugarit\Artifacts\Users\Http\Controllers\User\Capabilities;

use Heritage\Http\Request;
use Heritage\Routing\Controller;
use Ugarit\Artifacts\Users\Capabilities\User\CreateUserCapability;
use Ugarit\Artifacts\Users\Capabilities\User\DestroyUserCapability;
use Ugarit\Artifacts\Users\Capabilities\User\EditUserCapability;
use Ugarit\Artifacts\Users\Capabilities\User\IndexUsersCapability;
use Ugarit\Artifacts\Users\Capabilities\User\SaveUserCapability;
use Ugarit\Artifacts\Users\Capabilities\User\ShowUserCapability;
use Ugarit\Artifacts\Users\Http\Requests\User\Capabilities\DestroyUserRequest;
use Ugarit\Artifacts\Users\Http\Requests\User\Capabilities\StoreUserRequest;
use Ugarit\Artifacts\Users\Http\Requests\User\Capabilities\UpdateUserRequest;
use Ugarit\Artifacts\Users\Http\Resources\User\UserResource;
use Ugarit\Artifacts\Users\Models\User;
use Ugarit\Artifacts\Users\Parcels\User\Capabilities\DestroyUserParcel;
use Ugarit\Artifacts\Users\Parcels\User\Capabilities\EditUserParcel;
use Ugarit\Artifacts\Users\Parcels\User\Capabilities\IndexUserParcel;
use Ugarit\Artifacts\Users\Parcels\User\Capabilities\SaveUserParcel;
use Ugarit\Artifacts\Users\Parcels\User\Capabilities\ShowUserParcel;

/**
 * Handles the HTTP endpoints of the User capabilities.
 *
 * Every endpoint answers JSON to clients expecting JSON (ResponderType::AUTO).
 */
class UserController extends Controller
{
    /**
     * List users, filtered, searched, sorted and paged by the query string.
     *
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->page(IndexUsersCapability::class, IndexUserParcel::fromQuery($request->query()), 'users::user/Index', UserResource::class);
    }

    /**
     * Render the create user form.
     *
     * @return mixed
     */
    public function create()
    {
        return $this->page(CreateUserCapability::class, null, 'users::user/Create');
    }

    /**
     * Create a user.
     *
     * @param  StoreUserRequest  $request  Validated creation payload.
     * @return mixed
     */
    public function store(StoreUserRequest $request)
    {
        return $this->back(SaveUserCapability::class, SaveUserParcel::fromArray($request->validated()), UserResource::class);
    }

    /**
     * Show a user.
     *
     * @param  User  $user  Resolved via route-model binding.
     * @return mixed
     */
    public function show(User $user)
    {
        return $this->page(ShowUserCapability::class, ShowUserParcel::fromModel($user, true), 'users::user/Show', UserResource::class);
    }

    /**
     * Render the edit form of a user.
     *
     * @param  User  $user  Resolved via route-model binding.
     * @return mixed
     */
    public function edit(User $user)
    {
        return $this->page(EditUserCapability::class, EditUserParcel::fromModel($user, true), 'users::user/Edit', UserResource::class);
    }

    /**
     * Update a user.
     *
     * @param  UpdateUserRequest  $request  Validated update payload.
     * @param  User  $user  Resolved via route-model binding.
     * @return mixed
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        return $this->back(SaveUserCapability::class, SaveUserParcel::fromArray($request->validated())->setModel($user), UserResource::class);
    }

    /**
     * Delete a user, then go to the index (back when it fails).
     *
     * @param  DestroyUserRequest  $request  Validated deletion payload.
     * @param  User  $user  Resolved via route-model binding.
     * @return mixed
     */
    public function destroy(DestroyUserRequest $request, User $user)
    {
        return $this->toRoute(
            DestroyUserCapability::class,
            DestroyUserParcel::fromArray([...$request->validated(), 'id' => $user->id])->setModel($user),
            'user.index'
        );
    }
}
