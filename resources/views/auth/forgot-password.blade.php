<x-guest-layout>
    
    <!-- Session Status -->
    
    <div class="container-fluid">
        <div class="mb-4">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-100" type="email" name="email" :value="old('email')" required autofocus placeholder="Example@example.com"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button>
                        {{ __('Email Password Reset Link') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
</x-guest-layout>
