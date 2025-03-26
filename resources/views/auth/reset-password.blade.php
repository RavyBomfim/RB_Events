<x-guest-layout>
    <x-authentication-card>
        <div class="form-container">
            <img src="{{ asset('img/rbevents-logo.png') }}" class='logo'>
            
            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="block">
                    <x-label for="email" value="{{ __($request->email) }}" class="label-center" />
                    <x-input id="email" class="block mt-1 w-full" type="hidden" name="email" :value="old('email', $request->email)" autofocus autocomplete="username" />
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

                <div class="flex items-center justify-end mt-4">
                    <x-button>
                        {{ __('Redefinir Senha') }}
                    </x-button>
                </div>
            </form>
            </div>
    </x-authentication-card>
</x-guest-layout>
