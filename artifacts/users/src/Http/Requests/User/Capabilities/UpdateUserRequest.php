<?php

namespace Ugarit\Artifacts\Users\Http\Requests\User\Capabilities;

use Heritage\Foundation\Http\Attributes\ForAction;
use Heritage\Foundation\Http\FormRequest;
use Ugarit\Artifacts\Users\Capabilities\User\SaveUserCapability;

/**
 * Validates payload for UpdateUserRequest.
 */
#[ForAction(SaveUserCapability::class)]
class UpdateUserRequest extends FormRequest
{
    /**
     * Validation rules applied to the incoming payload.
     *
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'entity_id' => 'required|integer|exists:entities,id',
            'username' => 'required|string|max:255',
        ];
    }
}
