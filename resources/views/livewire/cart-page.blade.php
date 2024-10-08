<section class="antialiased dark:bg-gray-900 md:py-16">
    <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Keranjang</h2>
        <div class="mt-6 sm:mt-8 lg:flex lg:space-x-8">
            <div class="lg:w-2/3 space-y-6">
                @forelse($cart_items as $item)
                    <div class="w-full flex-none" wire:key="{{ $item['book_id'] }}">
                        <div class="space-y-6">
                            <div
                                class="rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 md:p-6">
                                <div class="md:flex md:items-center md:justify-between md:gap-6 space-y-4 md:space-y-0">
                                    <a wire:navigate href="/books/{{ $item['book_id'] }}" class="shrink-0">
                                        <img class="h-20 w-20 object-contain" src="{{ url('storage', $item['image']) }}"
                                            alt="{{ $item['title'] }}" loading="lazy" />
                                    </a>
                                    <div class="w-full min-w-0 flex-1 md:max-w-md">
                                        <a wire:navigate href="/books/{{ $item['book_id'] }}"
                                            class="text-base font-medium text-gray-900 hover:underline dark:text-white">{{ $item['title'] }}</a>
                                        <div class="flex items-center gap-4">
                                            <button wire:click="removeItem('{{ $item['book_id'] }}')" type="button"
                                                class="inline-flex items-center text-sm font-medium text-red-600 hover:underline dark:text-red-500">
                                                <svg class="mr-1.5 h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Hapus
                                            </button>
                                        </div>
                                    </div>
                                    <div class="flex items-center">
                                        <button wire:click="decreaseQty('{{ $item['book_id'] }}')" type="button"
                                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M1 1h16" />
                                            </svg>
                                        </button>
                                        <span
                                            class="w-10 shrink-0 border-0 bg-transparent text-center text-sm font-medium text-gray-900 dark:text-white">{{ $item['quantity'] }}</span>
                                        <button wire:click="increaseQty('{{ $item['book_id'] }}')" type="button"
                                            class="inline-flex h-5 w-5 shrink-0 items-center justify-center rounded-md border border-gray-300 bg-gray-100 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-700">
                                            <svg class="h-2.5 w-2.5 text-gray-900 dark:text-white"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="text-end md:w-32">
                                        <p class="text-base font-bold text-gray-900 dark:text-white">
                                            {{ Number::currency($item['total_price'], 'IDR') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-full text-center py-8">
                        <p class="text-gray-600 dark:text-gray-300 text-xl font-medium">Keranjang Anda kosong. Mulai
                            belanja sekarang!</p>
                        <a href="/books"
                            class="mt-4 inline-block bg-blue-600 text-white px-5 py-3 rounded-lg text-sm hover:bg-blue-700">Belanja
                            Buku</a>
                    </div>
                @endforelse
            </div>
            <div class="lg:w-1/3 space-y-6 mt-6 lg:mt-0">
                <div
                    class="space-y-4 rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6">
                    <p class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan total</p>
                    <div class="space-y-4">
                        <div class="space-y-2">
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ Number::currency($grand_total, 'IDR') }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pajak</dt>
                                <dd class="text-base font-medium text-gray-900">{{ Number::currency(0, 'IDR') }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya pengiriman</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ Number::currency(0, 'IDR') }}</dd>
                            </dl>
                        </div>
                        <dl
                            class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
                            <dt class="text-base font-bold text-gray-900 dark:text-white">Grand Total</dt>
                            <dd class="text-base font-bold text-gray-900 dark:text-white">
                                {{ Number::currency($grand_total, 'IDR') }}</dd>
                        </dl>
                    </div>
                    @if ($cart_items)
                        <a href="/checkout"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Checkout</a>
                    @endif
                    <div class="flex items-center justify-center gap-2">
                        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">atau</span>
                        <a href="/books"
                            class="inline-flex items-center gap-2 text-sm font-medium text-primary-700 underline hover:no-underline dark:text-primary-500">Lanjutkan
                            Belanja
                            <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m14 0-4 4m4-4-4-4" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
