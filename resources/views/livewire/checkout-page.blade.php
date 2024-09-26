<section class="antialiased dark:bg-gray-900 md:py-8">
    <form wire:submit.prevent="placeOrder"" class="mx-auto max-w-screen-xl px-4 2xl:px-0">
        <ol
            class="items-center flex w-full max-w-2xl text-center text-sm font-medium text-gray-500 dark:text-gray-400 sm:text-base">
            <li
                class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-white dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                <span
                    class="flex items-center after:mx-2 after:text-white after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                    <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Keranjang
                </span>
            </li>
            <li
                class="after:border-1 flex items-center text-primary-700 after:mx-6 after:hidden after:h-1 after:w-full after:border-b after:border-white dark:text-primary-500 dark:after:border-gray-700 sm:after:inline-block sm:after:content-[''] md:w-full xl:after:mx-10">
                <span
                    class="flex items-center after:mx-2 after:text-gray-200 after:content-['/'] dark:after:text-gray-500 sm:after:hidden">
                    <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Checkout
                </span>
            </li>
            <li class="flex shrink-0 items-center">
                <svg class="me-2 h-4 w-4 sm:h-5 sm:w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.5 11.5 11 14l4-4m6 2a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Ringkasan pesanan
            </li>
        </ol>
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12 xl:gap-16">
            <div class="min-w-0 flex-1 space-y-8">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <div class="space-y-4">
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Alamat Pengiriman</h2>
                        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                            <div>
                                <label for="first_name"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Depan</label>
                                <input wire:model="first_name" type="text" id="first_name"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('first_name') border-red-500 dark:border-red-500 @enderror" />
                                @error('first_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="last_name"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Nama Belakang*
                                </label>
                                <input wire:model="last_name" type="text" id="last_name"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500  @error('last_name') border-red-500 dark:border-red-500 @enderror" />
                                @error('last_name')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="phone"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    No Telepon*
                                </label>
                                <div class="flex items-center">
                                    <div class="relative w-full">
                                        <input wire:model="phone" type="number" id="phone"
                                            class="z-20 block w-full rounded-lg border border-s-0 border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:border-s-gray-700  dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500  @error('phone') border-red-500 dark:border-red-500 @enderror"
                                            pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" />
                                        @error('phone')
                                            <div class="text-red-500 text-sm">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div>
                                <label for="postal_code"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Kode Pos
                                </label>
                                <input wire:model="postal_code" type="number" id="postal_code"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500 @error('postal_code') border-red-500 dark:border-red-500 @enderror" />
                                @error('postal_code')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="city"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Kota
                                </label>
                                <input wire:model="city" type="text" id="city"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500  @error('city') border-red-500 dark:border-red-500 @enderror" />
                                @error('city')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label for="state"
                                    class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                    Provinsi
                                </label>
                                <input wire:model="state" type="text" id="state"
                                    class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500  @error('state') border-red-500 dark:border-red-500 @enderror" />
                                @error('state')
                                    <div class="text-red-500 text-sm">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div>
                            <label for="street_address"
                                class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">
                                Alamat Lengkap</label>
                            <input wire:model="street_address" type="text" id="street_address"
                                class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500  @error('street_address') border-red-500 dark:border-red-500 @enderror" />
                            @error('street_address')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <div class="space-y-4">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Metode Pembayaran</h3>
                        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="cod" type="radio" wire:model="payment_method"
                                            value="cod"
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                    </div>
                                    <div class="ms-4 text-sm">
                                        <label for="cod"
                                            class="font-medium leading-none text-gray-900 dark:text-white">Cash On
                                            Delivery</label>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="stripe" type="radio" wire:model="payment_method"
                                            value="stripe"
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                    </div>
                                    <div class="ms-4 text-sm">
                                        <label for="stripe"
                                            class="font-medium leading-none text-gray-900 dark:text-white">Stripe</label>
                                    </div>
                                </div>
                            </div>
                            <div
                                class="rounded-lg border border-gray-200 bg-gray-50 p-4 ps-4 dark:border-gray-700 dark:bg-gray-800">
                                <div class="flex items-start">
                                    <div class="flex h-5 items-center">
                                        <input id="midtrans" type="radio" wire:model="payment_method"
                                            value="midtrans"
                                            class="h-4 w-4 border-gray-300 bg-white text-primary-600 focus:ring-2 focus:ring-primary-600 dark:border-gray-600 dark:bg-gray-700 dark:ring-offset-gray-800 dark:focus:ring-primary-600" />
                                    </div>
                                    <div class="ms-4 text-sm">
                                        <label for="midtrans"
                                            class="font-medium leading-none text-gray-900 dark:text-white">Midtrans</label>
                                    </div>
                                </div>
                            </div>
                            @error('payment_method')
                                <div class="text-red-500 text-sm">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 w-full space-y-6 sm:mt-8 lg:mt-0 lg:max-w-xs xl:max-w-md">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Pesanan</h2>
                    <div class="flow-root">
                        <div class="my-3 divide-y divide-gray-200 dark:divide-gray-800">
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Subtotal</dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ Number::currency($grand_total, 'IDR') }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Pajak</dt>
                                <dd class="text-base font-medium text-gray-900">{{ Number::currency(0, 'IDR') }}
                                </dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Biaya Pengiriman
                                </dt>
                                <dd class="text-base font-medium text-gray-900 dark:text-white">
                                    {{ Number::currency(0, 'IDR') }}</dd>
                            </dl>
                            <dl class="flex items-center justify-between gap-4 py-3">
                                <dt class="text-base font-bold text-gray-900 dark:text-white">Grand Total</dt>
                                <dd class="text-base font-bold text-gray-900 dark:text-white">
                                    {{ Number::currency($grand_total, 'IDR') }}</dd>
                            </dl>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <button type="submit"
                            class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4  focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                            <span wire:loading.remove>Buat Pesanan</span>
                            <span wire:loading>Diproses...</span></button>
                    </div>
                </div>
                <div class="bg-white mt-4 rounded-xl shadow p-6 dark:bg-gray-800">
                    <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Ringkasan Keranjang</h2>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-800 mt-4" role="list">
                        @foreach ($cart_items as $item)
                            <li class="py-4" wire:key="{{ $item['book_id'] }}">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <img alt="{{ $item['title'] }}" class="w-12 h-12 object-contain"
                                            src="{{ url('storage', $item['image']) }}" loading="lazy" />
                                    </div>
                                    <div class="flex-1 min-w-0 ms-4">
                                        <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                            {{ $item['title'] }}
                                        </p>
                                        <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                            Quantity: {{ $item['quantity'] }}
                                        </p>
                                    </div>
                                    <div
                                        class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                        {{ Number::currency($item['total_price'], 'IDR') }}
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </form>
</section>
