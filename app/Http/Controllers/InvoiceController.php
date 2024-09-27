<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class InvoiceController extends Controller
{
    public function generateInvoicePdf(Order $order)
    {
        $pdf = PDF::loadView('invoices.invoice-pdf', ['order' => $order]);
        
        return $pdf->download("invoice-{$order->id}.pdf");
    }
}
