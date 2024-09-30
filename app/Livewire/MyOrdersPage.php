<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title('My Orders')]
class MyOrdersPage extends Component
{
    use WithPagination;

    public function render()
    {
        $my_orders = Order::with(['items.book'])->where('user_id', auth()->id())->latest()->paginate(5);

        return view('livewire.my-orders-page', [
            'orders' => $my_orders
        ]);
    }
}
