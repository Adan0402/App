<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsa de Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-600">🎓 ITSZN</h1>
                <h2 class="text-xl text-gray-700 mt-2">Bolsa de Trabajo</h2>
                <p class="text-gray-600 mt-4">Conectando alumnos con oportunidades laborales</p>
            </div>

            <div class="space-y-4">
                <a href="{{ route('login') }}" 
                   class="block w-full bg-blue-600 text-white py-3 px-4 rounded-lg text-center hover:bg-blue-700 transition">
                   🔐 Iniciar Sesión
                </a>
                
                <a href="/register-custom" 
                   class="block w-full bg-green-600 text-white py-3 px-4 rounded-lg text-center hover:bg-green-700 transition">
                   📝 Registrarse
                </a>

                <div class="border-t pt-4">
                    <a href="/usuarios" class="block text-center text-blue-600 hover:underline">
                        👥 Ver Usuarios Registrados
                    </a>
                    <a href="/dashboard" class="block text-center text-blue-600 hover:underline mt-2">
                        📊 Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>