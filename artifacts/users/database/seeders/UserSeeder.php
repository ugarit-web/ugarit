<?php

declare(strict_types=1);

namespace Ugarit\Artifacts\Users\Database\Seeders;

use Heritage\Database\Seeder;
use Ugarit\Artifacts\Identity\Models\Entity;
use Ugarit\Artifacts\Users\Models\User;

/**
 * Database seeder for Users.
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure admin user exists for entity_id 1
        $adminEntity = Entity::find(1);

        if ($adminEntity) {
            $user = User::firstOrCreate([
                'entity_id' => $adminEntity->id,
            ], [
                'username' => 'admin',
            ]);

            if (! $user->currentPassword) {
                $user->setPassword('password');
            }
        }
    }
}
