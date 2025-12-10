<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empresas - ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
        
        .pulse {
            animation: pulseSoft 2s infinite;
        }
        
        @keyframes pulseSoft {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }
        
        .action-btn:hover {
            transform: scale(1.1);
        }
        
        .modal-itszn {
            display: flex;
            animation: fadeIn 0.3s ease-in;
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
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        /* ✅ FOTO REDONDA */
        .empresa-img {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #e2e8f0;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .empresa-img:hover {
            transform: scale(1.05);
            border-color: #1B396A;
            box-shadow: 0 4px 12px rgba(27, 57, 106, 0.2);
        }
        
        .empresa-img-placeholder {
            width: 3rem;
            height: 3rem;
            border-radius: 50%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .empresa-img-placeholder:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.3);
        }
        
        /* ✅ MODAL DE FOTO EN GRANDE (estilo WhatsApp) */
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
        
        .photo-modal-info {
            color: white;
            text-align: center;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.7);
            border-radius: 0 0 8px 8px;
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
                        <i class="fas fa-building mr-2"></i>
                        Empresas
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="container mx-auto px-4 py-6">
        <!-- Header con gradiente ITSZN -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4 mb-6 fade-in">
            <div class="flex items-center gap-3">
                <div class="bg-blue-50 p-3 rounded-full shadow-sm">
                    <div class="w-12 h-12 flex items-center justify-center">
                        <span class="text-2xl texto-azul-itszn">🏢</span>
                    </div>
                </div>
                <div>
                    <h1 class="text-2xl lg:text-3xl font-bold texto-azul-itszn">Gestión de Empresas</h1>
                    <p class="text-gray-600 mt-1">Administra todas las empresas registradas en el sistema ITSZN</p>
                </div>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('admin.empresas.crear') }}" 
                   class="btn-itszn flex items-center gap-2 px-4 py-3">
                    <span>➕</span>
                    <span class="font-medium">Nueva Empresa</span>
                </a>
                <a href="{{ route('admin.empresas.pendientes') }}" 
                   class="btn-itszn-secundario flex items-center gap-2 px-4 py-3">
                    <span>⏰</span>
                    <span class="font-medium">Pendientes</span>
                    @php
                        $pendientesCount = \App\Models\Empresa::where('estado', 'pendiente')->count();
                    @endphp
                    @if($pendientesCount > 0)
                    <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full text-xs font-bold pulse">
                        {{ $pendientesCount }}
                    </span>
                    @endif
                </a>
            </div>
        </div>

        <!-- Card de filtros -->
        <div class="info-card bg-white rounded-lg shadow-lg p-6 mb-6 fade-in">
            <div class="flex items-center gap-2 mb-4">
                <span class="text-xl texto-azul-itszn">🔍</span>
                <h2 class="text-lg font-semibold texto-azul-itszn">Filtros de Búsqueda</h2>
            </div>
            <form method="GET" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block texto-azul-itszn text-sm font-medium mb-2">Buscar</label>
                        <div class="relative">
                            <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400">🔎</span>
                            <input type="text" name="search" 
                                   class="form-input pl-10"
                                   placeholder="Empresa, representante o RFC..." 
                                   value="{{ request('search') }}">
                        </div>
                    </div>
                    <div>
                        <label class="block texto-azul-itszn text-sm font-medium mb-2">Estado</label>
                        <select name="estado" class="form-input">
                            <option value="">Todos los estados</option>
                            <option value="aprobada" {{ request('estado') == 'aprobada' ? 'selected' : '' }}>
                                ✅ Aprobadas
                            </option>
                            <option value="pendiente" {{ request('estado') == 'pendiente' ? 'selected' : '' }}>
                                ⏳ Pendientes
                            </option>
                            <option value="rechazada" {{ request('estado') == 'rechazada' ? 'selected' : '' }}>
                                ❌ Rechazadas
                            </option>
                        </select>
                    </div>
                    <div>
                        <label class="block texto-azul-itszn text-sm font-medium mb-2">Ordenar por</label>
                        <select name="sort" class="form-input">
                            <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Más recientes</option>
                            <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Más antiguas</option>
                            <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nombre (A-Z)</option>
                            <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nombre (Z-A)</option>
                        </select>
                    </div>
                    <div class="flex items-end space-x-2">
                        <button type="submit" class="btn-itszn flex-1 flex items-center justify-center gap-2">
                            <span>✅</span>
                            <span>Filtrar</span>
                        </button>
                        <a href="{{ route('admin.empresas.todas') }}" 
                           class="btn-itszn-secundario p-3" title="Limpiar filtros">
                            <span>🔄</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tarjetas de estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="stat-card bg-white rounded-lg shadow-lg p-5 fade-in" style="animation-delay: 0.1s">
                <div class="flex items-center">
                    <div class="bg-blue-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl texto-azul-itszn">🏢</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Total Empresas</p>
                        <p class="text-2xl font-bold texto-azul-itszn">{{ $empresas->total() }}</p>
                        <p class="text-xs text-green-600 mt-1">
                            ↑ {{ \App\Models\Empresa::where('created_at', '>=', now()->subMonth())->count() }} este mes
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="stat-card bg-white rounded-lg shadow-lg p-5 fade-in" style="animation-delay: 0.2s">
                <div class="flex items-center">
                    <div class="bg-green-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl text-green-600">✅</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Aprobadas</p>
                        <p class="text-2xl font-bold texto-azul-itszn">
                            {{ \App\Models\Empresa::where('estado', 'aprobada')->count() }}
                        </p>
                        <div class="mt-2">
                            <div class="h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-green-500" 
                                     style="width: {{ (\App\Models\Empresa::where('estado', 'aprobada')->count() / max($empresas->total(), 1)) * 100 }}%">
                                </div>
                            </div>
                            <p class="text-xs text-green-600 mt-1">
                                {{ number_format((\App\Models\Empresa::where('estado', 'aprobada')->count() / max($empresas->total(), 1)) * 100, 1) }}% del total
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="stat-card bg-white rounded-lg shadow-lg p-5 fade-in" style="animation-delay: 0.3s">
                <div class="flex items-center">
                    <div class="bg-yellow-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl text-yellow-600">⏰</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Pendientes</p>
                        <p class="text-2xl font-bold texto-azul-itszn">
                            {{ \App\Models\Empresa::where('estado', 'pendiente')->count() }}
                        </p>
                        <div class="mt-2">
                            <div class="h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-yellow-500" 
                                     style="width: {{ (\App\Models\Empresa::where('estado', 'pendiente')->count() / max($empresas->total(), 1)) * 100 }}%">
                                </div>
                            </div>
                            <p class="text-xs text-yellow-600 mt-1">
                                {{ \App\Models\Empresa::where('estado', 'pendiente')->where('created_at', '>=', now()->subDays(7))->count() }} nuevas esta semana
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="stat-card bg-white rounded-lg shadow-lg p-5 fade-in" style="animation-delay: 0.4s">
                <div class="flex items-center">
                    <div class="bg-blue-50 p-3 rounded-lg mr-4">
                        <span class="text-2xl texto-azul-itszn">📅</span>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Hoy</p>
                        <p class="text-2xl font-bold texto-azul-itszn">
                            {{ \App\Models\Empresa::whereDate('created_at', today())->count() }}
                        </p>
                        <div class="mt-2">
                            <div class="h-1 bg-gray-200 rounded-full overflow-hidden">
                                <div class="h-full bg-blue-600" 
                                     style="width: {{ (\App\Models\Empresa::whereDate('created_at', today())->count() / max($empresas->total(), 1)) * 100 }}%">
                                </div>
                            </div>
                            <p class="text-xs texto-azul-itszn mt-1">
                                {{ \App\Models\Empresa::whereDate('updated_at', today())->count() }} actualizadas
                            </p>
                        </div>
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
                            <span>Lista de Empresas</span>
                        </h2>
                        <p class="text-gray-600 text-sm mt-1">
                            {{ $empresas->total() }} empresas registradas en el sistema
                        </p>
                    </div>
                </div>
            </div>

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Empresa
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Representante Legal
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Contacto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Estado
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Registro
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-semibold texto-azul-itszn uppercase tracking-wider">
                                Acciones
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($empresas as $index => $empresa)
                        <tr class="hover:bg-gray-50 transition-colors fade-in" style="animation-delay: {{ $index * 0.05 }}s">
                            <!-- ID -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 texto-azul-itszn">
                                    #{{ str_pad($empresa->id, 5, '0', STR_PAD_LEFT) }}
                                </span>
                            </td>
                            
                            <!-- Empresa con Imagen REDONDA -->
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="relative">
                                        @if($empresa->logo_path)
                                        <img src="{{ Storage::url($empresa->logo_path) }}" 
                                             alt="{{ $empresa->nombre_empresa }}"
                                             class="empresa-img mr-3"
                                             onclick="showPhotoModal('{{ Storage::url($empresa->logo_path) }}', '{{ $empresa->nombre_empresa }}')"
                                             onerror="this.onerror=null; this.classList.add('hidden'); this.nextElementSibling?.classList.remove('hidden')">
                                        <div class="empresa-img-placeholder mr-3 hidden"
                                             onclick="showPhotoModal('', '{{ $empresa->nombre_empresa }}')">
                                            {{ substr($empresa->nombre_empresa, 0, 2) }}
                                        </div>
                                        @else
                                        <div class="empresa-img-placeholder mr-3"
                                             onclick="showPhotoModal('', '{{ $empresa->nombre_empresa }}')">
                                            {{ substr($empresa->nombre_empresa, 0, 2) }}
                                        </div>
                                        @endif
                                        @if($empresa->created_at->diffInDays(now()) < 7)
                                        <span class="absolute -top-1 -right-1 w-3 h-3 bg-red-500 rounded-full pulse border-2 border-white"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.empresas.mostrar', $empresa) }}" 
                                           class="text-sm font-medium texto-azul-itszn hover:text-blue-700">
                                            {{ $empresa->nombre_empresa }}
                                        </a>
                                        <div class="flex flex-col gap-1 mt-1">
                                            <span class="text-xs text-gray-500">{{ $empresa->tipo_negocio }}</span>
                                            <div class="flex items-center gap-2">
                                                @if($empresa->vacantes()->count() > 0)
                                                <span class="text-xs bg-blue-100 texto-azul-itszn px-2 py-0.5 rounded-full">
                                                    {{ $empresa->vacantes()->count() }} vacantes
                                                </span>
                                                @endif
                                                @if($empresa->vacantes()->where('estado', 'aprobada')->where('activa', true)->count() > 0)
                                                <span class="text-xs bg-green-100 text-green-800 px-2 py-0.5 rounded-full">
                                                    {{ $empresa->vacantes()->where('estado', 'aprobada')->where('activa', true)->count() }} activas
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            <!-- Representante Legal -->
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    @if($empresa->representante_legal)
                                    <div class="flex items-center">
                                        <span class="text-gray-400 mr-2">👤</span>
                                        <div>
                                            <p class="text-sm font-medium text-gray-900">{{ $empresa->representante_legal }}</p>
                                            @if($empresa->puesto_representante)
                                            <p class="text-xs text-gray-500">{{ $empresa->puesto_representante }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    @endif
                                    @if($empresa->rfc)
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-400 mr-2">📋</span>
                                        <code class="bg-gray-100 px-2 py-0.5 rounded font-mono text-xs">
                                            {{ $empresa->rfc }}
                                        </code>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Contacto -->
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    @if($empresa->correo_contacto)
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-400 mr-2">📧</span>
                                        <span class="truncate max-w-[180px]">{{ $empresa->correo_contacto }}</span>
                                    </div>
                                    @endif
                                    @if($empresa->telefono_contacto)
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-400 mr-2">📞</span>
                                        <span>{{ $empresa->telefono_contacto }}</span>
                                    </div>
                                    @endif
                                    @if($empresa->direccion)
                                    <div class="flex items-start text-sm">
                                        <span class="text-gray-400 mr-2 mt-1">📍</span>
                                        <span class="truncate max-w-[180px]">{{ Str::limit($empresa->direccion, 40) }}</span>
                                    </div>
                                    @endif
                                    @if($empresa->pagina_web)
                                    <div class="flex items-center text-sm">
                                        <span class="text-gray-400 mr-2">🌐</span>
                                        <span class="truncate max-w-[180px]">{{ $empresa->pagina_web }}</span>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Estado -->
                            <td class="px-6 py-4">
                                @if($empresa->estado == 'aprobada')
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-600">✅</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-green-600">Aprobada</span>
                                        @if($empresa->fecha_revision)
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($empresa->fecha_revision)->format('d/m/Y') }}</p>
                                        @endif
                                        @if($empresa->revisor)
                                        <p class="text-xs text-gray-500">Por: {{ $empresa->revisor->name ?? 'Administrador' }}</p>
                                        @endif
                                    </div>
                                </div>
                                @elseif($empresa->estado == 'pendiente')
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <span class="text-yellow-600 pulse">⏳</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-yellow-600">Pendiente</span>
                                        <p class="text-xs text-gray-500">{{ $empresa->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                                @elseif($empresa->estado == 'rechazada')
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                        <span class="text-red-600">❌</span>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-red-600">Rechazada</span>
                                        @if($empresa->motivo_rechazo)
                                        <p class="text-xs text-gray-500 cursor-help" title="{{ $empresa->motivo_rechazo }}">
                                            Ver motivo
                                        </p>
                                        @endif
                                        @if($empresa->fecha_revision)
                                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($empresa->fecha_revision)->format('d/m/Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                                @endif
                            </td>
                            
                            <!-- Registro -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm">
                                    <div class="font-medium texto-azul-itszn">{{ $empresa->created_at->format('d/m/Y') }}</div>
                                    <div class="text-gray-500">{{ $empresa->created_at->format('h:i A') }}</div>
                                    @if($empresa->updated_at->diffInDays($empresa->created_at) > 0)
                                    <div class="text-xs text-green-600 mt-1">
                                        Actualizada: {{ $empresa->updated_at->format('d/m/y') }}
                                    </div>
                                    @endif
                                </div>
                            </td>
                            
                            <!-- Acciones -->
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <!-- Ver detalles -->
                                    <a href="{{ route('admin.empresas.mostrar', $empresa) }}" 
                                       class="action-btn bg-blue-100 texto-azul-itszn hover:bg-blue-200"
                                       title="Ver detalles">
                                        <span>👁️</span>
                                    </a>
                                    
                                    <!-- Editar -->
                                    <a href="{{ route('admin.empresas.editar', $empresa) }}" 
                                       class="action-btn bg-yellow-100 text-yellow-600 hover:bg-yellow-200"
                                       title="Editar empresa">
                                        <span>✏️</span>
                                    </a>
                                    
                                    <!-- Aprobar/Rechazar -->
                                    @if($empresa->estado == 'pendiente')
                                    <form action="{{ route('admin.empresas.aprobar', $empresa) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="action-btn bg-green-100 text-green-600 hover:bg-green-200"
                                                title="Aprobar empresa"
                                                onclick="return confirm('¿Aprobar esta empresa?')">
                                            <span>✅</span>
                                        </button>
                                    </form>
                                    <button type="button" 
                                            class="action-btn bg-red-100 text-red-600 hover:bg-red-200"
                                            onclick="showRejectModal('{{ $empresa->id }}', '{{ $empresa->nombre_empresa }}')"
                                            title="Rechazar empresa">
                                        <span>❌</span>
                                    </button>
                                    @elseif($empresa->estado == 'aprobada')
                                    <form action="{{ route('admin.empresas.rechazar', $empresa) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" 
                                                class="action-btn bg-gray-100 text-gray-600 hover:bg-gray-200"
                                                title="Suspender empresa"
                                                onclick="return confirm('¿Suspender esta empresa?')">
                                            <span>⏸️</span>
                                        </button>
                                    </form>
                                    @endif
                                    
                                    <!-- Eliminar -->
                                    <button type="button" 
                                            class="action-btn bg-red-100 text-red-600 hover:bg-red-200"
                                            onclick="showDeleteModal('{{ $empresa->id }}', '{{ $empresa->nombre_empresa }}')"
                                            title="Eliminar empresa">
                                        <span>🗑️</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <span class="text-4xl text-gray-400">🏢</span>
                                    </div>
                                    <h3 class="text-lg font-medium texto-azul-itszn mb-2">No hay empresas registradas</h3>
                                    <p class="text-gray-600 mb-6">Comienza registrando una nueva empresa en el sistema</p>
                                    <a href="{{ route('admin.empresas.crear') }}" 
                                       class="btn-itszn inline-flex items-center gap-2 px-6 py-3">
                                        <span>➕</span>
                                        <span>Registrar Primera Empresa</span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if($empresas->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <div class="text-sm text-gray-700">
                        <span>📋</span>
                        Mostrando <span class="font-semibold texto-azul-itszn">{{ $empresas->firstItem() }}</span> a 
                        <span class="font-semibold texto-azul-itszn">{{ $empresas->lastItem() }}</span> de 
                        <span class="font-semibold texto-azul-itszn">{{ $empresas->total() }}</span> empresas
                    </div>
                    <div class="flex items-center space-x-2">
                        {{ $empresas->links('pagination::tailwind') }}
                    </div>
                    <div class="text-sm text-gray-700">
                        <span>📄</span>
                        {{ $empresas->perPage() }} por página
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- ✅ MODAL PARA FOTO EN GRANDE (estilo WhatsApp) -->
    <div id="photoModal" class="photo-modal fixed inset-0 hidden items-center justify-center z-[1000]">
        <button class="close-photo-modal" onclick="closePhotoModal()">
            ✕
        </button>
        <div class="photo-modal-content" onclick="closePhotoModal()">
            <img id="photoModalImg" src="" alt="" class="photo-modal-img">
            <div id="photoModalInfo" class="photo-modal-info"></div>
        </div>
    </div>

    <!-- Modales originales -->
    <!-- Modal para rechazar -->
    <div id="rejectModal" class="modal-itszn fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
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
                              class="form-input w-full"
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

    <!-- Modal para eliminar - VERSIÓN CORREGIDA -->
<div id="deleteModal" class="modal-itszn fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
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
            <!-- ✅ FORMULARIO DINÁMICO (la URL se establece con JavaScript) -->
            <form id="deleteForm" method="POST" action="">
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
    // ✅ FUNCIONES PARA MODALES DE FOTO (estilo WhatsApp)
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
        document.body.style.overflow = 'hidden'; // Previene scroll
    }

    function closePhotoModal() {
        document.getElementById('photoModal').classList.add('hidden');
        document.body.style.overflow = 'auto'; // Restaura scroll
    }

    // ✅ CERRAR MODAL DE FOTO CON ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePhotoModal();
        }
    });

    // ✅ FUNCIONES PARA MODALES ORIGINALES - ACTUALIZADA
