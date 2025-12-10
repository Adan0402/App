<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Vacante - ITSZN</title>
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
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL -->
    <header class="header-institucional shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                        <span class="text-xl">💼</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Editar Vacante</h1>
                        <p>Sistema Integral de Servicio Social - ITSZN</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.vacantes.mostrar', $vacante) }}" 
                       class="btn-itszn-secundario flex items-center gap-2 text-sm">
                        <i class="fas fa-times"></i>
                        <span>Cancelar</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start lg:items-center mb-6 fade-in">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold texto-azul-itszn mb-2">
                    <i class="fas fa-edit me-2"></i>Editar Vacante
                </h1>
                <p class="text-gray-600">Actualiza la información de la vacante "{{ $vacante->titulo }}"</p>
            </div>
            <div>
                <a href="{{ route('admin.vacantes.mostrar', $vacante) }}" 
                   class="btn-itszn-secundario flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i>
                    <span>Volver a detalles</span>
                </a>
            </div>
        </div>

        <!-- Formulario de Edición -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden fade-in">
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white py-4 px-6">
                <h5 class="text-lg font-bold">
                    <i class="fas fa-file-alt me-2"></i>Información de la Vacante
                </h5>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('admin.vacantes.actualizar', $vacante) }}" id="editarVacanteForm">
                    @csrf
                    @method('PUT')

                    <!-- Información Básica -->
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
                                       value="{{ old('titulo', $vacante->titulo) }}"
                                       required
                                       placeholder="Ej: Desarrollador Web Frontend">
                            </div>

                            <!-- Empresa -->
                            <div>
                                <label for="empresa_id" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-building me-2"></i>Empresa *
                                </label>
                                <select name="empresa_id" id="empresa_id" 
                                        class="form-input"
                                        required>
                                    <option value="">Selecciona una empresa</option>
                                    @foreach($empresas as $empresa)
                                        <option value="{{ $empresa->id }}" 
                                                {{ old('empresa_id', $vacante->empresa_id) == $empresa->id ? 'selected' : '' }}>
                                            {{ $empresa->nombre_empresa }} 
                                            @if($empresa->estado == 'aprobada')
                                                <span class="text-green-600">✅</span>
                                            @endif
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Tipo de Contrato -->
                            <div>
                                <label for="tipo_contrato" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-file-contract me-2"></i>Tipo de Contrato *
                                </label>
                                <select name="tipo_contrato" 
                                        class="form-input"
                                        required>
                                    <option value="">Selecciona el tipo</option>
                                    <option value="tiempo_completo" {{ old('tipo_contrato', $vacante->tipo_contrato) == 'tiempo_completo' ? 'selected' : '' }}>Tiempo Completo</option>
                                    <option value="medio_tiempo" {{ old('tipo_contrato', $vacante->tipo_contrato) == 'medio_tiempo' ? 'selected' : '' }}>Medio Tiempo</option>
                                    <option value="practicas" {{ old('tipo_contrato', $vacante->tipo_contrato) == 'practicas' ? 'selected' : '' }}>Prácticas</option>
                                    <option value="servicio_social" {{ old('tipo_contrato', $vacante->tipo_contrato) == 'servicio_social' ? 'selected' : '' }}>Servicio Social</option>
                                </select>
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
                                    <option value="presencial" {{ old('modalidad', $vacante->modalidad) == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                    <option value="remoto" {{ old('modalidad', $vacante->modalidad) == 'remoto' ? 'selected' : '' }}>Remoto</option>
                                    <option value="hibrido" {{ old('modalidad', $vacante->modalidad) == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                                </select>
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
                                       value="{{ old('ubicacion', $vacante->ubicacion) }}"
                                       required
                                       placeholder="Ej: Ciudad, Estado o 'Remoto'">
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
                                       value="{{ old('salario', $vacante->salario) }}"
                                       placeholder="Ej: $15,000 - $20,000 MXN">
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
                                       value="{{ old('numero_vacantes', $vacante->numero_vacantes) }}" 
                                       required
                                       min="1"
                                       max="50">
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
                                       value="{{ old('fecha_limite', $vacante->fecha_limite->format('Y-m-d')) }}" 
                                       required
                                       min="{{ date('Y-m-d') }}">
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
                                          placeholder="Describe las responsabilidades y funciones del puesto...">{{ old('descripcion', $vacante->descripcion) }}</textarea>
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
                                          placeholder="Lista los requisitos (estudios, experiencia, habilidades)...">{{ old('requisitos', $vacante->requisitos) }}</textarea>
                                <p class="text-gray-500 text-sm mt-2">Separa cada requisito con un salto de línea</p>
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
                                          placeholder="Beneficios adicionales (seguro médico, bonos, etc)...">{{ old('beneficios', $vacante->beneficios) }}</textarea>
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
                                           id="es_urgente" 
                                           name="es_urgente" 
                                           value="1"
                                           {{ old('es_urgente', $vacante->es_urgente) ? 'checked' : '' }}>
                                    <label class="font-semibold flex items-center gap-2" for="es_urgente">
                                        <i class="fas fa-exclamation-circle text-yellow-600"></i>
                                        Marcar como urgente
                                    </label>
                                </div>
                                <p class="text-gray-600 text-sm">
                                    Aparecerá destacada en la lista de vacantes.
                                </p>
                            </div>

                            <!-- Estado de Aprobación -->
                            <div class="info-card bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <input class="form-check-input h-5 w-5" 
                                           type="checkbox" 
                                           id="esta_aprobada" 
                                           name="esta_aprobada" 
                                           value="1"
                                           {{ old('esta_aprobada', $vacante->estado == 'aprobada') ? 'checked' : '' }}>
                                    <label class="font-semibold flex items-center gap-2" for="esta_aprobada">
                                        <i class="fas fa-check-circle text-green-600"></i>
                                        Vacante aprobada
                                    </label>
                                </div>
                                <p class="text-gray-600 text-sm">
                                    La vacante será visible para postulaciones.
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t">
                        <div>
                            <a href="{{ route('admin.vacantes.mostrar', $vacante) }}" 
                               class="btn-itszn-secundario flex items-center gap-2">
                                <i class="fas fa-times"></i>
                                <span>Cancelar</span>
                            </a>
                        </div>
                        <div class="flex gap-3">
                            <button type="reset" 
                                    class="btn-itszn-secundario flex items-center gap-2">
                                <i class="fas fa-redo"></i>
                                <span>Restablecer</span>
                            </button>
                            <button type="submit" 
                                    class="btn-itszn flex items-center gap-2 px-6">
                                <i class="fas fa-save"></i>
                                <span>Guardar Cambios</span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Información Adicional -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mt-6 fade-in">
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
                            <i class="fas fa-calendar-alt text-red-600"></i>
                            <span>La fecha límite no puede ser anterior a hoy</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-bell text-blue-600"></i>
                            <span>La empresa recibirá una notificación de los cambios</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-users text-green-600"></i>
                            <span>Actualmente hay {{ $vacante->postulaciones_count ?? 0 }} postulaciones para esta vacante</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar fecha mínima (hoy)
        const fechaLimite = document.getElementById('fecha_limite');
        const today = new Date().toISOString().split('T')[0];
        fechaLimite.min = today;
        
        // Contador de caracteres
        const descripcion = document.getElementById('descripcion');
        const requisitos = document.getElementById('requisitos');
        
        function updateCounter(textarea) {
            const counter = document.getElementById(textarea.id + '-counter');
            if (counter) {
                counter.textContent = `Caracteres: ${textarea.value.length}`;
            }
        }
        
        descripcion.addEventListener('input', () => updateCounter(descripcion));
        requisitos.addEventListener('input', () => updateCounter(requisitos));
        
        // Crear contadores si no existen
        if (!document.getElementById('descripcion-counter')) {
            const descCounter = document.createElement('p');
            descCounter.id = 'descripcion-counter';
            descCounter.className = 'text-gray-500 text-sm mt-2 text-right';
            descCounter.textContent = `Caracteres: ${descripcion.value.length}`;
            descripcion.parentNode.appendChild(descCounter);
        }
        
        if (!document.getElementById('requisitos-counter')) {
            const reqCounter = document.createElement('p');
            reqCounter.id = 'requisitos-counter';
            reqCounter.className = 'text-gray-500 text-sm mt-2 text-right';
            reqCounter.textContent = `Caracteres: ${requisitos.value.length}`;
            requisitos.parentNode.appendChild(reqCounter);
        }
        
        // Validación del formulario
        document.getElementById('editarVacanteForm').addEventListener('submit', function(e) {
            // Validar fecha
            if (fechaLimite.value < today) {
                e.preventDefault();
                alert('La fecha límite no puede ser anterior a hoy');
                return;
            }
            
            // Validar número de vacantes
            const numVacantes = document.getElementById('numero_vacantes').value;
            if (numVacantes < 1 || numVacantes > 50) {
                e.preventDefault();
                alert('El número de vacantes debe estar entre 1 y 50');
                return;
            }
        });
    });
    </script>
</body>
</html>