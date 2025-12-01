<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacantes Disponibles - Bolsa Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* ✅ SISTEMA DE DISEÑO UNIFICADO ITSZN */
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
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-itszn:hover {
            background-color: #2D4F8A;
            border-color: #2D4F8A;
            transform: translateY(-2px);
        }
        
        .btn-itszn-secundario {
            background-color: white;
            color: #1B396A;
            border: 2px solid #1B396A;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-itszn-secundario:hover {
            background-color: #1B396A;
            color: white;
            transform: translateY(-2px);
        }
        
        .estadisticas-container {
            border: 2px solid #1B396A;
            border-radius: 12px;
        }
        
        .modal-itszn {
            border: 3px solid #1B396A;
            border-radius: 12px;
        }
        
        .tarjeta-vacante {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }
        .tarjeta-vacante:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(27, 57, 106, 0.15);
        }
        
        .badge-contrato { background-color: #EFF6FF; color: #1B396A; }
        .badge-modalidad { background-color: #F0FDF4; color: #166534; }
        .badge-experiencia { background-color: #FFFBEB; color: #92400E; }
        .badge-salario { background-color: #FEF2F2; color: #DC2626; }
        
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* ✅ MEJORAS DE ACCESIBILIDAD */
        .focus-itszn:focus {
            outline: 2px solid #1B396A;
            outline-offset: 2px;
        }
        
        /* ✅ ANIMACIONES SUAVES */
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
        
        /* ✅ ESTADOS DE CARGA */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }
        
        @keyframes loading {
            0% { background-position: 200% 0; }
            100% { background-position: -200% 0; }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL MEJORADO -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">🎓 Vacantes Disponibles</h1>
                    <p>Encuentra tu oportunidad laboral ideal</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('alumno.mis-postulaciones') }}" class="btn-itszn-secundario">
                        📋 Mis Postulaciones
                    </a>
                    <a href="/dashboard" class="bg-white text-blue-800 border border-blue-800 px-4 py-2 rounded hover:bg-blue-100 transition">
    ← Menu Principal
</a>

                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- FILTROS MEJORADOS -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold texto-azul-itszn">🔍 Filtros de Búsqueda</h2>
                <button onclick="limpiarFiltros()" class="text-sm texto-azul-itszn hover:underline">
                    🗑️ Limpiar filtros
                </button>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium texto-azul-itszn mb-2">Tipo de Contrato</label>
                    <select id="filtroContrato" class="w-full border border-gray-300 rounded-md px-3 py-2 focus-itszn">
                        <option value="">Todos</option>
                        <option value="tiempo_completo">Tiempo Completo</option>
                        <option value="medio_tiempo">Medio Tiempo</option>
                        <option value="practicas">Prácticas</option>
                        <option value="freelance">Freelance</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium texto-azul-itszn mb-2">Modalidad</label>
                    <select id="filtroModalidad" class="w-full border border-gray-300 rounded-md px-3 py-2 focus-itszn">
                        <option value="">Todas</option>
                        <option value="presencial">Presencial</option>
                        <option value="remoto">Remoto</option>
                        <option value="hibrido">Híbrido</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium texto-azul-itszn mb-2">Experiencia</label>
                    <select id="filtroExperiencia" class="w-full border border-gray-300 rounded-md px-3 py-2 focus-itszn">
                        <option value="">Todas</option>
                        <option value="sin_experiencia">Sin experiencia</option>
                        <option value="junior">Junior</option>
                        <option value="mid">Mid-level</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button onclick="aplicarFiltros()" class="w-full btn-itszn">
                        ✅ Aplicar Filtros
                    </button>
                </div>
            </div>
            <!-- CONTADOR DE RESULTADOS -->
            <div id="contadorResultados" class="mt-4 text-sm texto-azul-itszn font-medium hidden">
                <span id="numeroResultados">0</span> vacantes encontradas
            </div>
        </div>

        <!-- ESTADÍSTICAS MEJORADAS -->
        <div class="estadisticas-container bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
            <h3 class="text-lg font-semibold texto-azul-itszn mb-4">📊 Resumen de Vacantes</h3>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">
                <div class="p-4 rounded-lg bg-blue-50">
                    <p class="text-2xl font-bold texto-azul-itszn">{{ $vacantes->count() }}</p>
                    <p class="text-sm text-gray-600">Vacantes Totales</p>
                </div>
                <div class="p-4 rounded-lg bg-green-50">
                    <p class="text-2xl font-bold text-green-600">{{ $vacantes->where('tipo_contrato', 'practicas')->count() }}</p>
                    <p class="text-sm text-gray-600">Prácticas</p>
                </div>
                <div class="p-4 rounded-lg bg-purple-50">
                    <p class="text-2xl font-bold text-purple-600">{{ $vacantes->where('modalidad', 'remoto')->count() }}</p>
                    <p class="text-sm text-gray-600">Remoto</p>
                </div>
                <div class="p-4 rounded-lg bg-yellow-50">
                    <p class="text-2xl font-bold text-yellow-600">{{ $vacantes->where('nivel_experiencia', 'sin_experiencia')->count() }}</p>
                    <p class="text-sm text-gray-600">Sin Experiencia</p>
                </div>
            </div>
        </div>

        <!-- INDICADOR DE CARGA -->
        <div id="loadingIndicator" class="hidden text-center py-8">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
            <p class="mt-2 texto-azul-itszn">Buscando vacantes...</p>
        </div>

        @if($vacantes->count() > 0)
            <div class="grid gap-6" id="contenedorVacantes">
                @foreach($vacantes as $vacante)
                <div class="tarjeta-vacante bg-white rounded-lg shadow-md p-6 border-l-4 border-green-500 vacante-card fade-in"
                     data-contrato="{{ $vacante->tipo_contrato }}"
                     data-modalidad="{{ $vacante->modalidad }}"
                     data-experiencia="{{ $vacante->nivel_experiencia }}">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-start justify-between">
                                <h3 class="text-xl font-semibold texto-azul-itszn">{{ $vacante->titulo }}</h3>
                                <span class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded ml-2">
                                    ⏰ {{ $vacante->fecha_limite->diffForHumans() }}
                                </span>
                            </div>
                            
                            <p class="text-gray-600 mt-1">
                                <strong>🏢 Empresa:</strong> {{ $vacante->empresa->nombre_empresa }}
                            </p>
                            
                            <!-- BADGES MEJORADOS -->
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="badge-contrato px-3 py-1 rounded-full text-xs font-medium">
                                    📍 {{ $vacante->ubicacion }}
                                </span>
                                <span class="badge-contrato px-3 py-1 rounded-full text-xs font-medium">
                                    💼 {{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}
                                </span>
                                <span class="badge-modalidad px-3 py-1 rounded-full text-xs font-medium">
                                    🏢 {{ ucfirst($vacante->modalidad) }}
                                </span>
                                <span class="badge-contrato px-3 py-1 rounded-full text-xs font-medium">
                                    👥 {{ $vacante->vacantes_disponibles }} vacante(s)
                                </span>
                                <span class="badge-experiencia px-3 py-1 rounded-full text-xs font-medium">
                                    🎯 {{ ucfirst(str_replace('_', ' ', $vacante->nivel_experiencia)) }}
                                </span>
                            </div>

                            @if($vacante->salario_min && $vacante->salario_max && $vacante->salario_mostrar)
                            <div class="mt-3">
                                <span class="badge-salario px-3 py-1 rounded-full text-sm font-medium">
                                    💰 ${{ number_format($vacante->salario_min, 0) }} - ${{ number_format($vacante->salario_max, 0) }}
                                </span>
                            </div>
                            @endif

                            <!-- Descripción breve -->
                            <div class="mt-4">
                                <p class="text-gray-700 line-clamp-2">
                                    {{ Str::limit($vacante->descripcion, 150) }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- ACCIONES MEJORADAS -->
                    <div class="flex flex-wrap gap-3 mt-6 pt-6 border-t border-gray-200">
                        <a href="{{ route('alumno.postular', $vacante) }}" 
                           class="btn-itszn flex items-center gap-2 pulse-soft">
                            📨 Postularme
                        </a>
                        
                        <button onclick="mostrarDetalles({{ $vacante->id }})" 
                                class="btn-itszn-secundario flex items-center gap-2">
                            👁️ Ver Detalles
                        </button>

                        <span class="text-sm text-gray-500 ml-auto self-center flex items-center gap-1">
                            📅 Publicada: {{ $vacante->created_at->format('d/m/Y') }}
                        </span>
                    </div>

                    <!-- MODAL DE DETALLES MEJORADO -->
                    <div id="detalles-{{ $vacante->id }}" class="hidden mt-4 p-4 bg-gray-50 rounded-lg borde-azul-itszn border">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold mb-2 texto-azul-itszn">📝 Descripción Completa:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $vacante->descripcion }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold mb-2 texto-azul-itszn">🎓 Requisitos:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $vacante->requisitos }}</p>
                                
                                @if($vacante->beneficios)
                                <h4 class="font-semibold mt-4 mb-2 texto-azul-itszn">⭐ Beneficios:</h4>
                                <p class="text-gray-700 whitespace-pre-line">{{ $vacante->beneficios }}</p>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Información de la empresa -->
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg borde-azul-itszn border">
                            <h4 class="font-semibold mb-2 texto-azul-itszn">🏢 Información de la Empresa:</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-blue-700"><strong>Nombre:</strong> {{ $vacante->empresa->nombre_empresa }}</p>
                                    <p class="text-blue-700"><strong>Representante:</strong> {{ $vacante->empresa->representante_legal }}</p>
                                </div>
                                <div>
                                    <p class="text-blue-700"><strong>Contacto:</strong> {{ $vacante->empresa->correo_contacto }}</p>
                                    @if($vacante->empresa->pagina_web)
                                    <p class="text-blue-700">
                                        <strong>Web:</strong> 
                                        <a href="{{ $vacante->empresa->pagina_web }}" target="_blank" class="underline hover:text-blue-900">
                                            {{ $vacante->empresa->pagina_web }}
                                        </a>
                                    </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <!-- ESTADO VACÍO MEJORADO -->
            <div class="bg-white rounded-lg shadow-md p-12 text-center fade-in">
                <div class="text-6xl mb-4">🔍</div>
                <h2 class="text-3xl font-bold texto-azul-itszn mb-4">No hay vacantes disponibles</h2>
                <p class="text-gray-600 text-lg mb-6">En este momento no hay vacantes activas. Vuelve más tarde.</p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 max-w-md mx-auto">
                    <p class="text-yellow-700 text-sm">
                        <strong>💡 Consejo:</strong><br>
                        Revisa periódicamente esta sección y actualiza tu perfil para ser visible para los reclutadores.
                    </p>
                </div>
            </div>
        @endif
    </div>

    <script>
        // ✅ MEJOR MANEJO DE FILTROS
        function aplicarFiltros() {
            const contrato = document.getElementById('filtroContrato').value;
            const modalidad = document.getElementById('filtroModalidad').value;
            const experiencia = document.getElementById('filtroExperiencia').value;
            
            const cards = document.querySelectorAll('.vacante-card');
            let contador = 0;
            
            // Mostrar indicador de carga
            document.getElementById('loadingIndicator').classList.remove('hidden');
            document.getElementById('contenedorVacantes').classList.add('opacity-50');
            
            setTimeout(() => {
                cards.forEach(card => {
                    let mostrar = true;
                    
                    if (contrato && card.dataset.contrato !== contrato) {
                        mostrar = false;
                    }
                    if (modalidad && card.dataset.modalidad !== modalidad) {
                        mostrar = false;
                    }
                    if (experiencia && card.dataset.experiencia !== experiencia) {
                        mostrar = false;
                    }
                    
                    if (mostrar) {
                        card.style.display = 'block';
                        contador++;
                        card.classList.add('fade-in');
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('fade-in');
                    }
                });
                
                // Actualizar contador
                const contadorElement = document.getElementById('contadorResultados');
                const numeroElement = document.getElementById('numeroResultados');
                
                numeroElement.textContent = contador;
                contadorElement.classList.remove('hidden');
                
                // Ocultar indicador de carga
                document.getElementById('loadingIndicator').classList.add('hidden');
                document.getElementById('contenedorVacantes').classList.remove('opacity-50');
                
                // Mostrar mensaje si no hay resultados
                if (contador === 0) {
                    mostrarSinResultados();
                }
            }, 500);
        }
        
        function limpiarFiltros() {
            document.getElementById('filtroContrato').value = '';
            document.getElementById('filtroModalidad').value = '';
            document.getElementById('filtroExperiencia').value = '';
            
            aplicarFiltros();
            document.getElementById('contadorResultados').classList.add('hidden');
        }
        
        function mostrarSinResultados() {
            // Podrías mostrar un toast o mensaje aquí
            console.log('No se encontraron vacantes con los filtros aplicados');
        }
        
        function mostrarDetalles(vacanteId) {
            const detalles = document.getElementById(`detalles-${vacanteId}`);
            const estaVisible = !detalles.classList.contains('hidden');
            
            // Cerrar todos los demás detalles
            document.querySelectorAll('[id^="detalles-"]').forEach(det => {
                if (det.id !== `detalles-${vacanteId}`) {
                    det.classList.add('hidden');
                }
            });
            
            // Alternar el actual
            detalles.classList.toggle('hidden');
            
            // Scroll suave si se está abriendo
            if (!estaVisible) {
                detalles.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }
        }
        
        // ✅ MEJORAS DE ACCESIBILIDAD
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('[id^="detalles-"]').forEach(det => {
                    det.classList.add('hidden');
                });
            }
        });
        
        // ✅ FILTRADO AUTOMÁTICO AL CAMBIAR SELECTS
        document.getElementById('filtroContrato').addEventListener('change', aplicarFiltros);
        document.getElementById('filtroModalidad').addEventListener('change', aplicarFiltros);
        document.getElementById('filtroExperiencia').addEventListener('change', aplicarFiltros);
    </script>
</body>
</html>