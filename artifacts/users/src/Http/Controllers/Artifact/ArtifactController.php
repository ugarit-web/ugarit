<?php

namespace Ugarit\Artifacts\Users\Http\Controllers\Artifact;

use Heritage\Routing\Controller;
use Ugarit\Artifacts\Users\Capabilities\Artifact\ShowArtifactCapability;

/**
 * Handles the HTTP endpoint of the Users artifact summary.
 *
 * It answers JSON to clients expecting JSON (ResponderType::AUTO).
 */
class ArtifactController extends Controller
{
    /**
     * Show the summary of the artifact.
     *
     * @return mixed
     */
    public function show()
    {
        return $this->page(ShowArtifactCapability::class, null, 'users::artifact/Show');
    }
}
