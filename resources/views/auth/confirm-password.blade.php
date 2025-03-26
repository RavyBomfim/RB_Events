<x-guest-layout>
    <x-authentication-card>
        <div class="form-container">
            <img src="{{ asset('img/rbevents-logo.png') }}" class='logo'>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Esta é uma área segura do aplicativo. Por favor, confirme sua senha antes de continuar.') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf

                <div>
                    <x-label for="password" value="{{ __('Senha') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
                </div>

                <div class="flex justify-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Confirmar') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
