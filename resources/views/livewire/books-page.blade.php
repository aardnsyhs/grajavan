<div class="w-full max-w-[85rem] py-5 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="px-3 mb-4">
        <div class="flex justify-end">
            <select wire:model.live="sort"
                class="py-3 px-4 pe-9 block border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-slate-800 dark:text-slate-300 dark:placeholder-slate-300 dark:focus:ring-slate-700">
                <option selected="">Urutkan berdasarkan</option>
                <option value="latest">Terbaru</option>
                <option value="price">Harga</option>
            </select>
        </div>
    </div>
    <section class="bg-gray-50 font-poppins dark:bg-gray-800 rounded-lg">
        <div class="px-4 mx-auto max-w-7xl lg:py-6 md:px-6">
            <div class="flex flex-wrap mb-24 -mx-3">
                <div class="w-full pr-2 lg:w-1/4 lg:block">
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Kategori</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-500 dark:border-gray-500"></div>
                        <ul>
                            @foreach ($categories as $category)
                                <li class="mb-4" wire:key="{{ $category->id }}">
                                    <label for="{{ $category->id }}"
                                        class="flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-300">
                                        <input type="checkbox" wire:model.live="selected_categories"
                                            id="{{ $category->id }}" value="{{ $category->id }}"
                                            class="w-4 h-4 mr-2 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="text-lg">{{ $category->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Tipe Buku</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-500 dark:border-gray-500"></div>
                        <ul>
                            @foreach ($bookTypes as $bookType)
                                <li class="mb-4" wire:key="{{ $bookType->id }}">
                                    <label for="{{ $bookType->id }}"
                                        class="flex items-center text-gray-700 dark:text-gray-300 hover:text-gray-900 dark:hover:text-gray-100 transition-colors duration-300">
                                        <input type="checkbox" wire:model.live="selected_bookType"
                                            id="{{ $bookType->id }}" value="{{ $bookType->id }}"
                                            class="w-4 h-4 mr-2 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                        <span class="text-lg">{{ $bookType->name }}</span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div
                        class="p-4 mb-5 bg-white border border-gray-200 rounded-lg shadow-sm dark:border-gray-900 dark:bg-gray-900">
                        <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">Harga</h2>
                        <div class="w-16 pb-2 mb-6 border-b border-rose-500 dark:border-gray-500"></div>
                        <div>
                            <div class="font-semibold dark:text-slate-300">{{ Number::currency($price_range, 'IDR') }}
                            </div>
                            <input type="range" wire:model.live="price_range"
                                class="w-full h-1 mb-4 bg-blue-100 rounded appearance-none cursor-pointer"
                                max="500000" value="300000" step="1000">
                            <div class="flex justify-between">
                                <span
                                    class="inline-block text-lg font-bold text-blue-400 ">{{ Number::currency(1000, 'IDR') }}</span>
                                <span
                                    class="inline-block text-lg font-bold text-blue-400 ">{{ Number::currency(500000, 'IDR') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full px-3 lg:w-3/4">
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($books as $book)
                            <div class="relative flex flex-col h-full bg-white shadow-sm border border-slate-200 rounded-lg dark:bg-slate-900 dark:border-slate-800"
                                wire:key="{{ $book->id }}">
                                <div class="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
                                    <a href="/books/{{ $book->id }}">
                                        <img src="{{ url('storage', $book->image) }}" alt="{{ $book->title }}"
                                            class="object-fit w-full h-full" loading="lazy" />
                                    </a>
                                </div>
                                <div class="p-4 flex flex-col flex-grow">
                                    <div class="flex items-center mb-2">
                                        <h6 class="text-slate-800 text-lg font-semibold dark:text-slate-200">
                                            {{ $book->title }}
                                        </h6>
                                        <div class="flex items-center gap-0.5 ml-auto">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="w-5 h-5 text-yellow-600">
                                                <path fill-rule="evenodd"
                                                    d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            <span class="text-slate-600 ml-1.5">{{ $book->rating }}</span>
                                        </div>
                                    </div>
                                    <p class="text-green-500 leading-normal font-light mt-auto">
                                        {{ Number::currency($book->price, 'IDR') }}
                                    </p>
                                </div>
                                <div class="flex justify-center px-4 pb-4 pt-0 mt-2">
                                    <button wire:click.prevent="addToCart('{{ $book->id }}')"
                                        class="w-full flex items-center justify-center rounded-md bg-slate-700 py-2 px-4 border border-transparent text-center text-sm text-white transition-all shadow-md hover:shadow-lg focus:bg-slate-700 focus:shadow-none active:bg-slate-700 hover:bg-slate-600 active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                                        type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="w-4 h-4 mr-2" viewBox="0 0 16 16">
                                            <path
                                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                            </path>
                                        </svg><span wire:loading.remove
                                            wire:target="addToCart('{{ $book->id }}')">Tambah ke keranjang</span>
                                        <span wire:loading
                                            wire:target="addToCart('{{ $book->id }}')">Menambahkan...</span>
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
