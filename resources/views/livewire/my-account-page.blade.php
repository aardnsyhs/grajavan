<section class="py-8 md:py-16 dark:bg-gray-700 antialiased">
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">My Account</h2>
        @if (session()->has('message'))
            <div class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg dark:bg-green-200 dark:text-green-900"
                role="alert">
                {{ session('message') }}
            </div>
        @endif
        <form wire:submit.prevent="updateAccount" enctype="multipart/form-data">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div x-data="{ photoName: null, photoPreview: null }" class="flex flex-col items-center">
                    <input type="file" id="profilePicture" wire:model="image" class="hidden" x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        ">
                    <label class="block text-gray-700 text-sm font-bold mb-2 dark:text-gray-300" for="profilePicture">
                        Foto Profil
                    </label>
                    <div class="mt-2" x-show="!photoPreview">
                        <img src="{{ $user->image ? url('storage', $user->image) : 'https://www.cartoonize.net/wp-content/uploads/2024/05/avatar-maker-photo-to-cartoon.png' }}"
                            class="w-32 h-32 rounded-full shadow-md">
                    </div>
                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block w-24 h-24 rounded-full shadow"
                            x-bind:style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' +
                            photoPreview + '\');'">
                        </span>
                    </div>
                    <button type="button"
                        class="mt-4 px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-400 focus:shadow-outline-blue active:text-gray-800 active:bg-gray-50 transition ease-in-out duration-150"
                        x-on:click.prevent="$refs.photo.click()">
                        Pilih foto baru
                    </button>
                    @error('image')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="md:col-span-2 space-y-6">
                    <div>
                        <label for="name"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama</label>
                        <input type="text" wire:model="name" id="name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                            placeholder="Enter your name" required>
                        @error('name')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label for="email"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" wire:model="email" id="email"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white focus:border-primary-500 focus:ring-primary-500 sm:text-sm"
                            placeholder="Enter your email" required>
                        @error('email')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end">
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-primary-700 dark:hover:bg-primary-800 dark:focus:ring-primary-600">
                            Update Account
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
