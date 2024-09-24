<div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <section class="overflow-hidden bg-white py-12 font-poppins dark:bg-gray-800 shadow-lg rounded-lg">
        <div class="max-w-6xl px-4 py-8 mx-auto lg:py-10 md:px-6">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full mb-8 md:w-1/2 md:mb-0" x-data="{ mainImage: '{{ url('storage', $book->image) }}' }">
                    <div class="sticky top-0 z-50 overflow-hidden">
                        <div class="relative mb-6 lg:mb-10 lg:h-auto">
                            <img x-bind:src="mainImage" alt="" class="object-contain w-full max-h-96">
                        </div>
                        <div class="px-6 pb-6 mt-6 border-t border-gray-300 dark:border-gray-400">
                            <div class="flex items-center mt-6 space-x-2">
                                <span class="mr-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                        fill="currentColor" class="w-5 h-5 text-blue-500 dark:text-blue-300 bi bi-truck"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M0 3.5A1.5 1.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                        </path>
                                    </svg>
                                </span>
                                <h2 class="text-lg font-bold text-blue-600 dark:text-blue-300">Free Shipping</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-4 md:w-1/2">
                    <div class="lg:pl-20">
                        <div class="mb-8 space-y-6">
                            <h2 class="max-w-xl text-3xl font-bold dark:text-gray-100 md:text-4xl">
                                {{ $book->title }}
                            </h2>
                            <p class="inline-block text-4xl font-bold text-gray-800 dark:text-gray-100">
                                <span>{{ Number::currency($book->price, 'IDR') }}</span>
                            </p>
                            <p class="max-w-md text-gray-700 dark:text-gray-300">
                                {!! Str::markdown($book->description) !!}
                            </p>
                        </div>
                        <div class="mb-8">
                            <label for="quantity"
                                class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Quantity</label>
                            <div class="relative flex items-center max-w-[8rem]">
                                <button type="button" wire:click="decreaseQty" id="decrement-button"
                                    data-input-counter-decrement="quantity"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M1 1h16" />
                                    </svg>
                                </button>
                                <input type="number" wire:model="quantity" id="quantity" readonly data-input-counter
                                    data-input-counter-min="1" data-input-counter-max="50"
                                    aria-describedby="helper-text-explanation"
                                    class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="1" required />
                                <button type="button" wire:click="increaseQty" id="increment-button"
                                    data-input-counter-increment="quantity"
                                    class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                    <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="M9 1v16M1 9h16" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <button wire:click.prevent="addToCart('{{ $book->id }}')"
                                class="w-full py-4 text-lg font-semibold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 focus:outline-none focus:ring focus:ring-blue-300 dark:focus:ring-blue-700">
                                <span wire:loading.remove wire:target="addToCart('{{ $book->id }}')">Add to
                                    Cart</span>
                                <span wire:loading wire:target="addToCart('{{ $book->id }}')">Adding...</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
