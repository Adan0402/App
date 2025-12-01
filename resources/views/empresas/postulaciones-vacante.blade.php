<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postulaciones por Vacante - ITSZN Bolsa de Trabajo</title>
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

        .btn-verde {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-verde:hover {
            background: linear-gradient(135deg, #218838, #1ea185);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(40, 167, 69, 0.2);
        }

        .btn-rojo {
            background: linear-gradient(135deg, #dc3545, #e83e8c);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-rojo:hover {
            background: linear-gradient(135deg, #c82333, #d63384);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(220, 53, 69, 0.2);
        }

        .info-card {
            border-left: 4px solid var(--azul-itszn);
            transition: all 0.3s ease;
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .postulacion-card {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .postulacion-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0,0,0,0.12);
        }

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

        .estado-aceptado { 
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .estado-rechazado { 
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
        }

        .stats-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }

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

        .form-input {
            border: 2px solid var(--gris-medio);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            transition: all 0.3s ease;
            width: 100%;
        }

        .form-input:focus {
            border-color: var(--azul-itszn);
            box-shadow: 0 0 0 3px rgba(27, 57, 106, 0.1);
            outline: none;
        }

        .card-header {
            background: linear-gradient(135deg, var(--azul-itszn) 0%, var(--azul-itszn-claro) 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 1rem 1rem 0 0;
        }

        .card-header h2 {
            color: white;
        }

        .separator {
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gris-medio), transparent);
            margin: 1.5rem 0;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
            }
            
            .action-buttons button, 
            .action-buttons a {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header Institucional -->
    <header class="header-institucional shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-center md:text-left">
                    <h1 class="text-2xl font-bold text-white mb-1">📋 Postulaciones por Vacante</h1>
                    <p class="text-white/90">{{ $user->empresa->nombre_empresa }}</p>
                </div>
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('empresa.postulaciones') }}" 
                       class="btn-itszn-secundario flex items-center gap-2">
                        <span>←</span>
                        <span>Todas las Postulaciones</span>
                    </a>
                    <a href="/dashboard" 
                       class="btn-itszn flex items-center gap-2">
                        <span>📊</span>
                        <span>Dashboard</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Información de la vacante -->
        <div class="info-card bg-white rounded-xl shadow-lg p-6 mb-8 fade-in">
            <div class="card-header mb-6">
                <h2 class="text-xl font-bold flex items-center gap-2">
                    <span>🎯</span>
                    <span>Información de la Vacante</span>
                </h2>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">🏢</span>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Puesto</p>
                            <p class="text-lg font-bold text-gray-900">{{ $vacante->titulo }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-lg">📍</span>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Ubicación</p>
                            <p class="text-gray-900">{{ $vacante->ubicacion }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-lg">👥</span>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Empresa</p>
                            <p class="text-gray-900">{{ $vacante->empresa->nombre_empresa }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <span class="text-lg">📄</span>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Tipo de contrato</p>
                            <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-lg">💼</span>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Modalidad</p>
                            <p class="text-gray-900">{{ ucfirst($vacante->modalidad) }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="text-lg">📅</span>
                        <div>
                            <p class="text-sm font-semibold text-gray-500">Fecha límite</p>
                            <p class="text-gray-900">{{ $vacante->fecha_limite->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas de esta vacante -->
        @php
            $totalPostulaciones = $postulaciones->count();
            $pendientes = $postulaciones->where('estado', 'pendiente')->count();
            $aceptadas = $postulaciones->where('estado', 'aceptado')->count();
            $rechazadas = $postulaciones->where('estado', 'rechazado')->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="stats-card fade-in" style="animation-delay: 0.1s">
                <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totalPostulaciones }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>📋</span>
                    <span>Total Postulaciones</span>
                </div>
                <div class="text-xs text-blue-500 mt-2 font-medium">
                    {{ $totalPostulaciones > 0 ? 'Interés en la vacante' : 'Sin postulaciones aún' }}
                </div>
            </div>
            
            <div class="stats-card fade-in" style="animation-delay: 0.2s">
                <div class="text-3xl font-bold text-yellow-600 mb-2">{{ $pendientes }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>⏳</span>
                    <span>Pendientes</span>
                </div>
                <div class="text-xs text-yellow-500 mt-2 font-medium">
                    {{ $pendientes > 0 ? 'Requieren revisión' : 'Todas revisadas' }}
                </div>
            </div>
            
            <div class="stats-card fade-in" style="animation-delay: 0.3s">
                <div class="text-3xl font-bold text-green-600 mb-2">{{ $aceptadas }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>✅</span>
                    <span>Aceptadas</span>
                </div>
                <div class="text-xs text-green-500 mt-2 font-medium">
                    {{ $aceptadas > 0 ? 'Candidatos potenciales' : 'Ninguna aceptada' }}
                </div>
            </div>
            
            <div class="stats-card fade-in" style="animation-delay: 0.4s">
                <div class="text-3xl font-bold text-red-600 mb-2">{{ $rechazadas }}</div>
                <div class="text-sm text-gray-600 flex items-center justify-center gap-1">
                    <span>❌</span>
                    <span>Rechazadas</span>
                </div>
                <div class="text-xs text-red-500 mt-2 font-medium">
                    {{ $rechazadas > 0 ? 'No seleccionadas' : 'Ninguna rechazada' }}
                </div>
            </div>
        </div>

        @if($postulaciones->count() > 0)
            <div class="space-y-6 mb-8">
                @foreach($postulaciones as $postulacion)
                <div class="postulacion-card fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                    <!-- Header con estado -->
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-6 pb-4">
                        <div class="flex items-start gap-4 mb-4 md:mb-0">
                            @if($postulacion->user && $postulacion->user->foto_perfil)
    <img src="{{ Storage::url($postulacion->user->foto_perfil) }}" 
         alt="{{ $postulacion->nombre_completo }}"
         class="w-16 h-16 rounded-full object-cover border-2 border-white shadow-md">
@else
    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
        <span class="text-2xl">👤</span>
    </div>
@endif
                            <div>
                                <h3 class="text-xl font-bold text-gray-900">{{ $postulacion->nombre_completo }}</h3>
                                <div class="flex flex-wrap items-center gap-2 mt-2">
                                    <span class="text-sm text-gray-500">🎓 {{ $postulacion->carrera }}</span>
                                    <span class="text-gray-300">•</span>
                                    <span class="text-sm text-gray-500">📚 {{ $postulacion->semestre }}° semestre</span>
                                    <span class="text-gray-300">•</span>
                                    <span class="text-sm text-gray-500">🎂 {{ $postulacion->edad }} años</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <span class="text-sm text-gray-500">
                                📅 {{ $postulacion->created_at->format('d/m/Y') }}
                            </span>
                            <span class="estado-badge estado-{{ $postulacion->estado }}">
                                @if($postulacion->estado == 'aceptado') ✅ Aceptado
                                @elseif($postulacion->estado == 'pendiente') ⏳ Pendiente
                                @elseif($postulacion->estado == 'rechazado') ❌ Rechazado
                                @endif
                            </span>
                        </div>
                    </div>

                    <!-- Información de contacto -->
                    <div class="px-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex items-center gap-3">
                                <span class="text-gray-500">📧</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-500">Email</p>
                                    <p class="text-gray-900">{{ $postulacion->email }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-gray-500">📞</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-500">Teléfono</p>
                                    <p class="text-gray-900">{{ $postulacion->telefono }}</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <span class="text-gray-500">💬</span>
                                <div>
                                    <p class="text-sm font-semibold text-gray-500">Postuló hace</p>
                                    <p class="text-gray-900">{{ $postulacion->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Motivación -->
                    @if($postulacion->motivacion)
                    <div class="px-6 mt-4">
                        <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-blue-600">💬</span>
                                <p class="font-semibold text-blue-700">Motivación del candidato</p>
                            </div>
                            <p class="text-gray-700 text-sm line-clamp-2">{{ $postulacion->motivacion }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="p-6 pt-4 mt-4 border-t border-gray-100">
                        <div class="action-buttons">
                            <a href="{{ route('empresa.postulacion.show', $postulacion) }}" 
                               class="btn-itszn-secundario flex items-center gap-2">
                                <span>👁️</span>
                                <span>Ver Detalles Completos</span>
                            </a>

                            <a href="{{ route('empresa.postulacion.descargar-cv', $postulacion) }}" 
                               class="btn-verde flex items-center gap-2">
                                <span>📄</span>
                                <span>Descargar CV</span>
                            </a>

                            @if($postulacion->solicitud_path)
                            <a href="{{ route('empresa.postulacion.descargar-solicitud', $postulacion) }}" 
                               class="btn-itszn flex items-center gap-2">
                                <span>📝</span>
                                <span>Descargar Solicitud</span>
                            </a>
                            @endif

                            @if($postulacion->estado == 'pendiente')
                            <form action="{{ route('empresa.postulacion.aprobar', $postulacion) }}" method="POST" class="contents">
                                @csrf
                                <button type="submit" 
                                        class="btn-verde flex items-center gap-2">
                                    <span>✅</span>
                                    <span>Aprobar Candidato</span>
                                </button>
                            </form>
                            
                            <button type="button" 
                                    onclick="mostrarModalRechazo('{{ $postulacion->id }}', '{{ $postulacion->nombre_completo }}')"
                                    class="btn-rojo flex items-center gap-2">
                                <span>❌</span>
                                <span>Rechazar Candidato</span>
                            </button>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- Estado vacío -->
            <div class="empty-state text-center fade-in">
                <div class="text-6xl mb-6">📭</div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">No hay postulaciones para esta vacante</h2>
                <p class="text-gray-600 text-lg mb-8 max-w-2xl mx-auto">
                    Aún no has recibido postulaciones para <span class="font-semibold text-blue-600">"{{ $vacante->titulo }}"</span>. 
                    Los estudiantes del ITSZN pueden ver esta vacante en la bolsa de trabajo.
                </p>
                
                <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-xl p-6 max-w-2xl mx-auto mb-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">💡</span>
                        <h3 class="text-lg font-semibold text-gray-800">Consejos para recibir más postulaciones</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-left">
                        <div class="flex items-start gap-2">
                            <span class="text-green-600 mt-0.5">✅</span>
                            <div>
                                <p class="font-medium text-gray-800">Descripción clara</p>
                                <p class="text-sm text-gray-600">Asegúrate de que la vacante tenga una descripción detallada</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">🎯</span>
                            <div>
                                <p class="font-medium text-gray-800">Requisitos específicos</p>
                                <p class="text-sm text-gray-600">Define claramente los requisitos y habilidades necesarias</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('empresa.vacantes') }}" 
                       class="btn-itszn-secundario">
                        ← Volver a Vacantes
                    </a>
                    <a href="{{ route('empresa.postulaciones') }}" 
                       class="btn-itszn">
                        📋 Ver Todas las Postulaciones
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal para rechazar -->
    <div id="modalRechazo" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4 transition-opacity duration-300">
        <div class="modal-content p-6 w-full max-w-lg transform transition-transform duration-300 scale-95" id="modalContent">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <span class="text-xl text-red-600">❌</span>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-800">Rechazar Postulación</h3>
                    <p id="postulanteNombre" class="text-gray-600"></p>
                </div>
            </div>
            
            <form id="formRechazo" method="POST">
                @csrf
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        Motivo del rechazo: *
                    </label>
                    <textarea name="mensaje_rechazo" 
                              class="form-input"
                              rows="4" required
                              placeholder="Proporciona un motivo constructivo para ayudar al candidato a mejorar..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">
                        Este mensaje será enviado al estudiante como retroalimentación.
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                            class="btn-rojo flex items-center justify-center gap-2 flex-1">
                        <span>❌</span>
                        <span>Confirmar Rechazo</span>
                    </button>
                    <button type="button" 
                            onclick="cerrarModal()"
                            class="btn-itszn-secundario flex items-center justify-center gap-2 flex-1">
                        <span>←</span>
                        <span>Cancelar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ✅ FUNCIÓN PARA MOSTRAR MODAL DE RECHAZO
        function mostrarModalRechazo(postulacionId, postulanteNombre) {
            const modal = document.getElementById('modalRechazo');
            const modalContent = document.getElementById('modalContent');
            const form = document.getElementById('formRechazo');
            const nombrePostulante = document.getElementById('postulanteNombre');
            
            // Configurar formulario
            form.action = `/empresa/postulaciones/${postulacionId}/rechazar`;
            nombrePostulante.textContent = `Postulante: ${postulanteNombre}`;
            
            // Mostrar modal con animación
            modal.classList.remove('hidden');
            setTimeout(() => {
                modalContent.classList.remove('scale-95');
                modalContent.classList.add('scale-100');
            }, 10);
        }

        // ✅ FUNCIÓN PARA CERRAR MODAL
        function cerrarModal() {
            const modal = document.getElementById('modalRechazo');
            const modalContent = document.getElementById('modalContent');
            
            modalContent.classList.remove('scale-100');
            modalContent.classList.add('scale-95');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        // ✅ CERRAR MODAL AL HACER CLIC FUERA
        document.getElementById('modalRechazo').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });

        // ✅ CERRAR MODAL CON ESCAPE
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });

        // ✅ ANIMACIÓN DE ENTRADA PARA LAS TARJETAS
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.fade-in');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });

        // ✅ UTILIDAD PARA LINE-CLAMP
        const style = document.createElement('style');
        style.textContent = `
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
            .line-clamp-3 {
                display: -webkit-box;
                -webkit-line-clamp: 3;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>