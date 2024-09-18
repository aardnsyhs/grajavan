<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\BookType;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order_items>
 */
class OrderItemFactory extends Factory
{
    protected $model = \App\Models\OrderItem::class;

    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'book_id' => Book::factory(),
            'book_type_id' => BookType::factory(),
            'quantity' => $this->faker->numberBetween(1, 5),
            'price' => $this->faker->randomFloat(2, 50, 200),
        ];
    }
}
