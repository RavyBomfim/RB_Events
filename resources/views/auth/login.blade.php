<link rel="stylesheet" href="{{ asset('css/login-register.css') }}">

<x-guest-layout>
    <x-authentication-card>
        {{-- <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot> --}}

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="form-container">
            @csrf

            <img src="{{ asset('img/rbevents-logo.png') }}" class='logo'>

            <div class="authentication-box">
                <a class='btn-auth' href="{{ route('googleAuth') }}">
                    <img src="{{ asset('img/google-logo.svg') }}">
                    <span>Entrar com o Google</span>
                </a>
            </div>

            <div class="paragraph-box">
                <p>Entrar com o email</p>
            </div>
            
            <div class="inputs-container">
                <div>
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Senha') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="block mt-4" id="remember-me">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Manter-se conectado') }}</span>
                    </label>
                </div>

                <div class="form-footer">
                    <x-button class="btn-form">
                        {{ __('Entrar') }}
                    </x-button>

                    <div class="forget-password">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Esqueceu sua senha?') }}
                            </a>
                        @endif
                    </div>

                    <div class="link-container">
                        <span>Não tem cadastro?</span>
                        <a href="/register">Cadastrar</a>
                    </div>
                </div>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<div class="mg-btm"></div>