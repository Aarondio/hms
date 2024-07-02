@section('title', 'Create a new account')

<div>
   

    <div class="">
        <div class="">
            <h1 class="font-medium mb-6 text-2xl text-gray-700">Sign up</h1>
            <form wire:submit.prevent="register">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 leading-5">
                        Name
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input placeholder="John Doe" wire:model.lazy="name" id="name" type="text" required autofocus class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-purple-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5   @error('name') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 leading-5">
                        Email address
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input placeholder="example@gmail.com" wire:model.lazy="email" id="email" type="email" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('email') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 leading-5">
                        Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input placeholder="Password" wire:model.lazy="password" id="password" type="password" required class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5 @error('password') border-red-300 text-red-900 placeholder-red-300 focus:border-red-300 focus:ring-red @enderror" />
                    </div>

                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 leading-5">
                        Confirm Password
                    </label>

                    <div class="mt-1 rounded-md shadow-sm">
                        <input placeholder="Confirm password" wire:model.lazy="passwordConfirmation" id="password_confirmation" type="password" required class="block w-full px-3 py-2 placeholder-gray-400 border border-gray-300 appearance-none rounded-md focus:outline-none focus:ring-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                    </div>
                </div>

                <div class="mt-6">
                    <span class="block w-full rounded-md shadow-sm">
                        <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-transparent rounded-md hover:bg-purple-500 focus:outline-none focus:border-purple-700 focus:ring-purple active:bg-purple-700 transition duration-150 ease-in-out">
                            Register
                        </button>
                    </span>
                </div>

                <div class="mt-6">
                    <p class="mt-2 text-sm  text-gray-600 leading-5 max-w">
                        Already registered ?
                        <a href="{{ route('login') }}" wire:navigate class="font-medium text-purple-600 hover:text-purple-500 focus:outline-none focus:underline transition ease-in-out duration-150">
                            Sign in
                        </a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
