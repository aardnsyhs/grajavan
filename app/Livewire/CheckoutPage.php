<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Mail\OrderPlaced;
use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Livewire\Attributes\Title;
use Livewire\Component;
use Midtrans\Config as MidtransConfig;
use Midtrans\Snap;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Component\Uid\Uuid;

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
            'payment_method' => 'required|in:stripe,midtrans,cod',
        ]);
    
        $cart_items = CartManagement::getCartItemsFromCookie();
        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->payment_method = $this->payment_method;
        $order->payment_status = 'pending';
        $order->status = 'new';
        $order->grand_total = CartManagement::calculateGrandTotal($cart_items);
        $order->shipping_method = 'none';
        $order->notes = 'Order placed by '. auth()->user()->name;

        $order->save();
    
        $address = new Address();
        $address->first_name = $this->first_name;
        $address->last_name = $this->last_name;
        $address->phone = $this->phone;
        $address->street_address = $this->street_address;
        $address->city = $this->city;
        $address->state = $this->state;
        $address->postal_code = $this->postal_code;
        $address->order_id = $order->id;
        $address->save();
    
        $redirect_url = '';
        Log::info('Place order started');
    
        if ($this->payment_method == 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));
    
            $sessionCheckout = Session::create([
                'payment_method_types' => ['card'],
                'customer_email' => auth()->user()->email,
                'line_items' => array_map(function ($item) {
                    return [
                        'price_data' => [
                            'currency' => 'idr',
                            'unit_amount' => $item['unit_price'] * 100,
                            'product_data' => [
                                'name' => $item['title'],
                            ]
                        ],
                        'quantity' => $item['quantity'],
                    ];
                }, $cart_items),
                'mode' => 'payment',
                'success_url' => url('/success?session_id={CHECKOUT_SESSION_ID}'),
                'cancel_url' => route('cancel'),
            ]);
            CartManagement::clearCartItemsFromCookie();
            $redirect_url = $sessionCheckout->url;
    
        } elseif ($this->payment_method == 'midtrans') {
            Log::info('Midtrans payment initiated');
    
            MidtransConfig::$serverKey = config('midtrans.server_key');
            MidtransConfig::$isProduction = config('midtrans.is_production');
            MidtransConfig::$isSanitized = true;
            MidtransConfig::$is3ds = true;
    
            $params = [
                'transaction_details' => [
                    'order_id' => $order->id,
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
                'callbacks' => [
                    'finish' => url('/success')
                ]
            ];
    
            try {
                $snapToken = Snap::getSnapToken($params);
                $redirect_url = config('midtrans.is_production')
                    ? 'https://app.midtrans.com/snap/v2/vtweb/'.$snapToken
                    : 'https://app.sandbox.midtrans.com/snap/v2/vtweb/'.$snapToken;
    
                Log::info('Midtrans token generated: ' . $snapToken);
    
                $orderItem = new OrderItem();
                $orderItem->order_id = $order->id;
                $orderItem->book_id = $cart_items[0]['book_id'];
                $orderItem->quantity = $cart_items[0]['quantity'];
                $orderItem->unit_price = $cart_items[0]['unit_price'];
                $orderItem->total_price = $cart_items[0]['total_price'];
                $orderItem->save();

                return redirect($redirect_url);
            } catch (\Exception $e) {
                Log::error('Midtrans Error: ' . $e->getMessage());
                return response()->json(['error' => $e->getMessage()]);
            }
        }

        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->book_id = $cart_items[0]['book_id'];
        $orderItem->quantity = $cart_items[0]['quantity'];
        $orderItem->unit_price = $cart_items[0]['unit_price'];
        $orderItem->total_price = $cart_items[0]['total_price'];
        $orderItem->save();

        return redirect($redirect_url);
    }

    // public function handleMidtransCallback(Request $request)
    // {
    //     Log::info('Midtrans callback diterima', ['data' => $request->all()]);
    
    //     $serverKey = config('midtrans.server_key');
    //     $transaction_status = $request->input('transaction_status');
    //     $order_id = $request->input('order_id');
    //     $signature_key = $request->input('signature_key');
    //     $gross_amount = $request->input('gross_amount');
    
    //     $calculated_signature_key = hash("sha512", $order_id.$gross_amount.$serverKey);
    
    //     if ($calculated_signature_key !== $signature_key) {
    //         Log::error('Invalid signature key received from Midtrans');
    //         return response()->json(['message' => 'Invalid signature key'], 403);
    //     }
    
    //     $order = Order::where('id', $order_id)->first();
    
    //     if ($order) {
    //         Log::info('Order ditemukan, mulai memproses status transaksi');
    
    //         if ($transaction_status == 'settlement') {
    //             $order->payment_status = 'paid';
    //             $order->status = 'completed';
    
    //             CartManagement::clearCartItemsFromCookie();
    //             Log::info('Keranjang telah dikosongkan setelah pembayaran sukses.');
    
    //             Mail::to($order->user->email)->send(new OrderPlaced($order));
    //         } elseif ($transaction_status == 'deny') {
    //             $order->payment_status = 'denied';
    //             $order->status = 'failed';
    //         } elseif ($transaction_status == 'expire') {
    //             $order->payment_status = 'expired';
    //             $order->status = 'failed';
    //         }
    
    //         $order->save();
    //     } else {
    //         Log::error('Order dengan ID ' . $order_id . ' tidak ditemukan.');
    //     }
    
    //     return response()->json(['message' => 'Payment processed']);
    // }

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
