<x-login-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="Link">
            <a href="{{route('home')}}">Blog Do Dhy</a>
        </div>
        <!-- Name -->
        <div>
            <input id="name" placeholder="Nome" type="text" name="name" :value="old('name')" required autofocus
                autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <input id="email" placeholder="Email" type="email" name="email" :value="old('email')" required
                autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <input id="password" placeholder="Senha" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">

            <input placeholder="Confirme sua senha" id="password_confirmation" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="btn btn-primary">
                {{ __('Registrar') }}
            </x-primary-button>
        </div>
    </form>
    </x-guest-layout>
