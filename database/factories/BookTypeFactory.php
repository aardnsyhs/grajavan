<?php

namespace Database\Factories;

use App\Models\BookType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BookType>
 */
class BookTypeFactory extends Factory
{
    protected $model = BookType::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
