<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Nueva Vacante - ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        
        .form-input {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: #1B396A;
            box-shadow: 0 0 0 3px rgba(27, 57, 106, 0.1);
        }
        
        .form-check-input:checked {
            background-color: #1B396A;
            border-color: #1B396A;
        }
        
        .alert-itszn {
            background-color: rgba(27, 57, 106, 0.1);
            border-left: 4px solid #1B396A;
            border-radius: 0.5rem;
        }
        
        .card-header-gradient {
            background: linear-gradient(135deg, #1B396A 0%, #2D4F8A 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
   <!-- ENCABEZADO INSTITUCIONAL PARA CREAR VACANTE -->
<header class="header-institucional shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <span class="text-xl">💼</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Publicar Nueva Vacante</h1>
                    <p class="text-white/80">Sistema Integral de Servicio Social - ITSZN</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <span class="text-white/90 text-sm">Administrador</span>
                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                    <span>👤</span>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Breadcrumb FUERA del header (para página CREATE) -->
<div class="container mx-auto px-4 py-4">
    <nav class="flex mb-6 fade-in" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium texto-azul-itszn hover:text-blue-700">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Publicar Nueva
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start lg:items-center mb-6 fade-in">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold texto-azul-itszn mb-2">
                    <i class="fas fa-briefcase me-2"></i>Publicar Nueva Vacante
                </h1>
                <p class="text-gray-600">Publica una vacante para cualquier empresa del sistema ITSZN</p>
            </div>
            <div>
                <a href="{{ route('admin.vacantes.todas') }}" 
                   class="btn-itszn-secundario flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver a la lista</span>
                </a>
            </div>
        </div>

        <!-- Card del formulario -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden fade-in">
            <div class="card-header-gradient text-white py-4 px-6">
                <h5 class="text-lg font-bold">
                    <i class="fas fa-file-alt me-2"></i>Información de la Vacante
                </h5>
            </div>
            
            <div class="p-6">
                <!-- CORREGIDO: Usar route() helper -->
                <form method="POST" action="{{ route('admin.vacantes.guardar') }}" id="vacanteForm">
                    @csrf

                    <!-- Empresa -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 pb-2 border-b">
                            <i class="fas fa-building me-2"></i>Empresa
                        </h6>
                        
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                            <div>
                                <label for="empresa_id" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-industry me-2"></i>Seleccionar Empresa *
                                </label>
                                <select name="empresa_id" id="empresa_id" 
                                        class="form-input"
                                        required>
                                    <option value="">Selecciona una empresa</option>
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id }}">
                                            {{ $empresa->nombre_empresa }} 
                                            @if($empresa->estado == 'aprobada')
                                                <span class="text-green-600">✅</span>
                                            @else
                                                <span class="text-yellow-600">⏳</span>
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                                <p class="text-gray-500 text-sm mt-2">Solo empresas aprobadas pueden recibir postulaciones</p>
                            </div>
                            
                            <div>
                                <div id="empresa-info" class="info-card bg-gray-50 rounded-lg p-4" style="display: none;">
                                    <h6 class="font-semibold texto-azul-itszn mb-2">📋 Información de la empresa:</h6>
                                    <p class="mb-1" id="empresa-nombre"></p>
                                    <p class="mb-1" id="empresa-contacto"></p>
                                    <p class="mb-0" id="empresa-estado"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Información Básica de la Vacante -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 pb-2 border-b">
                            <i class="fas fa-info-circle me-2"></i>Información Básica
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Título -->
                            <div>
                                <label for="titulo" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-heading me-2"></i>Título de la Vacante *
                                </label>
                                <input type="text" 
                                       class="form-input" 
                                       id="titulo" 
                                       name="titulo" 
                                       value="{{ old('titulo') }}"
                                       required
                                       placeholder="Ej: Desarrollador Web Frontend">
                                @error('titulo')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tipo de Contrato -->
                            <div>
                                <label for="tipo_contrato" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-file-contract me-2"></i>Tipo de Contrato *
                                </label>
                               <select name="tipo_contrato" class="form-input" required>
    <option value="">Selecciona el tipo</option>
    <option value="tiempo_completo">Tiempo Completo</option>
    <option value="medio_tiempo">Medio Tiempo</option>
    <option value="practicas">Prácticas</option>
    <option value="servicio_social">Servicio Social</option>
