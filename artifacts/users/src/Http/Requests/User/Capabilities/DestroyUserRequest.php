<?php

namespace Ugarit\Artifacts\Users\Http\Requests\User\Capabilities;

use Heritage\Foundation\Http\Attributes\ForAction;
use Heritage\Foundation\Http\FormRequest;
use Heritage\Validation\Rule;
use Ugarit\Artifacts\Users\Capabilities\User\DestroyUserCapability;
use Ugarit\Artifacts\Users\Models\User;

/**
 * Validates the deletion of a user, confirmed by typing its username.
 */
#[ForAction(DestroyUserCapability::class)]
class DestroyUserRequest extends FormRequest
{
    /**
     * Validation rules applied to the incoming payload: the typed confirmation must be the
     * username of the user being deleted, and `force` deletes it permanently.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            'confirmation' => [
                'required',
                'string',
                Rule::in($user instanceof User ? [(string) $user->username] : []),
            ],
            'force' => 'sometimes|boolean',
        ];
    }
}
