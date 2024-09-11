<x-app-layout>
    @vite(['resources/css/style.css', 'resources/js/script.js'])
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('books.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                        Tambah Buku
                    </a>

                    @php
                        $alertType = session('success')
                            ? 'bg-green-500'
                            : (session('edit')
                                ? 'bg-yellow-500'
                                : (session('delete')
                                    ? 'bg-red-500'
                                    : ''));
                        $alertMessage = session('success') ?? (session('edit') ?? session('delete'));
                    @endphp

                    @if ($alertMessage)
                        <div id="success-alert"
                            class="text-white font-bold rounded-lg p-4 mt-6 shadow-lg opacity-0 animate-fade-in {{ $alertType }}">
                            {{ $alertMessage }}
                        </div>
                    @endif

                    <table
                        class="min-w-full mt-8 border-collapse border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">No</th>
                                <!-- Tambahkan kolom untuk nomor -->
                                <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Judul</th>
                                <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Pengarang</th>
                                <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Tahun</th>
                                <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr
                                    class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300 text-left">
                                    <!-- Gunakan $loop->iteration untuk menampilkan nomor urut -->
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $loop->iteration }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $book->title }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $book->author }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $book->year }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="w-20 text-center bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300">
                                                Edit
                                            </a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="w-20 text-center bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
