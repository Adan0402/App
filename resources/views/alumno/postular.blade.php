<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postular a Vacante - Bolsa Trabajo ITSZN</title>
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
        }
        
        .step-indicator.active {
            background-color: #1B396A;
            color: white;
        }
        
        .step-indicator.completed {
            background-color: #10b981;
            color: white;
        }
        
        .file-upload-area {
            border: 2px dashed #d1d5db;
            border-radius: 0.5rem;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload-area:hover {
            border-color: #1B396A;
            background-color: #f8fafc;
        }
        
        .file-upload-area.dragover {
            border-color: #1B396A;
            background-color: #eff6ff;
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
        
        .shake {
            animation: shake 0.5s ease-in-out;
        }
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">📋 Postular a Vacante</h1>
                    <p>Completa tu información para aplicar</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('alumno.vacantes') }}" class="btn-itszn-secundario">
                        ← Volver a Vacantes
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
                    <h2 class="text-lg font-semibold texto-azul-itszn">📊 Progreso de la postulación</h2>
                    <span id="progressPercentage" class="text-sm texto-azul-itszn font-medium">0%</span>
                </div>
                <div class="progress-bar mb-2">
                    <div id="progressFill" class="progress-fill" style="width: 0%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-600">
                    <span>Información personal</span>
                    <span>Documentos</span>
                    <span>Revisión</span>
                </div>
            </div>

            <!-- INFORMACIÓN DE LA VACANTE MEJORADA -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6 border-l-4 borde-azul-itszn fade-in">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-xl font-semibold texto-azul-itszn mb-3">🎯 Vacante Seleccionada</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="space-y-2">
                                <p class="flex items-center gap-2"><span class="font-semibold texto-azul-itszn">💼 Puesto:</span> {{ $vacante->titulo }}</p>
                                <p class="flex items-center gap-2"><span class="font-semibold texto-azul-itszn">🏢 Empresa:</span> {{ $vacante->empresa->nombre_empresa }}</p>
                                <p class="flex items-center gap-2"><span class="font-semibold texto-azul-itszn">📍 Ubicación:</span> {{ $vacante->ubicacion }}</p>
                            </div>
                            <div class="space-y-2">
                                <p class="flex items-center gap-2"><span class="font-semibold texto-azul-itszn">📄 Contrato:</span> {{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}</p>
                                <p class="flex items-center gap-2"><span class="font-semibold texto-azul-itszn">💻 Modalidad:</span> {{ ucfirst($vacante->modalidad) }}</p>
                                <p class="flex items-center gap-2"><span class="font-semibold texto-azul-itszn">⏰ Vence:</span> 
                                    <span class="{{ $vacante->fecha_limite->diffInDays(now()) <= 3 ? 'text-red-600 font-semibold' : 'text-gray-600' }}">
                                        {{ $vacante->fecha_limite->format('d/m/Y') }} ({{ $vacante->fecha_limite->diffForHumans() }})
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-blue-50 rounded-lg p-3 min-w-[120px] text-center">
                        <div class="text-2xl font-bold texto-azul-itszn">{{ $vacante->vacantes_disponibles }}</div>
                        <div class="text-sm text-gray-600">Vacantes</div>
                    </div>
                </div>
            </div>

            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-4 rounded-lg mb-6 fade-in shake">
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

            <form id="postulacionForm" action="{{ route('alumno.postular.store', $vacante) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-md p-6 fade-in">
                @csrf
                
                <!-- PASO 1: INFORMACIÓN PERSONAL -->
                <div class="mb-8" id="step1">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="step-indicator active">1</div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">👤 Información Personal</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nombre Completo -->
                        <div class="md:col-span-2">
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                👤 Nombre completo *
                            </label>
                            <input type="text" name="nombre_completo" value="{{ old('nombre_completo', $user->name) }}" 
                                   class="form-input"
                                   placeholder="Ingresa tu nombre completo"
                                   required
                                   data-validate="true">
                            <div class="text-xs text-gray-500 mt-1">Como aparece en documentos oficiales</div>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📧 Email institucional *
                            </label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                                   class="form-input"
                                   placeholder="tu.email@itszn.edu.mx"
                                   required
                                   data-validate="true">
                        </div>

                        <!-- Teléfono -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📞 Teléfono de contacto *
                            </label>
                            <input type="tel" name="telefono" value="{{ old('telefono') }}" 
                                   class="form-input"
                                   placeholder="+52 123 456 7890"
                                   required
                                   data-validate="true"
                                   pattern="[+]?[0-9\s\-]+"
                                   maxlength="15">
                            <div class="text-xs text-gray-500 mt-1">Incluye código de país</div>
                        </div>

                        <!-- Carrera -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🎓 Carrera que cursas *
                            </label>
                            <select name="carrera" 
                                    class="form-input"
                                    required
                                    data-validate="true">
                                <option value="">Selecciona tu carrera</option>
                                <option value="Ingeniería en Sistemas Computacionales" {{ old('carrera') == 'Ingeniería en Sistemas Computacionales' ? 'selected' : '' }}>Ingeniería en Sistemas Computacionales</option>
                                <option value="Ingeniería Industrial" {{ old('carrera') == 'Ingeniería Industrial' ? 'selected' : '' }}>Ingeniería Industrial</option>
                                <option value="Ingeniería en Gestión Empresarial" {{ old('carrera') == 'Ingeniería en Gestión Empresarial' ? 'selected' : '' }}>Ingeniería en Gestión Empresarial</option>
                                <option value="Licenciatura en Administración" {{ old('carrera') == 'Licenciatura en Administración' ? 'selected' : '' }}>Licenciatura en Administración</option>
                                <option value="Contador Público" {{ old('carrera') == 'Contador Público' ? 'selected' : '' }}>Contador Público</option>
                                <option value="Otra" {{ old('carrera') == 'Otra' ? 'selected' : '' }}>Otra carrera</option>
                            </select>
                        </div>

                        <!-- Semestre -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📚 Semestre actual *
                            </label>
                            <select name="semestre" 
                                    class="form-input"
                                    required
                                    data-validate="true">
                                <option value="">Selecciona semestre</option>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ old('semestre') == $i ? 'selected' : '' }}>{{ $i }}° Semestre</option>
                                @endfor
                                <option value="13" {{ old('semestre') == '13' ? 'selected' : '' }}>Egresado</option>
                            </select>
                        </div>

                        <!-- Edad -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                🎂 Edad *
                            </label>
                            <input type="number" name="edad" value="{{ old('edad') }}" min="16" max="80"
                                   class="form-input"
                                   placeholder="Tu edad"
                                   required
                                   data-validate="true">
                            <div class="text-xs text-gray-500 mt-1">Entre 16 y 80 años</div>
                        </div>
                    </div>
                </div>

                <!-- PASO 2: HABILIDADES Y EXPERIENCIA -->
                <div class="mb-8" id="step2">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="step-indicator">2</div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">💼 Habilidades y Experiencia</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 gap-6">
                        <!-- Habilidades -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                ⚡ Habilidades y competencias *
                            </label>
                            <textarea name="habilidades" rows="4"
                                      class="form-input"
                                      placeholder="Describe tus habilidades técnicas, idiomas, software que manejas, etc."
                                      required
                                      data-validate="true"
                                      maxlength="500"
                                      oninput="updateCharacterCount(this, 'habilidades-count')">{{ old('habilidades') }}</textarea>
                            <div class="flex justify-between">
                                <p class="text-xs text-gray-500">Ej: JavaScript, Python, Inglés intermedio, Office, etc.</p>
                                <span id="habilidades-count" class="character-count">0/500</span>
                            </div>
                        </div>

                        <!-- Experiencia -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📈 Experiencia laboral o proyectos
                                <span class="text-gray-500 font-normal">(opcional)</span>
                            </label>
                            <textarea name="experiencia" rows="3"
                                      class="form-input"
                                      placeholder="Describe tu experiencia laboral, proyectos académicos, voluntariado, etc."
                                      maxlength="300"
                                      oninput="updateCharacterCount(this, 'experiencia-count')">{{ old('experiencia') }}</textarea>
                            <div class="flex justify-between">
                                <p class="text-xs text-gray-500">Incluye logros y responsabilidades</p>
                                <span id="experiencia-count" class="character-count">0/300</span>
                            </div>
                        </div>

                        <!-- Motivación -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                💬 ¿Por qué te interesa esta vacante? *
                            </label>
                            <textarea name="motivacion" rows="4"
                                      class="form-input"
                                      placeholder="Explica por qué eres un buen candidato para este puesto, qué te motiva y cómo puedes contribuir..."
                                      required
                                      data-validate="true"
                                      maxlength="600"
                                      oninput="updateCharacterCount(this, 'motivacion-count')">{{ old('motivacion') }}</textarea>
                            <div class="flex justify-between">
                                <p class="text-xs text-gray-500">Sé específico y muestra tu entusiasmo</p>
                                <span id="motivacion-count" class="character-count">0/600</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PASO 3: DOCUMENTOS -->
                <div class="mb-8" id="step3">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="step-indicator">3</div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">📄 Documentos Requeridos</h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- CV -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                📋 Curriculum Vitae (PDF) *
                            </label>
                            <div class="file-upload-area" onclick="document.getElementById('cvFile').click()">
                                <input type="file" name="cv" id="cvFile" 
                                       class="hidden"
                                       accept=".pdf"
                                       required
                                       data-validate="true">
                                <div class="text-3xl mb-2">📄</div>
                                <p class="text-sm texto-azul-itszn font-medium">Haz clic para subir tu CV</p>
                                <p class="text-xs text-gray-500 mt-1">Formato PDF • Máximo 2MB</p>
                                <div id="cvFileName" class="text-xs text-green-600 mt-2 hidden"></div>
                            </div>
                        </div>

                        <!-- Solicitud -->
                        <div>
                            <label class="block texto-azul-itszn text-sm font-semibold mb-2">
                                ✉️ Carta de solicitud
                                <span class="text-gray-500 font-normal">(opcional)</span>
                            </label>
                            <div class="file-upload-area" onclick="document.getElementById('solicitudFile').click()">
                                <input type="file" name="solicitud" id="solicitudFile" 
                                       class="hidden"
                                       accept=".pdf,.jpg,.jpeg,.png">
                                <div class="text-3xl mb-2">📝</div>
                                <p class="text-sm texto-azul-itszn font-medium">Haz clic para subir carta</p>
                                <p class="text-xs text-gray-500 mt-1">PDF o imagen • Máximo 2MB</p>
                                <div id="solicitudFileName" class="text-xs text-green-600 mt-2 hidden"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFORMACIÓN IMPORTANTE MEJORADA -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-xl">💡</span>
                        <h3 class="font-semibold texto-azul-itszn">Información importante para tu postulación</h3>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div class="space-y-2">
                            <p class="flex items-center gap-2"><span class="text-green-600">✅</span> Tu postulación será revisada por la empresa</p>
                            <p class="flex items-center gap-2"><span class="text-blue-600">🔔</span> Recibirás notificaciones del estado</p>
                        </div>
                        <div class="space-y-2">
                            <p class="flex items-center gap-2"><span class="text-purple-600">📱</span> Puedes ver el estado en "Mis Postulaciones"</p>
                            <p class="flex items-center gap-2"><span class="text-orange-600">📋</span> Documentos deben ser legibles y actualizados</p>
                        </div>
                    </div>
                </div>

                <!-- BOTONES MEJORADOS -->
                <div class="flex justify-between items-center pt-6 border-t border-gray-200">
                    <div class="text-sm text-gray-600">
                        <span id="formStatus">Completa todos los campos requeridos</span>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('alumno.vacantes') }}" 
                           class="btn-itszn-secundario">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="btn-itszn pulse-soft flex items-center gap-2">
                            <span>📨 Enviar Postulación</span>
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
                if (field.type === 'file') {
                    return field.files.length > 0;
                }
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

        // ✅ MANEJO DE ARCHIVOS
        function setupFileUpload(inputId, displayId, area) {
            const input = document.getElementById(inputId);
            const display = document.getElementById(displayId);
            const uploadArea = area;
            
            input.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    
                    if (fileSizeMB > 2) {
                        showNotification('El archivo no puede ser mayor a 2MB', 'error');
                        this.value = '';
                        display.classList.add('hidden');
                    } else {
                        display.textContent = `✅ ${file.name} (${fileSizeMB} MB)`;
                        display.classList.remove('hidden');
                        uploadArea.style.borderColor = '#10b981';
                        uploadArea.style.backgroundColor = '#f0fdf4';
                    }
                }
                updateProgress();
            });
            
            // Drag and drop
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('dragover');
            });
            
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('dragover');
            });
            
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                input.files = e.dataTransfer.files;
                input.dispatchEvent(new Event('change'));
            });
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
            
            if (field.type === 'email' && value && !isValidEmail(value)) {
                field.classList.add('error');
                return false;
            }
            
            if (field.name === 'edad' && value) {
                const age = parseInt(value);
                if (age < 16 || age > 80) {
                    field.classList.add('error');
                    return false;
                }
            }
            
            if (field.type === 'tel' && value && !isValidPhone(value)) {
                field.classList.add('error');
                return false;
            }
            
            return true;
        }

        function isValidEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
        }

        function isValidPhone(phone) {
            const re = /^[+]?[0-9\s\-\(\)]{10,}$/;
            return re.test(phone);
        }

        // ✅ NOTIFICACIONES
        function showNotification(message, type = 'info') {
            // Podrías implementar un sistema de toasts aquí
            console.log(`${type.toUpperCase()}: ${message}`);
        }

        // ✅ ENVIO DEL FORMULARIO
        document.getElementById('postulacionForm').addEventListener('submit', function(e) {
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
                showNotification('Por favor, corrige los errores en el formulario', 'error');
            }
        });

        // ✅ INICIALIZACIÓN
        document.addEventListener('DOMContentLoaded', function() {
            // Configurar upload de archivos
            setupFileUpload('cvFile', 'cvFileName', document.querySelector('input[name="cv"]').closest('.file-upload-area'));
            setupFileUpload('solicitudFile', 'solicitudFileName', document.querySelector('input[name="solicitud"]').closest('.file-upload-area'));
            
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

        // ✅ MEJORA DE ACCESIBILIDAD
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Cerrar cualquier modal o tooltip abierto
            }
        });
    </script>
</body>
</html>