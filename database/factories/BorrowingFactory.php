<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Client;
use App\Models\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Borrowing>
 */
class BorrowingFactory extends Factory
{
    public function definition(): array
    {
        $borrowedAt = fake()->dateTimeBetween('-30 days', 'now');

        return [
            'client_id' => Client::factory(),
            'book_id' => Book::factory(),
            'staff_id' => Staff::factory(),
            'borrowed_at' => $borrowedAt,
            'due_at' => (clone $borrowedAt)->modify('+14 days'),
            'returned_at' => null,
        ];
    }

    // Mark the borrowing as returned a few days after it started
    public function returned(): static
    {
        return $this->state(fn (array $attributes) => [
            'returned_at' => (clone $attributes['borrowed_at'])->modify('+'.fake()->numberBetween(1, 14).' days'),
        ]);
    }
}
