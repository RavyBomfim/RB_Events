<x-guest-layout>
    <x-authentication-card>
        <div class="form-container">
            <img src="{{ asset('img/rbevents-logo.png') }}" class='logo'>

            <div class="mb-4 text-sm text-gray-600">
                {{ __('Esqueceu sua senha? Sem problemas. Nos informe seu endereço de e-mail e lhe enviaremos o link para redefinição de senha.') }}
            </div>

            {{-- Mensagem de sucesso ao enviar o email: We have emailed your password reset link.
            Mensagem de falha ao tentar enviar o email: We can't find a user with that email address. --}}

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="block">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"/>
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Enviar Email de Redefinição de Senha') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-guest-layout>
