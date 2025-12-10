<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de Vacante - ITSZN</title>
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
        
        .badge-estado {
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-weight: 600;
        }
        
        .badge-aprobada { background-color: #D1FAE5; color: #065F46; }
        .badge-pendiente { background-color: #FEF3C7; color: #92400E; }
        .badge-rechazada { background-color: #FEE2E2; color: #991B1B; }
        
        .tipo-contrato {
            display: inline-block;
            padding: 0.5rem 1rem;
            background-color: #EFF6FF;
            color: #1B396A;
            border-radius: 0.5rem;
            font-weight: 500;
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
                        <h1 class="text-2xl font-bold">Detalles de Vacante</h1>
                        <p>Sistema Integral de Servicio Social - ITSZN</p>
                    </div>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.vacantes.todas') }}" 
                       class="btn-itszn-secundario flex items-center gap-2 text-sm">
                        <i class="fas fa-arrow-left"></i>
                        <span>Volver</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start lg:items-center mb-6 fade-in">
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                        <span class="text-2xl texto-azul-itszn">💼</span>
                    </div>
                    <div>
                        <h1 class="text-2xl lg:text-3xl font-bold texto-azul-itszn">{{ $vacante->titulo }}</h1>
                        <p class="text-gray-600">{{ $vacante->empresa->nombre_empresa ?? 'Empresa no especificada' }}</p>
                    </div>
                </div>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.vacantes.editar', $vacante) }}" 
                   class="btn-itszn-secundario flex items-center gap-2">
                    <i class="fas fa-edit"></i>
                    <span>Editar</span>
                </a>
                @if($vacante->estado == 'pendiente')
                <form action="{{ route('admin.vacantes.aprobar', $vacante) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" 
                            class="btn-itszn flex items-center gap-2 bg-green-600 hover:bg-green-700 border-green-600"
                            onclick="return confirm('¿Aprobar esta vacante?')">
                        <i class="fas fa-check"></i>
                        <span>Aprobar</span>
                    </button>
                </form>
                @endif
            </div>
        </div>

        <!-- Estado y Urgente -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            <div class="flex items-center gap-4">
                <!-- Estado -->
                @if($vacante->estado == 'aprobada')
                <div class="badge-estado badge-aprobada flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    <span>Aprobada</span>
                </div>
                @elseif($vacante->estado == 'pendiente')
                <div class="badge-estado badge-pendiente flex items-center gap-2">
                    <i class="fas fa-clock"></i>
                    <span>Pendiente</span>
                </div>
                @elseif($vacante->estado == 'rechazada')
                <div class="badge-estado badge-rechazada flex items-center gap-2">
                    <i class="fas fa-times-circle"></i>
                    <span>Rechazada</span>
                </div>
                @endif

                <!-- Urgente -->
                @if($vacante->es_urgente)
                <div class="bg-red-100 text-red-800 px-3 py-1 rounded-full flex items-center gap-2">
                    <i class="fas fa-exclamation-circle"></i>
                    <span class="font-medium">Urgente</span>
                </div>
                @endif
            </div>

            <!-- Fechas -->
            <div class="text-sm text-gray-600 flex flex-col items-end">
                <div class="flex items-center gap-2">
                    <span>Publicada: {{ $vacante->created_at->format('d/m/Y') }}</span>
                </div>
                @if($vacante->fecha_aprobacion)
                <div class="flex items-center gap-2">
                    <span>Aprobada: {{ $vacante->fecha_aprobacion->format('d/m/Y') }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Información Principal -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
            <!-- Información Básica -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Descripción -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                        <i class="fas fa-align-left"></i>
                        <span>Descripción del Puesto</span>
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $vacante->descripcion }}</p>
                    </div>
                </div>

                <!-- Requisitos -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                        <i class="fas fa-list-check"></i>
                        <span>Requisitos</span>
                    </h3>
                    <div class="prose max-w-none">
                        <ul class="list-disc pl-5 space-y-2 text-gray-700">
                            @foreach(explode("\n", $vacante->requisitos) as $requisito)
                                @if(trim($requisito))
                                <li>{{ trim($requisito) }}</li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Beneficios -->
                @if($vacante->beneficios)
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                        <i class="fas fa-gift"></i>
                        <span>Beneficios</span>
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 whitespace-pre-line">{{ $vacante->beneficios }}</p>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar con Detalles -->
            <div class="space-y-6">
                <!-- Detalles de la Vacante -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                        <i class="fas fa-info-circle"></i>
                        <span>Detalles de la Vacante</span>
                    </h3>
                    
                    <div class="space-y-4">
                        <!-- Empresa -->
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-building texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Empresa</p>
                                <p class="text-gray-900">{{ $vacante->empresa->nombre_empresa ?? 'No especificada' }}</p>
                                @if($vacante->empresa)
                                <p class="text-sm text-gray-600 mt-1">{{ $vacante->empresa->correo_contacto ?? '' }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Tipo de Contrato -->
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-file-contract texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Tipo de Contrato</p>
                                <p class="tipo-contrato">{{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}</p>
                            </div>
                        </div>

                        <!-- Modalidad -->
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-laptop-house texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Modalidad</p>
                                <p class="text-gray-900">{{ ucfirst($vacante->modalidad) }}</p>
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-map-marker-alt texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Ubicación</p>
                                <p class="text-gray-900">{{ $vacante->ubicacion }}</p>
                            </div>
                        </div>

                        <!-- Salario -->
                        @if($vacante->salario)
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-money-bill-wave texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Salario</p>
                                <p class="text-gray-900">{{ $vacante->salario }}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Número de Vacantes -->
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-user-plus texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Número de Vacantes</p>
                                <p class="text-gray-900">{{ $vacante->numero_vacantes }}</p>
                            </div>
                        </div>

                        <!-- Fecha Límite -->
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-calendar-times texto-azul-itszn"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium texto-azul-itszn">Fecha Límite</p>
                                <p class="text-gray-900">{{ $vacante->fecha_limite->format('d/m/Y') }}</p>
                                <p class="text-sm text-gray-600 mt-1">
                                    @if($vacante->fecha_limite->isPast())
                                        <span class="text-red-600">Vencida</span>
                                    @else
                                        {{ $vacante->fecha_limite->diffForHumans() }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadísticas</span>
                    </h3>
                    
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Postulaciones</span>
                            <span class="font-semibold texto-azul-itszn">{{ $vacante->postulaciones_count ?? 0 }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Vacantes disponibles</span>
                            <span class="font-semibold texto-azul-itszn">{{ $vacante->numero_vacantes }}</span>
                        </div>
                        
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Días restantes</span>
                            <span class="font-semibold {{ $vacante->fecha_limite->isPast() ? 'text-red-600' : 'text-green-600' }}">
                                {{ max(0, now()->diffInDays($vacante->fecha_limite, false)) }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Acciones -->
                <div class="info-card bg-white rounded-lg shadow-lg p-6 fade-in">
                    <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                        <i class="fas fa-cogs"></i>
                        <span>Acciones</span>
                    </h3>
                    
                    <div class="space-y-3">
                        <a href="{{ route('admin.vacantes.mostrar', $vacante) }}" 
                           class="btn-itszn-secundario w-full flex items-center justify-center gap-2">
                            <i class="fas fa-edit"></i>
                            <span>Editar Vacante</span>
                        </a>
                        
                        @if($vacante->estado == 'pendiente')
                        <form action="{{ route('admin.vacantes.aprobar', $vacante) }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit" 
                                    class="btn-itszn w-full flex items-center justify-center gap-2 bg-green-600 hover:bg-green-700 border-green-600"
                                    onclick="return confirm('¿Aprobar esta vacante?')">
                                <i class="fas fa-check"></i>
                                <span>Aprobar Vacante</span>
                            </button>
                        </form>
                        
                        <button type="button" 
                                onclick="showRejectModal()"
                                class="btn-itszn-secundario w-full flex items-center justify-center gap-2 text-red-600 border-red-600 hover:bg-red-50">
                            <i class="fas fa-times"></i>
                            <span>Rechazar Vacante</span>
                        </button>
                        @endif
                        
                        <button type="button" 
                                onclick="showDeleteModal()"
                                class="btn-itszn-secundario w-full flex items-center justify-center gap-2 text-red-600 border-red-600 hover:bg-red-50">
                            <i class="fas fa-trash"></i>
                            <span>Eliminar Vacante</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Postulaciones (si hay) -->
        @if(isset($vacante->postulaciones) && $vacante->postulaciones->count() > 0)
        <div class="info-card bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
            <h3 class="text-lg font-semibold texto-azul-itszn mb-4 flex items-center gap-2">
                <i class="fas fa-users"></i>
                <span>Postulaciones ({{ $vacante->postulaciones->count() }})</span>
            </h3>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Alumno
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Fecha
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($vacante->postulaciones as $postulacion)
                        <tr>
                            <td class="px-4 py-3">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">{{ $postulacion->user->name ?? 'Usuario no encontrado' }}</p>
                                        <p class="text-xs text-gray-500">{{ $postulacion->alumno->email ?? '' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-900">
                                {{ $postulacion->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-4 py-3">
                                @if($postulacion->estado == 'pendiente')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pendiente
                                </span>
                                @elseif($postulacion->estado == 'aprobada')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Aprobada
                                </span>
                                @elseif($postulacion->estado == 'rechazada')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    Rechazada
                                </span>
                                @endif
                            </td>
                            <td class="px-4 py-3">
                                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">
                                    Ver detalles
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
    </div>

    <!-- Modales -->
    <!-- Modal para rechazar -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-times text-xl text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold texto-azul-itszn">Rechazar Vacante</h3>
                    <p class="text-gray-600">"{{ $vacante->titulo }}"</p>
                </div>
            </div>
            <form action="{{ route('admin.vacantes.rechazar', $vacante) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block texto-azul-itszn text-sm font-medium mb-2">Motivo del rechazo:</label>
                    <textarea name="motivo_rechazo" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none"
                              rows="3"
                              required
                              placeholder="Ingresa el motivo del rechazo..."></textarea>
                </div>
                <div class="flex gap-3">
                    <button type="button" 
                            onclick="closeModal('rejectModal')"
                            class="btn-itszn-secundario flex-1">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex-1">
                        Rechazar Vacante
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para eliminar -->
    <div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trash text-2xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold texto-azul-itszn mb-2">Eliminar Vacante</h3>
                <p class="text-gray-600 mb-4">¿Estás seguro de eliminar permanentemente la vacante <span class="font-semibold">"{{ $vacante->titulo }}"</span>?</p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                        <div class="text-sm">
                            <p class="font-medium text-yellow-800">¡Advertencia!</p>
                            <p class="text-yellow-700">Esta acción no se puede deshacer. Se eliminarán todas las postulaciones asociadas.</p>
                        </div>
                    </div>
                </div>
                <form action="{{ route('admin.vacantes.eliminar', $vacante) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex gap-3">
                        <button type="button" 
                                onclick="closeModal('deleteModal')"
                                class="btn-itszn-secundario flex-1">
                            Cancelar
                        </button>
                        <button type="submit" 
                                class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 transition font-medium flex-1">
                            Eliminar Permanentemente
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    function showRejectModal() {
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function showDeleteModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Cerrar modales con ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('rejectModal');
            closeModal('deleteModal');
        }
    });

    // Cerrar modales al hacer clic fuera
    document.addEventListener('click', function(e) {
        const modals = ['rejectModal', 'deleteModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && !modal.classList.contains('hidden') && e.target === modal) {
                closeModal(modalId);
            }
        });
    });
    </script>
</body>
</html>