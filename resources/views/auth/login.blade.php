<x-guest-layout>
    <x-authentication-card class="bg-black text-white">
        <x-slot name="logo"></x-slot> <!-- Removed the logo -->

        <!-- Title Section -->
        <div class="text-center mb-6">
            <h2 class="login-title">LOGIN</h2>
        </div>

        <x-validation-errors class="mb-4 text-red-500" /> <!-- Updated error message color -->

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" class="text-red-500" />
                <x-input id="email" class="block mt-1 w-full bg-gray-800 text-white border-red-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4 relative">
                <x-label for="password" value="{{ __('Password') }}" class="text-red-500" />
                <x-input id="password" class="block mt-1 w-full bg-gray-800 text-white border-red-500 pr-10" type="password" name="password" required autocomplete="current-password" />
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; right: 10px; top: 45%; cursor: pointer; color: red;"></span>
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" class="text-red-500 border-red-500" />
                    <span class="ms-2 text-sm text-red-500">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-red-500 hover:text-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ms-4 bg-red-600 hover:bg-red-700 text-white">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<!-- Add this script to enable the toggle password feature -->
<script>
    document.querySelector('.toggle-password').addEventListener('click', function (e) {
        let passwordInput = document.getElementById('password');
        let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Add this style block to your CSS or inside <style> tags -->
<style>
    .login-title {
        font-size: 42px;
        color: #212121; /* Darker color for title */
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
    }
</style>
