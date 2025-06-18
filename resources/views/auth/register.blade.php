<x-guest-layout>
    

            <div class="text-center">
                <img src="{{ asset('imgs/matricula.png') }}" alt="Logo" class="mx-auto h-20 w-20">
                <h2 class="mt-4 text-2xl font-bold text-gray-800">Crea tu cuenta</h2>
                <p class="text-sm text-gray-500">Empieza a gestionar tu negocio.</p>
            </div>

        <!-- Formulario -->
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Nombre -->
            <div>
                <x-input-label for="name" :value="__('Nombre')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email -->
            <div>
                <x-input-label for="email" :value="__('Correo')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="relative">
                <x-input-label for="password" :value="__('Contraseña')" />
                <input id="password"
                    class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 pr-10"
                    type="password" name="password" required autocomplete="new-password" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                    onclick="togglePassword('password', this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-6 text-gray-500 hover:text-indigo-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="relative mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirma tu contraseña')" />
                <input id="password_confirmation"
                    class="block mt-1 w-full rounded-md border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 pr-10"
                    type="password" name="password_confirmation" required autocomplete="new-password" />
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer"
                    onclick="togglePassword('password_confirmation', this)">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-6 text-gray-500 hover:text-indigo-600"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Botón -->
            <div class="pt-4 flex justify-center">
                <x-primary-button>
                    Regístrate
                </x-primary-button>
            </div>
        </form>

        <!-- Link a login -->
        <div class="text-center text-sm text-gray-500 pt-4">
            ¿Ya tienes una cuenta?
            <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-800 font-semibold">Inicia sesión</a>
        </div>

    <script>
        function togglePassword(id, el) {
                const input = document.getElementById(id);
                const svg = el.querySelector('svg');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a10.05 10.05 0 012.26-3.592m3.768-2.179A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.963 9.963 0 01-4.293 5.097M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />';
                } else {
                    input.type = 'password';
                    svg.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />';
                }
            }
    </script>

    </form>
</x-guest-layout>