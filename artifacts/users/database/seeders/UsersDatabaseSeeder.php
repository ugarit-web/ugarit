<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Database\Seeders;

use Heritage\Database\Seeder;

/**
 * Master database seeder for the Users artifact domain.
 */
class UsersDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);
    }
}
