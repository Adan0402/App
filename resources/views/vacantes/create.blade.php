<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publicar Vacante - Bolsa Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">📋 Publicar Nueva Vacante</h1>
                    <p class="text-gray-600">{{ $user->empresa->nombre_empresa }}</p>
                </div>
                <div class="space-x-4">
                    <a href="/dashboard" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ← Dashboard
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            @if($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded mb-6">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('vacantes.store') }}" method="POST" class="bg-white rounded-lg shadow-md p-6">
                @csrf
                
                <!-- Información Básica -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">📝 Información de la Vacante</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Título -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Título de la vacante *
                            </label>
                            <input type="text" name="titulo" value="{{ old('titulo') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Ej: Desarrollador Web Frontend"
                                   required>
                        </div>

                        <!-- Descripción -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Descripción del puesto *
                            </label>
                            <textarea name="descripcion" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Describe las funciones y responsabilidades del puesto..."
                                      required>{{ old('descripcion') }}</textarea>
                        </div>

                        <!-- Requisitos -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Requisitos *
                            </label>
                            <textarea name="requisitos" rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Lista los requisitos educativos, técnicos y de experiencia..."
                                      required>{{ old('requisitos') }}</textarea>
                        </div>

                        <!-- Beneficios -->
                        <div class="md:col-span-2">
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Beneficios (opcional)
                            </label>
                            <textarea name="beneficios" rows="3"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                      placeholder="Seguro médico, prestaciones, bonos, etc.">{{ old('beneficios') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Detalles del Empleo -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">💼 Detalles del Empleo</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tipo de Contrato -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Tipo de contrato *
                            </label>
                            <select name="tipo_contrato" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Seleccionar...</option>
                                <option value="tiempo_completo" {{ old('tipo_contrato') == 'tiempo_completo' ? 'selected' : '' }}>Tiempo Completo</option>
                                <option value="medio_tiempo" {{ old('tipo_contrato') == 'medio_tiempo' ? 'selected' : '' }}>Medio Tiempo</option>
                                <option value="practicas" {{ old('tipo_contrato') == 'practicas' ? 'selected' : '' }}>Prácticas Profesionales</option>
                                <option value="freelance" {{ old('tipo_contrato') == 'freelance' ? 'selected' : '' }}>Freelance</option>
                                <option value="proyecto" {{ old('tipo_contrato') == 'proyecto' ? 'selected' : '' }}>Por Proyecto</option>
                            </select>
                        </div>

                        <!-- Modalidad -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Modalidad de trabajo *
                            </label>
                            <select name="modalidad" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Seleccionar...</option>
                                <option value="presencial" {{ old('modalidad') == 'presencial' ? 'selected' : '' }}>Presencial</option>
                                <option value="remoto" {{ old('modalidad') == 'remoto' ? 'selected' : '' }}>Remoto</option>
                                <option value="hibrido" {{ old('modalidad') == 'hibrido' ? 'selected' : '' }}>Híbrido</option>
                            </select>
                        </div>

                        <!-- Ubicación -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Ubicación *
                            </label>
                            <input type="text" name="ubicacion" value="{{ old('ubicacion') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="Ciudad, Estado"
                                   required>
                        </div>

                        <!-- Nivel de Experiencia -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Nivel de experiencia *
                            </label>
                            <select name="nivel_experiencia" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                    required>
                                <option value="">Seleccionar...</option>
                                <option value="sin_experiencia" {{ old('nivel_experiencia') == 'sin_experiencia' ? 'selected' : '' }}>Sin experiencia</option>
                                <option value="junior" {{ old('nivel_experiencia') == 'junior' ? 'selected' : '' }}>Junior (0-2 años)</option>
                                <option value="mid" {{ old('nivel_experiencia') == 'mid' ? 'selected' : '' }}>Mid-level (2-5 años)</option>
                                <option value="senior" {{ old('nivel_experiencia') == 'senior' ? 'selected' : '' }}>Senior (5+ años)</option>
                            </select>
                        </div>

                        <!-- Vacantes Disponibles -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Número de vacantes *
                            </label>
                            <input type="number" name="vacantes_disponibles" value="{{ old('vacantes_disponibles', 1) }}" min="1"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   required>
                        </div>

                        <!-- Fecha Límite -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Fecha límite *
                            </label>
                            <input type="date" name="fecha_limite" value="{{ old('fecha_limite') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   min="{{ date('Y-m-d') }}"
                                   required>
                        </div>
                    </div>
                </div>

                <!-- Información Salarial -->
                <div class="mb-8">
                    <h2 class="text-xl font-semibold mb-4 text-gray-800">💰 Información Salarial</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Salario Mínimo -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Salario mínimo (opcional)
                            </label>
                            <input type="number" name="salario_min" value="{{ old('salario_min') }}" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0.00">
                        </div>

                        <!-- Salario Máximo -->
                        <div>
                            <label class="block text-gray-700 text-sm font-medium mb-2">
                                Salario máximo (opcional)
                            </label>
                            <input type="number" name="salario_max" value="{{ old('salario_max') }}" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                   placeholder="0.00">
                        </div>

                        <!-- Mostrar Salario -->
                        <div class="flex items-end">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" name="salario_mostrar" value="1" 
                                       {{ old('salario_mostrar', true) ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-700 text-sm">Mostrar salario en la publicación</span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-gray-200">
                    <a href="/dashboard" 
                       class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700 transition font-medium">
                        Cancelar
                    </a>
                    <button type="submit" 
                            class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium">
                        📤 Publicar Vacante
                    </button>
                </div>
            </form>

            <!-- Información importante -->
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
                <h3 class="font-semibold text-blue-800 mb-2">📌 Información importante</h3>
                <ul class="text-blue-700 text-sm list-disc list-inside space-y-1">
                    <li>Todas las vacantes serán revisadas por el administrador antes de ser publicadas</li>
                    <li>Recibirás una notificación cuando tu vacante sea aprobada o rechazada</li>
                    <li>Las vacantes tienen una duración máxima de 60 días</li>
                </ul>
            </div>
        </div>
    </div>

    <script>
        // Validación de fechas
        const fechaInput = document.querySelector('input[name="fecha_limite"]');
        const today = new Date().toISOString().split('T')[0];
        fechaInput.min = today;

        // Validación de salarios
        const salarioMin = document.querySelector('input[name="salario_min"]');
        const salarioMax = document.querySelector('input[name="salario_max"]');

        salarioMin.addEventListener('change', function() {
            if(salarioMax.value && parseFloat(this.value) > parseFloat(salarioMax.value)) {
                alert('El salario mínimo no puede ser mayor al salario máximo');
                this.value = '';
            }
        });

        salarioMax.addEventListener('change', function() {
            if(salarioMin.value && parseFloat(this.value) < parseFloat(salarioMin.value)) {
                alert('El salario máximo no puede ser menor al salario mínimo');
                this.value = '';
            }
        });
    </script>
</body>
</html>