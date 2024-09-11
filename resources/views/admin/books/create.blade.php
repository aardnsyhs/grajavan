<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('books.store') }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="title" :value="__('Judul Buku')" />
                            <x-text-input id="title" class="block mt-1 w-full" type="text" name="title" required
                                autofocus />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="author" :value="__('Pengarang')" />
                            <x-text-input id="author" class="block mt-1 w-full" type="text" name="author"
                                required />
                        </div>

                        <div class="mt-4">
                            <x-input-label for="year" :value="__('Tahun Terbit')" />
                            <x-text-input id="year" class="block mt-1 w-full" type="number" name="year"
                                required />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Tambah Buku') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
