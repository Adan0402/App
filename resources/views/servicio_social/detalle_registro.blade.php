<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Registro - Servicio Social ITSZN</title>
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
        
        .pulse-soft {
            animation: pulseSoft 2s infinite;
        }
        
        @keyframes pulseSoft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .file-preview {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }
        
        .file-preview:hover {
            border-color: #1B396A;
            background-color: #f8fafc;
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
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            transition: stroke-dashoffset 0.5s ease;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">📋 Detalle de Registro</h1>
                    <p>{{ $registro->servicioSocial->empresa->nombre_empresa }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('servicio-social.registro-horas', $registro->servicio_social_id) }}" 
                       class="btn-itszn-secundario">
                        ← Volver al Registro
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- TARJETA PRINCIPAL -->
            <div class="info-card bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <!-- INFORMACIÓN DEL REGISTRO -->
                    <div class="lg:col-span-2">
                        <h2 class="text-xl font-semibold texto-azul-itszn mb-4">📅 Información del Registro</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="bg-blue-50 rounded-lg p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-2xl">📅</span>
                                    <div>
                                        <p class="text-sm font-medium texto-azul-itszn">Fecha</p>
                                        <p class="text-lg font-semibold text-gray-900">{{ $registro->fecha->format('d/m/Y') }}</p>
                                        <p class="text-xs text-gray-600">{{ $registro->fecha->translatedFormat('l') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-green-50 rounded-lg p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-2xl">⏱️</span>
                                    <div>
                                        <p class="text-sm font-medium texto-azul-itszn">Horas Trabajadas</p>
                                        <p class="text-2xl font-bold text-green-600">{{ $registro->horas_trabajadas }} hrs</p>
                                        <p class="text-xs text-gray-600">Registro diario</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- ESTADO DEL REGISTRO -->
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold texto-azul-itszn mb-3">📊 Estado del Registro</h3>
                            @php
                                $estados = [
                                    'aprobado' => [
                                        'class' => 'bg-green-100 text-green-800 border-green-200',
                                        'text' => '✅ Aprobado',
                                        'icon' => '✅',
                                        'description' => 'Este registro ha sido aprobado y contabilizado'
                                    ],
                                    'pendiente_empresa' => [
                                        'class' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                        'text' => '🏢 Pendiente de Empresa',
                                        'icon' => '⏳',
                                        'description' => 'Esperando aprobación del supervisor empresarial'
                                    ],
                                    'pendiente_jefe' => [
                                        'class' => 'bg-blue-100 text-blue-800 border-blue-200',
                                        'text' => '🎓 Pendiente de SS',
                                        'icon' => '📋',
                                        'description' => 'Esperando aprobación del coordinador de servicio social'
                                    ],
                                    'pendiente' => [
                                        'class' => 'bg-gray-100 text-gray-800 border-gray-200',
                                        'text' => '⏳ En revisión',
                                        'icon' => '🔍',
                                        'description' => 'Registro en proceso de revisión inicial'
                                    ],
                                ];
                                $estadoInfo = $estados[$registro->estado] ?? [
                                    'class' => 'bg-gray-100 text-gray-800 border-gray-200',
                                    'text' => 'Desconocido',
                                    'icon' => '❓',
                                    'description' => 'Estado no definido'
                                ];
                            @endphp
                            
                            <div class="border rounded-lg p-4 {{ $estadoInfo['class'] }}">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">{{ $estadoInfo['icon'] }}</span>
                                    <div>
                                        <p class="font-semibold">{{ $estadoInfo['text'] }}</p>
                                        <p class="text-sm mt-1 opacity-90">{{ $estadoInfo['description'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- EVIDENCIAS Y ACCIONES -->
                    <div class="space-y-6">
                        <!-- EVIDENCIAS -->
                        <div>
                            <h3 class="text-lg font-semibold texto-azul-itszn mb-3">📎 Evidencias Adjuntas</h3>
                            @if($registro->evidencias)
                                <div class="file-preview">
                                    <div class="text-center">
                                        <div class="text-4xl mb-3">📄</div>
                                        <p class="font-medium texto-azul-itszn truncate">{{ $registro->nombre_evidencia }}</p>
                                        <p class="text-sm text-gray-600 mt-1">Archivo adjunto</p>
                                        <div class="flex gap-2 mt-4">
                                            <a href="{{ Storage::disk('public')->url($registro->evidencias) }}" 
                                               target="_blank"
                                               class="btn-itszn-secundario text-sm flex-1 text-center">
                                                👀 Ver
                                            </a>
                                            <a href="{{ Storage::disk('public')->url($registro->evidencias) }}" 
                                               download
                                               class="btn-itszn text-sm flex-1 text-center">
                                                💾 Descargar
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="border border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <div class="text-3xl text-gray-400 mb-2">📎</div>
                                    <p class="text-gray-500 text-sm">No hay evidencias adjuntas</p>
                                </div>
                            @endif
                        </div>
                        
                        <!-- PROGRESO ACUMULADO -->
                        <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-4 border border-blue-200">
                            <h4 class="font-semibold texto-azul-itszn mb-2 text-center">📈 Progreso Acumulado</h4>
                            <div class="flex items-center justify-center gap-4">
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
                                                stroke-dashoffset="{{ 100 - $registro->servicioSocial->porcentajeCompletado() }}"
                                                class="progress-ring-circle"/>
                                    </svg>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <span class="text-sm font-bold texto-azul-itszn">
                                            {{ $registro->servicioSocial->porcentajeCompletado() }}%
                                        </span>
                                    </div>
                                </div>
                                <div class="text-sm">
                                    <p class="font-semibold">{{ $registro->servicioSocial->horas_completadas }}/{{ $registro->servicioSocial->horas_requeridas }}</p>
                                    <p class="text-gray-600">horas totales</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ACTIVIDADES REALIZADAS -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
                <h3 class="text-xl font-semibold texto-azul-itszn mb-4">⚡ Actividades Realizadas</h3>
                <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line leading-relaxed">{{ $registro->actividades_realizadas }}</p>
                    </div>
                </div>
            </div>

            <!-- TIMELINE DE ESTADOS -->
            <div class="bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
                <h3 class="text-xl font-semibold texto-azul-itszn mb-4">🔄 Proceso de Aprobación</h3>
                <div class="status-timeline">
                    @php
                        $timelineStates = [
                            'pendiente' => ['icon' => '📝', 'title' => 'Registro Creado', 'description' => 'Registro ingresado en el sistema'],
                            'pendiente_empresa' => ['icon' => '🏢', 'title' => 'Revisión Empresa', 'description' => 'En espera de aprobación del supervisor empresarial'],
                            'pendiente_jefe' => ['icon' => '🎓', 'title' => 'Revisión Servicio Social', 'description' => 'En espera de aprobación del coordinador'],
                            'aprobado' => ['icon' => '✅', 'title' => 'Aprobado', 'description' => 'Registro aprobado y contabilizado'],
                        ];
                        
                        $currentStateIndex = array_search($registro->estado, array_keys($timelineStates));
                    @endphp
                    
                    @foreach($timelineStates as $state => $info)
                        <div class="status-item 
                            @if($state === $registro->estado) active
                            @elseif($currentStateIndex > array_search($state, array_keys($timelineStates))) completed
                            @endif">
                            <div class="flex items-start gap-3">
                                <span class="text-xl mt-1">{{ $info['icon'] }}</span>
                                <div>
                                    <h4 class="font-semibold 
                                        @if($state === $registro->estado) texto-azul-itszn
                                        @elseif($currentStateIndex > array_search($state, array_keys($timelineStates))) text-green-600
                                        @else text-gray-500 @endif">
                                        {{ $info['title'] }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mt-1">{{ $info['description'] }}</p>
                                    @if($state === $registro->estado)
                                        <div class="flex items-center gap-2 mt-2">
                                            <div class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></div>
                                            <span class="text-xs texto-azul-itszn font-medium">Estado actual</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- ACCIONES -->
            @if(!$registro->estaAprobado())
            <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
                <h3 class="text-lg font-semibold texto-azul-itszn mb-4">⚙️ Acciones Disponibles</h3>
                <div class="flex flex-wrap gap-3">
                    <form id="deleteForm" 
                          action="{{ route('servicio-social.registro.destroy', $registro->id) }}" 
                          method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" 
                                onclick="confirmDelete()"
                                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex items-center gap-2">
                            🗑️ Eliminar Registro
                        </button>
                    </form>
                    
                    <a href="{{ route('servicio-social.registro-horas', $registro->servicio_social_id) }}" 
                       class="btn-itszn-secundario flex items-center gap-2">
                        📋 Volver al Registro
                    </a>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- MODAL DE CONFIRMACIÓN -->
    <div id="confirmModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="text-center">
                <div class="text-4xl mb-4">⚠️</div>
                <h3 class="text-xl font-semibold texto-azul-itszn mb-2">Confirmar Eliminación</h3>
                <p class="text-gray-600 mb-6">¿Estás seguro de eliminar este registro? Esta acción no se puede deshacer.</p>
                <div class="flex gap-3">
                    <button onclick="closeModal()" 
                            class="btn-itszn-secundario flex-1">
                        Cancelar
                    </button>
                    <button onclick="submitDelete()" 
                            class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex-1">
                        Sí, Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ✅ CONFIRMACIÓN DE ELIMINACIÓN
        function confirmDelete() {
            document.getElementById('confirmModal').classList.remove('hidden');
        }
        
        function closeModal() {
            document.getElementById('confirmModal').classList.add('hidden');
        }
        
        function submitDelete() {
            document.getElementById('deleteForm').submit();
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
            // Agregar pequeña animación a los elementos
            const elements = document.querySelectorAll('.fade-in');
            elements.forEach((element, index) => {
                element.style.animationDelay = `${index * 0.1}s`;
            });
        });
    </script>
</body>
</html>