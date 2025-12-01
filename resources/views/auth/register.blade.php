<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Bolsa de Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .azul-itszn { background-color: #1B396A; }
        .azul-itszn-claro { background-color: #2D4F8A; }
        .texto-azul-itszn { color: #1B396A; }
        .borde-azul-itszn { border-color: #1B396A; }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="max-w-md w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Encabezado institucional -->
            <div class="azul-itszn text-white p-4 text-center">
                <div class="flex items-center justify-center mb-2">
                    <img src="{{ asset('images/logo-tecnm.png') }}" 
                         alt="TecNM Logo" 
                         class="h-12 w-12 mr-3 bg-white rounded-lg p-1">
                    <div>
                        <h1 class="text-lg font-bold">Instituto Tecnológico Superior</h1>
                        <p class="text-sm opacity-90">de Rio Grande</p>
                    </div>
                </div>
            </div>

            <!-- Contenido del registro -->
            <div class="p-6">
                <div class="text-center mb-6">
                    <!-- Logo del TecNM -->
                    <div class="mx-auto mb-3 flex items-center justify-center">
                        <img src="{{ asset('images/logo-tecnm.png') }}" 
                             alt="TecNM Logo" 
                             class="h-16 w-16">
                    </div>
                    <h2 class="text-xl font-bold texto-azul-itszn">Bolsa de Trabajo</h2>
                    <p class="text-gray-600 text-sm">Crea tu cuenta</p>
                </div>

                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Tipo de Cuenta -->
                    <div class="mb-4">
                        <label for="tipo" class="block texto-azul-itszn text-sm font-bold mb-2">
                            👤 Tipo de Cuenta
                        </label>
                        <select name="tipo" id="tipo" 
                                class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                required>
                            <option value="">Selecciona tu tipo de cuenta</option>
                            <option value="alumno" {{ old('tipo') == 'alumno' ? 'selected' : '' }}>Alumno ITSZN</option>
                            <option value="egresado" {{ old('tipo') == 'egresado' ? 'selected' : '' }}>Egresado ITSZN</option>
                            <option value="empresa" {{ old('tipo') == 'empresa' ? 'selected' : '' }}>Empresa</option>
                        </select>
                    </div>

                    <!-- Nombre -->
                    <div class="mb-4">
                        <label for="name" class="block texto-azul-itszn text-sm font-bold mb-2">
                            👤 Nombre Completo
                        </label>
                        <input id="name" type="text" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               name="name" value="{{ old('name') }}" required
                               placeholder="Tu nombre completo">
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block texto-azul-itszn text-sm font-bold mb-2">
                            📧 Correo Electrónico
                        </label>
                        <input id="email" type="email" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               name="email" value="{{ old('email') }}" required
                               placeholder="usuario@itszn.edu.mx">
                    </div>

                    <!-- Campos para Alumnos/Egresados -->
                    <div id="campos-alumno" style="display: none;">
                        <!-- Número de Control -->
                        <div class="mb-4">
                            <label for="numero_control" class="block texto-azul-itszn text-sm font-bold mb-2">
                                🔢 Número de Control ITSZN
                            </label>
                            <input id="numero_control" type="text" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   name="numero_control" value="{{ old('numero_control') }}"
                                   placeholder="Ej: 21010104"
                                   maxlength="8" pattern="[0-9]{8}">
                            <p class="text-xs text-gray-500 mt-1">8 dígitos exactos</p>
                        </div>

                        <!-- Carrera -->
                        <div class="mb-4">
                            <label for="carrera" class="block texto-azul-itszn text-sm font-bold mb-2">
                                🎓 Carrera
                            </label>
                            <select name="carrera" id="carrera" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option value="">Selecciona tu carrera</option>
                                <option value="Ingeniería en Sistemas Computacionales">Sistemas Computacionales</option>
                                <option value="Ingeniería Industrias Alimenticias">Industrias Alimenticias</option>
                                <option value="Ingeniería en Gestión Empresarial">Gestión Empresarial</option>
                                <option value="Ingeniería en Electrómecanica">Electrómecanica</option>
                                <option value="Ingeniería en Administracion de Empresas">Administración de Empresas</option>
                                <<option value="Ingeniería en Contador Publico">Contador Publico</option>
                            </select>
                        </div>
                    </div>

                    <!-- ✅ CAMPOS PARA EMPRESAS -->
                    <div id="campos-empresa" style="display: none;">
                        <div class="bg-blue-50 p-4 rounded-lg mb-4 border border-blue-200">
                            <h3 class="font-semibold texto-azul-itszn mb-3">🏢 Datos de la Empresa</h3>
                            
                            <!-- Nombre Empresa -->
                            <div class="mb-4">
                                <label for="nombre_empresa" class="block texto-azul-itszn text-sm font-bold mb-2">
                                    Nombre de la Empresa/Negocio *
                                </label>
                                <input type="text" name="nombre_empresa" id="nombre_empresa" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Ej: Mi Tienda, Restaurante...">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <!-- Tipo Negocio -->
                                <div>
                                    <label for="tipo_negocio" class="block texto-azul-itszn text-sm font-bold mb-2">
                                        Tipo de Negocio *
                                    </label>
                                    <select name="tipo_negocio" id="tipo_negocio" 
                                            class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="">Selecciona el tipo</option>
                                        <option value="restaurante">Restaurante/Cafetería</option>
                                        <option value="tienda">Tienda/Comercio</option>
                                        <option value="servicios">Servicios</option>
                                        <option value="taller">Taller</option>
                                        <option value="consultoria">Consultoría</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>

                                <!-- Teléfono -->
                                <div>
                                    <label for="telefono_contacto" class="block texto-azul-itszn text-sm font-bold mb-2">
                                        Teléfono de Contacto *
                                    </label>
                                    <input type="tel" name="telefono_contacto" id="telefono_contacto" 
                                           class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                           placeholder="Ej: 1234567890">
                                </div>
                            </div>

                            <!-- Representante -->
                            <div class="mt-4">
                                <label for="representante_legal" class="block texto-azul-itszn text-sm font-bold mb-2">
                                    Persona de Contacto *
                                </label>
                                <input type="text" name="representante_legal" id="representante_legal" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       placeholder="Nombre completo">
                            </div>
                        </div>
                    </div>

                    <!-- Contraseña -->
                    <div class="mb-4">
                        <label for="password" class="block texto-azul-itszn text-sm font-bold mb-2">
                            🔒 Contraseña
                        </label>
                        <input id="password" type="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               name="password" required
                               placeholder="Mínimo 8 caracteres">
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="mb-6">
                        <label for="password_confirmation" class="block texto-azul-itszn text-sm font-bold mb-2">
                            🔒 Confirmar Contraseña
                        </label>
                        <input id="password_confirmation" type="password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                               name="password_confirmation" required
                               placeholder="Repite tu contraseña">
                    </div>

                    <!-- Botón de Registro -->
                    <button type="submit" 
                            class="w-full azul-itszn text-white py-3 px-4 rounded-lg hover:bg-blue-800 transition-all duration-300 font-semibold shadow-md mb-4">
                        📝 Crear Cuenta
                    </button>
                </form>

                <!-- Enlace para login -->
                <div class="mt-6 text-center">
                    <p class="text-gray-600 text-sm">
                        ¿Ya tienes cuenta? 
                        <a href="{{ route('login') }}" class="texto-azul-itszn hover:text-blue-800 font-medium">
                            Inicia sesión aquí
                        </a>
                    </p>
                </div>
            </div>

            <!-- Footer institucional -->
            <div class="bg-gray-100 border-t border-gray-200 p-3 text-center">
                <p class="text-xs text-gray-600">
                    Sistema de Bolsa de Trabajo - ITSZN
                </p>
                <p class="text-xs text-gray-500 mt-1">
                    Tecnológico Nacional de México
                </p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('tipo').addEventListener('change', function() {
            const tipo = this.value;
            const camposAlumno = document.getElementById('campos-alumno');
            const camposEmpresa = document.getElementById('campos-empresa');
            const numeroControl = document.getElementById('numero_control');
            const carrera = document.getElementById('carrera');
            const nombreEmpresa = document.getElementById('nombre_empresa');
            const tipoNegocio = document.getElementById('tipo_negocio');
            const telefonoContacto = document.getElementById('telefono_contacto');
            const representanteLegal = document.getElementById('representante_legal');
            
            // Ocultar todos primero
            camposAlumno.style.display = 'none';
            camposEmpresa.style.display = 'none';
            
            // Quitar requeridos de todos
            numeroControl.required = false;
            carrera.required = false;
            nombreEmpresa.required = false;
            tipoNegocio.required = false;
            telefonoContacto.required = false;
            representanteLegal.required = false;
            
            // Mostrar y hacer requeridos según el tipo
            if (tipo === 'alumno' || tipo === 'egresado') {
                camposAlumno.style.display = 'block';
                numeroControl.required = true;
                carrera.required = true;
            } else if (tipo === 'empresa') {
                camposEmpresa.style.display = 'block';
                nombreEmpresa.required = true;
                tipoNegocio.required = true;
                telefonoContacto.required = true;
                representanteLegal.required = true;
            }
        });

        // Ejecutar al cargar la página por si hay valores antiguos
        document.addEventListener('DOMContentLoaded', function() {
            const tipo = document.getElementById('tipo').value;
            if (tipo === 'alumno' || tipo === 'egresado') {
                document.getElementById('campos-alumno').style.display = 'block';
            } else if (tipo === 'empresa') {
                document.getElementById('campos-empresa').style.display = 'block';
            }
        });
    </script>
</body>
</html>