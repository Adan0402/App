<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles Servicio Social - ITSZN</title>
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
            transform: translateX(4px);
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            transition: stroke-dashoffset 0.5s ease;
        }
        
        .status-timeline {
            position: relative;
            padding-left: 2rem;
        }
        
        .status-timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }
        
        .status-item {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .status-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0.25rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #e2e8f0;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #e2e8f0;
        }
        
        .status-item.active::before {
            background: #1B396A;
            box-shadow: 0 0 0 2px #1B396A;
        }
        
        .status-item.completed::before {
            background: #10b981;
            box-shadow: 0 0 0 2px #10b981;
        }
        
        .stat-card {
            background: linear-gradient(135deg, #f8fafc, #f1f5f9);
            border-radius: 0.75rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }
        
        .pulse-soft {
            animation: pulseSoft 2s infinite;
        }
        
        @keyframes pulseSoft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">🎓 Mi Servicio Social</h1>
                    <p>Detalles de tu solicitud</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('alumno.mis-postulaciones') }}" class="btn-itszn-secundario">
                        ← Volver a Postulaciones
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- NOTIFICACIONES -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-lg mb-6 fade-in">
                <div class="flex items-center gap-2">
                    <span class="text-lg">✅</span>
                    <span class="font-medium">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-lg mb-6 fade-in">
                <div class="flex items-center gap-2">
                    <span class="text-lg">❌</span>
                    <span class="font-medium">{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- COLUMNA PRINCIPAL -->
            <div class="lg:col-span-2 space-y-6">
                <!-- INFORMACIÓN DEL PROYECTO -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">🚀</span>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Información del Proyecto</h2>
                    </div>
                    <div class="space-y-4">
                        <div class="bg-blue-50 rounded-lg p-4">
                            <p class="text-sm font-medium texto-azul-itszn mb-1">🎯 Nombre del Proyecto</p>
                            <p class="text-gray-900 text-lg font-semibold">{{ $servicioSocial->nombre_proyecto }}</p>
                        </div>
                        <div>
                            <p class="text-sm font-medium texto-azul-itszn mb-2">⚡ Actividades Principales</p>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $servicioSocial->actividades_principales }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFORMACIÓN DE LA EMPRESA -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">🏢</span>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Información de la Empresa</h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">🏢</span>
                                <div>
                                    <p class="text-sm font-medium texto-azul-itszn">Empresa</p>
                                    <p class="text-gray-900">{{ $servicioSocial->empresa->nombre_empresa }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-lg">💼</span>
                                <div>
                                    <p class="text-sm font-medium texto-azul-itszn">Puesto</p>
                                    <p class="text-gray-900">{{ $servicioSocial->vacante->titulo }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-lg">📍</span>
                                <div>
                                    <p class="text-sm font-medium texto-azul-itszn">Ubicación</p>
                                    <p class="text-gray-900">{{ $servicioSocial->vacante->ubicacion }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center gap-2">
                                <span class="text-lg">👨‍💼</span>
                                <div>
                                    <p class="text-sm font-medium texto-azul-itszn">Supervisor</p>
                                    <p class="text-gray-900">{{ $servicioSocial->supervisor_empresa ?? 'No asignado' }}</p>
                                </div>
                            </div>
                            @if($servicioSocial->email_supervisor)
                            <div class="flex items-center gap-2">
                                <span class="text-lg">📧</span>
                                <div>
                                    <p class="text-sm font-medium texto-azul-itszn">Email supervisor</p>
                                    <p class="text-gray-900">{{ $servicioSocial->email_supervisor }}</p>
                                </div>
                            </div>
                            @endif
                            @if($servicioSocial->telefono_supervisor)
                            <div class="flex items-center gap-2">
                                <span class="text-lg">📞</span>
                                <div>
                                    <p class="text-sm font-medium texto-azul-itszn">Teléfono supervisor</p>
                                    <p class="text-gray-900">{{ $servicioSocial->telefono_supervisor }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- COLUMNA LATERAL -->
            <div class="space-y-6">
                <!-- ESTADO Y PROGRESO -->
                <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📊</span>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Estado y Progreso</h2>
                    </div>
                    <div class="space-y-4">
                        <!-- ESTADO ACTUAL -->
                        <div>
                            <p class="text-sm font-medium texto-azul-itszn mb-2">📈 Estado actual</p>
                            @php
                                $estados = [
                                    'solicitado' => [
                                        'class' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'text' => '⏳ Pendiente de revisión (SS)',
                                        'icon' => '⏳'
                                    ],
                                    'jefe_aprobo' => [
                                        'class' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'text' => '✅ Aprobado por SS - Esperando empresa',
                                        'icon' => '✅'
                                    ],
                                    'empresa_acepto' => [
                                        'class' => 'bg-green-100 text-green-800 border-green-200',
                                        'text' => '🏢 Empresa aceptó - Puedes registrar horas',
                                        'icon' => '🏢'
                                    ],
                                    'en_proceso' => [
                                        'class' => 'bg-purple-100 text-purple-800 border-purple-200',
                                        'text' => '⚡ En proceso - Registra horas',
                                        'icon' => '⚡'
                                    ],
                                    'completado' => [
                                        'class' => 'bg-gray-100 text-gray-800 border-gray-200',
                                        'text' => '🏆 Completado',
                                        'icon' => '🏆'
                                    ],
                                    'rechazado' => [
                                        'class' => 'bg-red-100 text-red-800 border-red-200',
                                        'text' => '❌ Rechazado',
                                        'icon' => '❌'
                                    ],
                                ];
                                $estadoInfo = $estados[$servicioSocial->estado] ?? [
                                    'class' => 'bg-gray-100 text-gray-800 border-gray-200',
                                    'text' => $servicioSocial->estado,
                                    'icon' => '❓'
                                ];
                            @endphp
                            <div class="border rounded-lg p-3 {{ $estadoInfo['class'] }}">
                                <div class="flex items-center gap-2">
                                    <span class="text-lg">{{ $estadoInfo['icon'] }}</span>
                                    <span class="font-semibold">{{ $estadoInfo['text'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- PROGRESO DE HORAS -->
                        @if(in_array($servicioSocial->estado, ['empresa_acepto', 'en_proceso', 'completado']))
                        <div class="stat-card">
                            <div class="flex items-center justify-between mb-3">
                                <p class="text-sm font-medium texto-azul-itszn">⏱️ Progreso de Horas</p>
                                <span class="text-lg font-bold texto-azul-itszn">{{ $servicioSocial->progreso_horas }}%</span>
                            </div>
                            <div class="flex items-center gap-4">
                                <div class="relative">
                                    <svg class="w-16 h-16 progress-ring" viewBox="0 0 36 36">
                                        <circle cx="18" cy="18" r="15.9155" 
                                                fill="none" 
                                                stroke="#e2e8f0" 
                                                stroke-width="2"/>
                                        <circle cx="18" cy="18" r="15.9155" 
                                                fill="none" 
                                                stroke="#1B396A" 
                                                stroke-width="2"
                                                stroke-dasharray="100"
                                                stroke-dashoffset="{{ 100 - $servicioSocial->progreso_horas }}"
                                                class="progress-ring-circle"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-xs font-bold texto-azul-itszn">
                                            {{ $servicioSocial->progreso_horas }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="text-2xl font-bold texto-azul-itszn">
                                        {{ $servicioSocial->horas_totales }}
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        de {{ $servicioSocial->horas_requeridas }} hrs
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- FECHAS IMPORTANTES -->
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-sm texto-azul-itszn">🗓️ Solicitud</span>
                                <span class="text-sm text-gray-700">{{ $servicioSocial->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            
                            @if($servicioSocial->fecha_jefe_aprobo)
                            <div class="flex justify-between items-center">
                                <span class="text-sm texto-azul-itszn">✅ Aprobación SS</span>
                                <span class="text-sm text-gray-700">{{ $servicioSocial->fecha_jefe_aprobo->format('d/m/Y H:i') }}</span>
                            </div>
                            @endif
                            
                            @if($servicioSocial->fecha_empresa_acepto)
                            <div class="flex justify-between items-center">
                                <span class="text-sm texto-azul-itszn">🏢 Aceptación Empresa</span>
                                <span class="text-sm text-gray-700">{{ $servicioSocial->fecha_empresa_acepto->format('d/m/Y H:i') }}</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- ACCIONES -->
                <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">⚡</span>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Acciones</h2>
                    </div>
                    <div class="space-y-3">
                        @if(in_array($servicioSocial->estado, ['empresa_acepto', 'en_proceso']))
                            <a href="{{ route('servicio-social.registro-horas', $servicioSocial->id) }}" 
                               class="w-full btn-itszn pulse-soft flex items-center justify-center gap-2">
                                <span>⏰ Registrar Horas</span>
                            </a>
                        @endif

                        @if($servicioSocial->estado == 'solicitado')
                            <button onclick="confirmCancel()"
                                    class="w-full bg-red-600 text-white px-4 py-3 rounded-lg hover:bg-red-700 transition font-medium flex items-center justify-center gap-2">
                                ❌ Cancelar Solicitud
                            </button>
                        @endif

                        <a href="{{ route('alumno.mis-postulaciones') }}" 
                           class="w-full btn-itszn-secundario flex items-center justify-center gap-2">
                            ← Volver a Postulaciones
                        </a>
                    </div>
                </div>

                <!-- OBSERVACIONES -->
                @if($servicioSocial->observaciones_jefe)
                <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📝</span>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Observaciones del Coordinador</h2>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                        <p class="text-gray-700 whitespace-pre-line">{{ $servicioSocial->observaciones_jefe }}</p>
                    </div>
                </div>
                @endif

                @if($servicioSocial->observaciones_empresa)
                <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📝</span>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Observaciones de la Empresa</h2>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                        <p class="text-gray-700 whitespace-pre-line">{{ $servicioSocial->observaciones_empresa }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- ÚLTIMOS REGISTROS DE HORAS -->
        @if(in_array($servicioSocial->estado, ['empresa_acepto', 'en_proceso', 'completado']) && $servicioSocial->registrosHoras->count() > 0)
        <div class="mt-8 fade-in">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-semibold texto-azul-itszn flex items-center gap-2">
                    <span>⏰</span>
                    <span>Últimos Registros de Horas</span>
                </h2>
                <a href="{{ route('servicio-social.registro-horas', $servicioSocial->id) }}" 
                   class="btn-itszn-secundario text-sm">
                    Ver todos ({{ $servicioSocial->registrosHoras->count() }})
                </a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach($servicioSocial->registrosHoras->take(6) as $registro)
                <div class="bg-white rounded-lg shadow p-4 hover:shadow-md transition">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-lg font-semibold texto-azul-itszn">{{ $registro->horas_trabajadas }}h</span>
                        <span class="text-sm text-gray-500">{{ $registro->fecha->format('d/m') }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                        {{ Str::limit($registro->actividades_realizadas, 80) }}
                    </p>
                    @php
                        $estadosRegistro = [
                            'aprobado' => ['class' => 'bg-green-100 text-green-800', 'text' => '✅', 'label' => 'Aprobado'],
                            'pendiente_empresa' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => '🏢', 'label' => 'Pendiente Empresa'],
                            'pendiente_jefe' => ['class' => 'bg-blue-100 text-blue-800', 'text' => '🎓', 'label' => 'Pendiente SS'],
                            'pendiente' => ['class' => 'bg-gray-100 text-gray-800', 'text' => '⏳', 'label' => 'Pendiente'],
                        ];
                        $estadoRegistroInfo = $estadosRegistro[$registro->estado] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => '❓', 'label' => 'Desconocido'];
                    @endphp
                    <div class="flex justify-between items-center">
                        <span class="inline-flex items-center gap-1 text-xs {{ $estadoRegistroInfo['class'] }} px-2 py-1 rounded-full">
                            {{ $estadoRegistroInfo['text'] }}
                            <span>{{ $estadoRegistroInfo['label'] }}</span>
                        </span>
                        <a href="{{ route('servicio-social.registro.show', $registro->id) }}" 
                           class="text-xs texto-azul-itszn hover:underline">
                            Ver detalles
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- MODAL DE CONFIRMACIÓN -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="text-center">
                <div class="text-4xl mb-4">⚠️</div>
                <h3 class="text-xl font-semibold texto-azul-itszn mb-2">Confirmar Cancelación</h3>
                <p class="text-gray-600 mb-6">¿Estás seguro de cancelar esta solicitud de servicio social? Esta acción no se puede deshacer.</p>
                <div class="flex gap-3">
                    <button onclick="closeModal()" 
                            class="btn-itszn-secundario flex-1">
                        Cancelar
                    </button>
                    <form id="cancelForm" action="{{ route('servicio-social.cancelar', $servicioSocial->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex-1">
                            Sí, Cancelar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ✅ CONFIRMACIÓN DE CANCELACIÓN
        function confirmCancel() {
            document.getElementById('confirmModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
        
        // ✅ CERRAR MODAL CON ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });
        
        // ✅ CERRAR MODAL AL HACER CLIC FUERA
        document.getElementById('confirmModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
        
        // ✅ ANIMACIÓN DE ENTRADA
        document.addEventListener('DOMContentLoaded', function() {
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>