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
    <h1 class="text-4xl font-bold text-slate-900 dark:text-gray-200">Detail Pesanan</h1>
    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mt-5">
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Pelanggan
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2 dark:text-gray-200">
                        <div>{{ $address->full_name }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 22h14" />
                        <path d="M5 2h14" />
                        <path d="M17 22v-4.172a2 2 0 0 0-.586-1.414L12 12l-4.414 4.414A2 2 0 0 0 7 17.828V22" />
                        <path d="M7 2v4.172a2 2 0 0 0 .586 1.414L12 12l4.414-4.414A2 2 0 0 0 17 6.172V2" />
                    </svg>
                </div>
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Tanggal Pesanan
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <h3 class="text-xl font-medium text-gray-800 dark:text-gray-200">
                            {{ $order->created_at->format('d-m-Y') }}
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M21 11V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h6" />
                        <path d="m12 12 4 10 1.7-4.3L22 16Z" />
                    </svg>
                </div>
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Status Pesanan
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <span
                            class="{{ $statusClasses[$order->status] ?? 'bg-gray-500 py-1 px-3 rounded text-white shadow' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col bg-white border shadow-sm rounded-xl dark:bg-slate-900 dark:border-gray-800">
            <div class="p-4 md:p-5 flex gap-x-4">
                <div
                    class="flex-shrink-0 flex justify-center items-center size-[46px] bg-gray-100 rounded-lg dark:bg-gray-800">
                    <svg class="flex-shrink-0 size-5 text-gray-600 dark:text-gray-400"
                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 12s2.545-5 7-5c4.454 0 7 5 7 5s-2.546 5-7 5c-4.455 0-7-5-7-5z" />
                        <path d="M12 13a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                        <path d="M21 17v2a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-2" />
                        <path d="M21 7V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v2" />
                    </svg>
                </div>
                <div class="grow">
                    <div class="flex items-center gap-x-2">
                        <p class="text-xs uppercase tracking-wide text-gray-500">
                            Status Pembayaran
                        </p>
                    </div>
                    <div class="mt-1 flex items-center gap-x-2">
                        <span
                            class="{{ $paymentStatusClasses[$order->payment_status] ?? 'bg-gray-500 py-1 px-3 rounded text-white shadow' }}">
                            {{ ucfirst($order->payment_status) }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col md:flex-row gap-4 mt-4">
        <div class="md:w-3/4">
            <div
                class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4 dark:bg-slate-900 dark:border-gray-800 dark:text-gray-200">
                <table class="w-full">
                    <thead>
                        <tr>
                            <th class="text-left font-semibold">Buku</th>
                            <th class="text-left font-semibold">Harga</th>
                            <th class="text-left font-semibold">Jumlah</th>
                            <th class="text-left font-semibold">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_items as $item)
                            <tr wire:key="{{ $item->id }}">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 mr-4 object-contain"
                                            src="{{ url('storage', $item->book->image) }}"
                                            alt="{{ $item->book->title }}" loading="lazy">
                                        <span class="font-semibold">{{ $item->book->title }}</span>
                                    </div>
                                </td>
                                <td class="py-4">{{ Number::currency($item->unit_price, 'IDR') }}</td>
                                <td class="py-4">
                                    <span class="text-center w-8">{{ $item->quantity }}</span>
                                </td>
                                <td class="py-4">{{ Number::currency($item->total_price, 'IDR') }}</td>
                                <td class="py-4">
                                    @if ($order->status == 'delivered')
                                        <button type="button" data-modal-target="review-modal"
                                            data-modal-toggle="review-modal"
                                            class="bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-500 ms-2">Berikan
                                            Ulasan</button>
                                        <livewire:product-review-modal :order="$order" :bookId="$item->book->id" />
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="bg-white overflow-x-auto rounded-lg shadow-md p-6 mb-4  dark:bg-slate-900 dark:border-gray-800 dark:text-gray-200">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-gray-200 mb-3">Alamat Pengiriman</h1>
                <div class="flex justify-between items-center">
                    <div>
                        <p>{{ $address->street_address }}, {{ $address->city }}, {{ $address->state }},
                            {{ $address->postal_code }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Nomor Telepon:</p>
                        <p>{{ $address->phone }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-1/4">
            <div class="bg-white rounded-lg shadow-md p-6 dark:bg-slate-900 dark:border-gray-800 dark:text-gray-200">
                <h2 class="text-lg font-semibold mb-4">Ringkasan</h2>
                <div class="flex justify-between mb-2">
                    <span>Subtotal</span>
                    <span>{{ Number::currency($item->order->grand_total, 'IDR') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Pajak</span>
                    <span>{{ Number::currency(0, 'IDR') }}</span>
                </div>
                <div class="flex justify-between mb-2">
                    <span>Kurir</span>
                    <span>{{ Number::currency(0, 'IDR') }}</span>
                </div>
                <hr class="my-2">
                <div class="flex justify-between mb-2">
                    <span class="font-semibold">Grand Total</span>
                    <span class="font-semibold">{{ Number::currency($item->order->grand_total, 'IDR') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
