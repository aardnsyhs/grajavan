<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex justify-between items-center">
                        <a href="{{ route('categories.create') }}"
                            class="inline-flex items-center bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Kategori
                        </a>
                        <div>
                            <input type="text" id="search" placeholder="Cari Kategori"
                                class="block mt-1 w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:ring-1 focus:ring-indigo-300 dark:focus:ring-indigo-600 focus:border-indigo-500 dark:focus:border-indigo-600 dark:bg-gray-700">
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
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">No</th>
                                    <th>
                                        <a
                                            href="{{ request()->fullUrlWithQuery(['sort' => 'name', 'direction' => request('direction') === 'asc' ? 'desc' : 'asc']) }}">
                                            Nama Kategori
                                            @if (request('sort') === 'name')
                                                @if (request('direction') === 'asc')
                                                    ▲
                                                @else
                                                    ▼
                                                @endif
                                            @endif
                                        </a>
                                    </th>
                                    <th class="px-6 py-3 border-b border-gray-300 dark:border-gray-600">Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="category-list">
                                @forelse ($categories as $category)
                                    <tr
                                        class="hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300 text-left">
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            {{ $category->name }}
                                        </td>
                                        <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                            <div class="flex space-x-2">
                                                <a href="{{ route('categories.edit', $category->id) }}"
                                                    class="w-20 flex items-center justify-center bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                        height="16" fill="currentColor" class="bi bi-pencil mr-1"
                                                        viewBox="0 0 16 16">
                                                        <path
                                                            d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                                                    </svg>
                                                    Edit
                                                </a>
                                                <form action="{{ route('categories.destroy', $category->id) }}"
                                                    method="POST" class="delete-form" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button"
                                                        class="delete-button w-20 flex items-center justify-center bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="16"
                                                            height="16" fill="currentColor" class="bi bi-trash3 mr-1"
                                                            viewBox="0 0 16 16">
                                                            <path
                                                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center py-4">Tidak ada kategori ditemukan.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div id="no-results" class="text-center py-6 text-gray-600 dark:text-gray-300 hidden">
                        Tidak ada hasil yang ditemukan.
                    </div>
                    <div id="pagination" class="mt-6">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