</select>
                                @error('tipo_contrato')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Modalidad -->
                            <div>
                                <label for="modalidad" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-laptop-house me-2"></i>Modalidad *
                                </label>
                                <select name="modalidad" 
                                        class="form-input"
                                        required>
                                    <option value="">Selecciona modalidad</option>
                                    <option value="presencial" {{ old('modalidad') == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="remoto" {{ old('modalidad') == 'remoto' ? 'selected' : '' }}>Remoto</option>
                                    <option value="hibrido" {{ old('modalidad') == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                                </select>
                                @error('modalidad')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ubicación -->
                            <div>
                                <label for="ubicacion" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>Ubicación *
                                </label>
                                <input type="text" 
                                       class="form-input" 
                                       id="ubicacion" 
                                       name="ubicacion" 
                                       value="{{ old('ubicacion') }}"
                                       required
                                       placeholder="Ej: Ciudad, Estado o 'Remoto'">
                                @error('ubicacion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Salario -->
                            <div>
                                <label for="salario" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-money-bill-wave me-2"></i>Salario (Opcional)
                                </label>
                                <input type="text" 
                                       class="form-input" 
                                       id="salario" 
                                       name="salario" 
                                       value="{{ old('salario') }}"
                                       placeholder="Ej: $15,000 - $20,000 MXN">
                                @error('salario')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Número de Vacantes -->
                            <div>
                                <label for="numero_vacantes" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-user-plus me-2"></i>Número de Vacantes *
                                </label>
                                <input type="number" 
                                       class="form-input" 
                                       id="numero_vacantes" 
                                       name="numero_vacantes" 
                                       value="{{ old('numero_vacantes', 1) }}" 
                                       required
                                       min="1"
                                       max="50">
                                @error('numero_vacantes')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fecha Límite -->
                            <div>
                                <label for="fecha_limite" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-calendar-times me-2"></i>Fecha Límite *
                                </label>
                                <input type="date" 
                                       class="form-input" 
                                       id="fecha_limite" 
                                       name="fecha_limite" 
                                       value="{{ old('fecha_limite') }}" 
                                       required
                                       min="{{ date('Y-m-d') }}">
                                @error('fecha_limite')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm mt-2">Fecha límite para postularse</p>
                            </div>
                        </div>
                    </div>

                    <!-- Descripción y Requisitos -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 pb-2 border-b">
                            <i class="fas fa-clipboard-list me-2"></i>Descripción y Requisitos
                        </h6>
                        
                        <div class="space-y-6">
                            <!-- Descripción -->
                            <div>
                                <label for="descripcion" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-align-left me-2"></i>Descripción del Puesto *
                                </label>
                                <textarea class="form-input" 
                                          id="descripcion" 
                                          name="descripcion" 
                                          rows="4"
                                          required
                                          placeholder="Describe las responsabilidades y funciones del puesto...">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-gray-500 text-sm">Describe detalladamente el puesto</p>
                                    <p id="descripcion-counter" class="text-gray-500 text-sm">Caracteres: 0</p>
                                </div>
                            </div>

                            <!-- Requisitos -->
                            <div>
                                <label for="requisitos" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-list-check me-2"></i>Requisitos *
                                </label>
                                <textarea class="form-input" 
                                          id="requisitos" 
                                          name="requisitos" 
                                          rows="4"
                                          required
                                          placeholder="Lista los requisitos (estudios, experiencia, habilidades)...">{{ old('requisitos') }}</textarea>
                                @error('requisitos')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <div class="flex justify-between items-center mt-2">
                                    <p class="text-gray-500 text-sm">Separa cada requisito con un salto de línea</p>
                                    <p id="requisitos-counter" class="text-gray-500 text-sm">Caracteres: 0</p>
                                </div>
                            </div>

                            <!-- Beneficios (Opcional) -->
                            <div>
                                <label for="beneficios" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-gift me-2"></i>Beneficios (Opcional)
                                </label>
                                <textarea class="form-input" 
                                          id="beneficios" 
                                          name="beneficios" 
                                          rows="3"
                                          placeholder="Beneficios adicionales (seguro médico, bonos, etc)...">{{ old('beneficios') }}</textarea>
                                @error('beneficios')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Configuración -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 pb-2 border-b">
                            <i class="fas fa-cogs me-2"></i>Configuración
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Estado -->
                            <div class="info-card bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <input class="form-check-input h-5 w-5" 
                                           type="checkbox" 
                                           id="esta_aprobada" 
                                           name="esta_aprobada" 
                                           value="1" 
                                           checked>
                                    <label class="font-semibold flex items-center gap-2" for="esta_aprobada">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                        Aprobar vacante automáticamente
                                    </label>
                                </div>
                                <p class="text-gray-600 text-sm">
                                    La vacante se publicará inmediatamente sin necesidad de revisión.
                                </p>
                            </div>

                            <!-- Urgente -->
                            <div class="info-card bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <input class="form-check-input h-5 w-5" 
                                           type="checkbox" 
                                           id="es_urgente" 
                                           name="es_urgente" 
                                           value="1">
                                    <label class="font-semibold flex items-center gap-2" for="es_urgente">
                                        <i class="fas fa-exclamation-circle text-yellow-600"></i>
                                        Marcar como urgente
                                    </label>
                                </div>
                                <p class="text-gray-600 text-sm">
                                    Aparecerá destacada en la lista de vacantes.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t">
                        <div>
                            <!-- CORREGIDO: Usar route() helper -->
                            <a href="{{ route('admin.vacantes.todas') }}" 
                               class="btn-itszn-secundario flex items-center gap-2">
                                <i class="fas fa-times"></i>
                                <span>Cancelar</span>
                            </a>
                        </div>
                        <div class="flex gap-3">
                            <button type="reset" 
                                    class="btn-itszn-secundario flex items-center gap-2">
                                <i class="fas fa-redo"></i>
                                <span>Limpiar Formulario</span>
                            </button>
                            <button type="submit" 
                                    class="btn-itszn flex items-center gap-2 px-6">
                                <i class="fas fa-paper-plane"></i>
                                <span>Publicar Vacante</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="alert-itszn rounded-lg p-6 mt-6 fade-in">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                    <i class="fas fa-info-circle text-xl texto-azul-itszn"></i>
                </div>
                <div>
                    <h6 class="texto-azul-itszn font-semibold text-lg mb-3">📋 Información Importante</h6>
                    <ul class="space-y-2 text-gray-700">
                        <li class="flex items-center gap-2">
                            <i class="fas fa-asterisk text-xs texto-azul-itszn"></i>
                            <span>Los campos marcados con * son obligatorios</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-bolt text-yellow-600"></i>
                            <span>Las vacantes publicadas por admin se aprueban automáticamente</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-bell text-blue-600"></i>
                            <span>La empresa recibirá una notificación de la nueva vacante</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span>Revisa que la empresa seleccionada esté aprobada ✅</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-calendar-alt text-red-600"></i>
                            <span>La fecha límite no puede ser anterior a hoy</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos de empresas (se cargarán dinámicamente según lo seleccionado)
        const selectEmpresa = document.getElementById('empresa_id');
        const empresaInfo = document.getElementById('empresa-info');
        const empresaNombre = document.getElementById('empresa-nombre');
        const empresaContacto = document.getElementById('empresa-contacto');
        const empresaEstado = document.getElementById('empresa-estado');
        const submitBtn = document.querySelector('button[type="submit"]');
        
        // Contadores de caracteres
        const descripcion = document.getElementById('descripcion');
        const requisitos = document.getElementById('requisitos');
        const descripcionCounter = document.getElementById('descripcion-counter');
        const requisitosCounter = document.getElementById('requisitos-counter');
        
        // Inicializar contadores
        updateCounter(descripcion, descripcionCounter);
        updateCounter(requisitos, requisitosCounter);
        
        // Mostrar información de la empresa seleccionada
        selectEmpresa.addEventListener('change', function() {
            const empresaId = this.value;
            const selectedOption = this.options[this.selectedIndex];
            const empresaText = selectedOption.textContent;
            
            if (empresaId) {
                // Extraer información del texto de la opción
                const nombre = empresaText.split('✅')[0].split('⏳')[0].trim();
                const estaAprobada = empresaText.includes('✅');
                
                empresaNombre.textContent = `🏢 ${nombre}`;
                empresaContacto.textContent = `📧 Contacto: Información disponible después de seleccionar`;
                empresaEstado.textContent = `📊 Estado: ${estaAprobada ? '✅ Aprobada' : '⏳ Pendiente'}`;
                empresaEstado.className = estaAprobada ? 'text-green-600 font-medium' : 'text-yellow-600 font-medium';
                empresaInfo.style.display = 'block';
                
                // Deshabilitar formulario si empresa no está aprobada
                if (!estaAprobada) {
                    submitBtn.disabled = true;
                    submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
                    
                    // Mostrar advertencia
                    if (!document.getElementById('empresa-warning')) {
                        const warning = document.createElement('div');
                        warning.id = 'empresa-warning';
                        warning.className = 'bg-yellow-50 border border-yellow-200 rounded-lg p-3 mt-3';
                        warning.innerHTML = `
                            <div class="flex items-center gap-2">
                                <i class="fas fa-exclamation-triangle text-yellow-600"></i>
                                <p class="text-yellow-800 text-sm font-medium">
                                    Esta empresa está pendiente de aprobación. Solo empresas aprobadas pueden recibir postulaciones.
                                </p>
                            </div>
                        `;
                        empresaInfo.appendChild(warning);
                    }
                } else {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
                    
                    // Quitar advertencia si existe
                    const warning = document.getElementById('empresa-warning');
                    if (warning) warning.remove();
                }
            } else {
                empresaInfo.style.display = 'none';
                submitBtn.disabled = false;
                submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }
        });
        
        // Configurar fecha mínima (hoy)
        const fechaLimite = document.getElementById('fecha_limite');
        const today = new Date().toISOString().split('T')[0];
        fechaLimite.min = today;
        
        // Si no hay valor, establecer 30 días en el futuro
        if (!fechaLimite.value) {
            const futureDate = new Date();
            futureDate.setDate(futureDate.getDate() + 30);
            fechaLimite.value = futureDate.toISOString().split('T')[0];
        }
        
        // Actualizar contadores
        descripcion.addEventListener('input', () => updateCounter(descripcion, descripcionCounter));
        requisitos.addEventListener('input', () => updateCounter(requisitos, requisitosCounter));
        
        function updateCounter(textarea, counterElement) {
            counterElement.textContent = `Caracteres: ${textarea.value.length}`;
            
            // Cambiar color según longitud
            if (textarea.value.length < 50) {
                counterElement.className = 'text-red-500 text-sm font-medium';
            } else if (textarea.value.length < 100) {
                counterElement.className = 'text-yellow-500 text-sm font-medium';
            } else {
                counterElement.className = 'text-green-500 text-sm font-medium';
            }
        }
        
        // Validación del formulario
        document.getElementById('vacanteForm').addEventListener('submit', function(e) {
            // Validación básica
            if (!selectEmpresa.value) {
                e.preventDefault();
                alert('Por favor selecciona una empresa');
                return;
            }
            
            // Validar que empresa esté aprobada
            const selectedOption = selectEmpresa.options[selectEmpresa.selectedIndex];
            const empresaText = selectedOption.textContent;
            const estaAprobada = empresaText.includes('✅');
            
            if (!estaAprobada) {
                e.preventDefault();
                alert('Solo puedes publicar vacantes para empresas aprobadas');
                return;
            }
            
            // Validar fecha
            if (fechaLimite.value < today) {
                e.preventDefault();
                alert('La fecha límite no puede ser anterior a hoy');
                return;
            }
        });
    });
    </script>
</body>
</html>