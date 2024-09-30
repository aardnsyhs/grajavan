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
