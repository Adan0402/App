<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supervisión de Horas - Servicio Social</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">🎓 Supervisión de Horas</h1>
                    <p class="text-gray-600">Servicio Social - Solo lectura</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('admin.servicio-social.index') }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        ← Volver a Servicios
                    </a>
                    <a href="{{ route('admin.servicio-social.reporte', $servicioSocial->id) }}" 
                       class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        📊 Reporte Detallado
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Información del Proyecto -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📋 Información del Proyecto</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Alumno</h3>
                    <p class="text-gray-900">{{ $servicioSocial->alumno->name }}</p>
                    <p class="text-sm text-gray-600">{{ $servicioSocial->carrera }} - {{ $servicioSocial->semestre }}°</p>
                    <p class="text-sm text-gray-600">{{ $servicioSocial->numero_control }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Empresa</h3>
                    <p class="text-gray-900">{{ $servicioSocial->empresa->nombre_empresa }}</p>
                    <p class="text-sm text-gray-600">{{ $servicioSocial->vacante->titulo }}</p>
                    <p class="text-sm text-gray-600">Supervisor: {{ $servicioSocial->supervisor_empresa ?? 'No asignado' }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Proyecto</h3>
                    <p class="text-gray-900">{{ $servicioSocial->nombre_proyecto }}</p>
                    <p class="text-sm text-gray-600">
                        {{ $servicioSocial->fecha_inicio->format('d/m/Y') }} - 
                        {{ $servicioSocial->fecha_fin_estimada->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $estadisticas['total_horas'] }}</div>
                <div class="text-sm text-gray-600">Horas Totales</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $estadisticas['horas_aprobadas'] }}</div>
                <div class="text-sm text-gray-600">Horas Aprobadas</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-yellow-600">{{ $estadisticas['horas_pendientes'] }}</div>
                <div class="text-sm text-gray-600">Horas Pendientes</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $estadisticas['progreso'] }}%</div>
                <div class="text-sm text-gray-600">Progreso General</div>
            </div>
        </div>

        <!-- Barra de Progreso -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Progreso del Servicio Social</h3>
            <div class="w-full bg-gray-200 rounded-full h-6">
                <div class="bg-green-600 h-6 rounded-full flex items-center justify-center text-white text-sm font-medium" 
                     style="width: {{ $estadisticas['progreso'] }}%">
                    {{ $estadisticas['progreso'] }}%
                </div>
            </div>
            <div class="flex justify-between text-sm text-gray-600 mt-2">
                <span>{{ $estadisticas['total_horas'] }}/{{ $servicioSocial->horas_requeridas }} horas</span>
                <span>{{ $estadisticas['progreso'] }}% completado</span>
            </div>
        </div>

        <!-- Registros de Horas -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-800">⏰ Registros de Horas</h3>
                <p class="text-gray-600 text-sm">Vista de supervisión - Solo lectura</p>
            </div>

            @if($servicioSocial->registrosHoras->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actividades</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Evidencias</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Observaciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($servicioSocial->registrosHoras->sortByDesc('fecha') as $registro)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $registro->fecha->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <span class="font-semibold">{{ $registro->horas_trabajadas }} hrs</span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                <details class="cursor-pointer">
                                    <summary class="text-blue-600 hover:text-blue-800">
                                        Ver actividades
                                    </summary>
                                    <div class="mt-2 p-3 bg-gray-50 rounded text-gray-700 whitespace-pre-line">
                                        {{ $registro->actividades_realizadas }}
                                    </div>
                                </details>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if($registro->evidencias)
                                    <a href="{{ Storage::disk('public')->url($registro->evidencias) }}" 
                                       target="_blank"
                                       class="text-blue-600 hover:text-blue-800 flex items-center">
                                        📎 {{ $registro->nombre_evidencia }}
                                    </a>
                                @else
                                    <span class="text-gray-400">Sin evidencia</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($registro->aprobado_empresa)
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        ✅ Aprobado
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ⏳ Pendiente
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-900">
                                @if($registro->observaciones_empresa)
                                    <details class="cursor-pointer">
                                        <summary class="text-blue-600 hover:text-blue-800 text-xs">
                                            Ver observaciones
                                        </summary>
                                        <div class="mt-2 p-2 bg-yellow-50 rounded text-gray-700 text-xs">
                                            {{ $registro->observaciones_empresa }}
                                        </div>
                                    </details>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-8">
                    <p class="text-gray-500">No hay registros de horas aún</p>
                </div>
            @endif
        </div>

        <!-- Resumen de Actividades -->
        <div class="bg-white rounded-lg shadow p-6 mt-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">📈 Resumen de Actividades</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Distribución por Estado</h4>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Aprobados:</span>
                            <span class="font-semibold">{{ $estadisticas['registros_aprobados'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Pendientes:</span>
                            <span class="font-semibold">{{ $estadisticas['total_registros'] - $estadisticas['registros_aprobados'] }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Total Registros:</span>
                            <span class="font-semibold">{{ $estadisticas['total_registros'] }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="font-medium text-gray-700 mb-2">Próximos Pasos</h4>
                    <ul class="text-sm text-gray-600 space-y-1">
                        <li>• El alumno debe completar {{ $servicioSocial->horas_requeridas - $estadisticas['total_horas'] }} horas más</li>
                        <li>• {{ $estadisticas['horas_pendientes'] }} horas esperan aprobación de la empresa</li>
                        <li>• Fecha de finalización estimada: {{ $servicioSocial->fecha_fin_estimada->format('d/m/Y') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>