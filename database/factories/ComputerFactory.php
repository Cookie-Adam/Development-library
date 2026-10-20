<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Computer>
 */
class ComputerFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'PC-'.str_pad((string) fake()->unique()->numberBetween(1, 99), 2, '0', STR_PAD_LEFT),
            'status' => 'available',
        ];
    }
}
