<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Servicio Social - ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">🎓 Panel de Servicio Social</h1>
                    <p class="text-gray-600">Coordinación de Servicio Social - ITSZN</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('dashboard') }}" class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        ← Dashboard Principal
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
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $estadisticas['total'] }}</div>
                <div class="text-sm text-gray-600">Total Solicitudes</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $estadisticas['pendientes'] }}</div>
                <div class="text-sm text-gray-600">Pendientes</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $estadisticas['aprobados'] }}</div>
                <div class="text-sm text-gray-600">Aprobados</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $estadisticas['en_proceso'] + $estadisticas['completados'] }}</div>
                <div class="text-sm text-gray-600">En Proceso/Completados</div>
            </div>
        </div>

        <!-- ✅ PANEL DE ACCIONES RÁPIDAS -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🚀 Acciones Rápidas</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Estadísticas Globales -->
                <a href="{{ route('admin.servicio-social.estadisticas') }}" 
                   class="bg-blue-600 text-white p-4 rounded-lg hover:bg-blue-700 transition text-center">
                    <div class="text-2xl mb-2">📊</div>
                    <div class="font-semibold">Estadísticas Globales</div>
                    <div class="text-sm opacity-80">Ver reportes y gráficos</div>
                </a>

                <!-- Servicios en Proceso -->
                <a href="{{ route('admin.servicio-social.index') }}?estado=en_proceso" 
                   class="bg-purple-600 text-white p-4 rounded-lg hover:bg-purple-700 transition text-center">
                    <div class="text-2xl mb-2">⚡</div>
                    <div class="font-semibold">Servicios Activos</div>
                    <div class="text-sm opacity-80">{{ $estadisticas['en_proceso'] }} en proceso</div>
                </a>

                <!-- Pendientes de Revisión -->
                <a href="{{ route('admin.servicio-social.index') }}?estado=solicitado" 
                   class="bg-yellow-600 text-white p-4 rounded-lg hover:bg-yellow-700 transition text-center">
                    <div class="text-2xl mb-2">⏳</div>
                    <div class="font-semibold">Pendientes</div>
                    <div class="text-sm opacity-80">{{ $estadisticas['pendientes'] }} por revisar</div>
                </a>
            </div>
        </div>

        <!-- ✅ FILTROS MEJORADOS -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <h2 class="text-lg font-semibold text-gray-800">Filtros</h2>
                
                <!-- Filtro por Estado -->
                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('admin.servicio-social.index') }}" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ !request('estado') ? 'bg-blue-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        Todos ({{ $estadisticas['total'] }})
                    </a>
                    <a href="{{ route('admin.servicio-social.index') }}?estado=solicitado" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ request('estado') == 'solicitado' ? 'bg-yellow-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        ⏳ Pendientes ({{ $estadisticas['pendientes'] }})
                    </a>
                    <a href="{{ route('admin.servicio-social.index') }}?estado=jefe_aprobo" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ request('estado') == 'jefe_aprobo' ? 'bg-green-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        ✅ Aprobados ({{ $estadisticas['aprobados'] }})
                    </a>
                    <a href="{{ route('admin.servicio-social.index') }}?estado=empresa_acepto" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ request('estado') == 'empresa_acepto' ? 'bg-blue-500 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        🏢 Empresa Aceptó
                    </a>
                    <a href="{{ route('admin.servicio-social.index') }}?estado=en_proceso" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ request('estado') == 'en_proceso' ? 'bg-purple-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        ⚡ En Proceso ({{ $estadisticas['en_proceso'] }})
                    </a>
                    <a href="{{ route('admin.servicio-social.index') }}?estado=completado" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ request('estado') == 'completado' ? 'bg-gray-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        🎓 Completados ({{ $estadisticas['completados'] }})
                    </a>
                    <a href="{{ route('admin.servicio-social.index') }}?estado=rechazado" 
                       class="px-4 py-2 rounded text-sm font-medium transition-all {{ request('estado') == 'rechazado' ? 'bg-red-600 text-white shadow-md' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        ❌ Rechazados
                    </a>
                </div>
            </div>

            <!-- Mostrar filtro activo -->
            @if(request('estado'))
                <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <span class="text-blue-700 font-medium">
                                Filtro activo: 
                                @php
                                    $estadosTexto = [
                                        'solicitado' => '⏳ Pendientes',
                                        'jefe_aprobo' => '✅ Aprobados', 
                                        'empresa_acepto' => '🏢 Empresa Aceptó',
                                        'en_proceso' => '⚡ En Proceso',
                                        'completado' => '🎓 Completados',
                                        'rechazado' => '❌ Rechazados'
                                    ];
                                @endphp
                                {{ $estadosTexto[request('estado')] ?? request('estado') }}
                            </span>
                            <span class="ml-2 text-blue-600 text-sm">
                                ({{ $solicitudes->count() }} resultados)
                            </span>
                        </div>
                        <a href="{{ route('admin.servicio-social.index') }}" 
                           class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            ✕ Limpiar filtro
                        </a>
                    </div>
                </div>
            @endif
        </div>

        @if($solicitudes->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <p class="text-sm text-gray-600">
                            Mostrando <span class="font-semibold">{{ $solicitudes->count() }}</span> 
                            de <span class="font-semibold">{{ $estadisticas['total'] }}</span> servicios sociales
                        </p>
                        @if(request('estado'))
                            <a href="{{ route('admin.servicio-social.index') }}" 
                               class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                ← Ver todos
                            </a>
                        @endif
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alumno</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empresa</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puesto</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha Solicitud</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($solicitudes as $solicitud)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $solicitud->alumno->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $solicitud->carrera }} - {{ $solicitud->semestre }}°</div>
                                            <div class="text-xs text-gray-400">{{ $solicitud->numero_control }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $solicitud->empresa->nombre_empresa }}</div>
                                    <div class="text-xs text-gray-500">{{ $solicitud->empresa->giro_empresa }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $solicitud->vacante->titulo }}</div>
                                    <div class="text-xs text-gray-500">{{ $solicitud->nombre_proyecto }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $solicitud->created_at->format('d/m/Y H:i') }}
                                    <div class="text-xs text-gray-400">
                                        {{ $solicitud->created_at->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $estados = [
                                            'solicitado' => ['class' => 'bg-yellow-100 text-yellow-800 border border-yellow-200', 'text' => '⏳ Pendiente', 'icon' => '⏳'],
                                            'jefe_aprobo' => ['class' => 'bg-green-100 text-green-800 border border-green-200', 'text' => '✅ Aprobado SS', 'icon' => '✅'],
                                            'empresa_acepto' => ['class' => 'bg-blue-100 text-blue-800 border border-blue-200', 'text' => '🏢 Empresa Aceptó', 'icon' => '🏢'],
                                            'en_proceso' => ['class' => 'bg-purple-100 text-purple-800 border border-purple-200', 'text' => '⚡ En Proceso', 'icon' => '⚡'],
                                            'completado' => ['class' => 'bg-gray-100 text-gray-800 border border-gray-300', 'text' => '🎓 Completado', 'icon' => '🎓'],
                                            'rechazado' => ['class' => 'bg-red-100 text-red-800 border border-red-200', 'text' => '❌ Rechazado', 'icon' => '❌'],
                                        ];
                                        $estadoInfo = $estados[$solicitud->estado] ?? ['class' => 'bg-gray-100 text-gray-800 border border-gray-300', 'text' => $solicitud->estado, 'icon' => '📄'];
                                    @endphp
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $estadoInfo['class'] }}">
                                        {{ $estadoInfo['icon'] }} 
                                        <span class="ml-1">{{ $estadoInfo['text'] }}</span>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex flex-col space-y-2 min-w-[140px]">
                                        <!-- Botón VER DETALLES - siempre visible -->
                                        <a href="{{ route('admin.servicio-social.show', $solicitud->id) }}" 
                                           class="inline-flex items-center justify-center bg-blue-100 text-blue-700 px-3 py-2 rounded text-xs hover:bg-blue-200 w-full text-center transition-colors">
                                            👁️ Ver Detalles
                                        </a>
                                        
                                        <!-- Botón REPORTE - para servicios aprobados y en proceso -->
                                        @if(in_array($solicitud->estado, ['jefe_aprobo', 'empresa_acepto', 'en_proceso', 'completado']))
                                            <a href="{{ route('admin.servicio-social.reporte', $solicitud->id) }}" 
                                               class="inline-flex items-center justify-center bg-purple-100 text-purple-700 px-3 py-2 rounded text-xs hover:bg-purple-200 w-full text-center transition-colors">
                                                📊 Ver Reporte
                                            </a>
                                        @endif
                                        
                                        <!-- Botón VER HORAS - solo para servicios activos -->
                                        @if(in_array($solicitud->estado, ['empresa_acepto', 'en_proceso']))
                                            <a href="{{ route('admin.servicio-social.registros', $solicitud->id) }}" 
                                               class="inline-flex items-center justify-center bg-green-100 text-green-700 px-3 py-2 rounded text-xs hover:bg-green-200 w-full text-center transition-colors">
                                                ⏱️ Ver Horas
                                            </a>
                                        @endif
                                        
                                        <!-- Botones APROBAR/RECHAZAR - solo para pendientes -->
                                        @if($solicitud->estado == 'solicitado')
                                            <button onclick="aprobarSolicitud({{ $solicitud->id }})" 
                                                    class="inline-flex items-center justify-center bg-green-100 text-green-700 px-3 py-2 rounded text-xs hover:bg-green-200 w-full text-center transition-colors">
                                                ✅ Aprobar
                                            </button>
                                            <button onclick="rechazarSolicitud({{ $solicitud->id }})" 
                                                    class="inline-flex items-center justify-center bg-red-100 text-red-700 px-3 py-2 rounded text-xs hover:bg-red-200 w-full text-center transition-colors">
                                                ❌ Rechazar
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

                        <!-- Paginación -->
            @if($solicitudes->hasPages())
                <div class="bg-white px-6 py-4 border-t border-gray-200 rounded-b-lg">
                    {{ $solicitudes->links() }}
                </div>
            @endif
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">📋</div>
                <h2 class="text-2xl font-bold text-gray-800 mb-4">
                    @if(request('estado'))
                        No hay servicios en estado "{{ $estadosTexto[request('estado')] ?? request('estado') }}"
                    @else
                        No hay solicitudes de Servicio Social
                    @endif
                </h2>
                <p class="text-gray-600 mb-6">
                    @if(request('estado'))
                        No se encontraron servicios sociales con el filtro aplicado.
                    @else
                        Los alumnos aparecerán aquí cuando soliciten Servicio Social.
                    @endif
                </p>
                @if(request('estado'))
                    <a href="{{ route('admin.servicio-social.index') }}" 
                       class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        ← Ver todos los servicios
                    </a>
                @endif
            </div>
        @endif
    </div>

    <!-- Modal para aprobar -->
    <div id="modalAprobar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">✅ Aprobar Servicio Social</h3>
            <form id="formAprobar" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="observaciones_aprobacion" class="block text-sm font-medium text-gray-700 mb-1">
                        Observaciones (opcional)
                    </label>
                    <textarea id="observaciones_aprobacion" name="observaciones_jefe" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                              rows="3" placeholder="Comentarios para el alumno..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="cerrarModal('modalAprobar')" 
                            class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                        ✅ Aprobar
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
                    <textarea id="observaciones_rechazo" name="observaciones_jefe" 
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
            document.getElementById('formAprobar').action = `/admin/servicio-social/${id}/aprobar`;
            document.getElementById('modalAprobar').classList.remove('hidden');
        }

        function rechazarSolicitud(id) {
            document.getElementById('formRechazar').action = `/admin/servicio-social/${id}/rechazar`;
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