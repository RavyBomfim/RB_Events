<x-guest-layout>
    <x-authentication-card>
        <div class="form-container container-lg">
            <form method="POST" action="{{ route('login') }}">
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
                        @error('email') 
                            <span class='error-message'>{{ $message }}</span>
                        @enderror 
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Senha') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        @error('password') 
                            <span class='error-message'>{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-footer">
                        <x-button>
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
        </div>
    </x-authentication-card>
</x-guest-layout>

<div class="mg-btm"></div>