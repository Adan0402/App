<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Postulación - ITSZN Bolsa de Trabajo</title>
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

        .modal-content {
            background: white;
            border-radius: 1rem;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .section-card {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            margin-bottom: 1.5rem;
        }

        .section-header {
            border-bottom: 2px solid var(--gris-medio);
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }

        .avatar-large {
            width: 120px;
            height: 120px;
            border: 4px solid white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .document-card {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 0.75rem;
            padding: 1rem;
            transition: all 0.3s ease;
        }

        .document-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }

        .info-item {
            background: var(--gris-claro);
            border-radius: 0.75rem;
            padding: 1rem;
        }

        .motivation-card {
            background: linear-gradient(135deg, #e3f2fd, #bbdefb);
            border-radius: 0.75rem;
            padding: 1.5rem;
            border-left: 4px solid var(--azul-itszn);
        }

        .skills-card {
            background: linear-gradient(135deg, #f3e5f5, #e1bee7);
            border-radius: 0.75rem;
            padding: 1.5rem;
            border-left: 4px solid #9c27b0;
        }

        .experience-card {
            background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
            border-radius: 0.75rem;
            padding: 1.5rem;
            border-left: 4px solid var(--verde-itszn);
        }

        .rejection-card {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            border-radius: 0.75rem;
            padding: 1.5rem;
            border-left: 4px solid var(--rojo-itszn);
        }

        .vacante-tag {
            background: linear-gradient(135deg, var(--azul-itszn), var(--azul-itszn-claro));
            color: white;
            border-radius: 0.5rem;
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .avatar-large {
                width: 100px;
                height: 100px;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
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
                    <h1 class="text-2xl font-bold text-white mb-1">👤 Detalle de Postulación</h1>
                    <p class="text-white/90">{{ $user->empresa->nombre_empresa }}</p>
                </div>
                <div class="flex flex-wrap gap-2 justify-center">
                    <a href="{{ route('empresa.postulaciones') }}" 
                       class="btn-itszn-secundario flex items-center gap-2">
                        <span>←</span>
                        <span>Volver a Postulaciones</span>
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
        <div class="max-w-6xl mx-auto">
            <!-- Perfil Principal -->
            <div class="info-card bg-white rounded-xl shadow-lg p-6 mb-6 fade-in">
                <div class="flex flex-col md:flex-row items-start md:items-center gap-6 mb-6">
                    <!-- Avatar del Estudiante -->
                    <div class="flex flex-col items-center md:items-start">
                        @if($postulacion->user && $postulacion->user->foto_perfil)
                        <img src="{{ Storage::url($postulacion->user->foto_perfil) }}" 
                             alt="{{ $postulacion->nombre_completo }}"
                             class="avatar-large rounded-full object-cover">
                        @else
                        <div class="avatar-large rounded-full flex items-center justify-center bg-gradient-to-br from-blue-500 to-blue-700">
                            <span class="text-4xl font-bold text-white">
                                {{ strtoupper(substr($postulacion->nombre_completo, 0, 1)) }}
                            </span>
                        </div>
                        @endif
                        <div class="mt-3 text-center md:text-left">
                            <div class="flex items-center gap-2">
                                <span class="vacante-tag">{{ $postulacion->vacante->titulo }}</span>
                                <span class="estado-badge estado-{{ $postulacion->estado }}">
                                    @if($postulacion->estado == 'aceptado') ✅ Aceptado
                                    @elseif($postulacion->estado == 'pendiente') ⏳ Pendiente
                                    @elseif($postulacion->estado == 'rechazado') ❌ Rechazado
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Información Principal -->
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $postulacion->nombre_completo }}</h2>
                        <p class="text-gray-600 mb-4">🎓 {{ $postulacion->carrera }} - {{ $postulacion->semestre }}° semestre</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">📧</span>
                                    <span class="text-gray-800">{{ $postulacion->email }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">📞</span>
                                    <span class="text-gray-800">{{ $postulacion->telefono }}</span>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">🎂</span>
                                    <span class="text-gray-800">{{ $postulacion->edad }} años</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-gray-500">📅</span>
                                    <span class="text-gray-800">{{ $postulacion->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estado y Acciones -->
                    <div class="text-center md:text-right">
                        <div class="mb-3">
                            <div class="text-sm text-gray-500">Postuló hace</div>
                            <div class="text-sm font-medium">{{ $postulacion->created_at->diffForHumans() }}</div>
                        </div>
                        
                        @if($postulacion->fecha_revision)
                        <div>
                            <div class="text-sm text-gray-500">Revisado</div>
                            <div class="text-sm font-medium">{{ $postulacion->fecha_revision->format('d/m/Y H:i') }}</div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Grid de Información -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                <!-- Habilidades -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <span>💼</span>
                            <span>Habilidades Técnicas</span>
                        </h3>
                    </div>
                    <div class="skills-card">
                        <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->habilidades }}</p>
                    </div>
                </div>

                <!-- Experiencia -->
                <div class="section-card">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                            <span>📈</span>
                            <span>Experiencia</span>
                        </h3>
                    </div>
                    <div class="experience-card">
                        @if($postulacion->experiencia)
                            <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->experiencia }}</p>
                        @else
                            <p class="text-gray-500 italic">El alumno no especificó experiencia previa.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Motivación -->
            <div class="section-card mb-6">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span>💬</span>
                        <span>Motivación y Objetivos</span>
                    </h3>
                </div>
                <div class="motivation-card">
                    <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->motivacion }}</p>
                </div>
            </div>

            <!-- Motivo de Rechazo (si aplica) -->
            @if($postulacion->estado == 'rechazado' && $postulacion->mensaje_rechazo)
            <div class="section-card mb-6">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span>📋</span>
                        <span>Motivo de Rechazo</span>
                    </h3>
                </div>
                <div class="rejection-card">
                    <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->mensaje_rechazo }}</p>
                </div>
            </div>
            @endif

            <!-- Documentos -->
            <div class="section-card mb-6">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span>📄</span>
                        <span>Documentos Adjuntos</span>
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('empresa.postulacion.descargar-cv', $postulacion) }}" 
                       class="document-card hover:border-blue-500 border-2 border-transparent transition-all duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <span class="text-xl text-green-600">📄</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Curriculum Vitae</h4>
                                <p class="text-sm text-gray-600">Descargar CV del estudiante</p>
                            </div>
                        </div>
                    </a>

                    @if($postulacion->solicitud_path)
                    <a href="{{ route('empresa.postulacion.descargar-solicitud', $postulacion) }}" 
                       class="document-card hover:border-purple-500 border-2 border-transparent transition-all duration-300">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <span class="text-xl text-purple-600">📝</span>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-800">Carta de Solicitud</h4>
                                <p class="text-sm text-gray-600">Descargar carta formal</p>
                            </div>
                        </div>
                    </a>
                    @endif
                </div>
            </div>

            <!-- Acciones (si está pendiente) -->
            @if($postulacion->estado == 'pendiente')
            <div class="section-card mb-6">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span>⚡</span>
                        <span>Acciones Disponibles</span>
                    </h3>
                </div>
                <div class="flex flex-col sm:flex-row gap-4">
                    <form action="{{ route('empresa.postulacion.aprobar', $postulacion) }}" method="POST" class="flex-1">
                        @csrf
                        <button type="submit" 
                                class="btn-verde w-full flex items-center justify-center gap-2 py-3">
                            <span>✅</span>
                            <span>Aprobar Postulación</span>
                        </button>
                    </form>
                    
                    <button type="button" 
                            onclick="mostrarModalRechazo('{{ $postulacion->id }}', '{{ $postulacion->nombre_completo }}')"
                            class="btn-rojo flex-1 flex items-center justify-center gap-2 py-3">
                        <span>❌</span>
                        <span>Rechazar Postulación</span>
                    </button>
                </div>
            </div>
            @endif

            <!-- Información de la Vacante -->
            <div class="section-card">
                <div class="section-header">
                    <h3 class="text-lg font-semibold text-gray-800 flex items-center gap-2">
                        <span>🎯</span>
                        <span>Información de la Vacante</span>
                    </h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">🏢</span>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Puesto</p>
                                <p class="text-gray-900 font-medium">{{ $postulacion->vacante->titulo }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-lg">📍</span>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Ubicación</p>
                                <p class="text-gray-900">{{ $postulacion->vacante->ubicacion }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-lg">👥</span>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Empresa</p>
                                <p class="text-gray-900">{{ $postulacion->vacante->empresa->nombre_empresa }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <span class="text-lg">📄</span>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Tipo de contrato</p>
                                <p class="text-gray-900">{{ ucfirst(str_replace('_', ' ', $postulacion->vacante->tipo_contrato)) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-lg">💼</span>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Modalidad</p>
                                <p class="text-gray-900">{{ ucfirst($postulacion->vacante->modalidad) }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-lg">📅</span>
                            <div>
                                <p class="text-sm font-semibold text-gray-500">Fecha límite</p>
                                <p class="text-gray-900">{{ $postulacion->vacante->fecha_limite->format('d/m/Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('empresa.postulaciones.vacante', $postulacion->vacante) }}" 
                       class="text-blue-600 hover:text-blue-800 font-medium flex items-center gap-2">
                        <span>📋</span>
                        <span>Ver todas las postulaciones de esta vacante</span>
                    </a>
                </div>
            </div>
        </div>
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
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent"
                              rows="4" required
                              placeholder="Proporciona un motivo constructivo para ayudar al candidato a mejorar..."></textarea>
                    <p class="text-xs text-gray-500 mt-2">
                        Este mensaje será enviado al estudiante como retroalimentación.
                    </p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" 
                            class="btn-rojo flex items-center justify-center gap-2 flex-1 py-3">
                        <span>❌</span>
                        <span>Confirmar Rechazo</span>
                    </button>
                    <button type="button" 
                            onclick="cerrarModal()"
                            class="btn-itszn-secundario flex items-center justify-center gap-2 flex-1 py-3">
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
            
            form.action = `/empresa/postulaciones/${postulacionId}/rechazar`;
            nombrePostulante.textContent = `Postulante: ${postulanteNombre}`;
            
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