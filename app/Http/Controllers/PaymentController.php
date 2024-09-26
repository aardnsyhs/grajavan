<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Support\Facades\Request;
use Midtrans\Config as MidtransConfig;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function midtransNotification(Request $request)
    {
        MidtransConfig::$serverKey = config('midtrans.server_key');
        MidtransConfig::$isProduction = config('midtrans.is_production');
        MidtransConfig::$isSanitized = true;
        MidtransConfig::$is3ds = true;

        $notification = new Notification();

        $transaction_status = $notification->transaction_status;
        $order_id = $notification->order_id;

        $order = Order::where('order_id', $order_id)->first();

        if ($order) {
            if ($transaction_status == 'settlement') {
                $order->payment_status = 'paid';
                $order->status = 'completed';
                $order->save();
                
                return redirect()->route('success', ['order_id' => $order_id]);
            } else {
            }
        }
    }
}
