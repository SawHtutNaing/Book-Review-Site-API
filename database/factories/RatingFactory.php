<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rating>
 */
class RatingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomUser = User::inRandomOrder()->first();
        $randomBook = Book::inRandomOrder()->first();
        return [
            'book_id' => $randomBook->id,
            'rating' => rand(10, 100),
            'user_id' => $randomUser->id
        ];
    }
}