function showDeleteModal(companyId, companyName) {
    const modal = document.getElementById('deleteModal');
    const form = document.getElementById('deleteForm');
    const nameSpan = document.getElementById('deleteCompanyName');
    
    nameSpan.textContent = companyName;
    
    // ✅ ESTABLECER LA RUTA CORRECTA
    form.action = `/admin/empresas/${companyId}`;
    
    modal.classList.remove('hidden');
}

function showRejectModal(companyId, companyName) {
    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    const nameSpan = document.getElementById('rejectCompanyName');
    
    nameSpan.textContent = companyName;
    form.action = `/admin/empresas/${companyId}/rechazar`;
    modal.classList.remove('hidden');
}

function closeModal(modalId) {
    document.getElementById(modalId).classList.add('hidden');
}

    // ✅ ANIMACIONES
    document.addEventListener('DOMContentLoaded', function() {
        // Animación escalonada para elementos
        const elements = document.querySelectorAll('.fade-in');
        elements.forEach((element, index) => {
            element.style.animationDelay = `${index * 0.05}s`;
        });
        
        // Filtros automáticos
        document.querySelectorAll('select[name], input[name="search"]').forEach(input => {
            input.addEventListener('change', function() {
                if (this.name === 'search') {
                    if (this.value.length > 2 || this.value.length === 0) {
                        setTimeout(() => this.closest('form').submit(), 500);
                    }
                } else {
                    this.closest('form').submit();
                }
            });
        });
    });
    </script>
</body>
</html>