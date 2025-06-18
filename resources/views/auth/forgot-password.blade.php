<x-guest-layout>

    <div class="text-center">
        <img src="{{ asset('imgs/matricula.png') }}" alt="Logo" class="mx-auto h-20 w-20">
        <h2 class="mt-4 text-2xl font-bold text-gray-800">¿Olvidó su contraseña?</h2>
        <p class="mt-4 mb-4 text-sm text-gray-500">No hay problema, ingrese su correo electrónico y le enviaremos un enlace para restablecer su
            contraseña.</p>
    </div>
    
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Botón de enviar -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Enviar enlace') }}
            </x-primary-button>
        </div> 
        <div class="mt-4">
                <a href="{{ route('login') }}" class="text-sm text-indigo-600 hover:underline">
                    Regresar al inicio sesión
                </a>
            </span>        
    </form>
</x-guest-layout>
