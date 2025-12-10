<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Vacantes - ITSZN</title>
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
        
        .badge-estado {
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 600;
        }
        
        .badge-aprobada { background-color: #D1FAE5; color: #065F46; }
        .badge-pendiente { background-color: #FEF3C7; color: #92400E; }
        .badge-rechazada { background-color: #FEE2E2; color: #991B1B; }
        
        .table-row:hover {
            background-color: #f8fafc;
        }
        
        .modal-itszn {
            display: flex;
            animation: fadeIn 0.3s ease-in;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- ENCABEZADO INSTITUCIONAL PARA GESTIÓN DE VACANTES -->
<header class="header-institucional shadow-sm">
    <div class="container mx-auto px-4 py-4">
        <div class="flex justify-between items-center">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <span class="text-xl">💼</span>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">Gestión de Vacantes</h1>
                    <p class="text-white/80">Sistema Integral de Servicio Social - ITSZN</p>
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

<!-- Breadcrumb para la página INDEX/LISTADO de vacantes -->
<div class="container mx-auto px-4 py-4">
    <nav class="flex mb-6 fade-in" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <a href="/dashboard" class="inline-flex items-center text-sm font-medium texto-azul-itszn hover:text-blue-700">
                    <i class="fas fa-home mr-2"></i>
                    Dashboard
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500">
                        <i class="fas fa-briefcase mr-2"></i>
                        Vacantes
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="flex justify-between items-start lg:items-center mb-6 fade-in">
            <div>
                <h1 class="text-2xl lg:text-3xl font-bold texto-azul-itszn mb-2">
                    <i class="fas fa-briefcase me-2"></i>Gestión de Vacantes
                </h1>
                <p class="text-gray-600">Administra todas las vacantes publicadas en el sistema ITSZN</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.vacantes.crear') }}" 
                   class="btn-itszn flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Nueva Vacante</span>
                </a>
                <a href="{{ route('admin.vacantes.pendientes') }}" 
                   class="btn-itszn-secundario flex items-center gap-2">
                    <i class="fas fa-clock"></i>
                    <span>Vacantes Pendientes</span>
                    @php
                        $pendientesCount = \App\Models\Vacante::where('estado', 'pendiente')->count();
                    @endphp
                    @if($pendientesCount > 0)
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold">
                        {{ $pendientesCount }}
                    </span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="info-card bg-white rounded-lg shadow-sm p-5 fade-in">
                <div class="flex items-center">
                    <div class="bg-blue-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl texto-azul-itszn">💼</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Vacantes</p>
                        <p class="text-2xl font-bold texto-azul-itszn">{{ $vacantes->total() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="info-card bg-white rounded-lg shadow-sm p-5 fade-in">
                <div class="flex items-center">
                    <div class="bg-green-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl text-green-600">✅</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Aprobadas</p>
                        <p class="text-2xl font-bold texto-azul-itszn">
                            {{ \App\Models\Vacante::where('estado', 'aprobada')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="info-card bg-white rounded-lg shadow-sm p-5 fade-in">
                <div class="flex items-center">
                    <div class="bg-yellow-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl text-yellow-600">⏳</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pendientes</p>
                        <p class="text-2xl font-bold texto-azul-itszn">
                            {{ \App\Models\Vacante::where('estado', 'pendiente')->count() }}
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="info-card bg-white rounded-lg shadow-sm p-5 fade-in">
                <div class="flex items-center">
                    <div class="bg-blue-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl texto-azul-itszn">🏢</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Con Empresa</p>
                        <p class="text-2xl font-bold texto-azul-itszn">
                            {{ \App\Models\Vacante::distinct('empresa_id')->count('empresa_id') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla principal -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden fade-in">
            <!-- Header de tabla -->
            <div class="px-6 py-4 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                    <div>
                        <h2 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                            <span>📋</span>
                            <span>Lista de Vacantes</span>
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">
                            {{ $vacantes->total() }} vacantes registradas en el sistema
                        </p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <button class="btn-itszn-secundario flex items-center gap-2 px-4 py-2" 
                                    onclick="toggleFilterMenu()">
                                <span>🔍</span>
                                <span>Filtrar</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Título
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Empresa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Tipo
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Ubicación
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Fecha Límite
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($vacantes as $index => $vacante)
                        <tr class="table-row transition-colors fade-in">
                            <!-- Título -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-blue-50 rounded-lg flex items-center justify-center mr-3">
                                        <span class="texto-azul-itszn">💼</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.vacantes.mostrar', $vacante) }}" 
                                           class="text-sm font-medium texto-azul-itszn hover:text-blue-700">
                                            {{ $vacante->titulo }}
                                        </a>
                                        <div class="flex items-center gap-2 mt-1">
                                            <span class="text-xs text-gray-500">{{ $vacante->tipo_contrato }}</span>
                                            @if($vacante->es_urgente)
                                            <span class="text-xs bg-red-100 text-red-800 px-2 py-0.5 rounded-full">
                                                Urgente
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Empresa -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-2">
                                        <span class="text-blue-600">🏢</span>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ $vacante->empresa->nombre_empresa ?? 'Sin empresa' }}
                                        </p>
                                        <p class="text-xs text-gray-500">
                                            {{ $vacante->empresa->correo_contacto ?? 'Sin contacto' }}
                                        </p>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Tipo -->
                            <td class="px-6 py-4">
                                <div class="flex flex-col">
                                    <span class="text-sm text-gray-900">{{ $vacante->tipo_contrato }}</span>
                                    <span class="text-xs text-gray-500">{{ $vacante->modalidad }}</span>
                                </div>
                            </td>
                            
                            <!-- Ubicación -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <span class="text-gray-400 mr-2">📍</span>
                                    <span class="text-sm">{{ $vacante->ubicacion }}</span>
                                </div>
                            </td>
                            
                            <!-- Estado -->
                            <td class="px-6 py-4">
                                @if($vacante->estado == 'aprobada')
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-600">✅</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-green-600">Aprobada</span>
                                        @if($vacante->fecha_aprobacion)
                                        <p class="text-xs text-gray-500">{{ $vacante->fecha_aprobacion->format('d/m/Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @elseif($vacante->estado == 'pendiente')
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <span class="text-yellow-600">⏳</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-yellow-600">Pendiente</span>
                                        <p class="text-xs text-gray-500">{{ $vacante->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @elseif($vacante->estado == 'rechazada')
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-red-600">❌</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-red-600">Rechazada</span>
                                        @if($vacante->motivo_rechazo)
                                        <p class="text-xs text-gray-500 cursor-help" title="{{ $vacante->motivo_rechazo }}">
                                            Ver motivo
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </td>
                            
                            <!-- Fecha Límite -->
                            <td class="px-6 py-4">
                                <div class="text-sm">
                                    <div class="font-medium texto-azul-itszn">{{ $vacante->fecha_limite->format('d/m/Y') }}</div>
                                    <div class="text-gray-500">
                                        @if($vacante->fecha_limite->isPast())
                                        <span class="text-red-600">Vencida</span>
                                        @else
                                        <span>{{ $vacante->fecha_limite->diffForHumans() }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Acciones -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <!-- Ver detalles -->
                                    <a href="{{ route('admin.vacantes.mostrar', $vacante) }}" 
                                       class="action-btn bg-blue-100 texto-azul-itszn hover:bg-blue-200 rounded-lg p-2 transition"
                                       title="Ver detalles">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    
                                    <!-- Editar -->
                                    <a href="{{ route('admin.vacantes.editar', $vacante) }}" 
                                       class="action-btn bg-yellow-100 text-yellow-600 hover:bg-yellow-200 rounded-lg p-2 transition"
                                       title="Editar vacante">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    
                                    <!-- Aprobar/Rechazar -->
                                    @if($vacante->estado == 'pendiente')
                                    <form action="{{ route('admin.vacantes.aprobar', $vacante) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="action-btn bg-green-100 text-green-600 hover:bg-green-200 rounded-lg p-2 transition"
                                                title="Aprobar vacante"
                                                onclick="return confirm('¿Aprobar esta vacante?')">
                                            <i class="fas fa-check"></i>
                                        </button>
                                    </form>
                                    <button type="button" 
                                            class="action-btn bg-red-100 text-red-600 hover:bg-red-200 rounded-lg p-2 transition"
                                            onclick="showRejectModal('{{ $vacante->id }}', '{{ $vacante->titulo }}')"
                                            title="Rechazar vacante">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                    
                                    <!-- Eliminar -->
                                    <button type="button" 
                                            class="action-btn bg-red-100 text-red-600 hover:bg-red-200 rounded-lg p-2 transition"
                                            onclick="showDeleteModal('{{ $vacante->id }}', '{{ $vacante->titulo }}')"
                                            title="Eliminar vacante">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <span class="text-4xl text-gray-400">💼</span>
                                    </div>
                                    <h3 class="text-lg font-medium texto-azul-itszn mb-2">No hay vacantes registradas</h3>
                                    <p class="text-gray-600 mb-6">Comienza publicando una nueva vacante</p>
                                    <a href="{{ route('admin.vacantes.crear') }}" 
                                       class="btn-itszn inline-flex items-center gap-2 px-6 py-3">
                                        <i class="fas fa-plus"></i>
                                        <span>Publicar Primera Vacante</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($vacantes->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-700">
                        <span>📋</span>
                        Mostrando <span class="font-semibold">{{ $vacantes->firstItem() }}</span> a 
                        <span class="font-semibold">{{ $vacantes->lastItem() }}</span> de 
                        <span class="font-semibold">{{ $vacantes->total() }}</span> vacantes
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $vacantes->links() }}
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Modal para rechazar -->
    <div id="rejectModal" class="modal-itszn fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-times text-xl text-red-600"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold texto-azul-itszn">Rechazar Vacante</h3>
                    <p id="rejectVacanteTitle" class="text-gray-600"></p>
                </div>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block texto-azul-itszn text-sm font-medium mb-2">Motivo del rechazo:</label>
                    <textarea name="motivo_rechazo" 
                              class="form-input w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                              rows="3"
                              required
                              placeholder="Ingresa el motivo del rechazo..."></textarea>
                    <p class="text-xs text-gray-500 mt-1">Este motivo será visible para la empresa.</p>
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
    <div id="deleteModal" class="modal-itszn fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="text-center">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-trash text-2xl text-red-600"></i>
                </div>
                <h3 class="text-xl font-semibold texto-azul-itszn mb-2">Eliminar Vacante</h3>
                <p class="text-gray-600 mb-4">¿Estás seguro de eliminar permanentemente la vacante <span id="deleteVacanteTitle" class="font-semibold"></span>?</p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-2">
                        <i class="fas fa-exclamation-triangle text-yellow-600 mt-1"></i>
                        <div class="text-sm">
                            <p class="font-medium text-yellow-800">¡Advertencia!</p>
                            <p class="text-yellow-700">Esta acción no se puede deshacer. Se eliminarán todas las postulaciones asociadas.</p>
                        </div>
                    </div>
                </div>
                <form id="deleteForm" method="POST">
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
    // ✅ FUNCIONES PARA MODALES
    function showRejectModal(vacanteId, vacanteTitle) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        const titleSpan = document.getElementById('rejectVacanteTitle');
        
        titleSpan.textContent = `"${vacanteTitle}"`;
        form.action = `/admin/vacantes/${vacanteId}/rechazar`;
        modal.classList.remove('hidden');
    }

    function showDeleteModal(vacanteId, vacanteTitle) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const titleSpan = document.getElementById('deleteVacanteTitle');
        
        titleSpan.textContent = `"${vacanteTitle}"`;
        form.action = `/admin/vacantes/${vacanteId}/eliminar`;
        modal.classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // ✅ CERRAR MODALES CON ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal('rejectModal');
            closeModal('deleteModal');
        }
    });

    // ✅ CERRAR MODALES AL HACER CLIC FUERA
    document.addEventListener('click', function(e) {
        const modals = ['rejectModal', 'deleteModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && !modal.classList.contains('hidden') && e.target === modal) {
                closeModal(modalId);
            }
        });
    });

    // ✅ ANIMACIONES
    document.addEventListener('DOMContentLoaded', function() {
        // Animación escalonada para elementos
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.05}s`;
        });
    });
    </script>
</body>
</html>