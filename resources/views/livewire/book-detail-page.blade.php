<section class="py-8 md:py-16 dark:bg-gray-900 antialiased">
    <div class="max-w-screen-xl px-4 mx-auto 2xl:px-0 bg-white dark:bg-gray-800 rounded-lg">
        <div class="lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-16 py-3 md:py-8">
            <div class="shrink-0 max-w-md lg:max-w-lg mx-auto">
                <img class="w-full h-auto max-h-[500px] object-contain dark:hidden"
                    src="{{ url('storage', $book->image) }}" alt="{{ $book->title }}" />
                <img class="w-full h-auto max-h-[500px] object-contain hidden dark:block"
                    src="{{ url('storage', $book->image) }}" alt="{{ $book->title }}" />
            </div>
            <div class="mt-6 sm:mt-8 lg:mt-0">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-gray-300">
                    {{ $book->title }}
                </h1>
                <div class="mt-4 sm:items-center sm:gap-4 sm:flex">
                    <p class="text-2xl font-extrabold text-gray-900 sm:text-3xl dark:text-gray-300">
                        {{ Number::currency($book->price, 'IDR') }}
                    </p>
                </div>
                <div class="mt-6 sm:gap-4 sm:items-center sm:flex sm:mt-8">
                    <div class="py-2 px-3 bg-white border border-gray-200 rounded-lg dark:bg-neutral-900 dark:border-neutral-700"
                        data-hs-input-number="">
                        <div class="w-full flex justify-between items-center gap-x-5">
                            <div class="grow">
                                <span class="block text-xs text-gray-500 dark:text-neutral-400">
                                    Pilih jumlahnya
                                </span>
                                <input wire:model="quantity" readonly
                                    class="w-full p-0 bg-transparent border-0 text-gray-800 focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none dark:text-gray-300"
                                    style="-moz-appearance: textfield;" type="number"
                                    aria-roledescription="Number field" value="1" data-hs-input-number-input="">
                            </div>
                            <div class="flex justify-end items-center gap-x-1.5">
                                <button type="button" wire:click="decreaseQty"
                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-gray-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                    </svg>
                                </button>
                                <button type="button" wire:click="increaseQty"
                                    class="size-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-full border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-gray-300 dark:hover:bg-neutral-800 dark:focus:bg-neutral-800"
                                    tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M5 12h14"></path>
                                        <path d="M12 5v14"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <button wire:click.prevent="addToCart('{{ $book->id }}')"
                        class="text-white mt-4 sm:mt-0 bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-4 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800 flex items-center justify-center">
                        <svg class="w-5 h-5 -ms-2 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                        </svg>
                        <span wire:loading.remove wire:target="addToCart('{{ $book->id }}')">Tambah ke
                            keranjang</span>
                        <span wire:loading wire:target="addToCart('{{ $book->id }}')">Menambahkan...</span>
                    </button>
                </div>
                <hr class="my-6 md:my-8 border-gray-200 dark:border-gray-800" />
                <h2 class="mb-6 text-gray-500 dark:text-gray-300">
                    {!! Str::markdown($book->description) !!}
                </h2>
            </div>
        </div>
        <section class="bg-white py-8 antialiased dark:bg-gray-800 md:py-16">
            <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
                <div class="flex items-center gap-2">
                    <h2 class="text-2xl font-semibold text-gray-900 dark:text-gray-300">Reviews</h2>
                    <div class="mt-2 flex items-center gap-2 sm:mt-0">
                        <div class="flex items-center gap-0.5">
                            @for ($i = 1; $i <= 5; $i++)
                                <svg class="h-4 w-4 {{ $i <= round($averageRating) ? 'text-yellow-300' : 'text-gray-300' }}"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477Z" />
                                </svg>
                            @endfor
                        </div>
                        <p class="text-sm font-medium leading-none text-gray-500 dark:text-gray-400">
                            ({{ $averageRating }})
                        </p>
                        <a href="#"
                            class="text-sm font-medium leading-none text-gray-900 underline hover:no-underline dark:text-gray-300">
                            {{ $totalReviews }} Reviews </a>
                    </div>
                </div>
                <div class="my-6 gap-8 sm:flex sm:items-start md:my-8">
                    <div class="shrink-0 space-y-4">
                        <p class="text-2xl font-semibold leading-none text-gray-900 dark:text-gray-300">
                            {{ $averageRating }} dari 5
                        </p>
                    </div>
                    <div class="mt-6 min-w-0 flex-1 space-y-3 sm:mt-0">
                        @foreach ([5, 4, 3, 2, 1] as $star)
                            <div class="flex items-center gap-2">
                                <p
                                    class="w-2 shrink-0 text-start text-sm font-medium leading-none text-gray-900 dark:text-gray-300">
                                    {{ $star }}</p>
                                <svg class="h-4 w-4 shrink-0 text-yellow-300" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477Z" />
                                </svg>
                                <div class="h-1.5 w-80 rounded-full bg-gray-200 dark:bg-gray-700">
                                    <div class="h-1.5 rounded-full bg-yellow-300"
                                        style="width: {{ $ratingPercentages[$star] }}%">
                                    </div>
                                </div>
                                <a href="#"
                                    class="w-8 shrink-0 text-right text-sm font-medium leading-none text-primary-700 hover:underline dark:text-primary-500 sm:w-auto sm:text-left">
                                    {{ $ratingCounts[$star] }} <span class="hidden sm:inline">reviews</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                @forelse ($reviews as $review)
                    <div class="mt-6 divide-y divide-gray-200 dark:divide-gray-700">
                        <div class="gap-3 pb-6 sm:flex sm:items-start">
                            <div class="shrink-0 space-y-2 sm:w-48 md:w-72">
                                <div class="flex items-center gap-0.5">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg class="h-4 w-4 {{ $i <= $review->rating ? 'text-yellow-300' : 'text-gray-300' }}"
                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M13.849 4.22c-.684-1.626-3.014-1.626-3.698 0L8.397 8.387l-4.552.361c-1.775.14-2.495 2.331-1.142 3.477l3.468 2.937-1.06 4.392c-.413 1.713 1.472 3.067 2.992 2.149L12 19.35l3.897 2.354c1.52.918 3.405-.436 2.992-2.15l-1.06-4.39 3.468-2.938c1.353-1.146.633-3.336-1.142-3.477Z" />
                                        </svg>
                                    @endfor
                                </div>
                                <div class="space-y-0.5">
                                    <p class="text-base font-semibold text-gray-900 dark:text-gray-300">
                                        {{ $review->user->name }}</p>
                                    <p class="text-sm font-normal text-gray-500 dark:text-gray-400">
                                        {{ $review->created_at->format('F d, Y') }}</p>
                                </div>
                            </div>
                            <div class="mt-4 min-w-0 flex-1 space-y-4 sm:mt-0">
                                <h2 class="text-base font-normal text-gray-500 dark:text-gray-300">
                                    {!! Str::markdown($review->comment) !!}
                                </h2>
                            </div>
                        </div>
                        <hr>
                    </div>
                @empty
                    <p class="text-gray-500 dark:text-gray-400">Belum ada review untuk buku ini.</p>
                @endforelse
                <div class="mt-6 text-center">
                    <button type="button"
                        class="mb-2 me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">
                        View more reviews
                    </button>
                </div>
            </div>
        </section>
    </div>
</section>
