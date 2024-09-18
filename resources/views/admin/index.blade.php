<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div
                class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg transition transform hover:scale-105 duration-300">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <div class="text-3xl font-bold">
                        {{ __('Kamu admin') }}
                    </div>
                    <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">
                        Kamu memiliki akses untuk mengelola semua data di sistem. Pastikan data tetap teratur dan
                        terbaru.
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('books.index') }}"
                            class="inline-flex items-center bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-6 rounded-lg shadow-lg transform hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('images/gear.svg') }}" alt="Gear Icon" class="w-5 h-5 mr-2">
                            Kelola Data
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
