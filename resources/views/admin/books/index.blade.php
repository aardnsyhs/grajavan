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
                    <a href="{{ route('books.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow-lg transform hover:scale-105 transition-transform duration-300 ease-in-out">
                        Tambah Buku
                    </a>

                    @if (session('success'))
                        <div id="success-alert"
                            class="bg-green-500 text-white font-bold rounded-lg p-4 mt-4 shadow-lg opacity-0 animate-fade-in">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table
                        class="min-w-full mt-8 border-collapse border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg">
                        <thead>
                            <tr class="bg-gray-200 dark:bg-gray-700 text-left">
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
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $book->title }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $book->author }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        {{ $book->year }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600">
                                        <div class="flex space-x-2">
                                            <!-- Tombol Edit -->
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="w-20 text-center bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded shadow-lg transform hover:scale-105 transition-transform duration-300">
                                                Edit
                                            </a>
                                            <!-- Tombol Hapus -->
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

    <style>
        .animate-fade-in {
            animation: fade-in 1s forwards;
        }

        @keyframes fade-in {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <script>
        function removeAlertAfterTimeout(alertId, timeout) {
            const alertElement = document.getElementById(alertId);
            if (!alertElement) return;

            setTimeout(() => {
                fadeOut(alertElement);
            }, timeout);
        }

        function fadeOut(element) {
            element.style.transition = "opacity 1s ease, transform 1s ease";
            element.style.opacity = "0";
            element.style.transform = "translateY(-20px)";

            setTimeout(() => {
                element.remove();
            }, 1000);
        }

        removeAlertAfterTimeout('success-alert', 2500);
    </script>
</x-app-layout>
