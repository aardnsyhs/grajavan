<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-6">
                            <x-input-label for="name" :value="__('Judul Kategori')" />
                            <x-text-input id="name"
                                class="block mt-2 w-full px-4 py-2 border border-gray-200 dark:border-gray-600 rounded-md shadow-sm focus:ring-1 focus:ring-indigo-200 dark:focus:ring-indigo-500 focus:border-indigo-400 dark:focus:border-indigo-500 dark:bg-gray-700"
                                type="text" name="name" value="{{ $category->name }}" required autofocus />
                        </div>

                        <div class="flex items-center justify-end mt-8">
                            <x-primary-button
                                class="ml-4 bg-indigo-600 hover:bg-indigo-500 text-white px-6 py-2 rounded-lg shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
                                {{ __('Perbarui Kategori') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
