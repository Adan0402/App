<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Nueva Empresa - ITSZN</title>
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
        
        .section-divider {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #6b7280;
            cursor: pointer;
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
                    <h1 class="text-2xl font-bold">Registrar Nueva Empresa</h1>
                    <p class="text-white/80 text-sm">Panel de Administración - ITSZN</p>
                </div>
            </div>
            <div class="flex items-center gap-4">
                <a href="/dashboard" 
                   class="bg-white/20 text-white px-4 py-2 rounded hover:bg-white/30 transition flex items-center gap-2">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                
                <div class="flex items-center gap-2 ml-4 pl-4 border-l border-white/20">
                    <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <span class="text-white/90 text-sm">Administrador</span>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container mx-auto px-4 py-6">
    <!-- Breadcrumb (dentro del contenido) -->
    <nav class="flex mb-6 fade-in" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium texto-azul-itszn hover:text-blue-700">
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
                        <i class="fas fa-user-plus mr-2"></i>
                        Nueva Empresa
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="container mx-auto px-4 py-6">
        <!-- Formulario Principal -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden fade-in">
            <div class="card-header-gradient text-white py-4 px-6">
                <h5 class="text-lg font-bold flex items-center gap-2">
                    <i class="fas fa-user-plus"></i>
                    Registro de Nueva Empresa
                </h5>
            </div>
            
            <div class="p-6">
                <form method="POST" action="{{ route('admin.empresas.guardar') }}" id="empresaForm">
                    @csrf

                    <!-- Información del Administrador -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 section-divider">
                            <i class="fas fa-user-shield me-2"></i>Datos del Administrador
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nombre del Administrador De la Empresa-->
                            <div>
                                <label for="admin_nombre" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-user me-2"></i>Nombre del Administrador *
                                </label>
                                <input type="text" 
                                       class="form-input @error('admin_nombre') border-red-500 @enderror" 
                                       id="admin_nombre" 
                                       name="admin_nombre" 
                                       value="{{ old('admin_nombre') }}" 
                                       required
                                       placeholder="Ej: Juan Pérez">
                                @error('admin_nombre')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email del Administrador -->
                            <div>
                                <label for="correo_contacto" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-envelope me-2"></i>Email de Contacto *
                                </label>
                                <input type="email" 
                                       class="form-input @error('correo_contacto') border-red-500 @enderror" 
                                       id="correo_contacto" 
                                       name="correo_contacto" 
                                       value="{{ old('correo_contacto') }}" 
                                       required
                                       placeholder="ejemplo@empresa.com">
                                @error('correo_contacto')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm mt-2">Se usará para el acceso al sistema</p>
                            </div>

                            <!-- Contraseña -->
                            <div class="password-container">
                                <label for="password" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-lock me-2"></i>Contraseña *
                                </label>
                                <input type="password" 
                                       class="form-input @error('password') border-red-500 @enderror pr-10" 
                                       id="password" 
                                       name="password" 
                                       required
                                       placeholder="Mínimo 8 caracteres">
                                <button type="button" class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Confirmar Contraseña -->
                            <div class="password-container">
                                <label for="password_confirmation" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-lock me-2"></i>Confirmar Contraseña *
                                </label>
                                <input type="password" 
                                       class="form-input pr-10" 
                                       id="password_confirmation" 
                                       name="password_confirmation" 
                                       required
                                       placeholder="Repite la contraseña">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Datos de la Empresa -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 section-divider">
                            <i class="fas fa-building me-2"></i>Datos de la Empresa
                        </h6>
                        
                        <div class="info-card bg-blue-50 rounded-lg p-6 mb-6 border border-blue-200">
                            <!-- Nombre Empresa -->
                            <div class="mb-4">
                                <label for="nombre_empresa" class="block texto-azul-itszn font-semibold mb-2">
                                    Nombre de la Empresa/Negocio *
                                </label>
                                <input type="text" 
                                       class="form-input @error('nombre_empresa') border-red-500 @enderror" 
                                       name="nombre_empresa" 
                                       id="nombre_empresa" 
                                       value="{{ old('nombre_empresa') }}"
                                       required
                                       placeholder="Ej: Mi Tienda, Restaurante...">
                                @error('nombre_empresa')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Tipo Negocio -->
                                <div>
                                    <label for="tipo_negocio" class="block texto-azul-itszn font-semibold mb-2">
                                        Tipo de Negocio *
                                    </label>
                                    <select name="tipo_negocio" 
                                            id="tipo_negocio" 
                                            class="form-input @error('tipo_negocio') border-red-500 @enderror"
                                            required>
                                        <option value="">Selecciona el tipo</option>
                                        <option value="restaurante" {{ old('tipo_negocio') == 'restaurante' ? 'selected' : '' }}>Restaurante/Cafetería</option>
                                        <option value="tienda" {{ old('tipo_negocio') == 'tienda' ? 'selected' : '' }}>Tienda/Comercio</option>
                                        <option value="servicios" {{ old('tipo_negocio') == 'servicios' ? 'selected' : '' }}>Servicios</option>
                                        <option value="taller" {{ old('tipo_negocio') == 'taller' ? 'selected' : '' }}>Taller</option>
                                        <option value="consultoria" {{ old('tipo_negocio') == 'consultoria' ? 'selected' : '' }}>Consultoría</option>
                                        <option value="automotriz" {{ old('tipo_negocio') == 'automotriz' ? 'selected' : '' }}>Automotriz</option>
                                        <option value="industrial" {{ old('tipo_negocio') == 'industrial' ? 'selected' : '' }}>Industrial</option>
                                        <option value="otro" {{ old('tipo_negocio') == 'otro' ? 'selected' : '' }}>Otro</option>
                                    </select>
                                    @error('tipo_negocio')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Teléfono -->
                                <div>
                                    <label for="telefono_contacto" class="block texto-azul-itszn font-semibold mb-2">
                                        Teléfono de Contacto *
                                    </label>
                                    <input type="tel" 
                                           class="form-input @error('telefono_contacto') border-red-500 @enderror" 
                                           name="telefono_contacto" 
                                           id="telefono_contacto" 
                                           value="{{ old('telefono_contacto') }}"
                                           required
                                           placeholder="Ej: 1234567890">
                                    @error('telefono_contacto')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Representante -->
                            <div class="mt-4">
                                <label for="representante_legal" class="block texto-azul-itszn font-semibold mb-2">
                                    Persona de Contacto *
                                </label>
                                <input type="text" 
                                       class="form-input @error('representante_legal') border-red-500 @enderror" 
                                       name="representante_legal" 
                                       id="representante_legal" 
                                       value="{{ old('representante_legal') }}"
                                       required
                                       placeholder="Nombre completo">
                                @error('representante_legal')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 section-divider">
                            <i class="fas fa-info-circle me-2"></i>Información Adicional
                        </h6>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- RFC -->
                            <div>
                                <label for="rfc" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-id-card me-2"></i>RFC
                                </label>
                                <input type="text" 
                                       class="form-input @error('rfc') border-red-500 @enderror" 
                                       id="rfc" 
                                       name="rfc" 
                                       value="{{ old('rfc') }}"
                                       placeholder="Ej: STE120304ABC" 
                                       maxlength="13">
                                @error('rfc')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                                <p class="text-gray-500 text-sm mt-2">Máximo 13 caracteres (opcional)</p>
                            </div>

                            <!-- Tamaño de Empresa -->
                            <div>
                                <label for="tamano_empresa" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-users me-2"></i>Tamaño de la Empresa
                                </label>
                                <select class="form-input @error('tamano_empresa') border-red-500 @enderror" 
                                        id="tamano_empresa" name="tamano_empresa">
                                    <option value="">Seleccionar tamaño...</option>
                                    <option value="Micro (1-10 empleados)" {{ old('tamano_empresa') == 'Micro (1-10 empleados)' ? 'selected' : '' }}>Micro (1-10 empleados)</option>
                                    <option value="Pequeña (11-50 empleados)" {{ old('tamano_empresa') == 'Pequeña (11-50 empleados)' ? 'selected' : '' }}>Pequeña (11-50 empleados)</option>
                                    <option value="Mediana (51-250 empleados)" {{ old('tamano_empresa') == 'Mediana (51-250 empleados)' ? 'selected' : '' }}>Mediana (51-250 empleados)</option>
                                    <option value="Grande (251+ empleados)" {{ old('tamano_empresa') == 'Grande (251+ empleados)' ? 'selected' : '' }}>Grande (251+ empleados)</option>
                                </select>
                                @error('tamano_empresa')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Puesto del Representante -->
                            <div>
                                <label for="puesto_representante" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-briefcase me-2"></i>Puesto del Contacto
                                </label>
                                <input type="text" 
                                       class="form-input @error('puesto_representante') border-red-500 @enderror" 
                                       id="puesto_representante" 
                                       name="puesto_representante" 
                                       value="{{ old('puesto_representante') }}"
                                       placeholder="Ej: Director General, Gerente">
                                @error('puesto_representante')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Dirección -->
                            <div>
                                <label for="direccion" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-map-marker-alt me-2"></i>Dirección
                                </label>
                                <input type="text" 
                                       class="form-input @error('direccion') border-red-500 @enderror" 
                                       id="direccion" 
                                       name="direccion" 
                                       value="{{ old('direccion') }}"
                                       placeholder="Ej: Av. Principal #123, Col. Centro">
                                @error('direccion')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Página Web -->
                            <div>
                                <label for="pagina_web" class="block texto-azul-itszn font-semibold mb-2">
                                    <i class="fas fa-globe me-2"></i>Página Web
                                </label>
                                <input type="url" 
                                       class="form-input @error('pagina_web') border-red-500 @enderror" 
                                       id="pagina_web" 
                                       name="pagina_web" 
                                       value="{{ old('pagina_web') }}"
                                       placeholder="https://www.ejemplo.com">
                                @error('pagina_web')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Descripción de Empresa -->
                        <div class="mt-6">
                            <label for="descripcion_empresa" class="block texto-azul-itszn font-semibold mb-2">
                                <i class="fas fa-file-alt me-2"></i>Descripción de la Empresa
                            </label>
                            <textarea class="form-input @error('descripcion_empresa') border-red-500 @enderror" 
                                      id="descripcion_empresa" 
                                      name="descripcion_empresa" 
                                      rows="3"
                                      placeholder="Breve descripción de las actividades de la empresa...">{{ old('descripcion_empresa') }}</textarea>
                            @error('descripcion_empresa')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Configuración -->
                    <div class="mb-8">
                        <h6 class="texto-azul-itszn text-lg font-semibold mb-4 section-divider">
                            <i class="fas fa-cogs me-2"></i>Configuración
                        </h6>
                        
                        <div class="info-card bg-gray-50 rounded-lg p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <input class="form-check-input h-5 w-5" 
                                       type="checkbox" 
                                       id="auto_aprobada" 
                                       name="auto_aprobada" 
                                       value="1" 
                                       checked
                                       disabled>
                                <label class="font-semibold flex items-center gap-2" for="auto_aprobada">
                                    <i class="fas fa-check-circle text-green-600"></i>
                                    Empresa aprobada automáticamente
                                </label>
                            </div>
                            <p class="text-gray-600 text-sm">
                                <i class="fas fa-info-circle me-2"></i>
                                Las empresas registradas por administrador se aprueban automáticamente.
                            </p>
                        </div>
                    </div>

                    <!-- Botones de Acción -->
                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t">
                        <div>
                            <a href="{{ route('admin.empresas.todas') }}" 
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
                                <i class="fas fa-save"></i>
                                <span>Registrar Empresa</span>
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
                            <i class="fas fa-envelope text-blue-600"></i>
                            <span>El email de contacto se usará para el acceso al sistema</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-id-card text-gray-600"></i>
                            <span>El RFC es opcional (máximo 13 caracteres si se proporciona)</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-lock text-green-600"></i>
                            <span>La contraseña debe tener mínimo 8 caracteres</span>
                        </li>
                        <li class="flex items-center gap-2">
                            <i class="fas fa-check-circle text-green-600"></i>
                            <span>La empresa tendrá acceso inmediato al sistema</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Validación de RFC (solo mayúsculas y números)
        const rfcInput = document.getElementById('rfc');
        if (rfcInput) {
            rfcInput.addEventListener('input', function() {
                this.value = this.value.toUpperCase().replace(/[^A-Z0-9]/g, '');
            });
        }
        
        // Validación de contraseñas
        const password = document.getElementById('password');
        const passwordConfirm = document.getElementById('password_confirmation');
        
        function validatePasswords() {
            if (password.value && passwordConfirm.value) {
                if (password.value !== passwordConfirm.value) {
                    passwordConfirm.classList.add('border-red-500');
                } else {
                    passwordConfirm.classList.remove('border-red-500');
                }
            }
        }
        
        password.addEventListener('input', validatePasswords);
        passwordConfirm.addEventListener('input', validatePasswords);
        
        // Validación del formulario
        document.getElementById('empresaForm').addEventListener('submit', function(e) {
            // Validar contraseñas
            if (password.value !== passwordConfirm.value) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                password.focus();
                return;
            }
            
            // Validar longitud mínima de contraseña
            if (password.value.length < 8) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 8 caracteres');
                password.focus();
                return;
            }
            
            // Validar RFC si se proporciona
            if (rfcInput.value && rfcInput.value.length > 13) {
                e.preventDefault();
                alert('El RFC no puede tener más de 13 caracteres');
                rfcInput.focus();
                return;
            }
        });
    });
    
    // Función para mostrar/ocultar contraseña
    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const toggle = field.nextElementSibling;
        
        if (field.type === 'password') {
            field.type = 'text';
            toggle.innerHTML = '<i class="fas fa-eye-slash"></i>';
        } else {
            field.type = 'password';
            toggle.innerHTML = '<i class="fas fa-eye"></i>';
        }
    }
    </script>
</body>
</html>