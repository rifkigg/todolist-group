<x-guest-layout>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="container">
        <form method="POST" action="{{ route('login') }}" class="card shadow">
            @csrf
            <div class="card-body">
                <a href="/"
                    class="text-2xl d-flex justify-content-center fs-2 fw-bold text-decoration-none text-dark">
                    Login Form
                </a>

                <!-- Email Address or Username -->
                <div>
                    <x-input-label for="login" class="form-label" :value="__('Email or Username')" />
                    <input id="login" type="text" name="login"
                        class="form-control @error('login') is-invalid @enderror" value="{{ old('login') }}" required
                        placeholder="Example@example.com" />
                    @error('login')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>


                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="Enter your password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                {{-- forgot password --}}
                <a href="{{ route('password.request') }}" class="text-sm text-gray-600 hover:text-gray-900">Lupa Password?</a>


                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="w-full">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
