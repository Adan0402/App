<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Servicio Social - Bolsa Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">🎓 Detalles de Servicio Social</h1>
                    <p class="text-gray-600">Información completa de la solicitud</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('empresa.servicio-social.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ← Volver a Solicitudes
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

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Columna izquierda: Información principal -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Información del Alumno -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">👨‍🎓 Información del Alumno</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm"><strong class="text-gray-700">Nombre completo:</strong> {{ $servicioSocial->alumno->name }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Carrera:</strong> {{ $servicioSocial->carrera }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Semestre:</strong> {{ $servicioSocial->semestre }}°</p>
                        </div>
                        <div>
                            <p class="text-sm"><strong class="text-gray-700">Número de control:</strong> {{ $servicioSocial->numero_control }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Email:</strong> {{ $servicioSocial->alumno->email }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Teléfono:</strong> {{ $servicioSocial->postulacion->telefono }}</p>
                        </div>
                    </div>
                </div>

                <!-- Información del Proyecto -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">🚀 Información del Proyecto</h2>
                    <div class="space-y-4">
                        <div>
                            <p class="text-sm font-medium text-gray-700">Nombre del Proyecto</p>
                            <p class="text-gray-900">{{ $servicioSocial->nombre_proyecto }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-700">Actividades Principales</p>
                            <p class="text-gray-900 whitespace-pre-line">{{ $servicioSocial->actividades_principales }}</p>
                        </div>
                    </div>
                </div>

                <!-- Información de la Vacante -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">💼 Información de la Vacante</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm"><strong class="text-gray-700">Puesto:</strong> {{ $servicioSocial->vacante->titulo }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Empresa:</strong> {{ $servicioSocial->empresa->nombre_empresa }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Ubicación:</strong> {{ $servicioSocial->vacante->ubicacion }}</p>
                        </div>
                        <div>
                            <p class="text-sm"><strong class="text-gray-700">Tipo de contrato:</strong> {{ ucfirst(str_replace('_', ' ', $servicioSocial->vacante->tipo_contrato)) }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Fecha postulación:</strong> {{ $servicioSocial->postulacion->created_at->format('d/m/Y') }}</p>
                            <p class="text-sm"><strong class="text-gray-700">Fecha aceptación:</strong> {{ $servicioSocial->postulacion->updated_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna derecha: Estado y acciones -->
            <div class="space-y-6">
                <!-- Estado y Período -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">📊 Estado y Período</h2>
                    <div class="space-y-4">
                        <!-- Estado -->
                        <div>
                            <p class="text-sm font-medium text-gray-700">Estado actual</p>
                            @php
                                $estados = [
                                    'solicitado' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => '⏳ Pendiente de revisión'],
                                    'empresa_acepto' => ['class' => 'bg-green-100 text-green-800', 'text' => '✅ Aceptado por empresa'],
                                    'jefe_aprobo' => ['class' => 'bg-blue-100 text-blue-800', 'text' => '🎓 Aprobado por servicio social'],
                                    'en_proceso' => ['class' => 'bg-purple-100 text-purple-800', 'text' => '⚡ En proceso'],
                                    'completado' => ['class' => 'bg-green-100 text-green-800', 'text' => '🏆 Completado'],
                                    'rechazado' => ['class' => 'bg-red-100 text-red-800', 'text' => '❌ Rechazado'],
                                ];
                                $estadoInfo = $estados[$servicioSocial->estado] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => $servicioSocial->estado];
                            @endphp
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $estadoInfo['class'] }}">
                                {{ $estadoInfo['text'] }}
                            </span>
                        </div>

                        <!-- Período -->
                        <div>
                            <p class="text-sm font-medium text-gray-700">Período estimado</p>
                            <p class="text-gray-900">
                                {{ $servicioSocial->fecha_inicio ? $servicioSocial->fecha_inicio->format('d/m/Y') : 'No definido' }} 
                                - 
                                {{ $servicioSocial->fecha_fin_estimada ? $servicioSocial->fecha_fin_estimada->format('d/m/Y') : 'No definido' }}
                            </p>
                        </div>

                        <!-- Horas -->
                        <div>
                            <p class="text-sm font-medium text-gray-700">Horas requeridas</p>
                            <p class="text-gray-900">{{ $servicioSocial->horas_requeridas }} horas totales</p>
                        </div>

                        <!-- Fechas importantes -->
                        <div>
                            <p class="text-sm font-medium text-gray-700">Fecha de solicitud</p>
                            <p class="text-gray-900">{{ $servicioSocial->created_at->format('d/m/Y H:i') }}</p>
                        </div>

                        @if($servicioSocial->fecha_empresa_acepto)
                        <div>
                            <p class="text-sm font-medium text-gray-700">Fecha de aprobación empresa</p>
                            <p class="text-gray-900">{{ $servicioSocial->fecha_empresa_acepto->format('d/m/Y H:i') }}</p>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Supervisor -->
                @if($servicioSocial->supervisor_empresa)
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">👨‍💼 Supervisor Designado</h2>
                    <div class="space-y-2">
                        <p class="text-sm"><strong class="text-gray-700">Nombre:</strong> {{ $servicioSocial->supervisor_empresa }}</p>
                        @if($servicioSocial->email_supervisor)
                        <p class="text-sm"><strong class="text-gray-700">Email:</strong> {{ $servicioSocial->email_supervisor }}</p>
                        @endif
                        @if($servicioSocial->telefono_supervisor)
                        <p class="text-sm"><strong class="text-gray-700">Teléfono:</strong> {{ $servicioSocial->telefono_supervisor }}</p>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Acciones para cuando está pendiente de empresa (jefe_aprobo) -->
                @if($servicioSocial->estado == 'jefe_aprobo')
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">⚡ Acciones - Aceptar Servicio Social</h2>
                    <div class="space-y-3">
                        <button onclick="aprobarSolicitud()" 
                                class="w-full bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Aprobar Servicio Social
                        </button>
                        
                        <button onclick="rechazarSolicitud()" 
                                class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            Rechazar Solicitud
                        </button>
                    </div>
                </div>
                @endif

                <!-- ✅ NUEVA SECCIÓN: Acciones para gestionar registros de horas -->
                @if(in_array($servicioSocial->estado, ['empresa_acepto', 'en_proceso']))
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">⏰ Gestión de Horas</h2>
                    <div class="space-y-3">
                        <a href="{{ route('empresa.servicio-social.registros-horas', $servicioSocial->id) }}" 
                           class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Gestionar Registros de Horas
                        </a>
                        <p class="text-sm text-gray-600 text-center">
                            Revisa y aprueba las horas registradas por el alumno
                        </p>
                    </div>
                </div>
                @endif

                <!-- Observaciones existentes -->
                @if($servicioSocial->observaciones_empresa)
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">📝 Observaciones</h2>
                    <p class="text-gray-700 whitespace-pre-line">{{ $servicioSocial->observaciones_empresa }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal para aprobar -->
    <div id="modalAprobar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">✅ Aprobar Servicio Social</h3>
            <form action="{{ route('empresa.servicio-social.aprobar', $servicioSocial->id) }}" method="POST">
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
            <form action="{{ route('empresa.servicio-social.rechazar', $servicioSocial->id) }}" method="POST">
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
        function aprobarSolicitud() {
            document.getElementById('modalAprobar').classList.remove('hidden');
        }

        function rechazarSolicitud() {
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