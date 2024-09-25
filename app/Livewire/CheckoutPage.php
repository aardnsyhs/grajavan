<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Attributes\Title;
use Livewire\Component;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Stripe\Checkout\Session;
use Stripe\Stripe;

#[Title('Checkout')]
class CheckoutPage extends Component
{
    public $first_name;
    public $last_name;
    public $phone;
    public $street_address;
    public $city;
    public $state;
    public $postal_code;
    public $payment_method;

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (count($cart_items) == 0) {
            return redirect('/books');
        }
    }

    public function placeOrder()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
            'payment_method' => 'required|in:stripe,midtrans', // Validasi tambahan untuk metode pembayaran
        ]);

        $cart_items = CartManagement::getCartItemsFromCookie();
        $line_items = [];

        foreach ($cart_items as $item) {
            $line_items[] = [
                'price_data' => [
                    'currency' => 'idr',
                    'unit_amount' => $item['unit_price'] * 100,
                    'product_data' => [
                        'name' => $item['title'],
                    ]
                ],
                'quantity' => $item['quantity'],
            ];
        }

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by '. auth()->user()->name;

        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->postal_code = $this->postal_code;

        $redirect_url = '';

        Log::info('Place order started');

        if ($this->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => url('/success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => route('cancel'),
            ]);

            $redirect_url = $sessionCheckout->url;

        } elseif ($this->payment_method == 'midtrans') {
            Log::info('Midtrans payment initiated');
            
            MidtransConfig::$serverKey = config('midtrans.server_key');
            MidtransConfig::$isProduction = config('midtrans.is_production');
            MidtransConfig::$isSanitized = true;
            MidtransConfig::$is3ds = true;

            $params = [
                'transaction_details' => [
                    'order_id' => uniqid(),
                    'gross_amount' => $order->grand_total,
                ],
                'customer_details' => [
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'email' => auth()->user()->email,
                    'phone' => $this->phone,
                ],
                'item_details' => array_map(function ($item) {
                    return [
                        'id' => $item['book_id'],
                        'price' => $item['unit_price'],
                        'quantity' => $item['quantity'],
                        'name' => $item['title'],
                    ];
                }, $cart_items),
            ];

            try {
                $snapToken = Snap::getSnapToken($params);
                $redirect_url = config('midtrans.is_production') 
                    ? 'https://app.midtrans.com/snap/v2/vtweb/'.$snapToken 
                    : 'https://app.sandbox.midtrans.com/snap/v2/vtweb/'.$snapToken;
                
                Log::info('Midtrans token generated: ' . $snapToken);
            } catch (\Exception $e) {
                Log::error('Midtrans Error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }

        $order->save();
        $address->order_id = $order->id;
        $address->save();
        $order->items()->createMany($cart_items);
        CartManagement::clearCartItemsFromCookie();
        Mail::to(auth()->user())->send(new OrderPlaced($order));

        return redirect($redirect_url);
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total
        ]);
    }
}
