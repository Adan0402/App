<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Soporte Técnico - Admin ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Header -->
        <header class="bg-white shadow-sm">
            <div class="container mx-auto px-4 py-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">🔧 Soporte Técnico</h1>
                        <p class="text-gray-600">Sistema de Administración - ITSZN</p>
                    </div>
                    <div class="space-x-4">
                        <a href="{{ route('dashboard') }}" 
                           class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                            ← Volver al Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </header>

        <!-- Contenido Principal -->
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-4xl mx-auto">
                <!-- Tarjetas de Información -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Contacto de Soporte -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-500 p-3 rounded-full">
                                <span class="text-white text-xl">📞</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Contacto Directo</h3>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center text-gray-600">
                                <span class="bg-blue-100 p-2 rounded mr-3">📧</span>
                                <div>
                                    <p class="font-medium">Correo Electrónico</p>
                                    <p class="text-sm">itszndirecciongeneral@gmail.com</p>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <span class="bg-blue-100 p-2 rounded mr-3">📱</span>
                                <div>
                                    <p class="font-medium">Teléfono</p>
                                    <p class="text-sm">+52 498 488 30 02</p>
                                </div>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <span class="bg-blue-100 p-2 rounded mr-3">🕒</span>
                                <div>
                                    <p class="font-medium">Horario de Atención</p>
                                    <p class="text-sm">Lun-Vie: 8:00 - 15:00 hrs</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Reportar Problema -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-red-500 p-3 rounded-full">
                                <span class="text-white text-xl">🚨</span>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-semibold text-gray-800">Reportar Problema</h3>
                            </div>
                        </div>
                        <form class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tipo de Problema</label>
                                <select class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                    <option value="">Selecciona el tipo</option>
                                    <option value="tecnico">Problema Técnico</option>
                                    <option value="funcional">Error Funcional</option>
                                    <option value="seguridad">Problema de Seguridad</option>
                                    <option value="otro">Otro</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                                <textarea rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Describe detalladamente el problema..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
                                📨 Enviar Reporte
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Guías Rápidas -->
                <div class="bg-white rounded-lg shadow p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📚 Guías Rápidas</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="#" class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <div class="text-blue-500 text-lg mb-2">📊</div>
                            <p class="font-medium text-gray-800">Manual de Administración</p>
                            <p class="text-sm text-gray-600 mt-1">Guía completa del sistema</p>
                        </a>
                        <a href="#" class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <div class="text-green-500 text-lg mb-2">🔐</div>
                            <p class="font-medium text-gray-800">Solución de Errores</p>
                            <p class="text-sm text-gray-600 mt-1">Problemas comunes y soluciones</p>
                        </a>
                        <a href="#" class="bg-gray-50 p-4 rounded-lg border border-gray-200 hover:shadow-md transition">
                            <div class="text-purple-500 text-lg mb-2">⚙️</div>
                            <p class="font-medium text-gray-800">Configuraciones</p>
                            <p class="text-sm text-gray-600 mt-1">Ajustes del sistema</p>
                        </a>
                    </div>
                </div>

                <!-- Estado del Sistema -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📈 Estado del Sistema</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="bg-green-500 p-2 rounded-full mr-3">✅</span>
                                <span class="font-medium text-green-800">Servidor Web</span>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Operativo</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="bg-green-500 p-2 rounded-full mr-3">✅</span>
                                <span class="font-medium text-green-800">Base de Datos</span>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Operativo</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-green-50 rounded-lg">
                            <div class="flex items-center">
                                <span class="bg-green-500 p-2 rounded-full mr-3">✅</span>
                                <span class="font-medium text-green-800">Servicio de Correo</span>
                            </div>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Operativo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>