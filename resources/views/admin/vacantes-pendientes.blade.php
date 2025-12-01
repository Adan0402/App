<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vacantes Pendientes - Admin ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">📋 Vacantes Pendientes de Aprobación</h1>
                    <p class="text-gray-600">Panel de Administración ITSZN</p>
                </div>
                <div class="space-x-4">
                    <a href="/dashboard" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                        ← Dashboard
                    </a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-8">
        <!-- Mensajes -->
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

        <!-- Estadísticas -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="text-center">
                    <p class="text-2xl font-bold text-yellow-600">{{ $vacantesPendientes->count() }}</p>
                    <p class="text-sm text-gray-600">Pendientes</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\Vacante::where('estado', 'aprobada')->count() }}</p>
                    <p class="text-sm text-gray-600">Aprobadas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-red-600">{{ \App\Models\Vacante::where('estado', 'rechazada')->count() }}</p>
                    <p class="text-sm text-gray-600">Rechazadas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-purple-600">{{ \App\Models\Vacante::count() }}</p>
                    <p class="text-sm text-gray-600">Total Vacantes</p>
                </div>
            </div>
        </div>

        @if($vacantesPendientes->count() > 0)
            <div class="space-y-6">
                @foreach($vacantesPendientes as $vacante)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $vacante->titulo }}</h3>
                            <p class="text-gray-600 mt-1">
                                <strong>🏢 Empresa:</strong> {{ $vacante->empresa->nombre_empresa }}
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-3">
                                <p class="text-gray-600">
                                    <strong>📍 Ubicación:</strong> {{ $vacante->ubicacion }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>💼 Contrato:</strong> {{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>🏢 Modalidad:</strong> {{ ucfirst($vacante->modalidad) }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>👥 Vacantes:</strong> {{ $vacante->vacantes_disponibles }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>🎯 Experiencia:</strong> {{ ucfirst(str_replace('_', ' ', $vacante->nivel_experiencia)) }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>📅 Fecha límite:</strong> {{ $vacante->fecha_limite->format('d/m/Y') }}
                                </p>
                            </div>

                            @if($vacante->salario_min && $vacante->salario_max)
                            <p class="text-gray-600 mt-2">
                                <strong>💰 Salario:</strong> ${{ number_format($vacante->salario_min, 2) }} - ${{ number_format($vacante->salario_max, 2) }}
                            </p>
                            @endif
                        </div>
                        <div class="ml-4 text-right">
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                ⏳ Pendiente
                            </span>
                            <p class="text-sm text-gray-500 mt-2">
                                Publicada: {{ $vacante->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <!-- Descripción y Requisitos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold text-gray-700 mb-2">📝 Descripción:</h4>
                            <p class="text-gray-700 text-sm">{{ Str::limit($vacante->descripcion, 200) }}</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-lg">
                            <h4 class="font-semibold text-gray-700 mb-2">🎓 Requisitos:</h4>
                            <p class="text-gray-700 text-sm">{{ Str::limit($vacante->requisitos, 200) }}</p>
                        </div>
                    </div>

                    @if($vacante->beneficios)
                    <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-semibold text-blue-700 mb-2">⭐ Beneficios:</h4>
                        <p class="text-blue-700 text-sm">{{ $vacante->beneficios }}</p>
                    </div>
                    @endif

                    <!-- Acciones -->
                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200">
                        <form action="{{ route('admin.vacantes.aprobar', $vacante) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-medium flex items-center">
                                <span class="mr-2">✅</span>
                                Aprobar Vacante
                            </button>
                        </form>
                        
                        <button type="button" 
                                onclick="mostrarModalRechazo('{{ $vacante->id }}', '{{ $vacante->titulo }}')"
                                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                            <span class="mr-2">❌</span>
                            Rechazar Vacante
                        </button>

                        <a href="mailto:{{ $vacante->empresa->correo_contacto }}?subject=Vacante%20{{ urlencode($vacante->titulo) }}&body=Estimado/a%20{{ urlencode($vacante->empresa->representante_legal) }}%2C%0A%0A" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center">
                            <span class="mr-2">📧</span>
                            Contactar Empresa
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">🎉</div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">¡No hay vacantes pendientes!</h2>
                <p class="text-gray-600 text-lg mb-6">Todas las vacantes han sido procesadas.</p>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 max-w-md mx-auto">
                    <p class="text-green-700">
                        <strong>Estado actual:</strong><br>
                        ✅ <strong>{{ \App\Models\Vacante::where('estado', 'aprobada')->count() }}</strong> vacantes aprobadas<br>
                        ❌ <strong>{{ \App\Models\Vacante::where('estado', 'rechazada')->count() }}</strong> vacantes rechazadas
                    </p>
                </div>
                <a href="/dashboard" class="inline-block mt-6 bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                    ← Volver al Dashboard
                </a>
            </div>
        @endif
    </div>

    <!-- Modal para rechazar -->
    <div id="modalRechazo" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white p-6 rounded-lg w-full max-w-md">
            <h3 class="text-xl font-semibold mb-2">❌ Rechazar Vacante</h3>
            <p id="vacanteTitulo" class="text-gray-600 mb-4"></p>
            <form id="formRechazo" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        Motivo del rechazo: *
                    </label>
                    <textarea name="motivo_rechazo" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                              rows="4" required
                              placeholder="Explica detalladamente por qué rechazas esta vacante..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Mínimo 10 caracteres. Este mensaje se registrará en el sistema.</p>
                </div>
                <div class="flex space-x-4">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition font-medium">
                        Confirmar Rechazo
                    </button>
                    <button type="button" 
                            onclick="cerrarModal()"
                            class="bg-gray-600 text-white px-6 py-2 rounded hover:bg-gray-700 transition font-medium">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function mostrarModalRechazo(vacanteId, vacanteTitulo) {
            const modal = document.getElementById('modalRechazo');
            const form = document.getElementById('formRechazo');
            const tituloVacante = document.getElementById('vacanteTitulo');
            
            form.action = `/admin/vacantes/${vacanteId}/rechazar`;
            tituloVacante.textContent = `Vacante: ${vacanteTitulo}`;
            modal.classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modalRechazo').classList.add('hidden');
        }

        document.getElementById('modalRechazo').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });
    </script>
</body>
</html>