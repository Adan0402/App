<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Horas - Servicio Social ITSZN</title>
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
        
        .progress-ring {
            transform: rotate(-90deg);
        }
        
        .progress-ring-circle {
            transition: stroke-dashoffset 0.5s ease;
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
        
        .table-row-hover:hover {
            background-color: #f8fafc;
            transform: translateX(4px);
            transition: all 0.3s ease;
        }
        
        .badge {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .empty-state {
            background: linear-gradient(135deg, #f8fafc, #e2e8f0);
            border-radius: 1rem;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">⏰ Registro de Horas</h1>
                    <p>{{ $servicioSocial->empresa->nombre_empresa }} - {{ $servicioSocial->vacante->titulo }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('servicio-social.show', $servicioSocial->id) }}" 
                       class="btn-itszn-secundario">
                        ← Volver a Detalles
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

        <!-- PANEL DE PROGRESO MEJORADO -->
        <div class="info-card bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-2xl">📊</span>
                <h2 class="text-xl font-semibold texto-azul-itszn">Progreso del Servicio Social</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold texto-azul-itszn mb-2">{{ $horasCompletadas }}</div>
                    <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                        <span>⏱️</span>
                        <span>Horas Completadas</span>
                    </div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold text-green-600 mb-2">{{ $servicioSocial->horas_requeridas }}</div>
                    <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                        <span>🎯</span>
                        <span>Horas Requeridas</span>
                    </div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold text-purple-600 mb-2">{{ $porcentaje }}%</div>
                    <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                        <span>📈</span>
                        <span>Progreso</span>
                    </div>
                </div>
                <div class="stat-card text-center">
                    <div class="text-3xl font-bold text-orange-600 mb-2">{{ $registrosMes->sum('horas_trabajadas') }}</div>
                    <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                        <span>📅</span>
                        <span>Horas este Mes</span>
                    </div>
                </div>
            </div>

            <!-- BARRA DE PROGRESO MEJORADA -->
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-medium texto-azul-itszn">Progreso general</span>
                    <span class="text-sm font-semibold texto-azul-itszn">{{ $porcentaje }}%</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 h-3 rounded-full transition-all duration-500 ease-out" 
                         style="width: {{ $porcentaje }}%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500">
                    <span>{{ $horasCompletadas }} horas completadas</span>
                    <span>{{ $servicioSocial->horas_requeridas - $horasCompletadas }} horas restantes</span>
                </div>
            </div>
        </div>

        <!-- ACCIONES RÁPIDAS MEJORADAS -->
        <div class="bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
            <div class="flex flex-col lg:flex-row gap-6 justify-between items-center">
                <div class="text-center lg:text-left">
                    <h3 class="text-xl font-semibold texto-azul-itszn mb-2 flex items-center gap-2">
                        <span>⚡</span>
                        <span>Acciones Rápidas</span>
                    </h3>
                    <p class="text-gray-600">Gestiona tu registro de horas de manera eficiente</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('servicio-social.registrar-horas', $servicioSocial->id) }}" 
                       class="btn-itszn pulse-soft flex items-center justify-center gap-2">
                        <span>➕</span>
                        <span>Registrar Horas</span>
                    </a>
                    <a href="{{ route('servicio-social.reporte-mensual', $servicioSocial->id) }}" 
                       class="btn-itszn-secundario flex items-center justify-center gap-2">
                        <span>📊</span>
                        <span>Reporte Mensual</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- REGISTROS DEL MES ACTUAL -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden fade-in">
            <!-- ENCABEZADO DE LA TABLA -->
            <div class="px-6 py-4 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-blue-50">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h3 class="text-xl font-semibold texto-azul-itszn flex items-center gap-2">
                            <span>📅</span>
                            <span>Registros del Mes</span>
                        </h3>
                        <p class="text-gray-600 text-sm mt-1">
                            {{ DateTime::createFromFormat('!m', $mesActual)->format('F') }} {{ $anoActual }} 
                            • Total: <span class="font-semibold texto-azul-itszn">{{ $registrosMes->sum('horas_trabajadas') }} horas</span>
                        </p>
                    </div>
                    <div class="mt-2 lg:mt-0">
                        <span class="text-sm text-gray-500">
                            {{ $registrosMes->count() }} registro{{ $registrosMes->count() !== 1 ? 's' : '' }} encontrado{{ $registrosMes->count() !== 1 ? 's' : '' }}
                        </span>
                    </div>
                </div>
            </div>

            @if($registrosMes->count() > 0)
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
                                    📎 Evidencias
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                    🏷️ Estado
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                    ⚡ Acciones
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($registrosMes as $registro)
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
                                    <div class="text-sm text-gray-900 max-w-xs">
                                        <p class="line-clamp-2">{{ $registro->actividades_realizadas }}</p>
                                    </div>
                                </td>
                                
                                <!-- EVIDENCIAS -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($registro->evidencias)
                                        <a href="{{ Storage::disk('public')->url($registro->evidencias) }}" 
                                           target="_blank"
                                           class="inline-flex items-center gap-1 text-sm text-blue-600 hover:text-blue-800 transition">
                                            <span>📎</span>
                                            <span class="max-w-xs truncate">{{ $registro->nombre_evidencia }}</span>
                                        </a>
                                    @else
                                        <span class="inline-flex items-center gap-1 text-sm text-gray-400">
                                            <span>📎</span>
                                            <span>Sin evidencia</span>
                                        </span>
                                    @endif
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
                                
                                <!-- ACCIONES -->
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('servicio-social.registro.show', $registro->id) }}" 
                                           class="text-blue-600 hover:text-blue-800 transition flex items-center gap-1">
                                            <span>👁️</span>
                                            <span>Ver</span>
                                        </a>
                                        
                                        @if(!$registro->estaAprobado())
                                            <span class="text-gray-300">•</span>
                                            <button onclick="confirmDelete({{ $registro->id }})" 
                                                    class="text-red-600 hover:text-red-800 transition flex items-center gap-1">
                                                <span>🗑️</span>
                                                <span>Eliminar</span>
                                            </button>
                                            
                                            <!-- FORMULARIO OCULTO PARA ELIMINAR -->
                                            <form id="deleteForm-{{ $registro->id }}" 
                                                  action="{{ route('servicio-social.registro.destroy', $registro->id) }}" 
                                                  method="POST" class="hidden">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <!-- ESTADO VACÍO MEJORADO -->
                <div class="empty-state text-center py-12 px-6">
                    <div class="text-6xl mb-4">📝</div>
                    <h4 class="text-xl font-semibold texto-azul-itszn mb-3">No hay registros este mes</h4>
                    <p class="text-gray-600 mb-6 max-w-md mx-auto">
                        Aún no has registrado horas para {{ DateTime::createFromFormat('!m', $mesActual)->format('F') }}. 
                        Comienza ahora para llevar un control de tu progreso.
                    </p>
                    <a href="{{ route('servicio-social.registrar-horas', $servicioSocial->id) }}" 
                       class="btn-itszn pulse-soft inline-flex items-center gap-2">
                        <span>➕</span>
                        <span>Registrar Primera Hora</span>
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- MODAL DE CONFIRMACIÓN PARA ELIMINAR -->
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
                    <button id="confirmDeleteBtn" 
                            class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex-1">
                        Sí, Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let registroToDelete = null;
        
        // ✅ CONFIRMACIÓN DE ELIMINACIÓN
        function confirmDelete(registroId) {
            registroToDelete = registroId;
            document.getElementById('confirmModal').classList.remove('hidden');
        }
        
        function closeModal() {
            registroToDelete = null;
            document.getElementById('confirmModal').classList.add('hidden');
        }
        
        function executeDelete() {
            if (registroToDelete) {
                document.getElementById(`deleteForm-${registroToDelete}`).submit();
            }
        }
        
        // ✅ CONFIGURAR BOTÓN DE CONFIRMACIÓN
        document.getElementById('confirmDeleteBtn').addEventListener('click', executeDelete);
        
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