<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Detallado - Servicio Social</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">📊 Reporte Detallado</h1>
                    <p class="text-gray-600">{{ $servicioSocial->alumno->name }} - {{ $servicioSocial->empresa->nombre_empresa }}</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('admin.servicio-social.registros', $servicioSocial->id) }}" 
                       class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">
                        ← Volver a Supervisión
                    </a>
                    <button onclick="window.print()" 
                            class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        🖨️ Imprimir Reporte
                    </button>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Resumen Ejecutivo -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📋 Resumen Ejecutivo</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Información del Alumno</h3>
                    <p><strong>Nombre:</strong> {{ $servicioSocial->alumno->name }}</p>
                    <p><strong>Carrera:</strong> {{ $servicioSocial->carrera }}</p>
                    <p><strong>Semestre:</strong> {{ $servicioSocial->semestre }}°</p>
                    <p><strong>Número de Control:</strong> {{ $servicioSocial->numero_control }}</p>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Información del Proyecto</h3>
                    <p><strong>Empresa:</strong> {{ $servicioSocial->empresa->nombre_empresa }}</p>
                    <p><strong>Proyecto:</strong> {{ $servicioSocial->nombre_proyecto }}</p>
                    <p><strong>Horas Requeridas:</strong> {{ $servicioSocial->horas_requeridas }}</p>
                    <p><strong>Horas Completadas:</strong> {{ $servicioSocial->horas_totales }} ({{ $servicioSocial->progreso_horas }}%)</p>
                </div>
            </div>
        </div>

        <!-- Estadísticas por Mes -->
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📈 Estadísticas por Mes</h2>
            @if($horasPorMes->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mes</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horas Totales</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horas Aprobadas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Registros</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Eficiencia</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($horasPorMes->sortKeys() as $mes => $datos)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ DateTime::createFromFormat('Y-m', $mes)->format('F Y') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $datos['horas_totales'] }} hrs
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $datos['horas_aprobadas'] }} hrs
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $datos['total_registros'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @php
                                    $eficiencia = $datos['horas_totales'] > 0 ? 
                                        round(($datos['horas_aprobadas'] / $datos['horas_totales']) * 100, 1) : 0;
                                @endphp
                                <span class="font-semibold {{ $eficiencia >= 80 ? 'text-green-600' : ($eficiencia >= 60 ? 'text-yellow-600' : 'text-red-600') }}">
                                    {{ $eficiencia }}%
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No hay datos por mes aún</p>
            @endif
        </div>

        <!-- Análisis de Progreso -->
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">📊 Análisis de Progreso</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Estado Actual</h3>
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Progreso General:</span>
                            <span class="font-semibold">{{ $servicioSocial->progreso_horas }}%</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Horas Restantes:</span>
                            <span class="font-semibold">{{ $servicioSocial->horas_requeridas - $servicioSocial->horas_totales }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Días Restantes:</span>
                            <span class="font-semibold">{{ max(0, now()->diffInDays($servicioSocial->fecha_fin_estimada, false)) }}</span>
                        </div>
                    </div>
                </div>
                <div>
                    <h3 class="font-semibold text-gray-700 mb-2">Recomendaciones</h3>
                    <ul class="text-sm text-gray-600 space-y-1">
                        @if($servicioSocial->progreso_horas < 50)
                            <li>• El progreso está por debajo del 50%, considerar seguimiento cercano</li>
                        @endif
                        @if(now()->diffInDays($servicioSocial->fecha_fin_estimada, false) < 30)
                            <li>• Fecha de finalización próxima, verificar cumplimiento</li>
                        @endif
                        <li>• Mantener comunicación con empresa y alumno</li>
                        <li>• Verificar calidad de evidencias y descripciones</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>