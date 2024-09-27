<title>Invoice PDF</title>
<style>
    body {
        font-family: 'Arial, sans-serif';
        margin: 0;
        padding: 20px;
        background-color: #f7fafc;
    }

    .container {
        max-width: 85rem;
        margin: auto;
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1,
    h2 {
        color: #2d3748;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        margin-bottom: 20px;
    }

    th,
    td {
        padding: 8px 12px;
        border: 1px solid #e2e8f0;
        text-align: left;
    }

    th {
        background-color: #edf2f7;
        color: #2d3748;
    }

    .invoice-header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
    }

    .invoice-details p {
        margin: 0;
        color: #4a5568;
    }

    .invoice-total {
        display: flex;
        justify-content: flex-end;
        margin-top: 20px;
    }

    .invoice-total div {
        text-align: right;
    }

    .invoice-total p {
        margin: 5px 0;
    }

    .text-bold {
        font-weight: bold;
    }

    .text-gray {
        color: #4a5568;
    }

    .border-top {
        border-top: 1px solid #e2e8f0;
    }
</style>
</head>

<body>
    <div class="container">
        <h1>Invoice</h1>

        <div class="invoice-header">
            <div class="invoice-details">
                <h2>Ditagih ke:</h2>
                <p class="text-bold">{{ $order->address->full_name }}</p>
                <p>{{ $order->address->street_address }}</p>
                <p>{{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->postal_code }}</p>
                <p>No Telepon: {{ $order->address->phone }}</p>
            </div>

            <div class="invoice-details">
                <p><span class="text-bold">Invoice number:</span> {{ $order->id }}</p>
                <p><span class="text-bold">Tanggal Pembelian:</span> {{ $order->created_at->format('d-m-Y') }}</p>
                <p><span class="text-bold">Metode Pembayaran:</span>
                    {{ $order->payment_method == 'cod' ? 'Cash On Delivery' : 'Card' }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ Number::currency($item->unit_price, 'IDR') }}</td>
                        <td>{{ Number::currency($item->total_price, 'IDR') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="invoice-total">
            <div>
                <p><span class="text-gray">Subtotal:</span> {{ Number::currency($order->grand_total, 'IDR') }}</p>
                <p><span class="text-gray">Pajak:</span> {{ Number::currency(0, 'IDR') }}</p>
                <p><span class="text-gray">Kurir:</span> {{ Number::currency(0, 'IDR') }}</p>
                <p class="text-bold border-top">Grand total: {{ Number::currency($order->grand_total, 'IDR') }}</p>
            </div>
        </div>
    </div>
</body>
