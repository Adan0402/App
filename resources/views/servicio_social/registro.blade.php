<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Horas - Servicio Social ITSZN</title>
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
        
        .progress-bar {
            height: 6px;
            background: #e2e8f0;
            border-radius: 3px;
            overflow: hidden;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #1B396A, #2D4F8A);
            transition: width 0.5s ease;
        }
        
        .hour-option {
            border: 2px solid #e2e8f0;
            border-radius: 0.5rem;
            padding: 0.75rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .hour-option:hover {
            border-color: #1B396A;
            background-color: #f8fafc;
        }
        
        .hour-option.selected {
            border-color: #1B396A;
            background-color: #eff6ff;
            color: #1B396A;
            font-weight: 600;
        }
        
        .info-card {
            border-left: 4px solid #1B396A;
            transition: all 0.3s ease;
        }
        
        .info-card:hover {
            transform: translateX(4px);
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold">➕ Registrar Horas</h1>
                    <p>{{ $servicioSocial->empresa->nombre_empresa }}</p>
                </div>
                <div class="flex space-x-3">
                    <a href="{{ route('servicio-social.registro-horas', $servicioSocial->id) }}" 
                       class="btn-itszn-secundario">
                        ← Volver al Registro
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- INFORMACIÓN DEL PROYECTO MEJORADA -->
            <div class="info-card bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-2xl">ℹ️</span>
                    <h2 class="text-xl font-semibold texto-azul-itszn">Información del Proyecto</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">🏢</span>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Empresa</p>
                                <p class="text-gray-900">{{ $servicioSocial->empresa->nombre_empresa }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg">🚀</span>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Proyecto</p>
                                <p class="text-gray-900">{{ $servicioSocial->nombre_proyecto }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-2">
                            <span class="text-lg">⏱️</span>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Progreso Actual</p>
                                <p class="text-gray-900">{{ $servicioSocial->horas_totales }}/{{ $servicioSocial->horas_requeridas }} horas</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="text-lg">📊</span>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Porcentaje</p>
                                <p class="text-gray-900 font-semibold">{{ $servicioSocial->progreso_horas }}% completado</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BARRA DE PROGRESO -->
                <div class="mt-4">
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $servicioSocial->progreso_horas }}%"></div>
                    </div>
                </div>
            </div>

            <!-- FORMULARIO PRINCIPAL -->
            <div class="bg-white rounded-lg shadow-lg p-6 fade-in">
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-2xl">📝</span>
                    <h2 class="text-xl font-semibold texto-azul-itszn">Nuevo Registro de Horas</h2>
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

                <form id="registroForm" action="{{ route('servicio-social.registrar-horas.store', $servicioSocial->id) }}" 
                      method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- FECHA -->
                    <div class="mb-6">
                        <label class="block texto-azul-itszn text-sm font-semibold mb-3">
                            📅 Fecha de Trabajo *
                        </label>
                        <input type="date" name="fecha" 
                               value="{{ old('fecha', date('Y-m-d')) }}"
                               max="{{ date('Y-m-d') }}"
                               class="form-input"
                               id="fechaInput"
                               required
                               data-validate="true">
                        <div class="flex justify-between mt-2">
                            <p class="text-xs text-gray-500">Selecciona la fecha en que realizaste el trabajo</p>
                            <span id="fechaDisplay" class="text-xs texto-azul-itszn font-medium"></span>
                        </div>
                    </div>

                    <!-- HORAS TRABAJADAS -->
                    <div class="mb-6">
                        <label class="block texto-azul-itszn text-sm font-semibold mb-3">
                            ⏰ Horas Trabajadas *
                        </label>
                        <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mb-3" id="hoursGrid">
                            @for($i = 1; $i <= 8; $i++)
                                <div class="hour-option" data-hours="{{ $i }}">
                                    {{ $i }}h
                                </div>
                            @endfor
                            <div class="hour-option" data-hours="9">9h</div>
                            <div class="hour-option" data-hours="10">10h</div>
                            <div class="hour-option" data-hours="11">11h</div>
                            <div class="hour-option" data-hours="12">12h</div>
                        </div>
                        <select name="horas_trabajadas"
                                class="form-input hidden"
                                id="horasSelect"
                                required
                                data-validate="true">
                            <option value="">Selecciona las horas</option>
                            @for($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}" {{ old('horas_trabajadas') == $i ? 'selected' : '' }}>
                                    {{ $i }} hora{{ $i > 1 ? 's' : '' }}
                                </option>
                            @endfor
                        </select>
                        <p class="text-xs text-gray-500">Máximo 12 horas por día - Selecciona haciendo clic</p>
                    </div>

                    <!-- ACTIVIDADES REALIZADAS -->
                    <div class="mb-6">
                        <label class="block texto-azul-itszn text-sm font-semibold mb-3">
                            📋 Actividades Realizadas *
                        </label>
                        <textarea name="actividades_realizadas" 
                                  rows="6"
                                  class="form-input"
                                  placeholder="Describe detalladamente las actividades que realizaste durante este periodo de trabajo. Incluye tareas específicas, herramientas utilizadas y logros alcanzados..."
                                  required
                                  data-validate="true"
                                  maxlength="1000"
                                  oninput="updateCharacterCount(this, 'actividades-count')"
                                  id="actividadesTextarea">{{ old('actividades_realizadas') }}</textarea>
                        <div class="flex justify-between mt-2">
                            <p class="text-xs text-gray-500">Sé específico: tareas completadas, proyectos, habilidades utilizadas</p>
                            <span id="actividades-count" class="character-count">0/1000</span>
                        </div>
                    </div>

                    <!-- EVIDENCIAS -->
                    <div class="mb-6">
                        <label class="block texto-azul-itszn text-sm font-semibold mb-3">
                            📎 Evidencias 
                            <span class="text-gray-500 font-normal">(Opcional)</span>
                        </label>
                        <div class="file-upload-area" onclick="document.getElementById('evidenciasInput').click()">
                            <input type="file" name="evidencias" id="evidenciasInput"
                                   class="hidden"
                                   accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                            <div class="text-4xl mb-3">📎</div>
                            <p class="text-sm texto-azul-itszn font-medium">Haz clic para subir evidencias</p>
                            <p class="text-xs text-gray-500 mt-1">JPG, PNG, PDF, DOC, DOCX • Máximo 5MB</p>
                            <div id="fileNameDisplay" class="text-xs text-green-600 mt-2 hidden"></div>
                        </div>
                    </div>

                    <!-- RESUMEN DEL REGISTRO -->
                    <div id="resumenRegistro" class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 hidden fade-in">
                        <h3 class="font-semibold texto-azul-itszn mb-2 flex items-center gap-2">
                            <span>📊</span>
                            <span>Resumen de tu registro</span>
                        </h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-600">📅 Fecha:</p>
                                <p class="font-medium" id="resumenFecha"></p>
                            </div>
                            <div>
                                <p class="text-gray-600">⏰ Horas:</p>
                                <p class="font-medium" id="resumenHoras"></p>
                            </div>
                            <div class="col-span-2">
                                <p class="text-gray-600">📋 Actividades:</p>
                                <p class="font-medium line-clamp-2" id="resumenActividades"></p>
                            </div>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                        <a href="{{ route('servicio-social.registro-horas', $servicioSocial->id) }}" 
                           class="btn-itszn-secundario flex-1 text-center">
                            Cancelar
                        </a>
                        <button type="submit" 
                                class="btn-itszn pulse-soft flex items-center justify-center gap-2 flex-1">
                            <span>💾 Guardar Registro</span>
                            <span id="submitSpinner" class="hidden animate-spin">⏳</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- CONSEJOS MEJORADOS -->
            <div class="bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-6 mt-6 fade-in">
                <div class="flex items-center gap-3 mb-4">
                    <span class="text-2xl">💡</span>
                    <h3 class="text-lg font-semibold texto-azul-itszn">Consejos para un registro exitoso</h3>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div class="space-y-3">
                        <div class="flex items-start gap-2">
                            <span class="text-green-600 mt-0.5">✅</span>
                            <div>
                                <p class="font-medium texto-azul-itszn">Registro oportuno</p>
                                <p class="text-gray-600">Registra tus horas el mismo día que trabajas</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-blue-600 mt-0.5">📝</span>
                            <div>
                                <p class="font-medium texto-azul-itszn">Descripción detallada</p>
                                <p class="text-gray-600">Sé específico en las actividades realizadas</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start gap-2">
                            <span class="text-purple-600 mt-0.5">📎</span>
                            <div>
                                <p class="font-medium texto-azul-itszn">Evidencias claras</p>
                                <p class="text-gray-600">Incluye capturas, documentos o fotos relevantes</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-orange-600 mt-0.5">🔍</span>
                            <div>
                                <p class="font-medium texto-azul-itszn">Verificación</p>
                                <p class="text-gray-600">Revisa que la información sea clara y precisa</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // ✅ INICIALIZACIÓN DE FECHA
        document.addEventListener('DOMContentLoaded', function() {
            // Establecer fecha máxima como hoy
            const fechaInput = document.getElementById('fechaInput');
            fechaInput.max = new Date().toISOString().split('T')[0];
            
            // Formatear y mostrar fecha
            updateDateDisplay();
            
            // Configurar selector de horas
            setupHourSelector();
            
            // Configurar upload de archivos
            setupFileUpload();
            
            // Actualizar resumen en tiempo real
            setupRealTimeSummary();
        });

        // ✅ SELECTOR DE HORAS INTERACTIVO
        function setupHourSelector() {
            const hourOptions = document.querySelectorAll('.hour-option');
            const horasSelect = document.getElementById('horasSelect');
            
            hourOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remover selección anterior
                    hourOptions.forEach(opt => opt.classList.remove('selected'));
                    
                    // Seleccionar actual
                    this.classList.add('selected');
                    
                    // Actualizar select oculto
                    const hours = this.getAttribute('data-hours');
                    horasSelect.value = hours;
                    
                    // Validar campo
                    validateField(horasSelect);
                    updateSummary();
                });
            });
            
            // Seleccionar opción si ya hay un valor
            if (horasSelect.value) {
                const selectedOption = document.querySelector(`.hour-option[data-hours="${horasSelect.value}"]`);
                if (selectedOption) {
                    selectedOption.classList.add('selected');
                }
            }
        }

        // ✅ ACTUALIZAR DISPLAY DE FECHA
        function updateDateDisplay() {
            const fechaInput = document.getElementById('fechaInput');
            const fechaDisplay = document.getElementById('fechaDisplay');
            
            const fecha = new Date(fechaInput.value);
            const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
            fechaDisplay.textContent = fecha.toLocaleDateString('es-ES', options);
            
            fechaInput.addEventListener('change', function() {
                updateDateDisplay();
                updateSummary();
            });
        }

        // ✅ CONFIGURAR UPLOAD DE ARCHIVOS
        function setupFileUpload() {
            const fileInput = document.getElementById('evidenciasInput');
            const fileDisplay = document.getElementById('fileNameDisplay');
            const uploadArea = fileInput.closest('.file-upload-area');
            
            fileInput.addEventListener('change', function(e) {
                if (this.files.length > 0) {
                    const file = this.files[0];
                    const fileSizeMB = (file.size / (1024 * 1024)).toFixed(2);
                    
                    if (fileSizeMB > 5) {
                        showNotification('El archivo no puede ser mayor a 5MB', 'error');
                        this.value = '';
                        fileDisplay.classList.add('hidden');
                        uploadArea.style.borderColor = '#d1d5db';
                        uploadArea.style.backgroundColor = '';
                    } else {
                        fileDisplay.textContent = `✅ ${file.name} (${fileSizeMB} MB)`;
                        fileDisplay.classList.remove('hidden');
                        uploadArea.style.borderColor = '#10b981';
                        uploadArea.style.backgroundColor = '#f0fdf4';
                    }
                }
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
                fileInput.files = e.dataTransfer.files;
                fileInput.dispatchEvent(new Event('change'));
            });
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
            
            updateSummary();
        }

        // ✅ RESUMEN EN TIEMPO REAL
        function setupRealTimeSummary() {
            const inputs = document.querySelectorAll('#fechaInput, #horasSelect, #actividadesTextarea');
            inputs.forEach(input => {
                input.addEventListener('input', updateSummary);
                input.addEventListener('change', updateSummary);
            });
        }

        function updateSummary() {
            const resumen = document.getElementById('resumenRegistro');
            const fecha = document.getElementById('fechaInput').value;
            const horas = document.getElementById('horasSelect').value;
            const actividades = document.getElementById('actividadesTextarea').value;
            
            if (fecha && horas && actividades) {
                document.getElementById('resumenFecha').textContent = new Date(fecha).toLocaleDateString('es-ES');
                document.getElementById('resumenHoras').textContent = `${horas} hora${horas > 1 ? 's' : ''}`;
                document.getElementById('resumenActividades').textContent = actividades.substring(0, 100) + (actividades.length > 100 ? '...' : '');
                resumen.classList.remove('hidden');
            } else {
                resumen.classList.add('hidden');
            }
        }

        // ✅ VALIDACIÓN DE CAMPOS
        function validateField(field) {
            const value = field.value.trim();
            
            // Limpiar estado anterior
            field.classList.remove('error');
            
            if (field.hasAttribute('required') && !value) {
                field.classList.add('error');
                return false;
            }
            
            return true;
        }

        // ✅ ENVIO DEL FORMULARIO
        document.getElementById('registroForm').addEventListener('submit', function(e) {
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
                showNotification('Por favor, completa todos los campos requeridos', 'error');
            }
        });

        // ✅ NOTIFICACIONES
        function showNotification(message, type = 'info') {
            // Podrías implementar un sistema de toasts aquí
            console.log(`${type.toUpperCase()}: ${message}`);
        }

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