<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Book;
use App\Models\BookType;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = \App\Models\Cart::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'book_type_id' => BookType::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
