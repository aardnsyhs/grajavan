<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
  protected $model = \App\Models\Order::class;

  public function definition()
  {
    return [
      'user_id' => User::factory(),
      'status' => 'Pending',
      'grand_total' => $this->faker->randomFloat(2, 100, 1000),
      'payment_method' => $this->faker->randomElement(['bank_transfer', 'credit_card', 'cod']),
      'payment_status' => $this->faker->randomElement(['pending', 'paid', 'failed']),
      'shipping_method' => $this->faker->randomElement(['standard', 'express', 'same_day']),
      'notes' => $this->faker->sentence,
    ];
  }
}
