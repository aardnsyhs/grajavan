<div>
    {{-- Hero Section --}}
    <div
        class="w-full h-screen bg-gradient-to-r from-blue-200 to-cyan-200 dark:from-slate-800 dark:to-slate-900 py-10 px-4 sm:px-6 lg:px-8 mx-auto">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid -->
            <div class="grid md:grid-cols-2 gap-4 md:gap-8 xl:gap-20 md:items-center">
                <div>
                    <h1
                        class="block text-3xl font-bold text-gray-800 sm:text-4xl lg:text-6xl lg:leading-tight dark:text-white">
                        Mulai perjalanan kamu dengan <span class="text-blue-600 dark:text-blue-400">Grajavan</span></h1>
                    <p class="mt-3 text-lg text-gray-800 dark:text-gray-300">Temukan beragam koleksi buku mulai dari
                        novel, biografi, buku anak, buku akademik, hingga literatur klasik dan banyak lagi.</p>

                    <!-- Buttons -->
                    @guest
                        <div class="mt-7 grid gap-3 w-full sm:inline-flex">
                            <a wire:navigate
                                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:bg-blue-500 dark:hover:bg-blue-600"
                                href="/register">
                                Mulai
                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="m9 18 6-6-6-6" />
                                </svg>
                            </a>
                            <a wire:navigate
                                class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800"
                                href="/contact">
                                Hubungi tim sales
                            </a>
                        </div>
                    @endguest
                    <!-- End Buttons -->
                </div>

                <!-- Image Section -->
                <div class="relative ms-4">
                    <img class="w-full rounded-md"
                        src="https://static.vecteezy.com/system/resources/previews/011/993/278/non_2x/3d-render-online-shopping-bag-using-credit-card-or-cash-for-future-use-credit-card-money-financial-security-on-mobile-3d-application-3d-shop-purchase-basket-retail-store-on-e-commerce-free-png.png"
                        alt="Image Description" loading="lazy">
                    <div
                        class="absolute inset-0 -z-[1] bg-gradient-to-tr from-gray-200 via-white/0 to-white/0 w-full h-full rounded-md mt-4 -mb-4 me-4 -ms-4 lg:mt-6 lg:-mb-6 lg:me-6 lg:-ms-6 dark:from-slate-800 dark:via-slate-900/0 dark:to-slate-900/0">
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Book Type Selection --}}
    <section class="py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-4xl font-bold dark:text-gray-200"> Jelajahi Koleksi<span class="text-blue-500"> Buku
                            Populer</span> </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-slate-700 dark:text-gray-300">
                    Temukan buku-buku terbaik yang akan memperluas wawasan dan imajinasi Anda. Dari fiksi hingga
                    non-fiksi, kami menawarkan pilihan yang sesuai untuk setiap pembaca.
                </p>
            </div>
        </div>
        <div class="justify-center max-w-6xl px-4 py-4 mx-auto lg:py-0">
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-4 md:grid-cols-2">
                @foreach ($bookTypes as $bookType)
                    <div class="bg-white rounded-lg shadow-md dark:bg-gray-800" wire:key="{{ $bookType->id }}">
                        <a href="/books?selected_bookType[0]={{ $bookType->id }}" class="">
                            <img src="{{ url('storage', $bookType->image) }}" alt="{{ $bookType->name }}"
                                class="object-cover w-full h-64 rounded-t-lg" loading="lazy">
                        </a>
                        <div class="p-5 text-center">
                            <a href=""
                                class="text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-300">
                                {{ $bookType->name }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Categoties Selection --}}
    <div class="bg-white-200 py-20">
        <div class="max-w-xl mx-auto">
            <div class="text-center ">
                <div class="relative flex flex-col items-center">
                    <h1 class="text-5xl font-bold dark:text-gray-200"> Jelajahi <span class="text-blue-500"> Kategori
                        </span> </h1>
                    <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                        <div class="flex-1 h-2 bg-blue-200">
                        </div>
                        <div class="flex-1 h-2 bg-blue-400">
                        </div>
                        <div class="flex-1 h-2 bg-blue-600">
                        </div>
                    </div>
                </div>
                <p class="mb-12 text-base text-center text-slate-700 dark:text-gray-300">
                    Temukan berbagai kategori buku mulai dari fiksi, non-fiksi, biografi, hingga buku-buku pendidikan.
                    Jelajahi pilihan kami untuk menemukan bacaan yang sesuai dengan minat Anda.
                </p>
            </div>
        </div>
        <div class="max-w-[85rem] px-4 sm:px-6 lg:px-8 mx-auto">
            <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-6">
                @foreach ($categories as $category)
                    <a wire:navigate
                        class="group flex flex-col bg-white border shadow-sm rounded-xl hover:shadow-md transition dark:bg-slate-900 dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="/books?selected_categories[0]={{ $category->id }}" wire:key="{{ $category->id }}">
                        <div class="p-4 md:p-5">
                            <div class="flex justify-between items-center">
                                <div class="flex items-center">
                                    <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                        src="{{ url('storage', $category->image) }}" alt="{{ $category->name }}"
                                        loading="lazy">
                                    <div class="ms-3">
                                        <h3
                                            class="group-hover:text-blue-600 font-semibold text-gray-800 dark:group-hover:text-gray-400 dark:text-gray-200">
                                            {{ $category->name }}
                                        </h3>
                                    </div>
                                </div>
                                <div class="ps-3">
                                    <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="m9 18 6-6-6-6" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Customer  --}}
    <section class="py-14 font-poppins dark:bg-gray-800">
        <div class="max-w-6xl px-4 py-6 mx-auto lg:py-4 md:px-6">
            <div class="max-w-xl mx-auto">
                <div class="text-center ">
                    <div class="relative flex flex-col items-center">
                        <h1 class="text-5xl font-bold dark:text-gray-200"> Penilaian <span class="text-blue-500">Pembaca</span> </h1>
                        <div class="flex w-40 mt-2 mb-6 overflow-hidden rounded">
                            <div class="flex-1 h-2 bg-blue-200"></div>
                            <div class="flex-1 h-2 bg-blue-400"></div>
                            <div class="flex-1 h-2 bg-blue-600"></div>
                        </div>
                    </div>
                    <p class="mb-12 text-base text-center text-slate-700 dark:text-gray-300">
                        Lihat apa yang dikatakan pembaca tentang buku-buku favorit mereka. Ulasan dari pelanggan kami
                        akan membantu Anda menemukan bacaan terbaik yang sesuai dengan selera Anda.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 ">
                @foreach($reviews as $review)
                    <div class="py-6 bg-white rounded-md shadow dark:bg-gray-900">
                        <div class="flex flex-wrap items-center justify-between pb-4 mb-6 space-x-2 border-b dark:border-gray-700">
                            <div class="flex items-center px-6 mb-2 md:mb-0 ">
                                <div class="flex mr-2 rounded-full">
                                    <img src="{{ $review->user->profile_picture_url }}" alt="{{ $review->user->name }}"
                                        class="object-cover w-12 h-12 rounded-full" loading="lazy">
                                </div>
                                <div>
                                    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-300">
                                        {{ $review->user->name }}</h2>
                                    <p class="text-xs text-gray-300 dark:text-gray-300">{{ $review->user->job_title }}</p> <!-- Pekerjaan user -->
                                </div>
                            </div>
                            <p class="px-6 text-base font-medium text-gray-600 dark:text-gray-300">
                                {{ $review->user->created_at->format('d, M, Y') }}
                            </p>
                        </div>
                        <p class="px-6 mb-6 text-base text-gray-300 dark:text-gray-300">
                            {{ $review->comment }}
                        </p>
                        <div class="flex flex-wrap justify-between pt-4 border-t dark:border-gray-700">
                            <div class="flex px-6 mb-2 md:mb-0">
                                <ul class="flex items-center justify-start mr-4">
                                    @for ($i = 0; $i < 5; $i++)
                                        <li>
                                            <a href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor"
                                                    class="w-4 mr-1 text-blue-500 bi bi-star-fill"
                                                    viewBox="0 0 16 16">
                                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                                    </path>
                                                </svg>
                                            </a>
                                        </li>
                                    @endfor
                                </ul>
                                <h2 class="text-sm text-gray-300 dark:text-gray-300">Rating:
                                    <span class="font-semibold text-gray-600 dark:text-gray-300">
                                        {{ $review->rating }}</span>
                                </h2>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>
