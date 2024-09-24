<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-semibold mb-6 dark:text-white">Keranjang</h1>
        <div class="flex flex-col md:flex-row gap-8">
            <div class="md:w-3/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 mb-6">
                    <table class="w-full table-auto">
                        <thead>
                            <tr>
                                <th class="text-left font-semibold py-4 dark:text-white">Judul buku</th>
                                <th class="text-center font-semibold py-4 dark:text-white">Harga</th>
                                <th class="text-center font-semibold py-4 dark:text-white">Jumlah</th>
                                <th class="text-center font-semibold py-4 dark:text-white">Total</th>
                                <th class="text-center font-semibold py-4 dark:text-white">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cart_items as $item)
                                <tr wire:key="{{ $item['book_id'] }}"
                                    class="border-b last:border-none dark:border-gray-700">
                                    <td class="py-6">
                                        <div class="flex items-center space-x-4">
                                            <img class="h-20 w-16 object-cover rounded-lg shadow-sm"
                                                src="{{ url('storage', $item['image']) }}" alt="{{ $item['title'] }}"
                                                loading="lazy">
                                            <span
                                                class="font-semibold text-gray-800 dark:text-white">{{ $item['title'] }}</span>
                                        </div>
                                    </td>
                                    <td class="py-6 text-center text-gray-600 dark:text-gray-300">
                                        {{ Number::currency($item['unit_price'], 'IDR') }}
                                    </td>
                                    <td class="py-6 text-center">
                                        <div class="inline-flex items-center">
                                            <button wire:click="decreaseQty('{{ $item['book_id'] }}')"
                                                class="border border-gray-300 dark:border-gray-700 rounded-md py-1 px-3 hover:bg-gray-200 dark:hover:bg-gray-700 dark:text-white">-</button>
                                            <span
                                                class="text-center w-10 mx-2 dark:text-white">{{ $item['quantity'] }}</span>
                                            <button wire:click="increaseQty('{{ $item['book_id'] }}')"
                                                class="border border-gray-300 dark:border-gray-700 rounded-md py-1 px-3 hover:bg-gray-200 dark:hover:bg-gray-700 dark:text-white">+</button>
                                        </div>
                                    </td>
                                    <td class="py-6 text-center text-gray-600 dark:text-gray-300">
                                        {{ Number::currency($item['total_price'], 'IDR') }}
                                    </td>
                                    <td class="py-6 text-center">
                                        <button wire:click="removeItem('{{ $item['book_id'] }}')"
                                            class="bg-red-500 text-white border-2 border-red-600 rounded-md px-2 py-1 hover:bg-red-700">
                                            <span wire:loading.remove
                                                wire:target="removeItem('{{ $item['book_id'] }}')">Hapus</span>
                                            <span wire:loading
                                                wire:target="removeItem('{{ $item['book_id'] }}')">Menghapus...</span>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="text-center py-8 text-2xl font-semibold text-gray-500 dark:text-gray-400">
                                        Tidak ada buku yang tersedia di keranjang
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="md:w-1/4">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <h2 class="text-xl font-semibold mb-4 dark:text-white">Ringkasan Total</h2>
                    <div class="flex justify-between mb-2 text-gray-600 dark:text-gray-300">
                        <span>Subtotal</span>
                        <span>{{ Number::currency($grand_total, 'IDR') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-600 dark:text-gray-300">
                        <span>Pajak</span>
                        <span>{{ Number::currency(0, 'IDR') }}</span>
                    </div>
                    <div class="flex justify-between mb-2 text-gray-600 dark:text-gray-300">
                        <span>Biaya pengiriman</span>
                        <span>{{ Number::currency(0, 'IDR') }}</span>
                    </div>
                    <hr class="my-4 border-gray-200 dark:border-gray-600">
                    <div class="flex justify-between mb-4 text-gray-800 dark:text-white font-semibold">
                        <span>Grand Total</span>
                        <span>{{ Number::currency($grand_total, 'IDR') }}</span>
                    </div>
                    @if ($cart_items)
                        <a href="/checkout"
                            class="bg-blue-500 block text-center text-white py-2 px-4 rounded-lg w-full hover:bg-blue-600 dark:hover:bg-blue-400">
                            Checkout
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
