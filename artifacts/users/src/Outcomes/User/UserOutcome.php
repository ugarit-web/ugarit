<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Outcomes\User;

use Heritage\Actions\Action;
use Heritage\Outcomes\Outcome;
use Ugarit\Artifacts\Users\Enums\User\Capabilities\SaveUserResult;
use Ugarit\Artifacts\Users\Models\User;

/**
 * The outcome of the User capabilities.
 *
 * Supplies the User placeholders of the feedback messages, naming the record from the data.
 */
readonly class UserOutcome extends Outcome
{
    /**
     * The User placeholders: model names, route base and the record carried by the outcome.
     *
     * @return array<string, mixed>
     */
    protected function defaultContext(): array
    {
        $subject = $this->subject();

        return [
            'model' => trans('users::user.name'),
            'model_singular' => trans('users::user.singular'),
            'model_plural' => trans('users::user.plural'),
            'model_plural_definite' => trans('users::user.plural_definite'),
            'routeBase' => 'user',
            'entity' => $subject instanceof User ? $subject->getRouteKey() : null,
        ];
    }

    /**
     * Offer to view the record once it is saved.
     *
     * @return array<int, Action>
     */
    public function actions(): array
    {
        $subject = $this->subject();

        if ($this->result !== SaveUserResult::SUCCESS || ! $subject instanceof User) {
            return parent::actions();
        }

        return [
            ...parent::actions(),
            Action::redirect(route('user.show', $subject), __('actions.view')),
        ];
    }
}
