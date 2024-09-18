<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\payments>
 */
class PaymentFactory extends Factory
{
    protected $model = \App\Models\Payment::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'payment_method' => $this->faker->creditCardType,
            'amount' => $this->faker->randomFloat(2, 100, 1000),
            'payment_date' => $this->faker->dateTimeThisYear,
        ];
    }
}
