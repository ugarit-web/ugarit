<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users;

use Heritage\Support\Artifact;
use Heritage\Support\ServiceProvider;

/**
 * Artifact manifest for the Users domain artifact.
 *
 * This file defines the identity, capabilities, providers, and dependencies
 * for the users artifact within the Ugarit ecosystem.
 */
return new class extends Artifact
{
    /**
     * The unique slug identifier for this artifact.
     */
    public string $id = 'users';

    /**
     * The human-readable display name of this artifact.
     */
    public string $name = 'Users Domain';

    /**
     * The semantic version of this artifact following Ugarit versioning (1.00.00).
     */
    public string $version = '1.00.00';

    /**
     * Human-readable description of what this artifact provides.
     */
    public string $description = 'Users domain artifact for Ugarit';

    /**
     * Technical capabilities exposed by this artifact to other artifacts.
     *
     * Keys are capability slugs, values describe what the capability provides.
     *
     * @var array<string, string>
     */
    public array $capabilities = [
        //
    ];

    /**
     * Service providers that should be registered when this artifact is loaded.
     *
     * @var array<int, class-string<ServiceProvider>>
     */
    public array $providers = [
        Providers\UsersServiceProvider::class,
    ];

    /**
     * Capability slugs required from other artifacts before this one can boot.
     *
     * @var array<int, string>
     */
    public array $requires = [
        //
    ];

    /**
     * Perform any bootstrap logic specific to this artifact.
     *
     * Called after all providers have been registered and booted.
     */
    public function boot(): void
    {
        // Internal users artifact bootstrap logic
    }
};
