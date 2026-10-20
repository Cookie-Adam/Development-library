<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Computer;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\ComputerSession>
 */
class ComputerSessionFactory extends Factory
{
    public function definition(): array
    {
        $startedAt = fake()->dateTimeBetween('-7 days', '-1 hour');

        return [
            'client_id' => Client::factory(),
            'computer_id' => Computer::factory(),
            'staff_id' => Staff::factory(),
            'started_at' => $startedAt,
            'ended_at' => (clone $startedAt)->modify('+'.fake()->numberBetween(15, 120).' minutes'),
        ];
    }

    // Session still running
    public function active(): static
    {
        return $this->state(fn () => ['started_at' => now()->subMinutes(fake()->numberBetween(5, 60)), 'ended_at' => null]);
    }
}
