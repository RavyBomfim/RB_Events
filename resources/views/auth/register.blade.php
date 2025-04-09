<x-guest-layout title="Cadastrar">
    <x-authentication-card>
        <div class="form-container container-rg">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <img src="{{ asset('img/rbevents-logo.png') }}" class='logo'>

                <div class="inputs-container">
                    <div>
                        <x-label for="name" value="{{ __('Nome') }}" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" autofocus autocomplete="name" />
                        @error('name')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" autocomplete="username" />
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mt-4">
                        <x-label for="password" value="{{ __('Senha') }}" />
                        <x-input id="password" class="block mt-1 w-full" type="password" name="password" autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-label for="password_confirmation" value="{{ __('Confirmar Senha') }}" />
                        <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" autocomplete="new-password" />
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required />

                                <div class="ms-2">
                                    {!! __('Eu concordo com os :termos de serviço e :políticas de privacidade', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Termos de Serviço').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('olíticas de Privacidade').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="form-footer">
                    <x-button>
                        {{ __('Cadastrar') }}
                    </x-button>

                    <div class="link-container">
                        <span>Já tem cadastro?</span>
                        <a href="{{ route('login') }}">
                            {{ __('Entrar') }}
                        </a>
                    </div>

                    <div class="paragraph-box" id="ph-box-register">
                        <p>ou</p>
                    </div>

                    <div class="authentication-box">
                        <a class='btn-auth' href="{{ route('googleAuth') }}">
                            <img src="{{ asset('img/google-logo.svg') }}">
                            <span>Entrar com o Google</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>

<div class="mg-btm"></div>
