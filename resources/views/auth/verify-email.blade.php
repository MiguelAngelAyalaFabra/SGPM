<x-guest-layout>
    <div class="text-center mt-12">
        <img src="{{ asset('imgs/verificacion.png') }}" alt="Verifica tu cuenta" class="mx-auto w-24 h-24">
        <h2 class="text-xl font-bold mt-4">Confirma tu dirección de correo</h2>
        <p class="mt-2 text-gray-600">Hemos enviado un enlace de verificación a tu email.</p>
        
        @if (session('status') == 'verification-link-sent')
            <div class="mt-4 text-green-600 font-semibold">
                ✅ ¡Un nuevo enlace ha sido enviado a tu correo!
            </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}" class="mt-6">
            @csrf
            <x-primary-button>Reenviar enlace</x-primary-button>
        </form>
    </div>
</x-guest-layout>
