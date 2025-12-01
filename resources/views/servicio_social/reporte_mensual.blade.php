<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Mensual - Servicio Social ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ✅ SISTEMA DE DISEÑO ITSZN */
        .azul-itszn { background-color: #1B396A; }
        .borde-azul-itszn { border-color: #1B396A; }
        .texto-azul-itszn { color: #1B396A; }
        
        .header-institucional {
            background: linear-gradient(135deg, #1B396A 0%, #2D4F8A 100%);
            border-bottom: 4px solid #1B396A;
        }
        .header-institucional h1 { color: white; font-weight: bold; }
        .header-institucional p { color: rgba(255, 255, 255, 0.9); }
        
        .btn-itszn {
            background-color: #1B396A;
            color: white;
            border: 2px solid #1B396A;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-itszn:hover {
            background-color: #2D4F8A;
            border-color: #2D4F8A;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(27, 57, 106, 0.2);
        }
        
        .btn-itszn-secundario {
            background-color: white;
            color: #1B396A;
            border: 2px solid #1B396A;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-itszn-secundario:hover {
            background-color: #f8fafc;
            transform: translateY(-2px);
        }
        
        .info-card {
            border-left: 4px solid #1B396A;
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .pulse-soft {
            animation: pulseSoft 2s infinite;
        }
        
        @keyframes pulseSoft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 1rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #1B396A, #2D4F8A);
        }
        
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(27, 57, 106, 0.15);
        }
        
        .table-row-hover:hover {
            background: linear-gradient(90deg, #f8fafc, #f1f5f9);
            transform: translateX(4px);
            transition: all 0.3s ease;
        }
        
        .filter-card {
            background: linear-gradient(135deg, #ffffff, #f8fafc);
            border: 1px solid #e2e8f0;
        }
        
        .empty-state {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">📊 Reporte Mensual</h1>
                    <p>{{ $servicioSocial->empresa->nombre_empresa }} - {{ $servicioSocial->nombre_proyecto }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('servicio-social.registro-horas', $servicioSocial->id) }}" 
                       class="btn-itszn-secundario">
                        ← Volver al Registro
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- FILTROS MEJORADOS -->
        <div class="filter-card rounded-lg shadow-lg p-6 mb-6 fade-in">
            <div class="flex items-center gap-3 mb-4">
                <span class="text-2xl">🔍</span>
                <h2 class="text-xl font-semibold texto-azul-itszn">Filtrar Reporte por Mes</h2>
            </div>
            <form method="GET" class="flex flex-col lg:flex-row gap-4 items-end">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 flex-1">
                    <div>
                        <label class="block text-sm font-semibold texto-azul-itszn mb-2">📅 Mes</label>
                        <select name="mes" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ $mes == $i ? 'selected' : '' }}>
                                    {{ DateTime::createFromFormat('!m', $i)->format('F') }}
                                </option>
                            @endfor
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold texto-azul-itszn mb-2">📅 Año</label>
                        <select name="ano" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @for($i = date('Y'); $i >= 2020; $i--)
                                <option value="{{ $i }}" {{ $ano == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn-itszn flex items-center gap-2 whitespace-nowrap">
                    <span>📈</span>
                    <span>Generar Reporte</span>
                </button>
            </form>
        </div>

        <!-- ESTADÍSTICAS PRINCIPALES -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="stat-card fade-in">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-2xl">⏱️</div>
                    <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-lg">📊</span>
                    </div>
                </div>
                <div class="text-3xl font-bold texto-azul-itszn mb-2">{{ $estadisticas['horas_mes'] }}</div>
                <div class="text-sm text-gray-600">Horas del Mes</div>
                <div class="mt-2 text-xs text-blue-600 font-medium">
                    {{ number_format(($estadisticas['horas_mes'] / 160) * 100, 1) }}% del mes laboral
                </div>
            </div>
            
            <div class="stat-card fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-2xl">📅</div>
                    <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                        <span class="text-lg">✅</span>
                    </div>
                </div>
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $estadisticas['dias_trabajados'] }}</div>
                <div class="text-sm text-gray-600">Días Trabajados</div>
                <div class="mt-2 text-xs text-green-600 font-medium">
                    {{ number_format(($estadisticas['dias_trabajados'] / 22) * 100, 1) }}% de días hábiles
                </div>
            </div>
            
            <div class="stat-card fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-2xl">🎯</div>
                    <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                        <span class="text-lg">⭐</span>
                    </div>
                </div>
                <div class="text-3xl font-bold text-purple-600 mb-2">{{ $estadisticas['horas_aprobadas'] }}</div>
                <div class="text-sm text-gray-600">Horas Aprobadas</div>
                <div class="mt-2 text-xs text-purple-600 font-medium">
                    {{ $estadisticas['horas_mes'] > 0 ? number_format(($estadisticas['horas_aprobadas'] / $estadisticas['horas_mes']) * 100, 1) : 0 }}% de aprobación
                </div>
            </div>
            
            <div class="stat-card fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center justify-between mb-4">
                    <div class="text-2xl">🚀</div>
                    <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center">
                        <span class="text-lg">📈</span>
                    </div>
                </div>
                <div class="text-3xl font-bold text-orange-600 mb-2">{{ $estadisticas['progreso_general'] }}%</div>
                <div class="text-sm text-gray-600">Progreso Total</div>
                <div class="mt-2">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-2 rounded-full transition-all duration-1000 ease-out" 
                             style="width: {{ $estadisticas['progreso_general'] }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- REGISTROS DEL MES -->
        <div class="info-card bg-white rounded-lg shadow-lg overflow-hidden fade-in" style="animation-delay: 0.2s">
            <!-- ENCABEZADO DE LA TABLA -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="text-xl font-semibold texto-azul-itszn flex items-center gap-2">
                            <span>📋</span>
                            <span>Registros de {{ DateTime::createFromFormat('!m', $mes)->format('F') }} {{ $ano }}</span>
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">
                            Total: <span class="font-semibold texto-azul-itszn">{{ $registros->count() }} registro{{ $registros->count() !== 1 ? 's' : '' }}</span>
                            • <span class="font-semibold text-green-600">{{ $estadisticas['horas_mes'] }} horas</span>
                        </p>
                    </div>
                    <div class="mt-2 lg:mt-0">
                        <span class="text-sm text-gray-500 bg-white px-3 py-1 rounded-full border">
                            Promedio: {{ $estadisticas['dias_trabajados'] > 0 ? number_format($estadisticas['horas_mes'] / $estadisticas['dias_trabajados'], 1) : 0 }}h/día
                        </span>
                    </div>
                </div>
            </div>

            @if($registros->count() > 0)
                <!-- TABLA MEJORADA -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                    📅 Fecha
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                    ⏰ Horas
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                    📋 Actividades
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                    🏷️ Estado
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($registros as $registro)
                            <tr class="table-row-hover">
                                <!-- FECHA -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $registro->fecha->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $registro->fecha->translatedFormat('l') }}
                                    </div>
                                </td>
                                
                                <!-- HORAS -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-blue-100 text-blue-800">
                                        ⏱️ {{ $registro->horas_trabajadas }} hrs
                                    </span>
                                </td>
                                
                                <!-- ACTIVIDADES -->
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 max-w-md">
                                        <p class="line-clamp-2">{{ $registro->actividades_realizadas }}</p>
                                    </div>
                                </td>
                                
                                <!-- ESTADO -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $estados = [
                                            'aprobado' => ['class' => 'bg-green-100 text-green-800 border border-green-200', 'text' => '✅ Aprobado', 'icon' => '✅'],
                                            'pendiente_empresa' => ['class' => 'bg-yellow-100 text-yellow-800 border border-yellow-200', 'text' => '🏢 Pendiente Empresa', 'icon' => '⏳'],
                                            'pendiente_jefe' => ['class' => 'bg-blue-100 text-blue-800 border border-blue-200', 'text' => '🎓 Pendiente SS', 'icon' => '📋'],
                                            'pendiente' => ['class' => 'bg-gray-100 text-gray-800 border border-gray-200', 'text' => '⏳ Pendiente', 'icon' => '🔍'],
                                        ];
                                        $estadoInfo = $estados[$registro->estado] ?? ['class' => 'bg-gray-100 text-gray-800 border border-gray-200', 'text' => 'Desconocido', 'icon' => '❓'];
                                    @endphp
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $estadoInfo['class'] }}">
                                        <span>{{ $estadoInfo['icon'] }}</span>
                                        <span>{{ $estadoInfo['text'] }}</span>
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- ESTADO VACÍO MEJORADO -->
                <div class="empty-state text-center py-12 px-6">
                    <div class="text-6xl mb-4">📊</div>
                    <h4 class="text-xl font-semibold texto-azul-itszn mb-3">No hay registros para este período</h4>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        No se encontraron registros de horas para {{ DateTime::createFromFormat('!m', $mes)->format('F') }} de {{ $ano }}.
                        Los registros aparecerán aquí una vez que comiences a registrar tus horas.
                    </p>
                    <a href="{{ route('servicio-social.registrar-horas', $servicioSocial->id) }}" 
                       class="btn-itszn pulse-soft inline-flex items-center gap-2">
                        <span>➕</span>
                        <span>Comenzar a Registrar Horas</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
        // ✅ ANIMACIÓN DE ENTRADA
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
        
        // ✅ CLASE UTILITARIA PARA LINE-CLAMP
        const style = document.createElement('style');
        style.textContent = `
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>