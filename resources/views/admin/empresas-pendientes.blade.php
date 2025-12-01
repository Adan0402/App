<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas Pendientes - Admin ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">🏢 Empresas Pendientes de Aprobación</h1>
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
        <!-- Mensajes de éxito/error -->
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
                    <p class="text-2xl font-bold text-blue-600">{{ $empresasPendientes->count() }}</p>
                    <p class="text-sm text-gray-600">Pendientes</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-green-600">{{ \App\Models\Empresa::where('estado', 'aprobada')->count() }}</p>
                    <p class="text-sm text-gray-600">Aprobadas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-red-600">{{ \App\Models\Empresa::where('estado', 'rechazada')->count() }}</p>
                    <p class="text-sm text-gray-600">Rechazadas</p>
                </div>
                <div class="text-center">
                    <p class="text-2xl font-bold text-purple-600">{{ \App\Models\Empresa::count() }}</p>
                    <p class="text-sm text-gray-600">Total Empresas</p>
                </div>
            </div>
        </div>

        @if($empresasPendientes->count() > 0)
            <div class="space-y-6">
                @foreach($empresasPendientes as $empresa)
                <div class="bg-white rounded-lg shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex-1">
                            <h3 class="text-xl font-semibold text-gray-800">{{ $empresa->nombre_empresa }}</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 mt-2">
                                <p class="text-gray-600">
                                    <strong>👤 Representante:</strong> {{ $empresa->representante_legal }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>💼 Puesto:</strong> {{ $empresa->puesto_representante }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>🏷️ Tipo:</strong> 
                                    <span class="capitalize">{{ str_replace('_', ' ', $empresa->tipo_negocio) }}</span>
                                </p>
                                <p class="text-gray-600">
                                    <strong>👥 Tamaño:</strong> 
                                    <span class="capitalize">{{ $empresa->tamano_empresa }}</span>
                                </p>
                                <p class="text-gray-600">
                                    <strong>📞 Teléfono:</strong> {{ $empresa->telefono_contacto }}
                                </p>
                                <p class="text-gray-600">
                                    <strong>📧 Email:</strong> {{ $empresa->correo_contacto }}
                                </p>
                            </div>
                            
                            @if($empresa->rfc)
                            <p class="text-gray-600 mt-2">
                                <strong>📄 RFC:</strong> {{ $empresa->rfc }}
                            </p>
                            @endif

                            @if($empresa->direccion)
                            <p class="text-gray-600 mt-2">
                                <strong>📍 Dirección:</strong> {{ $empresa->direccion }}
                            </p>
                            @endif

                            @if($empresa->pagina_web)
                            <p class="text-gray-600 mt-2">
                                <strong>🌐 Web/Redes:</strong> 
                                <a href="{{ $empresa->pagina_web }}" target="_blank" class="text-blue-600 hover:underline">
                                    {{ $empresa->pagina_web }}
                                </a>
                            </p>
                            @endif
                        </div>
                        <div class="ml-4 text-right">
                            <span class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-medium">
                                ⏳ Pendiente
                            </span>
                            <p class="text-sm text-gray-500 mt-2">
                                Registrada: {{ $empresa->created_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>

                    @if($empresa->descripcion_empresa)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                        <h4 class="font-semibold text-gray-700 mb-2">📝 Descripción de la Empresa:</h4>
                        <p class="text-gray-700">{{ $empresa->descripcion_empresa }}</p>
                    </div>
                    @endif

                    <!-- Información del Usuario Registrado -->
                    <div class="mb-4 p-4 bg-blue-50 rounded-lg">
                        <h4 class="font-semibold text-blue-700 mb-2">👤 Usuario de Acceso:</h4>
                        <p class="text-blue-700">
                            <strong>Nombre:</strong> {{ $empresa->user->name }} | 
                            <strong>Email:</strong> {{ $empresa->user->email }} |
                            <strong>Registrado:</strong> {{ $empresa->user->created_at->format('d/m/Y') }}
                        </p>
                    </div>

                    <!-- Acciones -->
                    <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200">
                        <form action="{{ route('admin.empresas.aprobar', $empresa) }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700 transition font-medium flex items-center">
                                <span class="mr-2">✅</span>
                                Aprobar Empresa
                            </button>
                        </form>
                        
                        <button type="button" 
                                onclick="mostrarModalRechazo('{{ $empresa->id }}', '{{ $empresa->nombre_empresa }}')"
                                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex items-center">
                            <span class="mr-2">❌</span>
                            Rechazar Empresa
                        </button>

                        <a href="mailto:{{ $empresa->correo_contacto }}?subject=Validación%20de%20Empresa%20ITSZN&body=Estimado/a%20{{ urlencode($empresa->representante_legal) }}%2C%0A%0A" 
                           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition font-medium flex items-center">
                            <span class="mr-2">📧</span>
                            Contactar
                        </a>

                        <a href="tel:{{ $empresa->telefono_contacto }}" 
                           class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition font-medium flex items-center">
                            <span class="mr-2">📞</span>
                            Llamar
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <div class="text-6xl mb-4">🎉</div>
                <h2 class="text-3xl font-bold text-gray-800 mb-4">¡No hay empresas pendientes!</h2>
                <p class="text-gray-600 text-lg mb-6">Todas las solicitudes de empresas han sido procesadas.</p>
                <div class="bg-green-50 border border-green-200 rounded-lg p-6 max-w-md mx-auto">
                    <p class="text-green-700">
                        <strong>Estado actual:</strong><br>
                        ✅ <strong>{{ \App\Models\Empresa::where('estado', 'aprobada')->count() }}</strong> empresas aprobadas<br>
                        ❌ <strong>{{ \App\Models\Empresa::where('estado', 'rechazada')->count() }}</strong> empresas rechazadas
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
            <h3 class="text-xl font-semibold mb-2">❌ Rechazar Empresa</h3>
            <p id="empresaNombre" class="text-gray-600 mb-4"></p>
            <form id="formRechazo" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-medium mb-2">
                        Motivo del rechazo: *
                    </label>
                    <textarea name="motivo_rechazo" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500"
                              rows="4" required
                              placeholder="Explica detalladamente por qué rechazas esta empresa..."></textarea>
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
        function mostrarModalRechazo(empresaId, empresaNombre) {
            const modal = document.getElementById('modalRechazo');
            const form = document.getElementById('formRechazo');
            const nombreEmpresa = document.getElementById('empresaNombre');
            
            form.action = `/admin/empresas/${empresaId}/rechazar`;
            nombreEmpresa.textContent = `Empresa: ${empresaNombre}`;
            modal.classList.remove('hidden');
        }

        function cerrarModal() {
            document.getElementById('modalRechazo').classList.add('hidden');
        }

        // Cerrar modal al hacer clic fuera
        document.getElementById('modalRechazo').addEventListener('click', function(e) {
            if (e.target === this) {
                cerrarModal();
            }
        });

        // Cerrar modal con ESC
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                cerrarModal();
            }
        });
    </script>
</body>
</html>