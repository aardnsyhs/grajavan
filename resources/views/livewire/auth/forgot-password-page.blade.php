<div class="flex flex-col items-center justify-center px-6 py-4 mx-auto lg:py-0 mt-32 mb-56">
    <span class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <img class="w-14 h-14 mr-2" src="{{ asset('images/logo_javan.png') }}" alt="logo">
        Grajavan
    </span>
    <div
        class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
        <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
            <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                Forgot password?
            </h1>
            <form wire:submit.prevent="save" class="space-y-4 md:space-y-6">
                @if (session('success'))
                    <div class="bg-green-500 text-sm text-white rounded-lg p-4 mb-4" role="alert">
                        {{ session('success') }}</div>
                @endif
                <div>
                    <label for="email"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" wire:model="email" id="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('email') border-red-500 dark:border-red-500 @enderror"
                        placeholder="johndoe@example.com">
                    @error('email')
                        <p class="text-xs text-red-600 mt-2" id="email-error">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset
                    password</button>
                <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                    Remember your password? <a wire:navigate href="/login"
                        class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign in here</a>
                </p>
            </form>
        </div>
    </div>
</div>

{{-- <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto">
    <div class="flex h-full items-center">
        <main class="w-full max-w-md mx-auto p-6">
            <div class="mt-7 bg-white border border-gray-200 rounded-xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <div class="p-4 sm:p-7">
                    <div class="text-center">
                        <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">Forgot password?</h1>
                        <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">
                            Remember your password?
                            <a wire:navigate
                                class="text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                                href="/login">
                                Sign in here
                            </a>
                        </p>
                    </div>
                    <div class="mt-5">
                        <form wire:submit.prevent="save">
                            @if (session('success'))
                                <div class="bg-green-500 text-sm text-white rounded-lg p-4 mb-4" role="alert">
                                    {{ session('success') }}</div>
                            @endif
                            <div class="grid gap-y-4">
                                <div>
                                    <label for="email" class="block text-sm mb-2 dark:text-white">Email
                                        address</label>
                                    <div class="relative">
                                        <input type="email" id="email" wire:model="email"
                                            class="py-3 px-4 block w-full border border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600"
                                            aria-describedby="email-error">
                                        @error('email')
                                            <div
                                                class="absolute inset-y-0 end-0 flex items-center pointer-events-none pe-3">
                                                <svg class="h-5 w-5 text-red-500" width="16" height="16"
                                                    fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                                                    <path
                                                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                                                </svg>
                                            </div>
                                        @enderror
                                    </div>
                                    @error('email')
                                        <p class="text-xs text-red-600 mt-2" id="email-error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="w-full py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Reset
                                    password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div> --}}
