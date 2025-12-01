<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Postulaciones - Bolsa Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ✅ AZUL INSTITUCIONAL ITSZN */
        .azul-itszn { background-color: #1B396A; }
        .borde-azul-itszn { border-color: #1B396A; }
        .texto-azul-itszn { color: #1B396A; }

        /* ENCABEZADO INSTITUCIONAL */
        .header-institucional {
            background: linear-gradient(135deg, #1B396A 0%, #2D4F8A 100%);
            border-bottom: 4px solid #1B396A;
        }
        .header-institucional h1 { 
            color: white;
            font-weight: bold;
        }
        .header-institucional p { 
            color: rgba(255, 255, 255, 0.9);
        }

        /* BOTONES CON AZUL ITSZN */
        .btn-itszn {
            background-color: #1B396A;
            color: white;
            border: 2px solid #1B396A;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .btn-itszn:hover {
            background-color: #2D4F8A;
            border-color: #2D4F8A;
            transform: translateY(-2px);
        }

        /* ESTADÍSTICAS CON BORDE AZUL */
        .estadisticas-container {
            border: 2px solid #1B396A;
            border-radius: 12px;
        }

        /* MODAL CON BORDE AZUL */
        .modal-itszn {
            border: 3px solid #1B396A;
            border-radius: 12px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO CON AZUL INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">📋 Mis Postulaciones</h1>
                    <p>Seguimiento de tus aplicaciones</p>
                </div>
                <div class="space-x-4">
                    <a href="{{ route('alumno.vacantes') }}" class="btn-itszn">
                        🔍 Buscar Vacantes
                    </a>
                    <a href="/dashboard" class="bg-white text-blue-800 border border-blue-800 px-4 py-2 rounded hover:bg-blue-100">
    ← Menu Principal
</a>


                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- ESTADÍSTICAS CON BORDES AZULES -->
        <div class="estadisticas-container bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-center">
                <div>
                    <p class="text-2xl font-bold texto-azul-itszn">{{ $postulaciones->count() }}</p>
                    <p class="text-sm text-gray-600">Total</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-yellow-600">{{ $postulaciones->where('estado', 'pendiente')->count() }}</p>
                    <p class="text-sm text-gray-600">Pendientes</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-green-600">{{ $postulaciones->where('estado', 'aceptado')->count() }}</p>
                    <p class="text-sm text-gray-600">Aceptadas</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-red-600">{{ $postulaciones->where('estado', 'rechazado')->count() }}</p>
                    <p class="text-sm text-gray-600">Rechazadas</p>
                </div>
            </div>
        </div>

        @if($postulaciones->count() > 0)
            <div class="grid gap-6">
                @foreach($postulaciones as $postulacion)
                <!-- TARJETA MANTIENE COLORES ORIGINALES DE ESTADO -->
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 
                    {{ $postulacion->estado == 'aceptado' ? 'border-green-500' : '' }}
                    {{ $postulacion->estado == 'pendiente' ? 'border-yellow-500' : '' }}
                    {{ $postulacion->estado == 'rechazado' ? 'border-red-500' : '' }}
                    {{ $postulacion->estado == 'revisado' ? 'border-blue-500' : '' }}">
                    
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold texto-azul-itszn">{{ $postulacion->vacante->titulo }}</h3>
                            <p class="text-gray-600 mt-1">
                                <strong>🏢 Empresa:</strong> {{ $postulacion->vacante->empresa->nombre_empresa }}
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                                <div>
                                    <p class="text-sm text-gray-600"><strong>📅 Postulaste:</strong> {{ $postulacion->created_at->format('d/m/Y H:i') }}</p>
                                    <p class="text-sm text-gray-600"><strong>🎓 Carrera:</strong> {{ $postulacion->carrera }}</p>
                                    <p class="text-sm text-gray-600"><strong>📚 Semestre:</strong> {{ $postulacion->semestre }}°</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600"><strong>📧 Email:</strong> {{ $postulacion->email }}</p>
                                    <p class="text-sm text-gray-600"><strong>📞 Teléfono:</strong> {{ $postulacion->telefono }}</p>
                                    <p class="text-sm text-gray-600"><strong>🎂 Edad:</strong> {{ $postulacion->edad }} años</p>
                                </div>
                            </div>

                            <!-- Motivación breve -->
                            <div class="mt-3">
                                <p class="text-gray-700 text-sm">
                                    <strong>💬 Motivación:</strong> {{ Str::limit($postulacion->motivacion, 100) }}
                                </p>
                            </div>
                        </div>
                        
                        <div class="text-right ml-4">
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                {{ $postulacion->estado == 'aceptado' ? 'bg-green-100 text-green-800' : '' }}
                                {{ $postulacion->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $postulacion->estado == 'rechazado' ? 'bg-red-100 text-red-800' : '' }}
                                {{ $postulacion->estado == 'revisado' ? 'bg-blue-100 text-blue-800' : '' }}">
                                @if($postulacion->estado == 'aceptado') ✅ Aceptado
                                @elseif($postulacion->estado == 'pendiente') ⏳ Pendiente
                                @elseif($postulacion->estado == 'rechazado') ❌ Rechazado
                                @elseif($postulacion->estado == 'revisado') 🔍 Revisado
                                @endif
                            </span>
                            
                            @if($postulacion->fecha_revision)
                            <p class="text-xs text-gray-500 mt-1">
                                Revisado: {{ $postulacion->fecha_revision->format('d/m/Y') }}
                            </p>
                            @endif

                            <!-- ✅ BOTÓN DE SERVICIO SOCIAL PARA POSTULACIONES ACEPTADAS -->
                            @if($postulacion->estado == 'aceptado')
                                <div class="mt-3">
                                    @if(!$postulacion->tieneSolicitudServicioSocial())
                                        <a href="{{ route('servicio-social.crear', $postulacion->id) }}" 
                                           class="btn-itszn text-sm">
                                            🎓 Solicitar SS
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1">¿Contar como Servicio Social?</p>
                                    @else
                                        @php
                                            $ss = $postulacion->servicioSocial;
                                            $estados = [
                                                'solicitado' => ['class' => 'bg-yellow-100 text-yellow-800', 'text' => '📤 Solicitado'],
                                                'empresa_acepto' => ['class' => 'bg-blue-100 text-blue-800', 'text' => '🏢 Empresa Aceptó'],
                                                'jefe_aprobo' => ['class' => 'bg-green-100 text-green-800', 'text' => '✅ Jefe Aprobó'],
                                                'en_proceso' => ['class' => 'bg-purple-100 text-purple-800', 'text' => '⏳ En Proceso'],
                                                'completado' => ['class' => 'bg-green-100 text-green-800', 'text' => '🎓 Completado'],
                                                'rechazado' => ['class' => 'bg-red-100 text-red-800', 'text' => '❌ Rechazado']
                                            ];
                                            $estadoInfo = $estados[$ss->estado] ?? ['class' => 'bg-gray-100 text-gray-800', 'text' => $ss->estado];
                                        @endphp
                                        
                                        <div class="space-y-1">
                                            <span class="inline-block px-2 py-1 rounded text-xs font-medium {{ $estadoInfo['class'] }}">
                                                {{ $estadoInfo['text'] }}
                                            </span>
                                            <br>
                                            <a href="{{ route('servicio-social.show', $ss->id) }}" 
                                               class="btn-itszn text-xs">
                                                Ver Detalles
                                            </a>
                                        </div>

                                        <!-- Información adicional del estado -->
                                        @if($ss->estado == 'solicitado')
                                            <p class="text-xs text-yellow-600 mt-1">Esperando aprobación de la empresa</p>
                                        @elseif($ss->estado == 'empresa_acepto')
                                            <p class="text-xs text-blue-600 mt-1">Esperando aprobación del jefe</p>
                                        @elseif($ss->estado == 'jefe_aprobo')
                                            <p class="text-xs text-green-600 mt-1">✅ Aprobado - Registra horas</p>
                                        @endif
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Acciones y Detalles -->
                    <div class="flex flex-wrap gap-3 mt-4 pt-4 border-t border-gray-200">
                        <!-- Ver detalles completos -->
                        <button onclick="mostrarDetalles({{ $postulacion->id }})" 
                                class="btn-itszn text-sm">
                            👁️ Ver Detalles
                        </button>

                        <!-- Descargar CV -->
                        <a href="{{ route('alumno.descargar-cv', $postulacion) }}" 
                           class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 text-sm">
                            📄 Descargar CV
                        </a>

                        <!-- Descargar solicitud si existe -->
                        @if($postulacion->solicitud_path)
                        <a href="{{ route('alumno.descargar-solicitud', $postulacion) }}" 
                           class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700 text-sm">
                            📝 Descargar Solicitud
                        </a>
                        @endif

                        <!-- Si fue rechazada, mostrar motivo -->
                        @if($postulacion->estado == 'rechazado' && $postulacion->mensaje_rechazo)
                        <button onclick="mostrarMotivoRechazo('{{ $postulacion->mensaje_rechazo }}')" 
                                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 text-sm">
                            📋 Ver Motivo
                        </button>
                        @endif
                    </div>

                    <!-- Modal de Detalles -->
                    <div id="detalles-{{ $postulacion->id }}" class="hidden mt-4 p-4 bg-gray-50 rounded-lg borde-azul-itszn border">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold mb-2 texto-azul-itszn">💼 Habilidades:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->habilidades }}</p>
                                
                                @if($postulacion->experiencia)
                                <h4 class="font-semibold mt-4 mb-2 texto-azul-itszn">📈 Experiencia:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->experiencia }}</p>
                                @endif
                            </div>
                            <div>
                                <h4 class="font-semibold mb-2 texto-azul-itszn">💬 Motivación Completa:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $postulacion->motivacion }}</p>
                            </div>
                        </div>
                        
                        <!-- Información de la vacante -->
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg borde-azul-itszn border">
                            <h4 class="font-semibold mb-2 texto-azul-itszn">🎯 Vacante Aplicada:</h4>
                            <p class="text-blue-700"><strong>Puesto:</strong> {{ $postulacion->vacante->titulo }}</p>
                            <p class="text-blue-700"><strong>Empresa:</strong> {{ $postulacion->vacante->empresa->nombre_empresa }}</p>
                            <p class="text-blue-700"><strong>Ubicación:</strong> {{ $postulacion->vacante->ubicacion }}</p>
                            <p class="text-blue-700"><strong>Tipo:</strong> {{ ucfirst(str_replace('_', ' ', $postulacion->vacante->tipo_contrato)) }}</p>
                        </div>

                        <!-- Información de Servicio Social si existe -->
                        @if($postulacion->tieneSolicitudServicioSocial())
                            @php
                                $ss = $postulacion->servicioSocial;
                            @endphp
                            <div class="mt-6 p-4 bg-green-50 rounded-lg border border-green-200">
                                <h4 class="font-semibold mb-2 text-green-800">🎓 Servicio Social:</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <p class="text-green-700"><strong>Estado:</strong> {{ ucfirst(str_replace('_', ' ', $ss->estado)) }}</p>
                                        <p class="text-green-700"><strong>Proyecto:</strong> {{ $ss->nombre_proyecto }}</p>
                                        <p class="text-green-700"><strong>Horas:</strong> {{ $ss->horas_completadas }}/{{ $ss->horas_requeridas }}</p>
                                    </div>
                                    <div>
                                        <p class="text-green-700"><strong>Inicio:</strong> {{ $ss->fecha_inicio ? $ss->fecha_inicio->format('d/m/Y') : 'No definido' }}</p>
                                        <p class="text-green-700"><strong>Fin estimado:</strong> {{ $ss->fecha_fin_estimada ? $ss->fecha_fin_estimada->format('d/m/Y') : 'No definido' }}</p>
                                        <p class="text-green-700"><strong>Progreso:</strong> {{ $ss->porcentajeCompletado() }}%</p>
                                    </div>
                                </div>
                                @if($ss->observaciones_empresa)
                                    <p class="text-green-700 mt-2"><strong>Observaciones empresa:</strong> {{ $ss->observaciones_empresa }}</p>
                                @endif
                                @if($ss->observaciones_jefe)
                                    <p class="text-green-700 mt-2"><strong>Observaciones jefe:</strong> {{ $ss->observaciones_jefe }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">📋</div>
                <h2 class="text-3xl font-bold texto-azul-itszn mb-4">Aún no te has postulado</h2>
                <p class="text-gray-600 text-lg mb-6">Encuentra vacantes que se ajusten a tu perfil y comienza a postularte.</p>
                <a href="{{ route('alumno.vacantes') }}" class="btn-itszn text-lg">
                    🔍 Explorar Vacantes
                </a>
            </div>
        @endif
    </div>

    <!-- Modal para motivo de rechazo -->
    <div id="modalMotivo" class="modal-itszn fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-4 texto-azul-itszn">📋 Motivo de Rechazo</h3>
            <p id="textoMotivo" class="text-gray-700 mb-4"></p>
            <button onclick="cerrarModalMotivo()" 
                    class="btn-itszn w-full">
                Cerrar
            </button>
        </div>
    </div>

    <script>
        function mostrarDetalles(postulacionId) {
            const detalles = document.getElementById(`detalles-${postulacionId}`);
            detalles.classList.toggle('hidden');
        }

        function mostrarMotivoRechazo(motivo) {
            document.getElementById('textoMotivo').textContent = motivo;
            document.getElementById('modalMotivo').classList.remove('hidden');
        }

        function cerrarModalMotivo() {
            document.getElementById('modalMotivo').classList.add('hidden');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modalMotivo').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModalMotivo();
            }
        });
    </script>
</body>
</html>