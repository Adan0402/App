<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Horas - Empresa</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">⏰ Gestión de Registros de Horas</h1>
                    <p class="text-gray-600">{{ $servicioSocial->alumno->name }} - {{ $servicioSocial->empresa->nombre_empresa }}</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('admin.servicio-social.index') }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        ← Volver a Servicios
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

        <!-- Tarjetas de Progreso -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $servicioSocial->horas_requeridas }}</div>
                <div class="text-sm text-gray-600">Horas Requeridas</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $horasAprobadas }}</div>
                <div class="text-sm text-gray-600">Horas Aprobadas</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $horasPendientes }}</div>
                <div class="text-sm text-gray-600">Horas Pendientes</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $progreso }}%</div>
                <div class="text-sm text-gray-600">Progreso Total</div>
            </div>
        </div>

        <!-- Barra de Progreso -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-center mb-2">
                <span class="text-sm font-medium text-gray-700">Progreso del Servicio Social</span>
                <span class="text-sm font-medium text-gray-700">{{ $progreso }}%</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-4">
                <div class="bg-green-600 h-4 rounded-full transition-all duration-300" 
                     style="width: {{ $progreso }}%"></div>
            </div>
            <div class="flex justify-between text-xs text-gray-500 mt-1">
                <span>0 horas</span>
                <span>{{ $servicioSocial->horas_requeridas }} horas</span>
            </div>
        </div>

        <!-- Registros de Horas -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h3 class="text-lg font-semibold text-gray-800">📋 Registros de Horas del Alumno</h3>
                <p class="text-gray-600 text-sm">Revisa y aprueba los registros de horas enviados por el alumno</p>
            </div>

            @if($servicioSocial->registrosHoras->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Horas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actividades</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Evidencias</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($servicioSocial->registrosHoras->sortByDesc('fecha') as $registro)
                            <tr class="hover:bg-gray-50 transition duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $registro->fecha->format('d/m/Y') }}</div>
                                    <div class="text-xs text-gray-500">{{ $registro->fecha->format('l') }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        ⏰ {{ $registro->horas_trabajadas }} horas
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-xs">
                                        {{ Str::limit($registro->actividades_realizadas, 60) }}
                                        @if(strlen($registro->actividades_realizadas) > 60)
                                            <button onclick="mostrarDetallesRegistro({{ $registro->id }})" 
                                                    class="text-blue-600 hover:text-blue-800 text-xs font-medium ml-1">
                                                Ver más
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($registro->evidencias)
                                        <button onclick="mostrarDetallesRegistro({{ $registro->id }})" 
                                                class="inline-flex items-center text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            <span class="mr-1">📎</span>
                                            Ver evidencia
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-sm">Sin evidencia</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($registro->aprobado_empresa === true)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            ✅ Aprobado
                                        </span>
                                    @elseif($registro->aprobado_empresa === false)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            ❌ Rechazado
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            ⏳ Pendiente
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    @if($registro->aprobado_empresa === null)
                                        <div class="flex space-x-2">
                                            <button onclick="aprobarRegistro({{ $registro->id }})" 
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-green-600 hover:bg-green-700 transition">
                                                ✅ Aprobar
                                            </button>
                                            <button onclick="rechazarRegistro({{ $registro->id }})" 
                                                    class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded text-white bg-red-600 hover:bg-red-700 transition">
                                                ❌ Rechazar
                                            </button>
                                        </div>
                                    @else
                                        <button onclick="mostrarDetallesRegistro({{ $registro->id }})" 
                                                class="inline-flex items-center px-3 py-1 border border-gray-300 text-xs font-medium rounded text-gray-700 bg-white hover:bg-gray-50 transition">
                                            👁️ Ver
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-6xl mb-4">📝</div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No hay registros de horas</h3>
                    <p class="text-gray-500">El alumno aún no ha registrado horas para este servicio social.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal para ver detalles completos -->
    <div id="modalDetalles" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-4xl max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-semibold text-gray-800">📋 Detalles Completos del Registro</h3>
                <button onclick="cerrarModal('modalDetalles')" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div id="detallesContenido">
                <!-- Contenido dinámico -->
            </div>
            
            <div class="mt-6 flex justify-end">
                <button onclick="cerrarModal('modalDetalles')" 
                        class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition">
                    Cerrar
                </button>
            </div>
        </div>
    </div>

    <!-- Modales de aprobación/rechazo -->
    <!-- Los modales se mantienen igual que en la versión anterior -->
    <!-- Modal Aprobar -->
    <div id="modalAprobar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">✅ Aprobar Registro</h3>
            <form id="formAprobar" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Observaciones (opcional)</label>
                    <textarea name="observaciones" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500"
                              rows="3" placeholder="Comentarios positivos para el alumno..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="cerrarModal('modalAprobar')" 
                            class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">Cancelar</button>
                    <button type="submit" class="flex-1 bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition">✅ Aprobar</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Rechazar -->
    <div id="modalRechazar" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4">❌ Rechazar Registro</h3>
            <form id="formRechazar" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Motivo del rechazo *</label>
                    <textarea name="observaciones" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                              rows="3" placeholder="Explica detalladamente el motivo del rechazo..." required></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" onclick="cerrarModal('modalRechazar')" 
                            class="flex-1 bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700 transition">Cancelar</button>
                    <button type="submit" class="flex-1 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">❌ Rechazar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Datos de los registros para el modal
        const registrosData = {
            @foreach($servicioSocial->registrosHoras as $registro)
            {{ $registro->id }}: {
                fecha: "{{ $registro->fecha->format('d/m/Y') }}",
                horas: {{ $registro->horas_trabajadas }},
                actividades: `{!! addslashes($registro->actividades_realizadas) !!}`,
                evidencias: "{{ $registro->evidencias }}",
                nombreEvidencia: "{{ $registro->nombre_evidencia }}",
                estado: "{{ $registro->aprobado_empresa === true ? 'Aprobado' : ($registro->aprobado_empresa === false ? 'Rechazado' : 'Pendiente') }}",
                observacionesEmpresa: "{{ $registro->observaciones_empresa ? addslashes($registro->observaciones_empresa) : 'Sin observaciones' }}"
            },
            @endforeach
        };

        function mostrarDetallesRegistro(registroId) {
            const registro = registrosData[registroId];
            if (!registro) return;

            const contenido = `
                <div class="space-y-6">
                    <!-- Información básica -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-blue-800 mb-1">📅 Fecha</h4>
                            <p class="text-blue-900">${registro.fecha}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-green-800 mb-1">⏰ Horas Trabajadas</h4>
                            <p class="text-green-900 text-xl font-bold">${registro.horas} horas</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg">
                            <h4 class="font-semibold text-purple-800 mb-1">📊 Estado</h4>
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full ${
                                registro.estado === 'Aprobado' ? 'bg-green-100 text-green-800' : 
                                registro.estado === 'Rechazado' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'
                            }">
                                ${registro.estado}
                            </span>
                        </div>
                    </div>

                    <!-- Actividades Realizadas -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-3">📋 Actividades Realizadas</h4>
                        <div class="bg-white p-4 rounded border border-gray-200">
                            <p class="text-gray-700 whitespace-pre-line">${registro.actividades}</p>
                        </div>
                    </div>

                    <!-- Evidencias -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-3">📎 Evidencias Adjuntas</h4>
                        ${registro.evidencias ? `
                            <div class="bg-white p-4 rounded border border-gray-200">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-gray-700 font-medium">${registro.nombreEvidencia}</p>
                                        <p class="text-sm text-gray-500">Archivo adjunto</p>
                                    </div>
                                    <a href="/storage/${registro.evidencias}" 
                                       target="_blank" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                                        📥 Descargar Evidencia
                                    </a>
                                </div>
                                ${registro.evidencias.toLowerCase().includes('.jpg') || registro.evidencias.toLowerCase().includes('.jpeg') || registro.evidencias.toLowerCase().includes('.png') ? `
                                <div class="mt-4">
                                    <p class="text-sm text-gray-600 mb-2">Vista previa:</p>
                                    <img src="/storage/${registro.evidencias}" 
                                         alt="Evidencia" 
                                         class="max-w-full h-auto max-h-64 rounded border border-gray-300">
                                </div>
                                ` : ''}
                            </div>
                        ` : `
                            <div class="bg-white p-4 rounded border border-gray-200 text-center">
                                <p class="text-gray-500">No hay evidencias adjuntas para este registro</p>
                            </div>
                        `}
                    </div>

                    <!-- Observaciones de la Empresa -->
                    ${registro.observacionesEmpresa && registro.observacionesEmpresa !== 'Sin observaciones' ? `
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-yellow-800 mb-3">💬 Observaciones de la Empresa</h4>
                        <div class="bg-white p-4 rounded border border-yellow-200">
                            <p class="text-yellow-700 whitespace-pre-line">${registro.observacionesEmpresa}</p>
                        </div>
                    </div>
                    ` : ''}
                </div>
            `;

            document.getElementById('detallesContenido').innerHTML = contenido;
            document.getElementById('modalDetalles').classList.remove('hidden');
        }

        function aprobarRegistro(id) {
            document.getElementById('formAprobar').action = `/empresa/registro-horas/${id}/aprobar`;
            document.getElementById('modalAprobar').classList.remove('hidden');
        }

        function rechazarRegistro(id) {
            document.getElementById('formRechazar').action = `/empresa/registro-horas/${id}/rechazar`;
            document.getElementById('modalRechazar').classList.remove('hidden');
        }

        function cerrarModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Cerrar modales al hacer clic fuera
        document.getElementById('modalDetalles').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal('modalDetalles');
        });
        document.getElementById('modalAprobar').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal('modalAprobar');
        });
        document.getElementById('modalRechazar').addEventListener('click', function(e) {
            if (e.target === this) cerrarModal('modalRechazar');
        });

        // Cerrar con tecla Escape
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal('modalDetalles');
                cerrarModal('modalAprobar');
                cerrarModal('modalRechazar');
            }
        });
    </script>
</body>
</html>