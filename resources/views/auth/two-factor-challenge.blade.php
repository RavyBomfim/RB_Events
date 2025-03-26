<x-guest-layout>
    <x-authentication-card>
        <div class="form-container">
            <img src="{{ asset('img/rbevents-logo.png') }}" class='logo'>
            
            <div x-data="{ recovery: false }">
                <div class="mb-4 text-sm text-gray-600" x-show="! recovery">
                    {{ __('Por favor, confirme o acesso à sua conta inserindo o código de autenticação fornecido pelo seu aplicativo autenticador.') }}
                </div>

                <div class="mb-4 text-sm text-gray-600" x-cloak x-show="recovery">
                    {{ __('Por favor, confirme o acesso à sua conta inserindo um dos seus códigos de recuperação de emergência.') }}
                </div>

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('two-factor.login') }}">
                    @csrf

                    <div class="mt-4" x-show="! recovery">
                        <x-label for="code" value="{{ __('Código') }}" />
                        <x-input id="code" class="block mt-1 w-full" type="text" inputmode="numeric" name="code" autofocus x-ref="code" autocomplete="one-time-code" />
                    </div>

                    <div class="mt-4" x-cloak x-show="recovery">
                        <x-label for="recovery_code" value="{{ __('Código de recuperação') }}" />
                        <x-input id="recovery_code" class="block mt-1 w-full" type="text" name="recovery_code" x-ref="recovery_code" autocomplete="one-time-code" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                        x-show="! recovery"
                                        x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                            {{ __('Use um código de recuperação') }}
                        </button>

                        <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                                        x-cloak
                                        x-show="recovery"
                                        x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                            {{ __('Use um código de autenticação') }}
                        </button>

                        <x-button>
                            {{ __('Entrar') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
