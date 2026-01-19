<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Categories>
 */
class CategoryFactory extends Factory
{
  protected $model = Category::class;

  public function definition()
  {
    return [
      'name' => $this->faker->word,
      'image' => $this->faker->imageUrl(640, 480, 'categories', true),
      'is_active' => $this->faker->boolean(80),
    ];
  }
}
