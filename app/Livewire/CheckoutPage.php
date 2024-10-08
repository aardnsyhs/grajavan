<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Models\Order;
use App\Models\Address;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Title;
use Livewire\Component;
use Midtrans\Config;
use Midtrans\Snap;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Stripe;

#[Title("Checkout")]
class CheckoutPage extends Component
{
    public $first_name, $last_name, $phone, $street_address, $city, $state, $postal_code, $payment_method;

    public function mount()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        if (empty($cart_items)) {
            return redirect('/books');
        }
    }

    public function placeOrder()
    {
        $this->validateOrderData();
    
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);
        $response = null;
    
        switch ($this->payment_method) {
            case 'stripe':
                $response = $this->processStripePayment($cart_items, $grand_total);
                break;
            case 'midtrans':
                $response = $this->processMidtransPayment($cart_items, $grand_total);
                break;
            case 'cod':
                $response = $this->processCodPayment();
                break;
            default:
                $response = redirect()->back()->with('error', 'Invalid payment method');
                break;
        }
    
        return $response;
    }

    private function validateOrderData()
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
    }

    private function processCodPayment()
    {
        $this->saveOrder('cod', 'pending');
        return redirect()->route('success');
    }

    private function processMidtransPayment($cart_items, $grand_total)
    {
        $this->setupMidtransConfig();

        try {
            $this->storeSessionData($cart_items);

            $params = $this->getMidtransParams($cart_items, $grand_total);
            $snapToken = Snap::getSnapToken($params);

            return redirect()->to("https://app.sandbox.midtrans.com/snap/v2/vtweb/" . $snapToken);
        } catch (\Exception $e) {
            Log::error('Midtrans payment initiation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to process Midtrans payment. Please try again.');
        }
    }

    private function setupMidtransConfig()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    private function storeSessionData($cart_items)
    {
        session([
            'midtrans_customer' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'phone' => $this->phone,
                'street_address' => $this->street_address,
                'city' => $this->city,
                'state' => $this->state,
                'postal_code' => $this->postal_code,
            ],
            'midtrans_cart_items' => $cart_items,
        ]);
    }

    private function getMidtransParams($cart_items, $grand_total)
    {
        return [
            'transaction_details' => [
                'order_id' => 'order-temp-' . time(),
                'gross_amount' => $grand_total,
            ],
            'customer_details' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'email' => auth()->user()->email,
                'phone' => $this->phone,
            ],
            'item_details' => $this->getItemDetails($cart_items),
            'callbacks' => [
                'finish' => url('/midtrans/callback'),
            ]
        ];
    }

    private function getItemDetails($cart_items)
    {
        return array_map(function ($item) {
            return [
                'id' => $item['book_id'],
                'price' => $item['unit_price'],
                'quantity' => $item['quantity'],
                'name' => $item['title'],
            ];
        }, $cart_items);
    }

    public function saveOrder($payment_method, $payment_status = 'pending')
    {
        $cart_items = CartManagement::getCartItemsFromCookie();

        $order = Order::create([
            'user_id' => auth()->id(),
            'grand_total' => CartManagement::calculateGrandTotal($cart_items),
            'payment_method' => $payment_method,
            'payment_status' => $payment_status,
            'status' => "new",
            'currency' => "idr",
            'shipping_amount' => 0,
            'shipping_method' => ($payment_method == 'cod') ? 'cod' : 'none',
            'notes' => "Order placed by " . auth()->user()->name,
        ]);

        Address::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'order_id' => $order->id,
        ]);

        foreach ($cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item['book_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['unit_price'] * $item['quantity'],
            ]);
        }

        CartManagement::clearCartItemsFromCookie();

        return $order->id;
    }

    private function processStripePayment($cart_items)
    {
        Stripe::setApiKey(env("STRIPE_SECRET"));

        try {
            $session = StripeSession::create([
                "payment_method_types" => ["card"],
                "customer_email" => auth()->user()->email,
                "line_items" => $this->prepareStripeLineItems($cart_items),
                "mode" => "payment",
                "success_url" => route('stripe.success') . "?session_id={CHECKOUT_SESSION_ID}",
                "cancel_url" => route('cancel'),
                "metadata" => $this->getStripeMetadata(),
            ]);

            return redirect($session->url);
        } catch (\Exception $e) {
            Log::error('Stripe session creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Unable to process Stripe payment. Please try again.');
        }
    }

    private function prepareStripeLineItems($cart_items)
    {
        return array_map(function ($item) {
            return [
                "price_data" => [
                    'currency' => 'idr',
                    'unit_amount' => $item['unit_price'] * 100,
                    "product_data" => [
                        "name" => $item['title'],
                    ],
                ],
                "quantity" => $item['quantity'],
            ];
        }, $cart_items);
    }

    private function getStripeMetadata()
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'user_id' => auth()->user()->id,
        ];
    }

    public function handleMidtransCallback(Request $request)
    {
        $cart_items = session('midtrans_cart_items');
        $customer_details = session('midtrans_customer');

        if (!$cart_items || !$customer_details) {
            return redirect()->route('checkout.failed')->with('error', 'Session expired.');
        }

        $transaction_status = $request->input('transaction_status');
        if (in_array($transaction_status, ['capture', 'settlement'])) {
            $this->saveOrderWithAddress(
                'midtrans',
                'paid',
                $customer_details
            );

            session()->forget(['midtrans_customer', 'midtrans_cart_items']);
            return redirect()->route('success');
        }

        return redirect()->route('checkout.failed')->with('error', 'Payment failed.');
    }

    public function handleStripeSuccess(Request $request)
    {
        $session_id = $request->get('session_id');
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = StripeSession::retrieve($session_id);

            if ($session->payment_status === 'paid') {
                $this->saveOrderWithAddress(
                    'stripe',
                    'paid',
                    $session->metadata
                );

                return redirect()->route('success');
            }

            return redirect()->route('checkout.pending')->with('message', 'Pembayaran sedang diproses.');
        } catch (\Exception $e) {
            Log::error('Stripe session verification failed: ' . $e->getMessage());
            return redirect()->route('checkout.failed')->with('error', 'Gagal memverifikasi pembayaran.');
        }
    }

    private function saveOrderWithAddress($payment_method, $payment_status, $metadata)
    {
        $cart_items = CartManagement::getCartItemsFromCookie();

        $order = Order::create([
            'user_id' => auth()->user()->id,
            'grand_total' => CartManagement::calculateGrandTotal($cart_items),
            'payment_method' => $payment_method,
            'payment_status' => $payment_status,
            'status' => 'new',
            'currency' => 'idr',
            'shipping_amount' => 0,
            'shipping_method' => ($payment_method == 'cod') ? 'cod' : 'none',
            'notes' => 'Order placed by ' . auth()->user()->name,
        ]);

        Address::create([
            'first_name' => $metadata['first_name'],
            'last_name' => $metadata['last_name'],
            'phone' => $metadata['phone'],
            'street_address' => $metadata['street_address'],
            'city' => $metadata['city'],
            'state' => $metadata['state'],
            'postal_code' => $metadata['postal_code'],
            'order_id' => $order->id,
        ]);

        foreach ($cart_items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item['book_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total_price' => $item['unit_price'] * $item['quantity'],
            ]);
        }

        CartManagement::clearCartItemsFromCookie();
        return $order->id;
    }

    public function render()
    {
        $cart_items = CartManagement::getCartItemsFromCookie();
        $grand_total = CartManagement::calculateGrandTotal($cart_items);

        return view('livewire.checkout-page', [
            'cart_items' => $cart_items,
            'grand_total' => $grand_total,
        ]);
    }
}
