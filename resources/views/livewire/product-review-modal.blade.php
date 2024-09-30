<div id="review-modal" tabindex="-1" aria-hidden="true"
    class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0 antialiased">
    <div class="relative max-h-full w-full max-w-2xl p-4">
        <div class="relative rounded-lg bg-white shadow dark:bg-gray-800">
            <div
                class="flex items-center justify-between rounded-t border-b border-gray-200 p-4 dark:border-gray-700 md:p-5">
                <div>
                    <h3 class="flex justify-start mb-1 text-lg font-semibold text-gray-900 dark:text-white">Berikan
                        ulasan untuk:</h3>
                    @foreach ($order->items as $item)
                        <span class="font-medium text-primary-700 hover:underline dark:text-primary-500"
                            wire:key="{{ $item->book->id }}">{{ $item->book->title }},
                        </span>
                    @endforeach
                </div>
                <button type="button"
                    class="absolute right-5 top-5 ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-toggle="review-modal">
                    <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <form wire:submit.prevent="submitReview" class="p-4 md:p-5">
                @if ($userHasReviewed)
                    <p class="text-green-500">Anda sudah memberikan ulasan untuk produk ini.</p>
                @else
                    <div class="mb-4 grid grid-cols-2 gap-4">
                        <div class="col-span-2">
                            <span class="flex justify-start text-xl">Rating</span>
                            <livewire:rating />
                        </div>
                        <div class="col-span-2">
                            <label for="comment"
                                class="flex justify-start mb-2 text-xl font-medium text-gray-900 dark:text-white">Ulasan</label>
                            <textarea id="comment" wire:model="comment" rows="6"
                                class="mb-2 block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500 dark:focus:ring-primary-500"></textarea>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-4 dark:border-gray-700 md:pt-5">
                        <button type="submit"
                            class="me-2 inline-flex items-center rounded-lg bg-primary-700 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Tambah
                            ulasan</button>
                        <button type="button" data-modal-toggle="review-modal"
                            class="me-2 rounded-lg border border-gray-200 bg-white px-5 py-2.5 text-sm font-medium text-gray-900 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:outline-none focus:ring-4 focus:ring-gray-100 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white dark:focus:ring-gray-700">Batal</button>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
