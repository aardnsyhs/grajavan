<div class="flex flex-col items-center justify-center px-6 py-4 mx-auto lg:py-0 mt-28 mb-52">
    <span class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
        <img class="w-14 h-14 mr-2" src="{{ asset('images/logo_javan.png') }}" alt="logo">
        Grajavan
    </span>
    <div
        class="w-full p-6 bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md dark:bg-gray-800 dark:border-gray-700 sm:p-8">
        <h2 class="mb-1 text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
            Change Password
        </h2>
        <form wire:submit.prevent="save" class="mt-4 space-y-4 lg:mt-5 md:space-y-5">
            @if (session('error'))
                <div class="bg-red-500 text-sm text-white rounded-lg p-4 mb-4" role="alert">
                    {{ session('error') }}</div>
            @endif
            <div>
                <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                    Password</label>
                <input type="password" wire:model="password" id="password" placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password') border-red-500 dark:border-red-500 @enderror">
                @error('password')
                    <p class="text-red-600 mt-2" id="password">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label for="password_confirmation"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                <input type="password" wire:model="password_confirmation" id="password_confirmation"
                    placeholder="••••••••"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 @error('password_confirmation') border-red-500 dark:border-red-500 @enderror">
                @error('password_confirmation')
                    <p class="text-red-600 mt-2" id="password_confirmation">{{ $message }}</p>
                @enderror
            </div>
            <button type="submit"
                class="w-full text-white bg-primary-600 hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Reset
                passwod</button>
        </form>
    </div>
</div>
