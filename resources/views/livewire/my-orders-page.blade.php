@php
    $statusClasses = [
        'new' => 'bg-blue-500 py-1 px-3 rounded text-white shadow',
        'processing' => 'bg-yellow-500 py-1 px-3 rounded text-white shadow',
        'shipped' => 'bg-green-500 py-1 px-3 rounded text-white shadow',
        'delivered' => 'bg-green-700 py-1 px-3 rounded text-white shadow',
        'cancelled' => 'bg-red-500 py-1 px-3 rounded text-white shadow',
    ];
    $paymentStatusClasses = [
        'paid' => 'bg-green-500 py-1 px-3 rounded text-white shadow',
        'pending' => 'bg-yellow-500 py-1 px-3 rounded text-white shadow',
        'failed' => 'bg-red-500 py-1 px-3 rounded text-white shadow',
    ];
@endphp
<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <h1 class="text-4xl font-bold text-slate-900 dark:text-white">Pesananku</h1>
    <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg dark:bg-slate-900">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Nomor
                                    pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Tanggal
                                    pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                    pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Status
                                    pembayaran</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Jumlah
                                    pesanan</th>
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="odd:bg-white even:bg-gray-100 dark:odd:bg-slate-900 dark:even:bg-slate-800"
                                    wire:key="{{ $order->id }}">
                                    <td
                                        class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        {{ $order->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $order->created_at->format('d-m-Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <span
                                            class="{{ $statusClasses[$order->status] ?? 'bg-gray-500 py-1 px-3 rounded text-white shadow' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        <span
                                            class="{{ $paymentStatusClasses[$order->payment_status] ?? 'bg-gray-500 py-1 px-3 rounded text-white shadow' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ Number::currency($order->grand_total, 'IDR') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a wire:navigate href="/my-orders/{{ $order->id }}"
                                            class="bg-slate-600 text-white py-2 px-4 rounded-md hover:bg-slate-500">
                                            Lihat Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            {{ $orders->links() }}
        </div>
    </div>
</div>
