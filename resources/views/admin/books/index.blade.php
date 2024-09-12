<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('books.create') }}"
                            class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Buku
                        </a>
                        <div>
                            <input type="text" id="search" placeholder="Cari Buku"
                                class="block mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring focus:ring-indigo-300 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-600 dark:bg-gray-700">
                        </div>
                    </div>

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
                    <div id="table-wrapper">
                        <table
                            class="min-w-full mt-8 border-collapse border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
                            <thead id="table-head">
                                <tr class="bg-gray-200 dark:bg-gray-700 text-left">
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'id', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                            class="font-bold">
                                            No
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'title', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                            class="font-bold">
                                            Judul
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'author', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                            class="font-bold">
                                            Pengarang
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">
                                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'year', 'direction' => request('direction') == 'asc' ? 'desc' : 'asc']) }}"
                                            class="font-bold">
                                            Tahun
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="book-list">
                                @foreach ($books as $book)
                                    <tr
                                        class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300 text-left">
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ ($books->currentPage() - 1) * $books->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $book->title }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $book->author }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $book->year }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('books.edit', $book->id) }}"
                                                    class="w-20 flex items-center justify-center bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                                                    Edit
                                                </a>
                                                <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                    class="delete-book-button" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="w-20 flex items-center justify-center bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
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
                    <div id="no-results" class="text-center py-6 text-gray-600 dark:text-gray-300 hidden">
                        Tidak ada hasil yang ditemukan.
                    </div>
                    <div id="pagination" class="mt-6">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
