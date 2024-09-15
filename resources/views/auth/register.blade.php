<x-guest-layout>
    <x-authentication-card class="bg-black text-white p-8 rounded-lg shadow-lg">
        <x-slot name="logo"></x-slot> <!-- Removed the logo -->

        <!-- Title Section -->
        <div class="text-center mb-6">
            <h2 class="register-title">REGISTER</h2>
        </div>

        <x-validation-errors class="mb-4 text-red-500" /> <!-- Error messages in red -->

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" class="text-red-500" />
                <x-input id="name" class="block mt-1 w-full bg-black text-white border-red-500 focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50 rounded-md shadow-sm" 
                         type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" class="text-red-500" />
                <x-input id="email" class="block mt-1 w-full bg-black text-white border-red-500 focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50 rounded-md shadow-sm" 
                         type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone') }}" class="text-red-500" />
                <div class="relative">
                    <x-input id="phone" class="block mt-1 w-full bg-black text-white border-red-500 focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50 rounded-md shadow-sm" 
                             type="tel" name="phone" :value="old('phone')" required autocomplete="phone" />
                </div>
            </div>

            <div class="mt-4 relative">
                <x-label for="password" value="{{ __('Password') }}" class="text-red-500" />
                <x-input id="password" class="block mt-1 w-full bg-black text-white border-red-500 focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50 pr-10 rounded-md shadow-sm" 
                         type="password" name="password" required autocomplete="new-password" />
                <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; right: 10px; top: 45%; cursor: pointer; color: red;"></span>
            </div>

            <div class="mt-4 relative">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="text-red-500" />
                <x-input id="password_confirmation" class="block mt-1 w-full bg-black text-white border-red-500 focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50 pr-10 rounded-md shadow-sm" 
                         type="password" name="password_confirmation" required autocomplete="new-password" />
                <span toggle="#password_confirmation" class="fa fa-fw fa-eye field-icon toggle-password" style="position: absolute; right: 10px; top: 45%; cursor: pointer; color: red;"></span>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" class="text-red-500 border-red-500 focus:border-red-500 focus:ring focus:ring-red-500 focus:ring-opacity-50 rounded-md shadow-sm" required />
                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-red-500 hover:text-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-red-500 hover:text-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex items-center justify-between mt-4">
                <a class="underline text-sm text-red-500 hover:text-red-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ms-4 bg-red-600 hover:bg-red-700 text-white shadow-lg rounded-lg px-4 py-2 transition ease-in-out duration-150 transform hover:scale-105">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<!-- intl-tel-input Integration -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>
    // Initialize intl-tel-input
    const phoneInputField = document.querySelector("#phone");
    const phoneInput = window.intlTelInput(phoneInputField, {
        initialCountry: "auto",
        geoIpLookup: function(callback) {
            fetch('https://ipinfo.io/json?token=YOUR_API_KEY')
            .then((response) => response.json())
            .then((json) => {
                const countryCode = (json && json.country) ? json.country : "us";
                callback(countryCode);
            })
            .catch(() => {
                callback("us");
            });
        },
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
    });

    // Adjust the width of the phone input to match the other inputs
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInputContainer = phoneInputField.closest('.relative');
        if (phoneInputContainer) {
            phoneInputContainer.style.width = '100%'; // Match the width of other inputs
        }
    });

    // Handle form submission
    document.querySelector("form").addEventListener("submit", function(e) {
        const phoneNumber = phoneInput.getNumber();

        // Add the phone number with country code to a hidden input or directly submit it
        const hiddenInput = document.createElement("input");
        hiddenInput.type = "hidden";
        hiddenInput.name = "full_phone_number";
        hiddenInput.value = phoneNumber;
        this.appendChild(hiddenInput);
    });

    document.querySelectorAll('.toggle-password').forEach(function (eyeIcon) {
        eyeIcon.addEventListener('click', function () {
            let passwordInput = document.querySelector(eyeIcon.getAttribute('toggle'));
            let type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

<!-- Add this style block to your CSS or inside <style> tags -->
<style>
    .register-title {
        font-size: 42px;
        color: #212121; /* Darker color for title */
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
    }

    .bg-black {
        background-color: #000000; /* Ensure background color is black */
    }

    .text-white {
        color: #ffffff; /* Ensure text color is white */
    }

    .border-red-500 {
        border-color: #ef4444; /* Red border color */
    }

    .focus:border-red-500 {
        --border-opacity: 1;
        border-color: #ef4444;
    }

    .focus:ring-red-500 {
        --ring-offset-shadow: 0 0 0 var(--ring-offset-width) var(--ring-offset-color);
        --ring-shadow: 0 0 0 calc(1px + var(--ring-width)) var(--ring-color);
        --ring-color: #ef4444;
    }

    input {
        color: #ffffff; /* Ensure text color inside input fields is white */
    }

    .field-icon {
        color: red;
    }
</style>
