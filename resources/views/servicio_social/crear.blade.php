<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Servicio Social - Bolsa Trabajo ITSZN</title>
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
        
        .form-input {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem;
            transition: all 0.3s ease;
            width: 100%;
        }
        .form-input:focus {
            border-color: #1B396A;
            box-shadow: 0 0 0 3px rgba(27, 57, 106, 0.1);
            outline: none;
        }
        
        .form-input.error {
            border-color: #dc2626;
            box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
        }
        
        .progress-bar {
            height: 4px;
            background: #e2e8f0;
            border-radius: 2px;
            overflow: hidden;
            margin: 1rem 0;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1B396A, #2D4F8A);
            transition: width 0.5s ease;
        }
        
        .step-indicator {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid #e2e8f0;
        }
        
        .step-indicator.active {
            background-color: #1B396A;
            color: white;
            border-color: #1B396A;
        }
        
        .step-indicator.completed {
            background-color: #10b981;
            color: white;
            border-color: #10b981;
        }
        
        .character-count {
            font-size: 0.75rem;
            color: #6b7280;
        }
        
        .character-count.warning {
            color: #f59e0b;
        }
        
        .character-count.error {
            color: #dc2626;
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
        
        .timeline {
            position: relative;
            padding-left: 2rem;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 0;
            bottom: 0;
            width: 2px;
            background: #e2e8f0;
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .timeline-item::before {
            content: '';
            position: absolute;
            left: -2rem;
            top: 0.25rem;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #1B396A;
            border: 2px solid white;
            box-shadow: 0 0 0 2px #1B396A;
        }
        
        .info-card {
            border-left: 4px solid #1B396A;
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateX(4px);
        }
        
        .duration-preview {
            background: linear-gradient(135deg, #1B396A, #2D4F8A);
            color: white;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">🎓 Solicitar Servicio Social</h1>
                    <p>Completa la información para tu servicio social</p>
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
        <div class="max-w-4xl mx-auto">
            <!-- PROGRESO DEL FORMULARIO -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold texto-azul-itszn">📊 Progreso de la solicitud</h2>
                    <span id="progressPercentage" class="text-sm texto-azul-itszn font-medium">0%</span>
                </div>
                <div class="progress-bar">
                    <div id="progressFill" class="progress-fill" style="width: 0%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Información académica</span>
                    <span>Periodo y supervisor</span>
                    <span>Proyecto</span>
                    <span>Revisión</span>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-lg mb-6 fade-in">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="text-lg">⚠️</span>
                        <h3 class="font-semibold">Errores en el formulario</h3>
                    </div>
                    <ul class="list-disc list-inside text-sm space-y-1">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- INFORMACIÓN DE LA POSTULACIÓN MEJORADA -->
            <div class="info-card bg-white rounded-lg shadow-md p-6 mb-6 fade-in">
                <div class="flex items-start justify-between">
                    <div class="flex-1">
                        <h2 class="text-xl font-semibold texto-azul-itszn mb-4">✅ Postulación Aceptada</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <p class="flex items-center gap-2">
                                    <span class="text-lg">🏢</span>
                                    <span><strong class="texto-azul-itszn">Empresa:</strong> {{ $postulacion->vacante->empresa->nombre_empresa }}</span>
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="text-lg">💼</span>
                                    <span><strong class="texto-azul-itszn">Puesto:</strong> {{ $postulacion->vacante->titulo }}</span>
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="text-lg">📍</span>
                                    <span><strong class="texto-azul-itszn">Ubicación:</strong> {{ $postulacion->vacante->ubicacion }}</span>
                                </p>
                            </div>
                            <div class="space-y-3">
                                <p class="flex items-center gap-2">
                                    <span class="text-lg">📅</span>
                                    <span><strong class="texto-azul-itszn">Aceptación:</strong> {{ $postulacion->updated_at->format('d/m/Y') }}</span>
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="text-lg">🎓</span>
                                    <span><strong class="texto-azul-itszn">Carrera:</strong> {{ $postulacion->carrera }}</span>
                                </p>
                                <p class="flex items-center gap-2">
                                    <span class="text-lg">📚</span>
                                    <span><strong class="texto-azul-itszn">Semestre:</strong> {{ $postulacion->semestre }}°</span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 min-w-[140px] text-center border border-green-200">
                        <div class="text-2xl font-bold text-green-600">✅</div>
                        <div class="text-sm text-green-700 font-medium mt-1">Postulación<br>Aceptada</div>
                    </div>
                </div>
            </div>

            <form id="servicioSocialForm" action="{{ route('servicio-social.store', $postulacion->id) }}" method="POST" class="bg-white rounded-lg shadow-md p-6 fade-in">
                @csrf

                <!-- PASO 1: INFORMACIÓN ACADÉMICA -->
                <div class="mb-8" id="step1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="step-indicator active">1</div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">📚 Información Académica</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🎓 Carrera *
                            </label>
                            <input type="text" name="carrera" 
                                   value="{{ old('carrera', Auth::user()->carrera ?? '') }}"
                                   class="form-input"
                                   placeholder="Ingeniería en Sistemas Computacionales"
                                   required
                                   data-validate="true">
                        </div>
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📚 Semestre *
                            </label>
                            <input type="number" name="semestre" 
                                   value="{{ old('semestre', Auth::user()->semestre ?? '') }}"
                                   class="form-input"
                                   placeholder="8"
                                   min="1" max="13"
                                   required
                                   data-validate="true">
                            <div class="text-xs text-gray-500 mt-1">Ingresa 13 si eres egresado</div>
                        </div>
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🔢 Número de Control *
                            </label>
                            <input type="text" name="numero_control" 
                                   value="{{ old('numero_control', Auth::user()->numero_control ?? '') }}"
                                   class="form-input"
                                   placeholder="21010000"
                                   required
                                   data-validate="true"
                                   pattern="[0-9]{8}"
                                   maxlength="8">
                            <div class="text-xs text-gray-500 mt-1">8 dígitos</div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: PERIODO Y SUPERVISOR -->
                <div class="mb-8" id="step2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="step-indicator">2</div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">📅 Periodo y Supervisor</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🗓️ Fecha de Inicio *
                            </label>
                            <input type="date" name="fecha_inicio" 
                                   value="{{ old('fecha_inicio') }}"
                                   class="form-input"
                                   id="fecha_inicio"
                                   required
                                   data-validate="true">
                        </div>
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🎯 Fecha de Finalización Estimada *
                            </label>
                            <input type="date" name="fecha_fin_estimada" 
                                   value="{{ old('fecha_fin_estimada') }}"
                                   class="form-input"
                                   id="fecha_fin_estimada"
                                   required
                                   data-validate="true">
                        </div>
                    </div>

                    <!-- PREVISUALIZACIÓN DE DURACIÓN -->
                    <div id="durationPreview" class="duration-preview mb-6 hidden fade-in">
                        <div class="text-sm">📅 Duración estimada del servicio social:</div>
                        <div class="text-lg font-bold mt-1" id="durationText"></div>
                        <div class="text-xs opacity-90 mt-1" id="hoursEstimate"></div>
                    </div>

                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4">👨‍💼 Supervisor en la Empresa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                👤 Nombre del Supervisor
                            </label>
                            <input type="text" name="supervisor_empresa" 
                                   value="{{ old('supervisor_empresa') }}"
                                   class="form-input"
                                   placeholder="Ing. Juan Pérez López">
                        </div>
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📧 Email del Supervisor
                            </label>
                            <input type="email" name="email_supervisor" 
                                   value="{{ old('email_supervisor') }}"
                                   class="form-input"
                                   placeholder="supervisor@empresa.com">
                        </div>
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📞 Teléfono
                            </label>
                            <input type="text" name="telefono_supervisor" 
                                   value="{{ old('telefono_supervisor') }}"
                                   class="form-input"
                                   placeholder="+52 123 456 7890">
                        </div>
                    </div>
                </div>

                <!-- PASO 3: INFORMACIÓN DEL PROYECTO -->
                <div class="mb-8" id="step3">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="step-indicator">3</div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">🚀 Información del Proyecto</h2>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🎯 Nombre del Proyecto *
                            </label>
                            <input type="text" name="nombre_proyecto" 
                                   value="{{ old('nombre_proyecto') }}"
                                   class="form-input"
                                   placeholder="Ej: Desarrollo de Sistema de Gestión de Inventarios"
                                   required
                                   data-validate="true">
                            <div class="text-xs text-gray-500 mt-1">Describe claramente el objetivo del proyecto</div>
                        </div>
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                ⚡ Actividades Principales *
                            </label>
                            <textarea name="actividades_principales" 
                                      rows="6"
                                      class="form-input"
                                      placeholder="Describe las actividades principales que realizarás durante tu servicio social..."
                                      required
                                      data-validate="true"
                                      maxlength="1000"
                                      oninput="updateCharacterCount(this, 'actividades-count')">{{ old('actividades_principales') }}</textarea>
                            <div class="flex justify-between">
                                <p class="text-xs text-gray-500">Describe detalladamente las actividades, tareas y responsabilidades</p>
                                <span id="actividades-count" class="character-count">0/1000</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PROCESO DE APROBACIÓN MEJORADO -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl">📋</span>
                        <h3 class="text-lg font-semibold texto-azul-itszn">Proceso de Aprobación</h3>
                    </div>
                    
                    <div class="timeline">
                        <div class="timeline-item">
                            <h4 class="font-semibold texto-azul-itszn">1. 📤 Solicitud enviada</h4>
                            <p class="text-sm text-gray-600 mt-1">Esperarás la aprobación de la empresa</p>
                        </div>
                        <div class="timeline-item">
                            <h4 class="font-semibold texto-azul-itszn">2. 🏢 Empresa acepta</h4>
                            <p class="text-sm text-gray-600 mt-1">La empresa confirmará que acepta como servicio social</p>
                        </div>
                        <div class="timeline-item">
                            <h4 class="font-semibold texto-azul-itszn">3. ✅ Jefe SS aprueba</h4>
                            <p class="text-sm text-gray-600 mt-1">El coordinador validará los requisitos académicos</p>
                        </div>
                        <div class="timeline-item">
                            <h4 class="font-semibold texto-azul-itszn">4. ⏳ En proceso</h4>
                            <p class="text-sm text-gray-600 mt-1">¡Podrás comenzar a registrar tus horas!</p>
                        </div>
                    </div>
                </div>

                <!-- INFORMACIÓN ADICIONAL MEJORADA -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4">ℹ️ Información Importante</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-3">
                            <div class="flex items-start gap-2">
                                <span class="text-lg">📊</span>
                                <div>
                                    <h4 class="font-medium texto-azul-itszn">Horas Requeridas</h4>
                                    <p class="text-gray-600">Se requieren <strong>480 horas</strong> de actividades relacionadas con tu carrera.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-lg">⏰</span>
                                <div>
                                    <h4 class="font-medium texto-azul-itszn">Registro de Horas</h4>
                                    <p class="text-gray-600">Podrás registrar horas diarias con actividades y evidencias.</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start gap-2">
                                <span class="text-lg">✅</span>
                                <div>
                                    <h4 class="font-medium texto-azul-itszn">Requisitos</h4>
                                    <p class="text-gray-600">50% de créditos aprobados y estar inscrito regularmente.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-2">
                                <span class="text-lg">📞</span>
                                <div>
                                    <h4 class="font-medium texto-azul-itszn">Contacto</h4>
                                    <p class="text-gray-600"><strong>servicio.social@itszn.edu.mx</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- BOTONES MEJORADOS -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        <span id="formStatus">Completa todos los campos requeridos</span>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('alumno.mis-postulaciones') }}" 
                           class="btn-itszn-secundario">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="btn-itszn pulse-soft flex items-center gap-2">
                            <span>🚀 Enviar Solicitud de SS</span>
                            <span id="submitSpinner" class="hidden animate-spin">⏳</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        // ✅ SISTEMA DE PROGRESO
        function updateProgress() {
            const requiredFields = document.querySelectorAll('[data-validate="true"]');
            const filledFields = Array.from(requiredFields).filter(field => {
                return field.value.trim() !== '';
            });
            
            const progress = (filledFields.length / requiredFields.length) * 100;
            const progressFill = document.getElementById('progressFill');
            const progressPercentage = document.getElementById('progressPercentage');
            
            progressFill.style.width = `${progress}%`;
            progressPercentage.textContent = `${Math.round(progress)}%`;
            
            // Actualizar estado del formulario
            const formStatus = document.getElementById('formStatus');
            if (progress === 100) {
                formStatus.textContent = '✅ Formulario completo - Listo para enviar';
                formStatus.className = 'text-sm text-green-600 font-medium';
            } else {
                formStatus.textContent = `📝 Completa los campos requeridos (${Math.round(progress)}%)`;
                formStatus.className = 'text-sm text-orange-600';
            }
        }

        // ✅ CONTADOR DE CARACTERES
        function updateCharacterCount(textarea, counterId) {
            const count = textarea.value.length;
            const maxLength = parseInt(textarea.getAttribute('maxlength'));
            const counter = document.getElementById(counterId);
            
            counter.textContent = `${count}/${maxLength}`;
            
            // Cambiar color según el uso
            const percentage = (count / maxLength) * 100;
            counter.className = 'character-count';
            
            if (percentage > 90) {
                counter.classList.add('error');
            } else if (percentage > 75) {
                counter.classList.add('warning');
            }
            
            updateProgress();
        }

        // ✅ CÁLCULO DE DURACIÓN
        function calculateDuration() {
            const startDate = document.getElementById('fecha_inicio').value;
            const endDate = document.getElementById('fecha_fin_estimada').value;
            const preview = document.getElementById('durationPreview');
            const durationText = document.getElementById('durationText');
            const hoursEstimate = document.getElementById('hoursEstimate');
            
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);
                
                if (end > start) {
                    const diffTime = Math.abs(end - start);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                    const diffMonths = Math.round(diffDays / 30);
                    
                    durationText.textContent = `${diffDays} días (${diffMonths} meses)`;
                    hoursEstimate.textContent = `≈ ${Math.round(diffDays * 6)} horas estimadas (6h/día)`;
                    
                    preview.classList.remove('hidden');
                    preview.classList.add('fade-in');
                }
            } else {
                preview.classList.add('hidden');
            }
        }

        // ✅ VALIDACIONES EN TIEMPO REAL
        function setupRealTimeValidation() {
            const inputs = document.querySelectorAll('input, select, textarea');
            
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    validateField(this);
                });
                
                input.addEventListener('input', function() {
                    if (this.classList.contains('error')) {
                        validateField(this);
                    }
                    updateProgress();
                    
                    // Calcular duración cuando cambien las fechas
                    if (this.name === 'fecha_inicio' || this.name === 'fecha_fin_estimada') {
                        calculateDuration();
                    }
                });
            });
        }

        function validateField(field) {
            const value = field.value.trim();
            
            // Limpiar estado anterior
            field.classList.remove('error');
            
            // Validaciones específicas
            if (field.hasAttribute('required') && !value) {
                field.classList.add('error');
                return false;
            }
            
            if (field.name === 'numero_control' && value && !/^\d{8}$/.test(value)) {
                field.classList.add('error');
                return false;
            }
            
            if (field.name === 'email_supervisor' && value && !isValidEmail(value)) {
                field.classList.add('error');
                return false;
            }
            
            if (field.name === 'semestre' && value) {
                const semestre = parseInt(value);
                if (semestre < 1 || semestre > 13) {
                    field.classList.add('error');
                    return false;
                }
            }
            
            // Validación de fechas
            if (field.name === 'fecha_inicio' && value) {
                const startDate = new Date(value);
                const today = new Date();
                today.setHours(0, 0, 0, 0);
                
                if (startDate < today) {
                    field.classList.add('error');
                    return false;
                }
            }
            
            if (field.name === 'fecha_fin_estimada' && value && document.getElementById('fecha_inicio').value) {
                const startDate = new Date(document.getElementById('fecha_inicio').value);
                const endDate = new Date(value);
                
                if (endDate <= startDate) {
                    field.classList.add('error');
                    return false;
                }
            }
            
            return true;
        }

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        // ✅ CONFIGURACIÓN DE FECHAS
        function setupDates() {
            const fechaInicio = document.getElementById('fecha_inicio');
            const fechaFin = document.getElementById('fecha_fin_estimada');
            
            // Establecer fecha mínima como hoy
            const hoy = new Date().toISOString().split('T')[0];
            fechaInicio.min = hoy;
            
            // Establecer fecha máxima como 1 año desde hoy
            const unAnioDespues = new Date();
            unAnioDespues.setFullYear(unAnioDespues.getFullYear() + 1);
            fechaFin.max = unAnioDespues.toISOString().split('T')[0];
            
            // Actualizar fecha mínima de fin cuando cambie la fecha de inicio
            fechaInicio.addEventListener('change', function() {
                fechaFin.min = this.value;
                calculateDuration();
            });
            
            fechaFin.addEventListener('change', calculateDuration);
        }

        // ✅ ENVIO DEL FORMULARIO
        document.getElementById('servicioSocialForm').addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('button[type="submit"]');
            const spinner = document.getElementById('submitSpinner');
            
            // Mostrar spinner
            submitBtn.disabled = true;
            spinner.classList.remove('hidden');
            
            // Validación final
            let isValid = true;
            const requiredFields = this.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!validateField(field)) {
                    isValid = false;
                    field.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    field.focus();
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                submitBtn.disabled = false;
                spinner.classList.add('hidden');
            }
        });

        // ✅ INICIALIZACIÓN
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar fechas
            setupDates();
            
            // Configurar validaciones
            setupRealTimeValidation();
            
            // Inicializar contadores de caracteres
            document.querySelectorAll('textarea[maxlength]').forEach(textarea => {
                const counterId = textarea.getAttribute('oninput').match(/'([^']+)'/)[1];
                updateCharacterCount(textarea, counterId);
            });
            
            // Actualizar progreso inicial
            updateProgress();
        });
    </script>
</body>
</html>