<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $empresa->nombre_empresa }} - Detalles - ITSZN</title>
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
        
        /* Foto de empresa */
        .empresa-foto {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .empresa-foto-placeholder {
            width: 8rem;
            height: 8rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 2rem;
            border: 4px solid #e2e8f0;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Modal para foto en grande */
        .photo-modal {
            background-color: rgba(0, 0, 0, 0.9);
            cursor: pointer;
        }
        
        .photo-modal-content {
            max-width: 90vw;
            max-height: 90vh;
            animation: zoomIn 0.3s ease-out;
        }
        
        @keyframes zoomIn {
            from { transform: scale(0.8); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
        
        .photo-modal-img {
            max-width: 100%;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 8px;
        }
        
        .close-photo-modal {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s ease;
            z-index: 1001;
        }
        
        .close-photo-modal:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: rotate(90deg);
        }
        
        /* Badges de estado */
        .badge-pendiente {
            background-color: #fef3c7;
            color: #92400e;
            border: 1px solid #fbbf24;
        }
        
        .badge-aprobada {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
        }
        
        .badge-rechazada {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #ef4444;
        }
        
        /* Tarjetas de información */
        .info-box {
            background: white;
            border-radius: 0.75rem;
            padding: 1.5rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            border: 1px solid #e5e7eb;
            transition: all 0.3s ease;
        }
        
        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        
        .info-label {
            color: #6b7280;
            font-size: 0.875rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .info-value {
            color: #1f2937;
            font-size: 1rem;
            font-weight: 500;
            margin-top: 0.25rem;
        }
        
        /* Grid de información */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
        }
        
        /* Secciones */
        .section-header {
            border-bottom: 2px solid #1B396A;
            padding-bottom: 0.75rem;
            margin-bottom: 1.5rem;
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
                            <i class="fas fa-eye mr-2"></i>
                            Detalles de Empresa
                        </span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Botones de acción -->
        <div class="flex flex-wrap gap-3 mb-6 fade-in">
            <a href="{{ route('admin.empresas.todas') }}" class="btn-itszn-secundario inline-flex items-center gap-2">
                <i class="fas fa-arrow-left"></i>
                Volver a Empresas
            </a>
            
            @if($empresa->estado == 'pendiente')
            <form action="{{ route('admin.empresas.aprobar', $empresa->id) }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="btn-itszn inline-flex items-center gap-2 bg-green-600 border-green-600"
                        onclick="return confirm('¿Aprobar esta empresa?')">
                    <i class="fas fa-check"></i>
                    Aprobar Empresa
                </button>
            </form>
            
            <button type="button" 
                    class="btn-itszn-secundario inline-flex items-center gap-2 border-red-600 text-red-600 hover:bg-red-50"
                    onclick="showRejectModal('{{ $empresa->id }}', '{{ $empresa->nombre_empresa }}')">
                <i class="fas fa-times"></i>
                Rechazar Empresa
            </button>
            @endif
            
            <a href="{{ route('admin.empresas.editar', $empresa) }}" 
               class="btn-itszn inline-flex items-center gap-2">
                <i class="fas fa-edit"></i>
                Editar Empresa
            </a>
            
            <button type="button" 
                    class="btn-itszn-secundario inline-flex items-center gap-2 border-red-600 text-red-600 hover:bg-red-50"
                    onclick="showDeleteModal('{{ $empresa->id }}', '{{ $empresa->nombre_empresa }}')">
                <i class="fas fa-trash"></i>
                Eliminar Empresa
            </button>
        </div>

        <!-- Tarjeta principal -->
        <div class="info-card bg-white rounded-lg shadow-lg overflow-hidden fade-in mb-6">
            <!-- Header con foto y nombre -->
            <div class="px-6 py-8 border-b border-gray-200">
                <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                    <!-- Foto de la empresa -->
                    <div class="relative">
                        @if($empresa->logo_path)
                        <img src="{{ Storage::url($empresa->logo_path) }}" 
                             alt="{{ $empresa->nombre_empresa }}"
                             class="empresa-foto cursor-pointer"
                             onclick="showPhotoModal('{{ Storage::url($empresa->logo_path) }}', '{{ $empresa->nombre_empresa }}')"
                             onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden')">
                        <div class="empresa-foto-placeholder cursor-pointer hidden"
                             onclick="showPhotoModal('', '{{ $empresa->nombre_empresa }}')">
                            {{ substr($empresa->nombre_empresa, 0, 2) }}
                        </div>
                        @else
                        <div class="empresa-foto-placeholder cursor-pointer"
                             onclick="showPhotoModal('', '{{ $empresa->nombre_empresa }}')">
                            {{ substr($empresa->nombre_empresa, 0, 2) }}
                        </div>
                        @endif
                    </div>
                    
                    <!-- Información principal -->
                    <div class="flex-1">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <h1 class="text-2xl lg:text-3xl font-bold texto-azul-itszn">
                                    {{ $empresa->nombre_empresa }}
                                </h1>
                                <p class="text-gray-600 mt-1">{{ $empresa->tipo_negocio }}</p>
                            </div>
                            
                            <!-- Estado de la empresa -->
                            <div class="flex items-center gap-3">
                                @if($empresa->estado == 'aprobada')
                                <span class="badge-aprobada px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2">
                                    <i class="fas fa-check-circle"></i>
                                    Aprobada
                                </span>
                                @elseif($empresa->estado == 'pendiente')
                                <span class="badge-pendiente px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2 pulse">
                                    <i class="fas fa-clock"></i>
                                    Pendiente
                                </span>
                                @elseif($empresa->estado == 'rechazada')
                                <span class="badge-rechazada px-4 py-2 rounded-full text-sm font-semibold inline-flex items-center gap-2">
                                    <i class="fas fa-times-circle"></i>
                                    Rechazada
                                </span>
                                @endif
                                
                                <!-- ID de empresa -->
                                <span class="px-3 py-1 bg-blue-100 texto-azul-itszn rounded-full text-sm font-medium">
                                    ID: {{ str_pad($empresa->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </div>
                        </div>
                        
                        <!-- Información resumida -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div class="info-box">
                                <span class="info-label">RFC</span>
                                <p class="info-value">
                                    {{ $empresa->rfc ?: 'No especificado' }}
                                    @if($empresa->rfc && $empresa->constancia_fiscal_path)
                                    <a href="{{ Storage::url($empresa->constancia_fiscal_path) }}" 
                                       target="_blank"
                                       class="text-xs text-blue-600 hover:underline ml-2">
                                        <i class="fas fa-file-pdf"></i> Ver constancia
                                    </a>
                                    @endif
                                </p>
                            </div>
                            
                            <div class="info-box">
                                <span class="info-label">Representante</span>
                                <p class="info-value">{{ $empresa->representante_legal ?: 'No especificado' }}</p>
                            </div>
                            
                            <div class="info-box">
                                <span class="info-label">Teléfono</span>
                                <p class="info-value">{{ $empresa->telefono_contacto }}</p>
                            </div>
                            
                            <div class="info-box">
                                <span class="info-label">Email</span>
                                <p class="info-value">{{ $empresa->correo_contacto }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Contenido principal -->
            <div class="p-6">
                <!-- Sección: Información General -->
                <div class="mb-8 fade-in" style="animation-delay: 0.1s">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            Información General
                        </h3>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-box">
                            <span class="info-label">Tamaño de Empresa</span>
                            <p class="info-value">{{ $empresa->tamano_empresa ?: 'No especificado' }}</p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Puesto del Representante</span>
                            <p class="info-value">{{ $empresa->puesto_representante ?: 'No especificado' }}</p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Página Web</span>
                            <p class="info-value">
                                @if($empresa->pagina_web)
                                <a href="{{ $empresa->pagina_web }}" 
                                   target="_blank"
                                   class="text-blue-600 hover:underline">
                                    {{ $empresa->pagina_web }}
                                    <i class="fas fa-external-link-alt ml-1 text-xs"></i>
                                </a>
                                @else
                                No especificada
                                @endif
                            </p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Dirección</span>
                            <p class="info-value">{{ $empresa->direccion ?: 'No especificada' }}</p>
                        </div>
                    </div>
                    
                    <!-- Descripción -->
                    @if($empresa->descripcion_empresa)
                    <div class="info-box mt-4">
                        <span class="info-label">Descripción de la Empresa</span>
                        <p class="info-value mt-2 text-gray-700 leading-relaxed whitespace-pre-line">
                            {{ $empresa->descripcion_empresa }}
                        </p>
                    </div>
                    @endif
                </div>
                
                <!-- Sección: Datos de Registro -->
                <div class="mb-8 fade-in" style="animation-delay: 0.2s">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                            <i class="fas fa-history"></i>
                            Datos de Registro
                        </h3>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-box">
                            <span class="info-label">Fecha de Registro</span>
                            <p class="info-value">{{ $empresa->created_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $empresa->created_at->format('h:i A') }}</p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Última Actualización</span>
                            <p class="info-value">{{ $empresa->updated_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $empresa->updated_at->diffForHumans() }}</p>
                        </div>
                        
                        @if($empresa->estado != 'pendiente')
                        <div class="info-box">
                            <span class="info-label">Revisado Por</span>
                            <p class="info-value">{{ $empresa->revisor->name ?? 'Administrador' }}</p>
                            <p class="text-xs text-gray-500">{{ $empresa->fecha_revision ? \Carbon\Carbon::parse($empresa->fecha_revision)->format('d/m/Y') : 'Sin revisión' }}</p>
                        </div>
                        
                        @if($empresa->estado == 'rechazada' && $empresa->motivo_rechazo)
                        <div class="info-box">
                            <span class="info-label">Motivo de Rechazo</span>
                            <p class="info-value text-red-600">{{ $empresa->motivo_rechazo }}</p>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
                
                <!-- Sección: Usuario Administrador -->
                @if($empresa->user)
                <div class="mb-8 fade-in" style="animation-delay: 0.3s">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                            <i class="fas fa-user-shield"></i>
                            Usuario Administrador
                        </h3>
                    </div>
                    
                    <div class="info-grid">
                        <div class="info-box">
                            <span class="info-label">Nombre del Administrador</span>
                            <p class="info-value">{{ $empresa->user->name }}</p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Email de Acceso</span>
                            <p class="info-value">{{ $empresa->user->email }}</p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Rol</span>
                            <p class="info-value">
                                <span class="px-2 py-1 bg-blue-100 texto-azul-itszn rounded-full text-xs">
                                    {{ ucfirst($empresa->user->role) }}
                                </span>
                            </p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Cuenta Creada</span>
                            <p class="info-value">{{ $empresa->user->created_at->format('d/m/Y') }}</p>
                            <p class="text-xs text-gray-500">{{ $empresa->user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Sección: Estadísticas -->
                <div class="fade-in" style="animation-delay: 0.4s">
                    <div class="section-header">
                        <h3 class="text-lg font-semibold texto-azul-itszn flex items-center gap-2">
                            <i class="fas fa-chart-bar"></i>
                            Estadísticas
                        </h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div class="info-box">
                            <span class="info-label">Vacantes Totales</span>
                            <p class="info-value text-2xl font-bold">{{ $empresa->vacantes->count() }}</p>
                            <div class="mt-2 flex gap-2">
                                @if($empresa->vacantes->where('estado', 'aprobada')->count() > 0)
                                <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded-full">
                                    {{ $empresa->vacantes->where('estado', 'aprobada')->count() }} aprobadas
                                </span>
                                @endif
                                @if($empresa->vacantes->where('estado', 'pendiente')->count() > 0)
                                <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">
                                    {{ $empresa->vacantes->where('estado', 'pendiente')->count() }} pendientes
                                </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Servicios Sociales</span>
                            <p class="info-value text-2xl font-bold">
                                {{ $empresa->serviciosSociales->count() ?? 0 }}
                            </p>
                            @if($empresa->serviciosSociales)
                            <div class="mt-2 flex flex-wrap gap-1">
                                @php
                                    $estadosSS = $empresa->serviciosSociales->groupBy('estado');
                                @endphp
                                @foreach($estadosSS as $estado => $servicios)
                                <span class="text-xs bg-blue-100 texto-azul-itszn px-2 py-1 rounded-full">
                                    {{ $servicios->count() }} {{ $estado }}
                                </span>
                                @endforeach
                            </div>
                            @endif
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Registrado Hace</span>
                            <p class="info-value text-2xl font-bold">{{ $empresa->created_at->diffForHumans() }}</p>
                            <p class="text-xs text-gray-500 mt-1">{{ $empresa->created_at->format('d/m/Y') }}</p>
                        </div>
                        
                        <div class="info-box">
                            <span class="info-label">Estado Actual</span>
                            <div class="flex items-center gap-2">
                                @if($empresa->estado == 'aprobada')
                                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                                <span class="info-value text-green-600">Activa</span>
                                @elseif($empresa->estado == 'pendiente')
                                <div class="w-3 h-3 bg-yellow-500 rounded-full animate-pulse"></div>
                                <span class="info-value text-yellow-600">En revisión</span>
                                @else
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="info-value text-red-600">Inactiva</span>
                                @endif
                            </div>
                            @if($empresa->revisor)
                            <p class="text-xs text-gray-500 mt-1">Revisado por: {{ $empresa->revisor->name }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Botón para imprimir -->
        <div class="text-center mt-6">
            <button onclick="window.print()" 
                    class="btn-itszn-secundario inline-flex items-center gap-2">
                <i class="fas fa-print"></i>
                Imprimir Detalles
            </button>
        </div>
    </div>

    <!-- ✅ MODAL PARA FOTO EN GRANDE -->
    <div id="photoModal" class="photo-modal fixed inset-0 hidden items-center justify-center z-[1000]">
        <button class="close-photo-modal" onclick="closePhotoModal()">
            ✕
        </button>
        <div class="photo-modal-content" onclick="closePhotoModal()">
            <img id="photoModalImg" src="" alt="" class="photo-modal-img">
            <div id="photoModalInfo" class="text-white text-center p-4">
                <h3 class="font-semibold"></h3>
                <p class="text-sm opacity-80"></p>
            </div>
        </div>
    </div>

    <!-- Modal para rechazar -->
    <div id="rejectModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-lg p-6 w-full max-w-md">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center">
                    <span class="text-xl text-red-600">❌</span>
                </div>
                <div>
                    <h3 class="text-lg font-semibold texto-azul-itszn">Rechazar Empresa</h3>
                    <p id="rejectCompanyName" class="text-gray-600"></p>
                </div>
            </div>
            <form id="rejectForm" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block texto-azul-itszn text-sm font-medium mb-2">Motivo del rechazo:</label>
                    <textarea name="motivo_rechazo" 
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition"
                              rows="3"
                              placeholder="Ingresa el motivo del rechazo..."
                              required></textarea>
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
                        Rechazar Empresa
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
                    <span class="text-2xl text-red-600">🗑️</span>
                </div>
                <h3 class="text-xl font-semibold texto-azul-itszn mb-2">Eliminar Empresa</h3>
                <p class="text-gray-600 mb-4">¿Estás seguro de eliminar permanentemente a <span id="deleteCompanyName" class="font-semibold"></span>?</p>
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                    <div class="flex items-start gap-2">
                        <span class="text-yellow-600">⚠️</span>
                        <div class="text-sm">
                            <p class="font-medium text-yellow-800">¡Advertencia!</p>
                            <p class="text-yellow-700">Esta acción no se puede deshacer. Se eliminarán todas las vacantes y datos asociados.</p>
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
    // ✅ FUNCIONES PARA MODALES DE FOTO
    function showPhotoModal(photoUrl, companyName) {
        const modal = document.getElementById('photoModal');
        const img = document.getElementById('photoModalImg');
        const info = document.getElementById('photoModalInfo');
        
        if (photoUrl) {
            img.src = photoUrl;
            img.classList.remove('hidden');
            info.innerHTML = `<h3 class="font-semibold">${companyName}</h3><p class="text-sm opacity-80">Logo de la empresa</p>`;
        } else {
            img.classList.add('hidden');
            info.innerHTML = `<h3 class="font-semibold">${companyName}</h3><p class="text-sm opacity-80">No hay logo disponible</p>`;
        }
        
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closePhotoModal() {
        document.getElementById('photoModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // ✅ FUNCIONES PARA MODALES ORIGINALES
    function showRejectModal(companyId, companyName) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        const nameSpan = document.getElementById('rejectCompanyName');
        
        nameSpan.textContent = companyName;
        form.action = `/admin/empresas/${companyId}/rechazar`;
        modal.classList.remove('hidden');
    }

    function showDeleteModal(companyId, companyName) {
        const modal = document.getElementById('deleteModal');
        const form = document.getElementById('deleteForm');
        const nameSpan = document.getElementById('deleteCompanyName');
        
        nameSpan.textContent = companyName;
        form.action = `/admin/empresas/${companyId}/eliminar`;
        modal.classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // ✅ CERRAR MODALES CON ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePhotoModal();
            closeModal('rejectModal');
            closeModal('deleteModal');
        }
    });

    // ✅ CERRAR MODALES AL HACER CLIC FUERA
    document.addEventListener('click', function(e) {
        const modals = ['rejectModal', 'deleteModal', 'photoModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && !modal.classList.contains('hidden') && e.target === modal) {
                closeModal(modalId);
            }
        });
    });

    // ✅ ANIMACIONES
    document.addEventListener('DOMContentLoaded', function() {
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.1}s`;
        });
        
        // Smooth scroll para impresión
        window.addEventListener('beforeprint', function() {
            window.scrollTo(0, 0);
        });
    });
    </script>
</body>
</html>