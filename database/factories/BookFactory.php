<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    public function definition(): array
    {
        $copies = fake()->numberBetween(1, 5);

        return [
            'title' => fake()->sentence(3),
            'author' => fake()->name(),
            'isbn' => fake()->unique()->isbn13(),
            'category' => fake()->randomElement(['Fiction', 'Science', 'History', 'Technology', 'Children', 'Biography']),
            'copies' => $copies,
            'available_copies' => $copies, // seeder lowers this for active borrowings
        ];
    }
}
