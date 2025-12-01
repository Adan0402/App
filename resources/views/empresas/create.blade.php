<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de Empresa - Bolsa Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center py-8">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-2xl">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-blue-600">🏢 Bienvenido - Completa los datos de tu empresa</h1>
                <p class="text-gray-600 mt-2">Como nuevo registro de empresa, necesitamos algunos datos básicos para validar tu cuenta</p>
                <p class="text-sm text-green-600 mt-1">✅ Tu usuario ya está creado, solo falta esta información</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li class="text-sm">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('empresa.store') }}">
                @csrf

                <div class="space-y-6">
                    <!-- Información Básica -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-blue-800 mb-3">📋 Información Básica</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nombre del Negocio -->
                            <div class="md:col-span-2">
                                <label for="nombre_empresa" class="block text-gray-700 text-sm font-medium mb-2">
                                    🏢 Nombre del Negocio/Empresa *
                                </label>
                                <input id="nombre_empresa" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="nombre_empresa" value="{{ old('nombre_empresa') }}" required
                                       placeholder="Ej: Mi Tienda, Restaurante La Familia, Taller Mecánico...">
                            </div>

                            <!-- Tipo de Negocio -->
                            <div>
                                <label for="tipo_negocio" class="block text-gray-700 text-sm font-medium mb-2">
                                    🏷️ Tipo de Negocio *
                                </label>
                                <select id="tipo_negocio" name="tipo_negocio" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Selecciona el tipo</option>
                                    <option value="restaurante" {{ old('tipo_negocio') == 'restaurante' ? 'selected' : '' }}>Restaurante/Cafetería</option>
                                    <option value="tienda" {{ old('tipo_negocio') == 'tienda' ? 'selected' : '' }}>Tienda/Comercio</option>
                                    <option value="servicios" {{ old('tipo_negocio') == 'servicios' ? 'selected' : '' }}>Servicios</option>
                                    <option value="taller" {{ old('tipo_negocio') == 'taller' ? 'selected' : '' }}>Taller</option>
                                    <option value="consultoria" {{ old('tipo_negocio') == 'consultoria' ? 'selected' : '' }}>Consultoría</option>
                                    <option value="manufactura" {{ old('tipo_negocio') == 'manufactura' ? 'selected' : '' }}>Manufactura</option>
                                    <option value="construccion" {{ old('tipo_negocio') == 'construccion' ? 'selected' : '' }}>Construcción</option>
                                    <option value="tecnologia" {{ old('tipo_negocio') == 'tecnologia' ? 'selected' : '' }}>Tecnología</option>
                                    <option value="salud" {{ old('tipo_negocio') == 'salud' ? 'selected' : '' }}>Salud/Belleza</option>
                                    <option value="educacion" {{ old('tipo_negocio') == 'educacion' ? 'selected' : '' }}>Educación</option>
                                    <option value="otro" {{ old('tipo_negocio') == 'otro' ? 'selected' : '' }}>Otro</option>
                                </select>
                            </div>

                            <!-- Tamaño de la Empresa -->
                            <div>
                                <label for="tamano_empresa" class="block text-gray-700 text-sm font-medium mb-2">
                                    👥 Tamaño de la Empresa *
                                </label>
                                <select id="tamano_empresa" name="tamano_empresa" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                                    <option value="">Selecciona</option>
                                    <option value="micro" {{ old('tamano_empresa') == 'micro' ? 'selected' : '' }}>Micro (1-10 empleados)</option>
                                    <option value="pequena" {{ old('tamano_empresa') == 'pequena' ? 'selected' : '' }}>Pequeña (11-50 empleados)</option>
                                    <option value="mediana" {{ old('tamano_empresa') == 'mediana' ? 'selected' : '' }}>Mediana (51-250 empleados)</option>
                                    <option value="grande" {{ old('tamano_empresa') == 'grande' ? 'selected' : '' }}>Grande (+250 empleados)</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Información de Contacto -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-green-800 mb-3">📞 Información de Contacto</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Persona de Contacto -->
                            <div>
                                <label for="representante_legal" class="block text-gray-700 text-sm font-medium mb-2">
                                    👤 Persona de Contacto *
                                </label>
                                <input id="representante_legal" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="representante_legal" value="{{ old('representante_legal') }}" required
                                       placeholder="Nombre de quien los atenderá">
                            </div>

                            <!-- Puesto -->
                            <div>
                                <label for="puesto_representante" class="block text-gray-700 text-sm font-medium mb-2">
                                    💼 Puesto/Cargo *
                                </label>
                                <input id="puesto_representante" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="puesto_representante" value="{{ old('puesto_representante') }}" required
                                       placeholder="Ej: Dueño, Gerente, Encargado...">
                            </div>

                            <!-- Teléfono -->
                            <div>
                                <label for="telefono_contacto" class="block text-gray-700 text-sm font-medium mb-2">
                                    📞 Teléfono de Contacto *
                                </label>
                                <input id="telefono_contacto" type="tel" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="telefono_contacto" value="{{ old('telefono_contacto') }}" required
                                       placeholder="Ej: 1234567890">
                            </div>

                            <!-- Correo -->
                            <div>
                                <label for="correo_contacto" class="block text-gray-700 text-sm font-medium mb-2">
                                    📧 Correo de Contacto *
                                </label>
                                <input id="correo_contacto" type="email" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="correo_contacto" value="{{ old('correo_contacto') }}" required
                                       placeholder="correo@ejemplo.com">
                            </div>
                        </div>
                    </div>

                    <!-- Información Adicional (OPCIONAL) -->
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <h2 class="text-lg font-semibold text-yellow-800 mb-3">ℹ️ Información Adicional (Opcional)</h2>
                        
                        <div class="space-y-4">
                            <!-- RFC -->
                            <div>
                                <label for="rfc" class="block text-gray-700 text-sm font-medium mb-2">
                                    📄 RFC (Si cuenta con él)
                                </label>
                                <input id="rfc" type="text" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="rfc" value="{{ old('rfc') }}"
                                       placeholder="Opcional para pequeños negocios">
                                <p class="text-xs text-gray-500 mt-1">Si eres persona física con actividad empresarial o tienes RFC</p>
                            </div>

                            <!-- Página Web/Redes Sociales -->
                            <div>
                                <label for="pagina_web" class="block text-gray-700 text-sm font-medium mb-2">
                                    🌐 Página Web o Redes Sociales
                                </label>
                                <input id="pagina_web" type="url" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                       name="pagina_web" value="{{ old('pagina_web') }}"
                                       placeholder="https://... o @usuario">
                                <p class="text-xs text-gray-500 mt-1">Facebook, Instagram, página web, etc.</p>
                            </div>

                            <!-- Dirección -->
                            <div>
                                <label for="direccion" class="block text-gray-700 text-sm font-medium mb-2">
                                    📍 Dirección (Zona/Colonia)
                                </label>
                                <textarea id="direccion" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          name="direccion" rows="2"
                                          placeholder="Colonia y municipio, o referencia">{{ old('direccion') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">Solo zona general, no es necesario dirección exacta</p>
                            </div>

                            <!-- Descripción -->
                            <div>
                                <label for="descripcion_empresa" class="block text-gray-700 text-sm font-medium mb-2">
                                    📝 ¿A qué se dedica tu negocio?
                                </label>
                                <textarea id="descripcion_empresa" 
                                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                          name="descripcion_empresa" rows="3"
                                          placeholder="Ej: Vendemos comida mexicana, taller de reparación de celulares, tienda de abarrotes...">{{ old('descripcion_empresa') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="mt-8 flex space-x-4">
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition font-medium">
                        ✅ Guardar y Solicitar Aprobación
                    </button>
                    <a href="/dashboard" 
                       class="flex-1 bg-gray-600 text-white py-3 px-4 rounded-lg hover:bg-gray-700 transition font-medium text-center">
                        ↩️ Volver al Dashboard
                    </a>
                </div>

                <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                    <h3 class="font-semibold text-blue-800 mb-2">📋 Proceso de Aprobación</h3>
                    <ul class="text-sm text-blue-700 space-y-1">
                        <li>• Tu información será revisada por el personal del ITSZN</li>
                        <li>• Recibirás una notificación cuando tu empresa sea aprobada</li>
                        <li>• Una vez aprobada, podrás publicar vacantes</li>
                        <li>• El proceso toma aproximadamente 1-2 días hábiles</li>
                    </ul>
                </div>

                <p class="text-sm text-gray-500 mt-4 text-center">
                    * Solo los campos marcados con asterisco son obligatorios. 
                    Entendemos que los pequeños negocios pueden no tener todos los datos formales.
                </p>
            </form>
        </div>
    </div>
</body>
</html>