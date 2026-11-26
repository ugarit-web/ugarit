<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Providers;

use Heritage\Support\ServiceProvider;

/**
 * Class UsersServiceProvider
 *
 * Service provider of the Users artifact domain. The kernel loads the artifact's
 * resources by convention: its config files, migrations, translations (users::file.key),
 * views (users::view) and routes/web.php and routes/api.php.
 */
class UsersServiceProvider extends ServiceProvider
{
    /**
     * Register users domain services into the IoC container.
     *
     * Bind interfaces, singletons, or any service-level dependencies here.
     */
    public function register(): void
    {
        // Users service bindings
    }

    /**
     * Bootstrap users domain services.
     *
     * This method is called after all providers have been registered.
     */
    public function boot(): void
    {
        // Users bootstrapping beyond the resources the kernel loads
    }
}
