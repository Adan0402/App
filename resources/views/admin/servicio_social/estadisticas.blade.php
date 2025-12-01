<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estadísticas Generales - Servicio Social</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">📊 Estadísticas Generales</h1>
                    <p class="text-gray-600">Servicio Social - Dashboard Administrativo</p>
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
        <!-- Tarjetas de Resumen -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $estadisticas['total_servicios'] }}</div>
                <div class="text-sm text-gray-600">Total Servicios</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $estadisticas['en_proceso'] }}</div>
                <div class="text-sm text-gray-600">En Proceso</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $estadisticas['completados'] }}</div>
                <div class="text-sm text-gray-600">Completados</div>
            </div>
            <div class="bg-white rounded-lg shadow p-4 text-center">
                <div class="text-2xl font-bold text-orange-600">{{ $estadisticas['total_horas'] }}</div>
                <div class="text-sm text-gray-600">Horas Totales</div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
            <!-- Gráfico de Estados -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">📈 Distribución por Estado</h3>
                <canvas id="estadosChart" width="400" height="300"></canvas>
            </div>

            <!-- Gráfico de Horas por Mes -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">⏰ Horas Registradas por Mes</h3>
                <canvas id="horasMesChart" width="400" height="300"></canvas>
            </div>
        </div>

        <!-- Servicios con Progreso Bajo -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">⚠️ Servicios con Progreso Bajo (< 50%)</h3>
            @if($serviciosBajoProgreso->count() > 0)
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Alumno</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Empresa</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Progreso</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Horas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Acción</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($serviciosBajoProgreso as $servicio)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $servicio->alumno->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $servicio->empresa->nombre_empresa }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <div class="flex items-center">
                                    <div class="w-full bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-red-600 h-2 rounded-full" style="width: {{ $servicio->progreso_horas }}%"></div>
                                    </div>
                                    <span class="text-red-600 font-semibold">{{ $servicio->progreso_horas }}%</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $servicio->horas_totales }}/{{ $servicio->horas_requeridas }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.servicio-social.registros', $servicio->id) }}" 
                                   class="text-blue-600 hover:text-blue-900">Ver Detalles</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-gray-500">No hay servicios con progreso bajo</p>
            @endif
        </div>
    </div>

    <script>
        // Gráfico de Estados
        const estadosCtx = document.getElementById('estadosChart').getContext('2d');
        new Chart(estadosCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode(array_keys($estadosData)) !!},
                datasets: [{
                    data: {!! json_encode(array_values($estadosData)) !!},
                    backgroundColor: [
                        '#3B82F6', // Azul - Solicitado
                        '#10B981', // Verde - En proceso
                        '#8B5CF6', // Purple - Completado
                        '#EF4444', // Rojo - Rechazado
                        '#F59E0B'  // Amarillo - Otros
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        // Gráfico de Horas por Mes
        const horasMesCtx = document.getElementById('horasMesChart').getContext('2d');
        new Chart(horasMesCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode(array_keys($horasPorMes)) !!},
                datasets: [{
                    label: 'Horas Registradas',
                    data: {!! json_encode(array_values($horasPorMes)) !!},
                    backgroundColor: '#3B82F6'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Horas'
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>