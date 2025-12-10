<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empresa - ITSZN</title>
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
        
        .form-select {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }
        
        .form-select:focus {
            outline: none;
            border-color: #1B396A;
            box-shadow: 0 0 0 3px rgba(27, 57, 106, 0.1);
        }
        
        .form-textarea {
            border: 1px solid #d1d5db;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
            width: 100%;
            transition: all 0.3s ease;
            resize: vertical;
        }
        
        .form-textarea:focus {
            outline: none;
            border-color: #1B396A;
            box-shadow: 0 0 0 3px rgba(27, 57, 106, 0.1);
        }
        
        .invalid-input {
            border-color: #dc2626;
        }
        
        .invalid-feedback {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .section-header {
            border-bottom: 2px solid #1B396A;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-info {
            background-color: #dbeafe;
            border: 1px solid #93c5fd;
            border-radius: 0.5rem;
            padding: 1rem;
            color: #1e40af;
        }
        
        .required-field::after {
            content: " *";
            color: #dc2626;
        }
        
        .optional-field::after {
            content: " (opcional)";
            color: #6b7280;
            font-weight: normal;
        }
        
        .optional-note {
            color: #6b7280;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        /* Mensajes de éxito/error */
        .alert-success {
            background-color: #d1fae5;
            border: 1px solid #10b981;
            border-radius: 0.5rem;
            padding: 1rem;
            color: #047857;
        }
        
        .alert-error {
            background-color: #fee2e2;
            border: 1px solid #ef4444;
            border-radius: 0.5rem;
            padding: 1rem;
            color: #dc2626;
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
                        <span class="text-xl">🏢</span>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold">Gestión de Empresas</h1>
                        <p>Sistema Integral de Servicio Social - ITSZN</p>
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

    <div class="container mx-auto px-4 py-6">
        <!-- Mensajes de sesión -->
        @if(session('success'))
            <div class="alert-success mb-6 fade-in">
                <div class="flex items-center gap-2">
                    <span>✅</span>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert-error mb-6 fade-in">
                <div class="flex items-center gap-2">
                    <span>❌</span>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif

        <!-- Breadcrumb -->
        <nav class="flex mb-6 fade-in" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium texto-azul-itszn hover:text-blue-700">
                        <i class="fas fa-home mr-2"></i>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('admin.empresas.todas') }}" class="ml-1 text-sm font-medium texto-azul-itszn hover:text-blue-700">
                            <i class="fas fa-building mr-2"></i>
                            Empresas
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="ml-1 text-sm font-medium text-gray-500">
                            <i class="fas fa-edit mr-2"></i>
                            Editar Empresa
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Botón volver -->
        <div class="mb-6 fade-in">
            <a href="{{ route('admin.empresas.todas') }}" class="btn-itszn-secundario inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver a Empresas
            </a>
        </div>

        <!-- Tarjeta principal del formulario -->
        <div class="info-card bg-white rounded-lg shadow-lg overflow-hidden fade-in">
            <!-- Header de la tarjeta -->
            <div class="px-6 py-4 border-b border-gray-200 bg-white">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                        <span class="text-xl texto-azul-itszn">✏️</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold texto-azul-itszn">Editar Empresa</h2>
                        <p class="text-gray-600 text-sm mt-1">{{ $empresa->nombre_empresa }}</p>
                    </div>
                </div>
            </div>

            <div class="p-6">
                <!-- Mostrar errores de validación -->
                @if($errors->any())
                    <div class="alert-error mb-6">
                        <div class="flex items-center gap-2 mb-2">
                            <span>⚠️</span>
                            <span class="font-medium">Por favor, corrige los siguientes errores:</span>
                        </div>
                        <ul class="list-disc list-inside text-sm">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.empresas.actualizar', $empresa->id) }}" class="space-y-8" id="editEmpresaForm">
                    @csrf
                    @method('PUT')
                    
                    <!-- Información del Administrador -->
                    <div class="fade-in" style="animation-delay: 0.1s">
                        <div class="section-header">
                            <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                                <i class="fas fa-user-shield"></i>
                                Datos del Administrador
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nombre Administrador -->
                            <div>
                                <label class="block texto-azul-itszn text-sm font-medium mb-2 required-field">
                                    Nombre del Administrador
                                </label>
                                <input type="text" 
                                       name="admin_nombre" 
                                       class="form-input @error('admin_nombre') invalid-input @enderror" 
                                       value="{{ old('admin_nombre', $empresa->user->name ?? '') }}" 
                                       required>
                                @error('admin_nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Email de Contacto -->
                            <div>
                                <label class="block texto-azul-itszn text-sm font-medium mb-2">
                                    Email de Contacto
                                </label>
                                <div class="form-input bg-gray-50 text-gray-700">
                                    <strong>{{ $empresa->correo_contacto }}</strong>
                                    <p class="text-xs text-gray-500 mt-1">No se puede modificar el email</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de la Empresa -->
                    <div class="fade-in" style="animation-delay: 0.2s">
                        <div class="section-header">
                            <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                                <i class="fas fa-building"></i>
                                Datos de la Empresa
                            </h3>
                        </div>
                        
                        <div class="bg-blue-50 p-5 rounded-lg border border-blue-200 space-y-4">
                            <!-- Nombre Empresa -->
                            <div>
                                <label for="nombre_empresa" class="block texto-azul-itszn text-sm font-medium mb-2 required-field">
                                    Nombre de la Empresa/Negocio
                                </label>
                                <input type="text" 
                                       class="form-input @error('nombre_empresa') invalid-input @enderror" 
                                       name="nombre_empresa" 
                                       id="nombre_empresa" 
                                       value="{{ old('nombre_empresa', $empresa->nombre_empresa) }}"
                                       required
                                       placeholder="Ej: Mi Tienda, Restaurante...">
                                @error('nombre_empresa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Tipo Negocio -->
                                <div>
                                    <label for="tipo_negocio" class="block texto-azul-itszn text-sm font-medium mb-2 required-field">
                                        Tipo de Negocio
                                    </label>
                                    <select name="tipo_negocio" 
                                            id="tipo_negocio" 
                                            class="form-select @error('tipo_negocio') invalid-input @enderror"
                                            required>
                                        <option value="">Selecciona el tipo</option>
                                        <option value="restaurante" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'restaurante') ? 'selected' : '' }}>Restaurante/Cafetería</option>
                                        <option value="tienda" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'tienda') ? 'selected' : '' }}>Tienda/Comercio</option>
                                        <option value="servicios" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'servicios') ? 'selected' : '' }}>Servicios</option>
                                        <option value="taller" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'taller') ? 'selected' : '' }}>Taller</option>
                                        <option value="consultoria" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'consultoria') ? 'selected' : '' }}>Consultoría</option>
                                        <option value="automotriz" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'automotriz') ? 'selected' : '' }}>Automotriz</option>
                                        <option value="industrial" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'industrial') ? 'selected' : '' }}>Industrial</option>
                                        <option value="otro" {{ (old('tipo_negocio', $empresa->tipo_negocio) == 'otro') ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('tipo_negocio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div>
                                    <label for="telefono_contacto" class="block texto-azul-itszn text-sm font-medium mb-2 required-field">
                                        Teléfono de Contacto
                                    </label>
                                    <input type="tel" 
                                           class="form-input @error('telefono_contacto') invalid-input @enderror" 
                                           name="telefono_contacto" 
                                           id="telefono_contacto" 
                                           value="{{ old('telefono_contacto', $empresa->telefono_contacto) }}"
                                           required
                                           placeholder="Ej: 1234567890">
                                    @error('telefono_contacto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Representante -->
                            <div>
                                <label for="representante_legal" class="block texto-azul-itszn text-sm font-medium mb-2 required-field">
                                    Persona de Contacto
                                </label>
                                <input type="text" 
                                       class="form-input @error('representante_legal') invalid-input @enderror" 
                                       name="representante_legal" 
                                       id="representante_legal" 
                                       value="{{ old('representante_legal', $empresa->representante_legal) }}"
                                       required
                                       placeholder="Nombre completo">
                                @error('representante_legal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="fade-in" style="animation-delay: 0.3s">
                        <div class="section-header">
                            <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                                <i class="fas fa-info-circle"></i>
                                Información Adicional
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- RFC (OPCIONAL) -->
                            <div>
                                <label for="rfc" class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    <i class="fas fa-id-card text-blue-600 mr-2"></i>RFC
                                </label>
                                <input type="text" 
                                       class="form-input @error('rfc') invalid-input @enderror" 
                                       id="rfc" 
                                       name="rfc" 
                                       value="{{ old('rfc', $empresa->rfc) }}"
                                       placeholder="Ej: STE120304ABC (opcional)" 
                                       maxlength="13">
                                @error('rfc')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <p class="text-xs text-gray-500 mt-1">Máximo 13 caracteres</p>
                            </div>

                            <!-- Tamaño de Empresa (OPCIONAL) -->
                            <div>
                                <label for="tamano_empresa" class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    <i class="fas fa-users text-blue-600 mr-2"></i>Tamaño de la Empresa
                                </label>
                                <select class="form-select @error('tamano_empresa') invalid-input @enderror" 
                                        id="tamano_empresa" name="tamano_empresa">
                                    <option value="">Seleccionar tamaño (opcional)...</option>
                                    <option value="Micro (1-10 empleados)" {{ (old('tamano_empresa', $empresa->tamano_empresa) == 'Micro (1-10 empleados)') ? 'selected' : '' }}>Micro (1-10 empleados)</option>
                                    <option value="Pequeña (11-50 empleados)" {{ (old('tamano_empresa', $empresa->tamano_empresa) == 'Pequeña (11-50 empleados)') ? 'selected' : '' }}>Pequeña (11-50 empleados)</option>
                                    <option value="Mediana (51-250 empleados)" {{ (old('tamano_empresa', $empresa->tamano_empresa) == 'Mediana (51-250 empleados)') ? 'selected' : '' }}>Mediana (51-250 empleados)</option>
                                    <option value="Grande (251+ empleados)" {{ (old('tamano_empresa', $empresa->tamano_empresa) == 'Grande (251+ empleados)') ? 'selected' : '' }}>Grande (251+ empleados)</option>
                                </select>
                                @error('tamano_empresa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Puesto del Representante (OPCIONAL) -->
                            <div>
                                <label for="puesto_representante" class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    <i class="fas fa-briefcase text-blue-600 mr-2"></i>Puesto del Contacto
                                </label>
                                <input type="text" 
                                       class="form-input @error('puesto_representante') invalid-input @enderror" 
                                       id="puesto_representante" 
                                       name="puesto_representante" 
                                       value="{{ old('puesto_representante', $empresa->puesto_representante) }}"
                                       placeholder="Ej: Director General, Gerente (opcional)">
                                @error('puesto_representante')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Dirección (OPCIONAL) -->
                            <div>
                                <label for="direccion" class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    <i class="fas fa-map-marker-alt text-blue-600 mr-2"></i>Dirección
                                </label>
                                <input type="text" 
                                       class="form-input @error('direccion') invalid-input @enderror" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="{{ old('direccion', $empresa->direccion) }}"
                                       placeholder="Ej: Av. Principal #123, Col. Centro (opcional)">
                                @error('direccion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Página Web (OPCIONAL) -->
                            <div>
                                <label for="pagina_web" class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    <i class="fas fa-globe text-blue-600 mr-2"></i>Página Web
                                </label>
                                <input type="url" 
                                       class="form-input @error('pagina_web') invalid-input @enderror" 
                                       id="pagina_web" 
                                       name="pagina_web" 
                                       value="{{ old('pagina_web', $empresa->pagina_web) }}"
                                       placeholder="https://www.ejemplo.com (opcional)">
                                @error('pagina_web')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Descripción de Empresa (OPCIONAL) -->
                            <div class="md:col-span-2">
                                <label for="descripcion_empresa" class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    <i class="fas fa-file-alt text-blue-600 mr-2"></i>Descripción de la Empresa
                                </label>
                                <textarea class="form-textarea @error('descripcion_empresa') invalid-input @enderror" 
                                          id="descripcion_empresa" 
                                          name="descripcion_empresa" 
                                          rows="3"
                                          placeholder="Breve descripción de las actividades de la empresa (opcional)...">{{ old('descripcion_empresa', $empresa->descripcion_empresa) }}</textarea>
                                @error('descripcion_empresa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Cambio de Contraseña (OPCIONAL) -->
                    <div class="fade-in" style="animation-delay: 0.4s">
                        <div class="section-header">
                            <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                                <i class="fas fa-lock"></i>
                                Cambiar Contraseña
                            </h3>
                        </div>
                        
                        <div class="alert-info mb-4">
                            <p class="text-sm">Deja estos campos en blanco si no deseas cambiar la contraseña.</p>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    Nueva Contraseña
                                </label>
                                <input type="password" 
                                       name="password" 
                                       class="form-input @error('password') invalid-input @enderror"
                                       placeholder="Mínimo 8 caracteres">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div>
                                <label class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    Confirmar Contraseña
                                </label>
                                <input type="password" 
                                       name="password_confirmation" 
                                       class="form-input"
                                       placeholder="Repite la contraseña">
                            </div>
                        </div>
                    </div>

                    <!-- Estado de la empresa -->
                    <div class="fade-in" style="animation-delay: 0.5s">
                        <div class="section-header">
                            <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                                <i class="fas fa-toggle-on"></i>
                                Estado de la Empresa
                            </h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block texto-azul-itszn text-sm font-medium mb-2 required-field">
                                    Estado
                                </label>
                                <select name="estado" 
                                        class="form-select @error('estado') invalid-input @enderror"
                                        required id="estadoSelect">
                                    <option value="pendiente" {{ (old('estado', $empresa->estado) == 'pendiente') ? 'selected' : '' }}>⏳ Pendiente</option>
                                    <option value="aprobada" {{ (old('estado', $empresa->estado) == 'aprobada') ? 'selected' : '' }}>✅ Aprobada</option>
                                    <option value="rechazada" {{ (old('estado', $empresa->estado) == 'rechazada') ? 'selected' : '' }}>❌ Rechazada</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div id="motivoRechazoContainer">
                                <label class="block texto-azul-itszn text-sm font-medium mb-2 optional-field">
                                    Motivo de Rechazo
                                </label>
                                <textarea class="form-textarea @error('motivo_rechazo') invalid-input @enderror" 
                                          name="motivo_rechazo" 
                                          rows="2"
                                          id="motivoRechazoTextarea"
                                          placeholder="Solo completar si se rechaza la empresa (opcional)...">{{ old('motivo_rechazo', $empresa->motivo_rechazo) }}</textarea>
                                @error('motivo_rechazo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Botones de acción -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 pt-6 border-t border-gray-200 fade-in" style="animation-delay: 0.6s">
                        <a href="{{ route('admin.empresas.todas') }}" class="btn-itszn-secundario inline-flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i>
                            Cancelar
                        </a>
                        <button type="submit" class="btn-itszn inline-flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i>
                            Actualizar Empresa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación de RFC (opcional, solo formateo)
        const rfcInput = document.getElementById('rfc');
        if (rfcInput) {
            rfcInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });
        }
        
        // Mostrar/ocultar motivo de rechazo según estado
        const estadoSelect = document.getElementById('estadoSelect');
        const motivoRechazoTextarea = document.getElementById('motivoRechazoTextarea');
        const motivoRechazoContainer = document.getElementById('motivoRechazoContainer');
        
        function toggleMotivoRechazo() {
            if (estadoSelect.value === 'rechazada') {
                motivoRechazoContainer.style.display = 'block';
                motivoRechazoTextarea.required = false; // Opcional, no requerido
                motivoRechazoTextarea.placeholder = "Motivo de rechazo (opcional)...";
            } else {
                motivoRechazoContainer.style.display = 'block';
                motivoRechazoTextarea.required = false;
                motivoRechazoTextarea.placeholder = "Solo completar si se rechaza la empresa (opcional)...";
            }
        }
        
        if (estadoSelect && motivoRechazoTextarea) {
            estadoSelect.addEventListener('change', toggleMotivoRechazo);
            toggleMotivoRechazo();
        }
        
        // Animaciones escalonadas
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Depuración del formulario
        const form = document.getElementById('editEmpresaForm');
        if (form) {
            form.addEventListener('submit', function(e) {
                console.log('Formulario enviado');
                console.log('Acción:', this.action);
                console.log('Método:', this.method);
                
                // Mostrar datos del formulario para depuración
                const formData = new FormData(this);
                for (let [key, value] of formData.entries()) {
                    console.log(`${key}: ${value}`);
                }
                
                // Validación básica del frontend
                const requiredFields = this.querySelectorAll('[required]');
                let isValid = true;
                let errorMessages = [];
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        field.classList.add('invalid-input');
                        const label = field.closest('div').querySelector('label');
                        errorMessages.push(`${label?.textContent || 'Campo'} es obligatorio`);
                        isValid = false;
                    } else {
                        field.classList.remove('invalid-input');
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    alert('Por favor, completa todos los campos obligatorios marcados con *.');
                    return false;
                }
                
                // Validación de contraseña si se proporciona
                const password = form.querySelector('input[name="password"]');
                const passwordConfirm = form.querySelector('input[name="password_confirmation"]');
                
                if (password.value || passwordConfirm.value) {
                    if (password.value.length < 8) {
                        e.preventDefault();
                        alert('La contraseña debe tener al menos 8 caracteres.');
                        return false;
                    }
                    
                    if (password.value !== passwordConfirm.value) {
                        e.preventDefault();
                        alert('Las contraseñas no coinciden.');
                        return false;
                    }
                }
                
                return true;
            });
        }
        
        // Verificar si hay errores de validación
        const errorFields = document.querySelectorAll('.invalid-input');
        if (errorFields.length > 0) {
            setTimeout(() => {
                alert('Hay errores en el formulario. Por favor, revísalos antes de enviar.');
            }, 500);
        }
    });
    </script>
</body>
</html>