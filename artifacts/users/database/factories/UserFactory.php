<?php

namespace Ugarit\Artifacts\Users\Database\Factories;

use Heritage\Database\Eloquent\Factories\Factory;
use Ugarit\Artifacts\Identity\Models\Entity;
use Ugarit\Artifacts\Users\Models\User;

/**
 * Unified factory for User entities and their multilingual translations.
 *
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'entity_id' => Entity::factory(),
            'username' => $this->faker->words(2, true),
        ];
    }
}
