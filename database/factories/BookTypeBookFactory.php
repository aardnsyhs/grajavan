<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookTypeBookFactory extends Factory
{
    protected $model = \App\Models\BookTypeBook::class;

    public function definition()
    {
        return [
            'book_id' => Book::factory(),
            'book_type_id' => BookType::factory(),
            'stock' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 10, 500),
        ];
    }
}
