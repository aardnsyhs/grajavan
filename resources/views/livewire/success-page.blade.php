<div class="print-area">
    <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto my-4 sm:my-10">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <div class="mb-5 pb-5 flex justify-between items-center border-b border-gray-200 dark:border-neutral-700">
                <div>
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-neutral-200">Invoice</h2>
                </div>
                <div class="inline-flex gap-x-2 no-print">
                    <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none focus:outline-none focus:bg-gray-50 dark:bg-transparent dark:border-neutral-700 dark:text-neutral-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                        href="{{ route('orders.invoice.pdf', $order->id) }}">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                            <polyline points="7 10 12 15 17 10" />
                            <line x1="12" x2="12" y1="15" y2="3" />
                        </svg>
                        Invoice PDF
                    </a>
                    <button
                        class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                        onclick="window.print(); return false;">
                        <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <polyline points="6 9 6 2 18 2 18 9" />
                            <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2" />
                            <rect width="12" height="8" x="6" y="14" />
                        </svg>
                        Print
                    </button>
                </div>
            </div>
            <div class="grid md:grid-cols-2 gap-3">
                <div>
                    <div class="grid space-y-3">
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Ditagih ke:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-semibold">{{ $order->address->full_name }}</span>
                                <address class="not-italic font-normal">
                                    {{ $order->address->street_address }}<br>
                                    {{ $order->address->city }}, {{ $order->address->state }},
                                    {{ $order->address->postal_code }}<br>
                                    No Telepon: {{ $order->address->phone }}
                                </address>
                            </dd>
                        </dl>
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Detail alamat:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                <span class="block font-semibold">{{ $order->address->full_name }}</span>
                                <address class="not-italic font-normal">
                                    {{ $order->address->street_address }}<br>
                                    {{ $order->address->city }}, {{ $order->address->state }},
                                    {{ $order->address->postal_code }}<br>
                                    No Telepon: {{ $order->address->phone }}
                                </address>
                            </dd>
                        </dl>
                    </div>
                </div>
                <div>
                    <div class="grid space-y-3">
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Invoice number:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{ $order->id }}
                            </dd>
                        </dl>
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Tanggal Pembelian:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{ $order->created_at->format('d-m-Y') }}
                            </dd>
                        </dl>
                        <dl class="flex flex-col sm:flex-row gap-x-3 text-sm">
                            <dt class="min-w-36 max-w-[200px] text-gray-500 dark:text-neutral-500">
                                Metode Pembayaran:
                            </dt>
                            <dd class="font-medium text-gray-800 dark:text-neutral-200">
                                {{ $order->payment_method == 'cod' ? 'Cash On Delivery' : 'Card' }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>
            <div class="mt-6 border border-gray-200 p-4 rounded-lg space-y-4 dark:border-neutral-700">
                <div class="hidden sm:grid sm:grid-cols-5">
                    <div class="sm:col-span-2 text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Item
                    </div>
                    <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Jumlah
                    </div>
                    <div class="text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Harga
                    </div>
                    <div class="text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Total</div>
                </div>
                <div class="hidden sm:block border-b border-gray-200 dark:border-neutral-700"></div>
                @foreach ($order->items as $item)
                    <div class="grid grid-cols-3 sm:grid-cols-5 gap-2">
                        <div class="col-span-full sm:col-span-2">
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Item
                            </h5>
                            <p class="font-medium text-gray-800 dark:text-neutral-200">{{ $item->title }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">Qty
                            </h5>
                            <p class="text-gray-800 dark:text-neutral-200">{{ $item->quantity }}</p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Price
                            </h5>
                            <p class="text-gray-800 dark:text-neutral-200">
                                {{ Number::currency($item->unit_price, 'IDR') }}
                            </p>
                        </div>
                        <div>
                            <h5 class="sm:hidden text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                Subtotal
                            </h5>
                            <p class="sm:text-end text-gray-800 dark:text-neutral-200">
                                {{ Number::currency($item->total_price, 'IDR') }}</p>
                        </div>
                    </div>
                    <div class="sm:hidden border-b border-gray-200 dark:border-neutral-700"></div>
                @endforeach
            </div>
            <div class="mt-8 flex sm:justify-end">
                <div class="w-full max-w-2xl sm:text-end space-y-2">
                    <div class="grid grid-cols-2 sm:grid-cols-1 gap-3 sm:gap-2">
                        <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                            <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Subtotal:</dt>
                            <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                {{ Number::currency($order->grand_total, 'IDR') }}</dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                            <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Pajak:</dt>
                            <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                {{ Number::currency(0, 'IDR') }}</dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                            <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Kurir:</dt>
                            <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                {{ Number::currency(0, 'IDR') }}</dd>
                        </dl>
                        <dl class="grid sm:grid-cols-5 gap-x-3 text-sm">
                            <dt class="col-span-3 text-gray-500 dark:text-neutral-500">Grand total:</dt>
                            <dd class="col-span-2 font-medium text-gray-800 dark:text-neutral-200">
                                {{ Number::currency($order->grand_total, 'IDR') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
