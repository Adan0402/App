<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes de Servicio Social - Empresa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">🎓 Solicitudes de Servicio Social</h1>
                    <p class="text-gray-600">Gestiona las solicitudes de servicio social de tus postulantes</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('empresa.postulaciones') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ← Volver a Postulaciones
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $solicitudes->count() }}</div>
                <div class="text-sm text-gray-600">Total</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $solicitudes->where('estado', 'jefe_aprobo')->count() }}</div>
                <div class="text-sm text-gray-600">Pendientes</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $solicitudes->where('estado', 'empresa_acepto')->count() }}</div>
                <div class="text-sm text-gray-600">Aceptadas</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-red-600">{{ $solicitudes->where('estado', 'rechazado')->count() }}</div>
                <div class="text-sm text-gray-600">Rechazadas</div>
            </div>
        </div>

        @if($solicitudes->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumno</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puesto</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Solicitud</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($solicitudes as $solicitud)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $solicitud->alumno->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $solicitud->carrera }} - {{ $solicitud->semestre }}°</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $solicitud->vacante->titulo }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $solicitud->created_at->format('d/m/Y H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $estados = [
                                        'solicitado' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => 'Pendiente SS'],
                                        'jefe_aprobo' => ['class' => 'bg-blue-100 text-blue-800', 'text' => '✅ Aprobado SS - Espera tu aceptación'],
                                        'empresa_acepto' => ['class' => 'bg-green-100 text-green-800', 'text' => 'Aceptada'],
                                        'en_proceso' => ['class' => 'bg-purple-100 text-purple-800', 'text' => 'En Proceso'],
                                        'completado' => ['class' => 'bg-gray-100 text-gray-800', 'text' => 'Completado'],
                                        'rechazado' => ['class' => 'bg-red-100 text-red-800', 'text' => 'Rechazada'],
                                    ];
                                    $estadoInfo = $estados[$solicitud->estado] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => $solicitud->estado];
                                @endphp
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $estadoInfo['class'] }}">
                                    {{ $estadoInfo['text'] }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('empresa.servicio-social.show', $solicitud->id) }}" 
                                   class="text-blue-600 hover:text-blue-900 mr-3">Ver Detalles</a>
                                
                                <!-- ✅ CORREGIDO: Mostrar acciones cuando el estado es 'jefe_aprobo' -->
                                @if($solicitud->estado == 'jefe_aprobo')
                                    <button onclick="aprobarSolicitud({{ $solicitud->id }})" 
                                            class="text-green-600 hover:text-green-900 mr-3">Aprobar</button>
                                    <button onclick="rechazarSolicitud({{ $solicitud->id }})" 
                                            class="text-red-600 hover:text-red-900">Rechazar</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">📋</div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">No hay solicitudes de Servicio Social</h2>
                <p class="text-gray-600 mb-6">Los alumnos que hayas aceptado en vacantes podrán solicitar que su experiencia cuente como Servicio Social.</p>
            </div>
        @endif
    </div>

    <!-- Modal para aprobar -->
    <div id="modalAprobar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">✅ Aceptar Servicio Social</h3>
            <form id="formAprobar" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="observaciones_aprobacion" class="block text-sm font-medium text-gray-700 mb-1">
                        Observaciones (opcional)
                    </label>
                    <textarea id="observaciones_aprobacion" name="observaciones_empresa" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                              rows="3" placeholder="Comentarios o observaciones para el alumno..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="cerrarModal('modalAprobar')" 
                            class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        ✅ Aceptar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para rechazar -->
    <div id="modalRechazar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">❌ Rechazar Servicio Social</h3>
            <form id="formRechazar" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="observaciones_rechazo" class="block text-sm font-medium text-gray-700 mb-1">
                        Motivo del rechazo *
                    </label>
                    <textarea id="observaciones_rechazo" name="observaciones_empresa" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                              rows="3" placeholder="Explica el motivo del rechazo..." required></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="cerrarModal('modalRechazar')" 
                            class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        ❌ Rechazar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function aprobarSolicitud(id) {
            document.getElementById('formAprobar').action = `/empresa/servicio-social/${id}/aprobar`;
            document.getElementById('modalAprobar').classList.remove('hidden');
        }

        function rechazarSolicitud(id) {
            document.getElementById('formRechazar').action = `/empresa/servicio-social/${id}/rechazar`;
            document.getElementById('modalRechazar').classList.remove('hidden');
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Cerrar modales al hacer clic fuera
        document.getElementById('modalAprobar').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal('modalAprobar');
        });

        document.getElementById('modalRechazar').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal('modalRechazar');
        });
    </script>
</body>
</html>