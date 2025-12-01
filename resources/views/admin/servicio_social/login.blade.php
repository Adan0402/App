<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Servicio Social - ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .azul-itszn { background-color: #1B396A; }
        .azul-itszn-claro { background-color: #2D4F8A; }
        .texto-azul-itszn { color: #1B396A; }
        .borde-azul-itszn { border-color: #1B396A; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Encabezado institucional -->
            <div class="azul-itszn text-white p-4 text-center">
                <div class="flex items-center justify-center mb-2">
                    <img src="{{ asset('images/logo-tecnm.png') }}" 
                         alt="TecNM Logo" 
                         class="h-12 w-12 mr-3">
                    <div>
                        <h1 class="text-lg font-bold">Instituto Tecnológico Superior</h1>
                        <p class="text-sm opacity-90">de Rio Grande</p>
                    </div>
                </div>
            </div>

            <!-- Contenido del login -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <!-- Logo del TecNM sin círculo de fondo -->
                    <div class="mx-auto mb-3 flex items-center justify-center">
                        <img src="{{ asset('images/logoblanco.png') }}" 
                             alt="TecNM Logo" 
                             class="h-16 w-16">
                    </div>
                    <h2 class="text-xl font-bold texto-azul-itszn">Servicio Social</h2>
                    <p class="text-gray-600 text-sm">Acceso al panel del coordinador</p>
                </div>

                @if(session('error'))
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.servicio-social.verify') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block texto-azul-itszn text-sm font-bold mb-2">Email Institucional</label>
                        <input type="email" name="email" value="servicio.social@itszn.edu.mx" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500 bg-gray-50"
                               required readonly>
                        <p class="text-xs text-gray-500 mt-1">Email institucional del coordinador</p>
                    </div>

                    <div class="mb-6">
                        <label class="block texto-azul-itszn text-sm font-bold mb-2">Contraseña</label>
                        <input type="password" name="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               placeholder="Ingresa la contraseña del coordinador" required>
                        <p class="text-xs text-gray-500 mt-1">Contraseña exclusiva del servicio social</p>
                    </div>

                    <button type="submit" 
                            class="w-full azul-itszn text-white py-3 px-4 rounded-lg hover:bg-blue-800 transition-all duration-300 font-semibold shadow-md">
                        🔐 Acceder al Panel de Servicio Social
                    </button>

                    <div class="mt-4 text-center">
                        <a href="{{ route('dashboard') }}" class="texto-azul-itszn hover:text-blue-800 text-sm font-medium">
                            ← Volver al Dashboard Principal
                        </a>
                    </div>
                </form>
            </div>

            <!-- Footer institucional -->
            <div class="bg-gray-100 border-t border-gray-200 p-3 text-center">
                <p class="text-xs text-gray-600">
                    Sistema de Gestión de Servicio Social - ITSZN
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Acceso restringido al personal autorizado
                </p>
            </div>
        </div>
    </div>
</body>
</html>