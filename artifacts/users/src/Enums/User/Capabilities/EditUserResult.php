<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Enums\User\Capabilities;

use Heritage\Contracts\Result\ResultContract;
use Heritage\Enums\Concerns\ResolvesResultFeedback;

/**
 * Enum EditUserResult
 *
 * The results of an action. Feedback is read from `responses.*` by convention, within the
 * group of FEEDBACK (e.g. "translation.saved" reads under `responses.translation.`):
 * SUCCESS reads the FEEDBACK key, SUCCESS_X "{action}_x", FAILED "failed_{action}" and
 * FAILED_X "failed_x". Success cases answer 200, failures 400; override feedbackKey(),
 * feedbackContext(), variant() or statusCode() per case.
 */
enum EditUserResult: int implements ResultContract
{
    use ResolvesResultFeedback;

    /**
     * The base translation key of this result's feedback.
     */
    const FEEDBACK = 'edited';

    /**
     * Edit user succeeded; its feedback reads `responses.edited`.
     */
    case SUCCESS = 1;

    /**
     * Edit user failed; its feedback reads `responses.failed_edited`.
     */
    case FAILED = 2;
}
