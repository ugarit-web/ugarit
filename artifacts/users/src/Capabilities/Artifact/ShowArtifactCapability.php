<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Capabilities\Artifact;

use Heritage\Capabilities\Capability;
use Heritage\Foundation\Support\ArtifactSummary;
use Heritage\Outcomes\Outcome;
use Throwable;
use Ugarit\Artifacts\Users\Enums\Artifact\Capabilities\ShowArtifactResult;

/**
 * Summarizes the Users artifact for its panel summary page: its manifest, totals, entities
 * (records, capabilities and features of each model) and latest activity, read by convention
 * by ArtifactSummary.
 */
class ShowArtifactCapability extends Capability
{
    /**
     * Execute the capability business logic.
     */
    protected function perform(): Outcome
    {
        return Outcome::fromResult(ShowArtifactResult::SUCCESS, ArtifactSummary::of('users'), $this->context());
    }

    /**
     * Build the outcome returned when perform() throws; unexpected exceptions are already reported.
     *
     * @param  Throwable  $e  The exception raised by perform().
     */
    protected function failed(Throwable $e): Outcome
    {
        return Outcome::fromResult(ShowArtifactResult::FAILED, null, $this->context());
    }

    /**
     * The placeholders of the feedback messages: the artifact's name.
     *
     * @return array<string, string>
     */
    protected function context(): array
    {
        $name = trans('users::artifact.name');

        return ['model' => $name, 'model_singular' => $name, 'entity' => $name];
    }
}
