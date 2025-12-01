<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bolsa de Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .azul-itszn { background-color: #1B396A; }
        .azul-itszn-claro { background-color: #2D4F8A; }
        .texto-azul-itszn { color: #1B396A; }
        .borde-azul-itszn { border-color: #1B396A; }
        
        /* Animaciones */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        
        .fade-in { animation: fadeIn 0.8s ease-out; }
        .fade-out { animation: fadeOut 0.8s ease-out; }
        
        .welcome-animation {
            animation: fadeIn 1s ease-out, fadeOut 0.8s ease-out 2.2s forwards;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Pantalla de Bienvenida AZUL -->
    <div id="welcomeScreen" class="fixed inset-0 azul-itszn flex items-center justify-center z-50 welcome-animation">
        <div class="text-center text-white">
            <div class="mb-6 flex justify-center">
                <img src="{{ asset('images/logo-tecnm.png') }}" 
                     alt="TecNM Logo" 
                     class="h-24 w-24 bg-white rounded-lg p-2">
            </div>
            <h1 class="text-4xl font-bold mb-2">ITSZN</h1>
            <p class="text-xl opacity-90">Instituto Tecnológico Superior Zacatecas Norte</p>
            <p class="text-lg mt-4 opacity-80">Bolsa de Trabajo</p>
            <div class="mt-8">
                <div class="inline-block h-1 w-16 bg-white rounded-full opacity-60"></div>
            </div>
        </div>
    </div>

    <!-- Contenido Principal (oculto inicialmente) -->
    <div id="loginContent" class="min-h-screen flex items-center justify-center hidden">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Encabezado institucional -->
            <div class="azul-itszn text-white p-4 text-center">
                <div class="flex items-center justify-center mb-2">
                    <img src="{{ asset('images/logo-tecnm.png') }}" 
                         alt="TecNM Logo" 
                         class="h-12 w-12 mr-3 bg-white rounded-lg p-1">
                    <div>
                        <h1 class="text-lg font-bold">Instituto Tecnológico Superior</h1>
                        <p class="text-sm opacity-90">de Rio Grande</p>
                    </div>
                </div>
            </div>

            <!-- Contenido del login -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <!-- Logo del TecNM -->
                    <div class="mx-auto mb-3 flex items-center justify-center">
                        <img src="{{ asset('images/logo-tecnm.png') }}" 
                             alt="TecNM Logo" 
                             class="h-16 w-16">
                    </div>
                    <h2 class="text-xl font-bold texto-azul-itszn">Bolsa de Trabajo</h2>
                    <p class="text-gray-600 text-sm">Inicia sesión en tu cuenta</p>
                </div>

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('status'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Formulario de Login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block texto-azul-itszn text-sm font-bold mb-2">
                            📧 Correo Electrónico
                        </label>
                        <input id="email" type="email" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               name="email" value="{{ old('email') }}" required autofocus
                               placeholder="usuario@itszn.edu.mx">
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-6">
                        <label for="password" class="block texto-azul-itszn text-sm font-bold mb-2">
                            🔒 Contraseña
                        </label>
                        <input id="password" type="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               name="password" required 
                               placeholder="Ingresa tu contraseña">
                        @error('password')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Recordar sesión -->
                    <div class="mb-6 flex items-center">
                        <input type="checkbox" name="remember" id="remember" class="mr-2">
                        <label for="remember" class="text-sm text-gray-700">Recordar sesión</label>
                    </div>

                    <!-- Botón de Login -->
                    <button type="submit" 
                            class="w-full azul-itszn text-white py-3 px-4 rounded-lg hover:bg-blue-800 transition-all duration-300 font-semibold shadow-md mb-4">
                        🔐 Iniciar Sesión
                    </button>
                </form>

                <!-- Enlaces adicionales -->
                <div class="mt-6 text-center space-y-3">
                    @if (Route::has('register'))
                        <p class="text-gray-600 text-sm">
                            ¿No tienes cuenta? 
                            <a href="{{ route('register') }}" class="texto-azul-itszn hover:text-blue-800 font-medium">
                                Regístrate aquí
                            </a>
                        </p>
                    @endif

                    @if (Route::has('password.request'))
                        <p class="text-gray-600 text-sm">
                            <a href="{{ route('password.request') }}" class="texto-azul-itszn hover:text-blue-800">
                                ¿Olvidaste tu contraseña?
                            </a>
                        </p>
                    @endif
                </div>
            </div>

            <!-- Footer institucional -->
            <div class="bg-gray-100 border-t border-gray-200 p-3 text-center">
                <p class="text-xs text-gray-600">
                    Sistema de Bolsa de Trabajo - ITSZN
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Tecnológico Nacional de México
                </p>
            </div>
        </div>
    </div>

    <script>
        // Animación de bienvenida
        document.addEventListener('DOMContentLoaded', function() {
            const welcomeScreen = document.getElementById('welcomeScreen');
            const loginContent = document.getElementById('loginContent');
            
            // Esperar 3 segundos y luego mostrar el login
            setTimeout(function() {
                welcomeScreen.classList.add('fade-out');
                
                setTimeout(function() {
                    welcomeScreen.style.display = 'none';
                    loginContent.classList.remove('hidden');
                    loginContent.classList.add('fade-in');
                }, 800); // Tiempo de la animación fadeOut
                
            }, 4000); // 3 segundos de bienvenida
        });
    </script>
</body>
</html>