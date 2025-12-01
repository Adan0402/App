<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Vacantes - ITSZN Bolsa de Trabajo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        :root {
            --azul-itszn: #1B396A;
            --azul-itszn-claro: #2D4F8A;
            --verde-itszn: #28a745;
            --naranja-itszn: #fd7e14;
            --rojo-itszn: #dc3545;
            --amarillo-itszn: #ffc107;
            --gris-claro: #f8f9fa;
            --gris-medio: #e9ecef;
            --gris-oscuro: #343a40;
        }

        .header-institucional {
            background: linear-gradient(135deg, var(--azul-itszn) 0%, var(--azul-itszn-claro) 100%);
            border-bottom: 4px solid var(--azul-itszn);
        }

        .btn-itszn {
            background-color: var(--azul-itszn);
            color: white;
            border: 2px solid var(--azul-itszn);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-itszn:hover {
            background-color: var(--azul-itszn-claro);
            border-color: var(--azul-itszn-claro);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(27, 57, 106, 0.2);
        }

        .btn-itszn-secundario {
            background-color: white;
            color: var(--azul-itszn);
            border: 2px solid var(--azul-itszn);
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-itszn-secundario:hover {
            background-color: var(--gris-claro);
            transform: translateY(-2px);
        }

        .vacante-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .vacante-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        }

        /* ✅ MANTENIENDO LOS COLORES DE ESTADO EN LAS TARJETAS */
        .vacante-card.aprobada { border-left: 4px solid var(--verde-itszn); }
        .vacante-card.pendiente { border-left: 4px solid var(--amarillo-itszn); }
        .vacante-card.rechazada { border-left: 4px solid var(--rojo-itszn); }

        .estado-badge {
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .estado-pendiente { 
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            border: 1px solid #ffeaa7;
        }

        .estado-aprobada { 
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .estado-rechazada { 
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .stats-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            text-align: center;
            border-top: 4px solid var(--azul-itszn);
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

        .stats-card.total { border-top-color: var(--azul-itszn); }
        .stats-card.aprobadas { border-top-color: var(--verde-itszn); }
        .stats-card.pendientes { border-top-color: var(--amarillo-itszn); }
        .stats-card.rechazadas { border-top-color: var(--rojo-itszn); }

        .empty-state {
            background: linear-gradient(135deg, var(--gris-claro), var(--gris-medio));
            border-radius: 1.5rem;
            padding: 4rem 2rem;
        }

        .modal-content {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .detalles-content {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 0.75rem;
            padding: 1.5rem;
            border-left: 4px solid var(--azul-itszn);
        }

        .salario-tag {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .info-tag {
            background: var(--gris-medio);
            border-radius: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            color: var(--gris-oscuro);
        }

        @media (max-width: 768px) {
            .vacante-card {
                margin: 0 -1rem;
                border-radius: 0;
                border-left: none;
                border-top: 4px solid var(--azul-itszn);
            }
            
            .vacante-card.aprobada { border-top-color: var(--verde-itszn); border-left: none; }
            .vacante-card.pendiente { border-top-color: var(--amarillo-itszn); border-left: none; }
            .vacante-card.rechazada { border-top-color: var(--rojo-itszn); border-left: none; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Institucional -->
    <header class="header-institucional shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <h1 class="text-2xl font-bold text-white mb-1">📋 Mis Vacantes Publicadas</h1>
                    <p class="text-white/90">{{ $user->empresa->nombre_empresa }}</p>
                </div>
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('vacantes.create') }}" 
                       class="btn-itszn flex items-center gap-2">
                        <span>➕</span>
                        <span>Nueva Vacante</span>
                    </a>
                    <a href="/dashboard" 
                       class="btn-itszn-secundario flex items-center gap-2">
                        <span>←</span>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Notificaciones -->
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-4 rounded-xl mb-6 fade-in flex items-center gap-2">
                <span class="text-lg">✅</span>
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-xl mb-6 fade-in flex items-center gap-2">
                <span class="text-lg">❌</span>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <!-- Estadísticas Mejoradas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stats-card total fade-in" style="animation-delay: 0.1s">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $vacantes->count() }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>📋</span>
                    <span>Total Vacantes</span>
                </div>
                <div class="text-xs text-blue-500 mt-2 font-medium">
                    {{ $vacantes->count() > 0 ? 'Publicadas' : 'Sin vacantes aún' }}
                </div>
            </div>
            
            <div class="stats-card aprobadas fade-in" style="animation-delay: 0.2s">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $vacantes->where('estado', 'aprobada')->count() }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>✅</span>
                    <span>Aprobadas</span>
                </div>
                <div class="text-xs text-green-500 mt-2 font-medium">
                    {{ $vacantes->where('estado', 'aprobada')->count() > 0 ? 'Visibles para alumnos' : 'Ninguna aprobada' }}
                </div>
            </div>
            
            <div class="stats-card pendientes fade-in" style="animation-delay: 0.3s">
                <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $vacantes->where('estado', 'pendiente')->count() }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>⏳</span>
                    <span>Pendientes</span>
                </div>
                <div class="text-xs text-yellow-500 mt-2 font-medium">
                    {{ $vacantes->where('estado', 'pendiente')->count() > 0 ? 'En revisión' : 'Todas revisadas' }}
                </div>
            </div>
            
            <div class="stats-card rechazadas fade-in" style="animation-delay: 0.4s">
                <div class="text-3xl font-bold text-red-600 mb-2">{{ $vacantes->where('estado', 'rechazada')->count() }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>❌</span>
                    <span>Rechazadas</span>
                </div>
                <div class="text-xs text-red-500 mt-2 font-medium">
                    {{ $vacantes->where('estado', 'rechazada')->count() > 0 ? 'No aprobadas' : 'Ninguna rechazada' }}
                </div>
            </div>
        </div>

        @if($vacantes->count() > 0)
            <div class="space-y-6 mb-8">
                @foreach($vacantes as $vacante)
                <div class="vacante-card {{ $vacante->estado }} fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <!-- Header Principal -->
                    <div class="p-6">
                        <div class="flex flex-col md:flex-row justify-between items-start gap-4 mb-4">
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-2 mb-3">
                                    <h3 class="text-xl font-bold text-gray-900">{{ $vacante->titulo }}</h3>
                                    <span class="estado-badge estado-{{ $vacante->estado }}">
                                        @if($vacante->estado == 'aprobada') ✅ Aprobada
                                        @elseif($vacante->estado == 'pendiente') ⏳ Pendiente
                                        @elseif($vacante->estado == 'rechazada') ❌ Rechazada
                                        @endif
                                    </span>
                                </div>
                                
                                <!-- Información de la vacante -->
                                <div class="flex flex-wrap items-center gap-3 mb-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">📍</span>
                                        <span class="text-sm text-gray-700">{{ $vacante->ubicacion }}</span>
                                    </div>
                                    <div class="w-px h-4 bg-gray-300"></div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">💼</span>
                                        <span class="text-sm text-gray-700">{{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}</span>
                                    </div>
                                    <div class="w-px h-4 bg-gray-300"></div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">🏢</span>
                                        <span class="text-sm text-gray-700">{{ ucfirst($vacante->modalidad) }}</span>
                                    </div>
                                </div>
                                
                                <!-- Información adicional -->
                                <div class="flex flex-wrap items-center gap-3">
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">👥</span>
                                        <span class="text-sm text-gray-700">{{ $vacante->vacantes_disponibles }} vacante{{ $vacante->vacantes_disponibles > 1 ? 's' : '' }}</span>
                                    </div>
                                    <div class="w-px h-4 bg-gray-300"></div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">📅</span>
                                        <span class="text-sm text-gray-700">Vence: {{ $vacante->fecha_limite->format('d/m/Y') }}</span>
                                    </div>
                                    <div class="w-px h-4 bg-gray-300"></div>
                                    <div class="flex items-center gap-2">
                                        <span class="text-gray-500">📊</span>
                                        <span class="text-sm text-gray-700">Publicada: {{ $vacante->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </div>
                                
                                <!-- Salario -->
                                @if($vacante->salario_min && $vacante->salario_max && $vacante->salario_mostrar)
                                <div class="mt-3">
                                    <span class="salario-tag inline-flex items-center gap-1">
                                        <span>💰</span>
                                        <span>${{ number_format($vacante->salario_min, 2) }} - ${{ number_format($vacante->salario_max, 2) }}</span>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Acciones -->
                    <div class="p-6 pt-0">
                        <div class="flex flex-wrap gap-2">
                            <!-- Ver Detalles -->
                            <button onclick="mostrarDetalles({{ $vacante->id }})" 
                                    class="btn-itszn-secundario flex items-center gap-2 px-4 py-2 text-sm">
                                <span>👁️</span>
                                <span>Ver Detalles</span>
                            </button>

                            <!-- Editar (solo si está pendiente o aprobada) -->
                            @if($vacante->estado == 'pendiente' || $vacante->estado == 'aprobada')
                            <a href="{{ route('vacantes.edit', $vacante) }}" 
                               class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700 transition flex items-center gap-2 text-sm">
                                <span>✏️</span>
                                <span>Editar</span>
                            </a>
                            @endif

                            <!-- Postulaciones -->
                            <a href="{{ route('empresa.postulaciones.vacante', $vacante) }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition flex items-center gap-2 text-sm">
                                <span>📋</span>
                                <span>Ver Postulaciones</span>
                            </a>

                            <!-- Eliminar -->
                            <button onclick="confirmarEliminacion({{ $vacante->id }}, '{{ $vacante->titulo }}')" 
                                    class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition flex items-center gap-2 text-sm">
                                <span>🗑️</span>
                                <span>Eliminar</span>
                            </button>

                            <!-- Si fue rechazada, mostrar motivo -->
                            @if($vacante->estado == 'rechazada' && $vacante->motivo_rechazo)
                            <button onclick="mostrarMotivoRechazo('{{ $vacante->motivo_rechazo }}')" 
                                    class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition flex items-center gap-2 text-sm">
                                <span>📋</span>
                                <span>Ver Motivo</span>
                            </button>
                            @endif
                        </div>
                    </div>

                    <!-- Detalles Expandibles -->
                    <div id="detalles-{{ $vacante->id }}" class="hidden p-6 pt-0">
                        <div class="detalles-content">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                        <span>📝</span>
                                        <span>Descripción del Puesto</span>
                                    </h4>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $vacante->descripcion }}</p>
                                </div>
                                
                                <div>
                                    <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                        <span>🎓</span>
                                        <span>Requisitos</span>
                                    </h4>
                                    <p class="text-gray-700 whitespace-pre-line">{{ $vacante->requisitos }}</p>
                                </div>
                            </div>
                            
                            @if($vacante->beneficios)
                            <div class="mt-6">
                                <h4 class="font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                    <span>⭐</span>
                                    <span>Beneficios</span>
                                </h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $vacante->beneficios }}</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Estado Vacío Mejorado -->
            <div class="empty-state text-center fade-in">
                <div class="text-6xl mb-6">📋</div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">Aún no has publicado vacantes</h2>
                <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                    Comienza publicando tu primera oferta de empleo para que los estudiantes del ITSZN puedan postularse.
                </p>
                
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-xl p-6 max-w-2xl mx-auto mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">💡</span>
                        <h3 class="text-lg font-semibold text-gray-800">¿Por qué publicar vacantes?</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        <div class="flex items-start gap-2">
                            <span class="text-green-600 mt-0.5">🎯</span>
                            <div>
                                <p class="font-medium text-gray-800">Talentos calificados</p>
                                <p class="text-sm text-gray-600">Accede a estudiantes del ITSZN</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">🚀</span>
                            <div>
                                <p class="font-medium text-gray-800">Proceso simplificado</p>
                                <p class="text-sm text-gray-600">Gestiona todo en una plataforma</p>
                            </div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('vacantes.create') }}" 
                   class="btn-itszn inline-flex items-center gap-2">
                    <span>➕</span>
                    <span>Publicar Primera Vacante</span>
                </a>
            </div>
        @endif
    </div>

    <!-- Modal para motivo de rechazo -->
    <div id="modalMotivo" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 transition-opacity duration-300">
        <div class="modal-content p-6 w-full max-w-lg transform transition-transform duration-300 scale-95" id="modalMotivoContent">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <span class="text-xl text-red-600">📋</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Motivo de Rechazo</h3>
                    <p class="text-sm text-gray-600">Información sobre la revisión de la vacante</p>
                </div>
            </div>
            
            <div class="mb-6">
                <p id="textoMotivo" class="text-gray-700 whitespace-pre-line bg-gray-50 p-4 rounded-lg"></p>
            </div>
            
            <button onclick="cerrarModalMotivo()" 
                    class="btn-itszn-secundario w-full flex items-center justify-center gap-2 py-3">
                <span>←</span>
                <span>Volver</span>
            </button>
        </div>
    </div>

    <!-- Formulario oculto para eliminación -->
    <form id="formEliminar" method="POST" class="hidden">
        @csrf
        @method('DELETE')
    </form>

    <script>
        // ✅ FUNCIÓN PARA MOSTRAR/OCULTAR DETALLES
        function mostrarDetalles(vacanteId) {
            const detalles = document.getElementById(`detalles-${vacanteId}`);
            detalles.classList.toggle('hidden');
            
            // Animar la apertura/cierre
            if (!detalles.classList.contains('hidden')) {
                detalles.style.opacity = '0';
                detalles.style.transform = 'translateY(-10px)';
                
                setTimeout(() => {
                    detalles.style.transition = 'all 0.3s ease';
                    detalles.style.opacity = '1';
                    detalles.style.transform = 'translateY(0)';
                }, 10);
            }
        }

        // ✅ FUNCIÓN PARA MOSTRAR MOTIVO DE RECHAZO
        function mostrarMotivoRechazo(motivo) {
            const modal = document.getElementById('modalMotivo');
            const modalContent = document.getElementById('modalMotivoContent');
            const textoMotivo = document.getElementById('textoMotivo');
            
            textoMotivo.textContent = motivo;
            
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        // ✅ FUNCIÓN PARA CERRAR MODAL MOTIVO
        function cerrarModalMotivo() {
            const modal = document.getElementById('modalMotivo');
            const modalContent = document.getElementById('modalMotivoContent');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // ✅ FUNCIÓN PARA CONFIRMAR ELIMINACIÓN
        function confirmarEliminacion(vacanteId, titulo) {
            const modal = document.createElement('div');
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
            modal.innerHTML = `
                <div class="bg-white rounded-xl p-6 w-full max-w-md">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                            <span class="text-xl text-red-600">🗑️</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800">Confirmar Eliminación</h3>
                            <p class="text-gray-600">¿Estás seguro de eliminar esta vacante?</p>
                        </div>
                    </div>
                    
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                        <p class="text-yellow-800 font-semibold">"${titulo}"</p>
                        <p class="text-sm text-yellow-600 mt-1">Esta acción no se puede deshacer.</p>
                    </div>
                    
                    <div class="flex gap-3">
                        <button id="confirmarEliminar" 
                                class="btn-rojo flex-1 flex items-center justify-center gap-2 py-3">
                            <span>🗑️</span>
                            <span>Sí, Eliminar</span>
                        </button>
                        <button id="cancelarEliminar" 
                                class="btn-itszn-secundario flex-1 flex items-center justify-center gap-2 py-3">
                            <span>←</span>
                            <span>Cancelar</span>
                        </button>
                    </div>
                </div>
            `;
            
            document.body.appendChild(modal);
            
            // Confirmar eliminación
            document.getElementById('confirmarEliminar').addEventListener('click', () => {
                const form = document.getElementById('formEliminar');
                form.action = `/empresa/vacantes/${vacanteId}`;
                form.submit();
                document.body.removeChild(modal);
            });
            
            // Cancelar eliminación
            document.getElementById('cancelarEliminar').addEventListener('click', () => {
                document.body.removeChild(modal);
            });
            
            // Cerrar al hacer clic fuera
            modal.addEventListener('click', (e) => {
                if (e.target === modal) {
                    document.body.removeChild(modal);
                }
            });
        }

        // ✅ CERRAR MODAL AL HACER CLIC FUERA
        document.getElementById('modalMotivo').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModalMotivo();
            }
        });

        // ✅ CERRAR MODAL CON ESCAPE
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModalMotivo();
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