    <x-login-layout>
        <div class="Link">
            <a href="{{route('home')}}">Portal de Notícias</a>
        </div>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <input placeholder="Email" id="email" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">

                <input placeholder="Senha" id="password"  type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="mt-4 form-group d-flex">
                <label for="remember_me" class="form-check-label d-flex">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar de mim') }}</span>
                </label>
            </div>

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
            </div>
        </form>
    </x-login-layout>
