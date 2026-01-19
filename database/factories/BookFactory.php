<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
  protected $model = Book::class;

  public function definition()
  {
    return [
      'title' => $this->faker->sentence,
      'author' => $this->faker->name,
      'year' => $this->faker->year,
      'rating' => $this->faker->randomFloat(1, 0, 5),
      'description' => $this->faker->paragraph,
      'category_id' => Category::factory(),
      'image' => $this->faker->imageUrl(640, 480, 'books', true),
      'price' => $this->faker->numberBetween(10000, 500000),
      'is_active' => $this->faker->boolean(80),
    ];
  }
}
