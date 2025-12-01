<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bolsa Trabajo ITSZN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Agregar Font Awesome para íconos -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Agregar Vue.js -->
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <!-- Agregar Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body class="bg-gray-100">
    <div id="app">
        <!-- Header -->
<header class="bg-white shadow-sm border-b border-gray-200">
    <div class="container mx-auto px-4 py-3">
        <div class="flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <!-- Logo TecNM -->
                <div class="flex items-center space-x-3">
                    <img src="{{ asset('images/logo-tecnm.png') }}" 
                         alt="Logo TecNM" 
                         class="h-12 w-auto">
                    <!-- Si no tienes el logo, puedes usar este placeholder -->
                    <div class="hidden">
                        <img src="https://www.tecnm.mx/assets/images/logo-tecnm.png" 
                             alt="Logo TecNM" 
                             class="h-12 w-auto">
                    </div>
                </div>

                <!-- Texto institucional -->
                <div class="border-l border-gray-300 pl-4">
                    <div class="flex items-baseline space-x-2">
                        <h1 class="text-xl font-bold text-gray-800">Bolsa de Trabajo</h1>
                        <span class="text-sm font-semibold text-blue-600 bg-blue-50 px-2 py-1 rounded">
                            ITSZN
                        </span>
                    </div>
                    <div class="flex items-center space-x-3 mt-1">
                        <p class="text-gray-600 text-sm">Bienvenido, {{ $user->name }}</p>
                        <span class="inline-block px-2 py-1 text-xs font-medium rounded 
                            {{ $user->tipo == 'alumno' ? 'bg-blue-100 text-blue-800 border border-blue-200' : '' }}
                            {{ $user->tipo == 'empresa' ? 'bg-green-100 text-green-800 border border-green-200' : '' }}
                            {{ $user->tipo == 'admin' ? 'bg-red-100 text-red-800 border border-red-200' : '' }}
                            {{ $user->tipo == 'egresado' ? 'bg-purple-100 text-purple-800 border border-purple-200' : '' }}">
                            {{ ucfirst($user->tipo) }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex items-center space-x-6">
                <!-- 🔔 COMPONENTE DE NOTIFICACIONES -->
                <div class="notificaciones-container relative">
                    <button @click="toggleNotificaciones" 
                            class="btn-notificacion relative p-2 rounded-full hover:bg-gray-100 transition duration-200 group">
                        <i class="fas fa-bell text-gray-500 text-xl group-hover:text-blue-600"></i>
                        <span v-if="contadorNotificaciones > 0" 
                              class="absolute -top-1 -right-1 bg-red-500 text-white rounded-full w-5 h-5 text-xs flex items-center justify-center font-semibold">
                            @{{ contadorNotificaciones }}
                        </span>
                    </button>

                    <!-- Dropdown de notificaciones -->
                    <div v-if="mostrarNotificaciones" 
                         class="notificaciones-dropdown absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl border border-gray-200 z-50">
                        <div class="p-4 border-b border-gray-200 bg-gradient-to-r from-blue-50 to-indigo-50">
                            <div class="flex justify-between items-center">
                                <h3 class="font-semibold text-gray-800 flex items-center">
                                    <i class="fas fa-bell text-blue-600 mr-2"></i>
                                    Notificaciones
                                </h3>
                                <button v-if="notificaciones.length > 0" 
                                        @click="marcarTodasLeidas" 
                                        class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                    Marcar todas como leídas
                                </button>
                            </div>
                        </div>

                        <div class="max-h-96 overflow-y-auto">
                            <div v-if="cargandoNotificaciones" class="p-6 text-center">
                                <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                                <p class="text-gray-500 text-sm mt-2">Cargando notificaciones...</p>
                            </div>
                            
                            <div v-else-if="notificaciones.length === 0" class="p-6 text-center">
                                <i class="fas fa-bell-slash text-gray-300 text-3xl mb-3"></i>
                                <p class="text-gray-500 text-sm">No hay notificaciones nuevas</p>
                            </div>

                            <div v-else>
                                <div v-for="notificacion in notificaciones" 
                                     :key="notificacion.id"
                                     :class="['notificacion-item p-4 border-b border-gray-100 cursor-pointer transition duration-200', 
                                             { 'bg-blue-50 border-l-4 border-l-blue-500': !notificacion.leida, 
                                               'hover:bg-gray-50': notificacion.leida }]"
                                     @click="abrirNotificacion(notificacion)">
                                    
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800 text-sm flex items-center">
                                                <span v-if="!notificacion.leida" 
                                                      class="bg-blue-500 rounded-full w-2 h-2 mr-2"></span>
                                                @{{ notificacion.titulo }}
                                            </h4>
                                            <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                                                @{{ notificacion.mensaje }}
                                            </p>
                                            <p class="text-gray-400 text-xs mt-2 flex items-center">
                                                <i class="fas fa-clock mr-1"></i>
                                                @{{ formatFecha(notificacion.created_at) }}
                                            </p>
                                        </div>
                                        
                                        <div class="flex space-x-2 ml-3">
                                            <button v-if="!notificacion.leida" 
                                                    @click.stop="marcarLeida(notificacion)"
                                                    class="text-green-600 hover:text-green-800 p-1 rounded transition"
                                                    title="Marcar como leída">
                                                <i class="fas fa-check text-sm"></i>
                                            </button>
                                            <button @click.stop="eliminarNotificacion(notificacion)"
                                                    class="text-red-600 hover:text-red-800 p-1 rounded transition"
                                                    title="Eliminar notificación">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3 border-t border-gray-200 text-center bg-gray-50">
                            <a href="/notificaciones" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium flex items-center justify-center">
                                Ver todas las notificaciones
                                <i class="fas fa-arrow-right ml-1 text-xs"></i>
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Enlaces de navegación -->
                <div class="flex items-center space-x-4">
                    <a href="/dashboard" 
                       class="text-gray-600 hover:text-blue-600 font-medium transition duration-200 flex items-center">
                        <i class="fas fa-tachometer-alt mr-2"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="text-red-600 hover:text-red-800 font-medium transition duration-200 flex items-center">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Cerrar Sesión
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

        <div class="container mx-auto px-4 py-8">
            <!-- Dashboard según tipo de usuario -->
            @if($user->tipo == 'admin')
                <!-- DASHBOARD ADMIN MEJORADO -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Header con color consistente -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
        <h2 class="text-xl font-bold text-white">👨‍💼 Panel de Administración - ITSZN</h2>
        <p class="text-red-100 text-sm mt-1">Sistema de gestión integral</p>
    </div>

    <div class="p-6">
        <!-- ACCIONES RÁPIDAS - 4 ARRIBA Y 2 ABAJO -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="bg-red-100 text-red-600 p-2 rounded-lg mr-3">⚡</span>
                Acciones de Administración
            </h3>
            
            <!-- PRIMERA FILA - 4 RECUADROS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <!-- Gestionar Usuarios -->
                <a href="/usuarios" 
                   class="group bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">👥</div>
                    <p class="font-semibold text-blue-800">Gestionar Usuarios</p>
                    <p class="text-sm text-blue-600 mt-1">{{ $totalUsuarios }} registrados</p>
                </a>
                
                <!-- Validar Empresas -->
                <a href="{{ route('admin.empresas.pendientes') }}" 
                   class="group bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🏢</div>
                    <p class="font-semibold text-green-800">Validar Empresas</p>
                    @if(isset($empresasPendientesCount) && $empresasPendientesCount > 0)
                        <span class="inline-block bg-red-500 text-white px-2 py-1 rounded-full text-xs mt-1 font-semibold">
                            {{ $empresasPendientesCount }} pendientes
                        </span>
                    @else
                        <p class="text-sm text-green-600 mt-1">Revisar solicitudes</p>
                    @endif
                </a>
                
                <!-- Validar Vacantes -->
                <a href="{{ route('admin.vacantes.pendientes') }}" 
                   class="group bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📋</div>
                    <p class="font-semibold text-purple-800">Validar Vacantes</p>
                    @if(isset($vacantesPendientesCount) && $vacantesPendientesCount > 0)
                        <span class="inline-block bg-red-500 text-white px-2 py-1 rounded-full text-xs mt-1 font-semibold">
                            {{ $vacantesPendientesCount }} pendientes
                        </span>
                    @else
                        <p class="text-sm text-purple-600 mt-1">Revisar vacantes</p>
                    @endif
                </a>
                
                <!-- Notificaciones -->
                <a href="{{ route('notificaciones') }}" 
                   class="group bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-lg border border-orange-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔔</div>
                    <p class="font-semibold text-orange-800">Notificaciones</p>
                    <p class="text-sm text-orange-600 mt-1">Gestionar alertas</p>
                </a>
            </div>

            <!-- SEGUNDA FILA - 2 RECUADROS CENTRADOS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 max-w-2xl mx-auto">
                <!-- Panel Servicio Social -->
                <a href="{{ route('admin.servicio-social.login') }}" 
                   class="group bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🎓</div>
                    <p class="font-semibold text-purple-800">Panel Servicio Social</p>
                    <p class="text-sm text-purple-600 mt-1">Acceso coordinador</p>
                    <div class="mt-2 text-xs text-purple-500">
                    </div>
                </a>

                <!-- Soporte Técnico -->
<a href="{{ route('admin.soporte-tecnico') }}" 
   class="group bg-gradient-to-br from-indigo-50 to-indigo-100 p-4 rounded-lg border border-indigo-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔧</div>
    <p class="font-semibold text-indigo-800">Soporte Técnico</p>
    <p class="text-sm text-indigo-600 mt-1">Sistema y ayuda</p>
    <div class="mt-2 text-xs text-indigo-500">
        <p>🛠️ Reportar problemas</p>
    </div>
</a>

            </div>
        </div>

        <!-- Estadísticas -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-blue-500 p-3 rounded-full">
                        <span class="text-white text-xl">👥</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-blue-600 font-medium">Total Usuarios</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $totalUsuarios }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-green-500 p-3 rounded-full">
                        <span class="text-white text-xl">🎓</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-green-600 font-medium">Alumnos</p>
                        <p class="text-2xl font-bold text-green-700">{{ $alumnos }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-purple-500 p-3 rounded-full">
                        <span class="text-white text-xl">🏢</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-purple-600 font-medium">Empresas</p>
                        <p class="text-2xl font-bold text-purple-700">{{ $empresas }}</p>
                    </div>
                </div>
            </div>

            <!-- 🔔 Estadística de Notificaciones -->
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-lg border border-orange-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-orange-500 p-3 rounded-full">
                        <span class="text-white text-xl">🔔</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-orange-600 font-medium">Notificaciones</p>
                        <p class="text-2xl font-bold text-orange-700">@{{ contadorNotificaciones }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🔔 Notificaciones Recientes -->
        <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-blue-800 flex items-center">
                    <span class="bg-blue-500 text-white p-1 rounded mr-2">🔔</span>
                    Notificaciones Recientes
                </h3>
                <a href="{{ route('notificaciones') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                    Ver todas
                    <span class="ml-1">→</span>
                </a>
            </div>
            <div class="space-y-3">
                <div v-if="cargandoNotificaciones" class="text-center py-4">
                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                    <p class="text-gray-500 text-sm mt-2">Cargando notificaciones...</p>
                </div>
                <div v-else-if="notificaciones.length === 0" class="text-center py-4">
                    <i class="fas fa-bell-slash text-gray-300 text-2xl mb-2"></i>
                    <p class="text-gray-500 text-sm">No hay notificaciones recientes</p>
                </div>
                <div v-else>
                    <div v-for="notificacion in notificaciones.slice(0, 5)" 
                         :key="notificacion.id"
                         :class="['p-4 bg-white rounded-lg border-l-4 cursor-pointer hover:shadow-md transition-all duration-200', 
                                 { 'border-l-blue-500 border-blue-100': !notificacion.leida, 
                                   'border-l-gray-300 border-gray-100': notificacion.leida }]"
                         @click="abrirNotificacion(notificacion)">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-sm flex items-center">
                                    <span v-if="!notificacion.leida" class="bg-blue-500 rounded-full w-2 h-2 mr-2"></span>
                                    @{{ notificacion.titulo }}
                                </h4>
                                <p class="text-gray-600 text-sm mt-1 leading-relaxed">
                                    @{{ notificacion.mensaje }}
                                </p>
                                <p class="text-gray-400 text-xs mt-2 flex items-center">
                                    <i class="fas fa-clock mr-1"></i>
                                    @{{ formatFecha(notificacion.created_at) }}
                                </p>
                            </div>
                            <div class="flex space-x-2 ml-3">
                                <button v-if="!notificacion.leida" 
                                        @click.stop="marcarLeida(notificacion)"
                                        class="text-green-600 hover:text-green-800 p-1 rounded transition"
                                        title="Marcar como leída">
                                    <i class="fas fa-check text-sm"></i>
                                </button>
                                <button @click.stop="eliminarNotificacion(notificacion)"
                                        class="text-red-600 hover:text-red-800 p-1 rounded transition"
                                        title="Eliminar notificación">
                                    <i class="fas fa-trash text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            @elseif($user->tipo == 'alumno')
               <!-- DASHBOARD ALUMNO MEJORADO -->
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Header con color consistente -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
        <h2 class="text-xl font-bold text-white">🎓 Panel del Alumno - ITSZN</h2>
        <p class="text-blue-100 text-sm mt-1">Bienvenido/a, {{ $user->name }}</p>
    </div>

    <div class="p-6">
        <!-- ACCIONES RÁPIDAS - AHORA EN LA PARTE SUPERIOR -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg mr-3">⚡</span>
                Acciones Rápidas
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('alumno.vacantes') }}" 
                   class="group bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔍</div>
                    <p class="font-semibold text-blue-800">Buscar Vacantes</p>
                    <p class="text-sm text-blue-600 mt-1">Explora oportunidades</p>
                </a>
                
                <a href="{{ route('alumno.mis-postulaciones') }}" 
                   class="group bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📋</div>
                    <p class="font-semibold text-green-800">Mis Postulaciones</p>
                    <p class="text-sm text-green-600 mt-1">Revisa tu historial</p>
                </a>

                <a href="{{ route('notificaciones') }}" 
                   class="group bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-lg border border-orange-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔔</div>
                    <p class="font-semibold text-orange-800">Notificaciones</p>
                    <p class="text-sm text-orange-600 mt-1">Mira tus alertas</p>
                </a>

                <a href="{{ route('perfil') }}" 
                   class="group bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">👤</div>
                    <p class="font-semibold text-purple-800">Mi Perfil</p>
                    <p class="text-sm text-purple-600">Gestionar Perfil</p>
                </a>
            </div>
        </div>

        <!-- Estadísticas rápidas -->
        @php
            $totalVacantes = \App\Models\Vacante::where('estado', 'aprobada')
                ->where('activa', true)
                ->where('fecha_limite', '>=', now())
                ->count();
            
            $misPostulaciones = \App\Models\Postulacion::where('user_id', $user->id)->count();
            $postulacionesPendientes = \App\Models\Postulacion::where('user_id', $user->id)
                ->where('estado', 'pendiente')
                ->count();
        @endphp
        
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-blue-500 p-3 rounded-full">
                        <span class="text-white text-xl">🔍</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-blue-600 font-medium">Vacantes Disponibles</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $totalVacantes }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-green-500 p-3 rounded-full">
                        <span class="text-white text-xl">📋</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-green-600 font-medium">Mis Postulaciones</p>
                        <p class="text-2xl font-bold text-green-700">{{ $misPostulaciones }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-gradient-to-br from-yellow-50 to-yellow-100 p-6 rounded-lg border border-yellow-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-yellow-500 p-3 rounded-full">
                        <span class="text-white text-xl">⏳</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-yellow-600 font-medium">Pendientes</p>
                        <p class="text-2xl font-bold text-yellow-700">{{ $postulacionesPendientes }}</p>
                    </div>
                </div>
            </div>

            <!-- 🔔 NUEVO: Estadística de Notificaciones -->
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-lg border border-orange-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-orange-500 p-3 rounded-full">
                        <span class="text-white text-xl">🔔</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-orange-600 font-medium">Notificaciones</p>
                        <p class="text-2xl font-bold text-orange-700">@{{ contadorNotificaciones }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 🔔 Notificaciones Importantes -->
        <div class="mb-6 bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6 shadow-sm">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-blue-800 flex items-center">
                    <span class="bg-blue-500 text-white p-1 rounded mr-2">🔔</span>
                    Alertas Importantes
                </h3>
                <a href="{{ route('notificaciones') }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center">
                    Ver todas
                    <span class="ml-1">→</span>
                </a>
            </div>
            <div class="space-y-3">
                <div v-if="cargandoNotificaciones" class="text-center py-4">
                    <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                    <p class="text-gray-500 text-sm mt-2">Cargando alertas...</p>
                </div>
                <div v-else-if="notificaciones.length === 0" class="text-center py-4">
                    <p class="text-gray-500 text-sm">No hay alertas importantes en este momento</p>
                </div>
                <div v-else>
                    <div v-for="notificacion in notificaciones.slice(0, 3)" 
                         :key="notificacion.id"
                         :class="['p-4 bg-white rounded-lg border-l-4 cursor-pointer hover:shadow-md transition-all duration-200', 
                                 { 'border-l-blue-500 border-blue-100': !notificacion.leida, 
                                   'border-l-gray-300 border-gray-100': notificacion.leida }]"
                         @click="abrirNotificacion(notificacion)">
                        <div class="flex items-start">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-800 text-sm flex items-center">
                                    <span v-if="!notificacion.leida" class="bg-blue-500 rounded-full w-2 h-2 mr-2"></span>
                                    @{{ notificacion.titulo }}
                                </h4>
                                <p class="text-gray-600 text-sm mt-1">@{{ notificacion.mensaje }}</p>
                                <p class="text-gray-400 text-xs mt-2 flex items-center">
                                    <span class="mr-1">🕒</span>
                                    @{{ formatFecha(notificacion.created_at) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vacantes Recientes -->
        @php
            $vacantesRecientes = \App\Models\Vacante::with('empresa')
                ->where('estado', 'aprobada')
                ->where('activa', true)
                ->where('fecha_limite', '>=', now())
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        @endphp

        @if($vacantesRecientes->count() > 0)
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white p-2 rounded-lg mr-3">🌟</span>
                Vacantes Recientes
            </h3>
            <div class="grid gap-4">
                @foreach($vacantesRecientes as $vacante)
                <div class="bg-gradient-to-r from-white to-blue-50 border border-blue-100 rounded-lg p-4 hover:shadow-lg transition-all duration-300 hover:border-blue-300">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-800 text-lg">{{ $vacante->titulo }}</h4>
                            <p class="text-blue-600 font-medium text-sm mt-1">{{ $vacante->empresa->nombre_empresa }}</p>
                            <div class="flex flex-wrap gap-2 mt-3">
                                <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}
                                </span>
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst($vacante->modalidad) }}
                                </span>
                                <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">
                                    📍 {{ $vacante->ubicacion }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('alumno.postular', $vacante->id) }}" 
                           class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-700 hover:to-blue-800 ml-4 transition-all duration-300 shadow-sm hover:shadow-md">
                            Postular
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if($totalVacantes > 3)
            <div class="text-center mt-6">
                <a href="{{ route('alumno.vacantes') }}" 
                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                    Ver todas las {{ $totalVacantes }} vacantes disponibles
                    <span class="ml-2">→</span>
                </a>
            </div>
            @endif
        </div>
        @endif

        <!-- Consejos -->
        <div class="mt-8 bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 rounded-lg p-6 shadow-sm">
            <h3 class="font-semibold text-yellow-800 mb-3 flex items-center">
                <span class="bg-yellow-500 text-white p-1 rounded mr-2">💡</span>
                Consejos para tu búsqueda
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-yellow-700 text-sm">
                <div class="flex items-center">
                    <span class="mr-2">✅</span>
                    <span>Actualiza tu CV regularmente</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-2">✅</span>
                    <span>Personaliza tu carta de motivación</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-2">✅</span>
                    <span>Revisa frecuentemente nuevas vacantes</span>
                </div>
                <div class="flex items-center">
                    <span class="mr-2">✅</span>
                    <span>Prepara tus documentos digitalizados</span>
                </div>
            </div>
        </div>
    </div>
</div>
@elseif($user->tipo == 'empresa')
    <!-- DASHBOARD EMPRESA MEJORADO -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Header con color consistente (verde para empresas) -->
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
            <h2 class="text-xl font-bold text-white">🏢 Panel de Empresa - ITSZN</h2>
            <p class="text-green-100 text-sm mt-1">
                @if($user->empresa)
                    Bienvenido/a, {{ $user->name }} - {{ $user->empresa->nombre_empresa }}
                @else
                    Bienvenido/a, {{ $user->name }}
                @endif
            </p>
        </div>

        <div class="p-6">
            @if(!$user->empresa)
                <!-- PRIMER ACCESO: Completar datos de empresa -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-8 text-center">
                    <div class="text-6xl mb-4">🏢</div>
                    <h3 class="text-2xl font-bold text-blue-800 mb-3">Completa los datos de tu empresa</h3>
                    <p class="text-blue-600 mb-6 text-lg">Para comenzar a publicar vacantes y encontrar talento del ITSZN</p>
                    <a href="{{ route('empresa.create') }}" 
                       class="bg-gradient-to-r from-blue-600 to-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:from-blue-700 hover:to-blue-800 inline-block transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-building me-2"></i>Completar Datos de Empresa
                    </a>
                </div>

            @elseif($user->empresa->estado == 'pendiente')
                <!-- PENDIENTE DE APROBACIÓN -->
                <div class="bg-gradient-to-r from-yellow-50 to-amber-50 border border-yellow-200 rounded-lg p-8 text-center">
                    <div class="text-6xl mb-4">⏳</div>
                    <h3 class="text-2xl font-bold text-yellow-800 mb-3">Empresa en Revisión</h3>
                    <p class="text-yellow-700 text-lg mb-2">Tu empresa <strong>{{ $user->empresa->nombre_empresa }}</strong> está siendo validada por el ITSZN.</p>
                    <p class="text-yellow-600">
                        Recibirás una notificación cuando tu empresa sea aprobada para publicar vacantes.
                    </p>
                </div>

            @elseif($user->empresa->estado == 'aprobada')
                <!-- EMPRESA APROBADA - DISEÑO MEJORADO -->
                @php
                    // Estadísticas
                    $totalVacantes = $user->empresa->vacantes->count();
                    $vacantesAprobadas = $user->empresa->vacantes->where('estado', 'aprobada')->count();
                    $vacantesPendientes = $user->empresa->vacantes->where('estado', 'pendiente')->count();
                    $vacantesActivas = $user->empresa->vacantes()
                        ->where('estado', 'aprobada')
                        ->where('activa', true)
                        ->where('fecha_limite', '>=', now())
                        ->count();
                    
                    // Postulaciones
                    $totalPostulaciones = \App\Models\Postulacion::whereIn('vacante_id', $user->empresa->vacantes->pluck('id'))->count();
                    $postulacionesPendientes = \App\Models\Postulacion::whereIn('vacante_id', $user->empresa->vacantes->pluck('id'))
                        ->where('estado', 'pendiente')
                        ->count();
                    $postulacionesAceptadas = \App\Models\Postulacion::whereIn('vacante_id', $user->empresa->vacantes->pluck('id'))
                        ->where('estado', 'aceptado')
                        ->count();
                    
                    // ✅ NUEVAS ESTADÍSTICAS DE SERVICIO SOCIAL
                    $solicitudesServicioSocialPendientes = \App\Models\ServicioSocial::where('empresa_id', $user->empresa->id)
                        ->where('estado', 'solicitado')
                        ->count();
                    $totalSolicitudesServicioSocial = \App\Models\ServicioSocial::where('empresa_id', $user->empresa->id)->count();
                @endphp

               <!-- ACCIONES RÁPIDAS - 4 ARRIBA, 2 ABAJO CENTRADAS -->
<div class="mb-8">
    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
        <span class="bg-green-100 text-green-600 p-2 rounded-lg mr-3">⚡</span>
        Acciones Rápidas
    </h3>
    
    <!-- PRIMERA FILA - 4 ACCIONES -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <!-- Publicar Vacante -->
        <a href="{{ route('vacantes.create') }}" 
           class="group bg-gradient-to-br from-green-50 to-green-100 p-4 rounded-lg border border-green-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📋</div>
            <p class="font-semibold text-green-800">Publicar Vacante</p>
            <p class="text-sm text-green-600 mt-1">Crear nueva oferta</p>
        </a>
        
        <!-- Gestionar Vacantes -->
        <a href="{{ route('vacantes.index') }}" 
           class="group bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">👥</div>
            <p class="font-semibold text-blue-800">Mis Vacantes</p>
            <p class="text-sm text-blue-600 mt-1">{{ $totalVacantes }} publicadas</p>
        </a>

        <!-- Ver Postulaciones -->
        <a href="{{ route('empresa.postulaciones') }}" 
           class="group bg-gradient-to-br from-purple-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📨</div>
            <p class="font-semibold text-purple-800">Postulaciones</p>
            <p class="text-sm text-purple-600 mt-1">
                @if($postulacionesPendientes > 0)
                    <span class="text-red-500 font-semibold">{{ $postulacionesPendientes }} pendientes</span>
                @else
                    {{ $totalPostulaciones }} total
                @endif
            </p>
        </a>

        <!-- Servicio Social -->
        <a href="{{ route('empresa.servicio-social.index') }}" 
           class="group bg-gradient-to-br from-indigo-50 to-purple-100 p-4 rounded-lg border border-purple-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🎓</div>
            <p class="font-semibold text-purple-800">Servicio Social</p>
            <p class="text-sm text-purple-600 mt-1">
                @if($solicitudesServicioSocialPendientes > 0)
                    <span class="text-red-500 font-semibold">{{ $solicitudesServicioSocialPendientes }} pendientes</span>
                @else
                    Gestionar solicitudes
                @endif
            </p>
        </a>
    </div>

    <!-- SEGUNDA FILA - 2 ACCIONES CENTRADAS (MISMO ANCHO) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-2xl mx-auto">
        <!-- Perfil de Empresa -->
        <a href="{{ route('empresa.perfil') }}" 
           class="group bg-gradient-to-br from-orange-50 to-amber-100 p-4 rounded-lg border border-orange-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🏢</div>
            <p class="font-semibold text-orange-800">Perfil Empresa</p>
            <p class="text-sm text-orange-600 mt-1">Editar información</p>
        </a>

        <!-- Notificaciones -->
        <a href="{{ route('notificaciones') }}" 
           class="group bg-gradient-to-br from-pink-50 to-rose-100 p-4 rounded-lg border border-pink-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
            <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔔</div>
            <p class="font-semibold text-pink-800">Notificaciones</p>
            <p class="text-sm text-pink-600 mt-1">Ver alertas</p>
        </a>
    </div>
</div>
                <!-- Estadísticas rápidas -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                    <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200 shadow-sm">
                        <div class="flex items-center">
                            <div class="bg-green-500 p-3 rounded-full">
                                <span class="text-white text-xl">📋</span>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-green-600 font-medium">Vacantes Activas</p>
                                <p class="text-2xl font-bold text-green-700">{{ $vacantesActivas }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200 shadow-sm">
                        <div class="flex items-center">
                            <div class="bg-blue-500 p-3 rounded-full">
                                <span class="text-white text-xl">✅</span>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-blue-600 font-medium">Vacantes Aprobadas</p>
                                <p class="text-2xl font-bold text-blue-700">{{ $vacantesAprobadas }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200 shadow-sm">
                        <div class="flex items-center">
                            <div class="bg-purple-500 p-3 rounded-full">
                                <span class="text-white text-xl">📨</span>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-purple-600 font-medium">Total Postulaciones</p>
                                <p class="text-2xl font-bold text-purple-700">{{ $totalPostulaciones }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- 🔔 Nueva tarjeta para Servicio Social -->
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-100 p-6 rounded-lg border border-purple-200 shadow-sm">
                        <div class="flex items-center">
                            <div class="bg-purple-500 p-3 rounded-full">
                                <span class="text-white text-xl">🎓</span>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm text-purple-600 font-medium">Servicio Social</p>
                                <p class="text-2xl font-bold text-purple-700">{{ $solicitudesServicioSocialPendientes }}</p>
                                <p class="text-xs text-purple-500 mt-1">solicitudes pendientes</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 🔔 Notificaciones Importantes -->
                <div class="mb-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-6 shadow-sm">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-green-800 flex items-center">
                            <span class="bg-green-500 text-white p-1 rounded mr-2">🔔</span>
                            Alertas Importantes
                        </h3>
                        <a href="{{ route('notificaciones') }}" class="text-green-600 hover:text-green-800 font-medium text-sm flex items-center">
                            Ver todas
                            <span class="ml-1">→</span>
                        </a>
                    </div>
                    <div class="space-y-3">
                        <div v-if="cargandoNotificaciones" class="text-center py-4">
                            <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-green-600"></div>
                            <p class="text-gray-500 text-sm mt-2">Cargando alertas...</p>
                        </div>
                        <div v-else-if="notificaciones.length === 0" class="text-center py-4">
                            <p class="text-gray-500 text-sm">No hay alertas importantes en este momento</p>
                        </div>
                        <div v-else>
                            <div v-for="notificacion in notificaciones.slice(0, 3)" 
                                 :key="notificacion.id"
                                 :class="['p-4 bg-white rounded-lg border-l-4 cursor-pointer hover:shadow-md transition-all duration-200', 
                                         { 'border-l-green-500 border-green-100': !notificacion.leida, 
                                           'border-l-gray-300 border-gray-100': notificacion.leida }]"
                                 @click="abrirNotificacion(notificacion)">
                                <div class="flex items-start">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 text-sm flex items-center">
                                            <span v-if="!notificacion.leida" class="bg-green-500 rounded-full w-2 h-2 mr-2"></span>
                                            @{{ notificacion.titulo }}
                                        </h4>
                                        <p class="text-gray-600 text-sm mt-1">@{{ notificacion.mensaje }}</p>
                                        <p class="text-gray-400 text-xs mt-2 flex items-center">
                                            <span class="mr-1">🕒</span>
                                            @{{ formatFecha(notificacion.created_at) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vacantes Recientes -->
                @php
                    $vacantesRecientes = $user->empresa->vacantes()
                        ->orderBy('created_at', 'desc')
                        ->take(3)
                        ->get();
                @endphp

                @if($vacantesRecientes->count() > 0)
                <div class="mt-8">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                        <span class="bg-gradient-to-r from-green-500 to-blue-500 text-white p-2 rounded-lg mr-3">🌟</span>
                        Vacantes Recientes
                    </h3>
                    <div class="grid gap-4">
                        @foreach($vacantesRecientes as $vacante)
                        <div class="bg-gradient-to-r from-white to-green-50 border border-green-100 rounded-lg p-4 hover:shadow-lg transition-all duration-300 hover:border-green-300">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 text-lg">{{ $vacante->titulo }}</h4>
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        <span class="inline-block px-2 py-1 rounded text-xs 
                                            {{ $vacante->estado == 'aprobada' ? 'bg-green-100 text-green-800' : '' }}
                                            {{ $vacante->estado == 'pendiente' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $vacante->estado == 'rechazada' ? 'bg-red-100 text-red-800' : '' }}">
                                            {{ ucfirst($vacante->estado) }}
                                        </span>
                                        <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-xs font-medium">
                                            {{ ucfirst(str_replace('_', ' ', $vacante->tipo_contrato)) }}
                                        </span>
                                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full text-xs font-medium">
                                            {{ ucfirst($vacante->modalidad) }}
                                        </span>
                                        <span class="text-xs text-gray-500">
                                            {{ $vacante->postulaciones_count ?? 0 }} postulaciones
                                        </span>
                                    </div>
                                </div>
                                <div class="flex space-x-2 ml-4">
                                    <a href="{{ route('empresa.postulaciones.vacante', $vacante) }}" 
                                       class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                        Ver Postulaciones
                                    </a>
                                    <a href="{{ route('vacantes.edit', $vacante) }}" 
                                       class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                        Editar
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($totalVacantes > 3)
                    <div class="text-center mt-6">
                        <a href="{{ route('vacantes.index') }}" 
                           class="inline-flex items-center text-green-600 hover:text-green-800 font-medium">
                            Ver todas las {{ $totalVacantes }} vacantes
                            <span class="ml-2">→</span>
                        </a>
                    </div>
                    @endif
                </div>
                @endif

                <!-- Consejos para Empresas -->
                <div class="mt-8 bg-gradient-to-r from-blue-50 to-cyan-50 border border-blue-200 rounded-lg p-6 shadow-sm">
                    <h3 class="font-semibold text-blue-800 mb-3 flex items-center">
                        <span class="bg-blue-500 text-white p-1 rounded mr-2">💡</span>
                        Consejos para Reclutamiento
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2 text-blue-700 text-sm">
                        <div class="flex items-center">
                            <span class="mr-2">✅</span>
                            <span>Describe claramente los requisitos</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">✅</span>
                            <span>Ofrece salarios competitivos</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">✅</span>
                            <span>Responde rápidamente a postulaciones</span>
                        </div>
                        <div class="flex items-center">
                            <span class="mr-2">✅</span>
                            <span>Promociona los beneficios de tu empresa</span>
                        </div>
                    </div>
                </div>

            @elseif($user->empresa->estado == 'rechazada')
                <!-- EMPRESA RECHAZADA -->
                <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 rounded-lg p-8 text-center">
                    <div class="text-6xl mb-4">❌</div>
                    <h3 class="text-2xl font-bold text-red-800 mb-3">Empresa Rechazada</h3>
                    <p class="text-red-700 text-lg mb-4">Tu empresa <strong>{{ $user->empresa->nombre_empresa }}</strong> no cumplió con los requisitos de validación.</p>
                    @if($user->empresa->motivo_rechazo)
                        <div class="bg-white border border-red-200 rounded-lg p-4 mb-4 text-left">
                            <h4 class="font-semibold text-red-800 mb-2">Motivo del rechazo:</h4>
                            <p class="text-red-700">{{ $user->empresa->motivo_rechazo }}</p>
                        </div>
                    @endif
                    <a href="{{ route('empresa.perfil') }}" 
                       class="bg-gradient-to-r from-red-600 to-red-700 text-white px-8 py-3 rounded-lg text-lg font-semibold hover:from-red-700 hover:to-red-800 inline-block transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-edit me-2"></i>Corregir Datos de Empresa
                    </a>
                </div>
            @endif
        </div>
    </div>
@endif

    <script>
        const { createApp } = Vue;
        
        createApp({
            data() {
                return {
                    mostrarNotificaciones: false,
                    notificaciones: [],
                    contadorNotificaciones: 0,
                    cargandoNotificaciones: false,
                    intervalo: null
                }
            },
            mounted() {
                this.cargarContador();
                this.cargarNotificaciones();
                
                // Actualizar cada 30 segundos
                this.intervalo = setInterval(() => {
                    this.cargarContador();
                }, 30000);
                
                // Cerrar dropdown al hacer click fuera
                document.addEventListener('click', this.cerrarDropdown);
            },
            beforeUnmount() {
                if (this.intervalo) {
                    clearInterval(this.intervalo);
                }
                document.removeEventListener('click', this.cerrarDropdown);
            },
            methods: {
                async cargarNotificaciones() {
                    this.cargandoNotificaciones = true;
                    try {
                        const response = await axios.get('/api/notificaciones');
                        this.notificaciones = response.data.notificaciones.data || response.data.notificaciones;
                    } catch (error) {
                        console.error('Error cargando notificaciones:', error);
                    } finally {
                        this.cargandoNotificaciones = false;
                    }
                },
                
                async cargarContador() {
                    try {
                        const response = await axios.get('/api/notificaciones/contador');
                        this.contadorNotificaciones = response.data.contador;
                    } catch (error) {
                        console.error('Error cargando contador:', error);
                    }
                },
                
                async marcarLeida(notificacion) {
                    try {
                        await axios.post(`/api/notificaciones/${notificacion.id}/leida`);
                        notificacion.leida = true;
                        this.contadorNotificaciones = Math.max(0, this.contadorNotificaciones - 1);
                    } catch (error) {
                        console.error('Error marcando notificación como leída:', error);
                    }
                },
                
                async marcarTodasLeidas() {
                    try {
                        await axios.post('/api/notificaciones/marcar-todas-leidas');
                        this.notificaciones.forEach(n => n.leida = true);
                        this.contadorNotificaciones = 0;
                    } catch (error) {
                        console.error('Error marcando todas como leídas:', error);
                    }
                },
                
                async eliminarNotificacion(notificacion) {
                    if (!confirm('¿Eliminar esta notificación?')) return;
                    
                    try {
                        await axios.delete(`/api/notificaciones/${notificacion.id}`);
                        this.notificaciones = this.notificaciones.filter(n => n.id !== notificacion.id);
                        if (!notificacion.leida) {
                            this.contadorNotificaciones = Math.max(0, this.contadorNotificaciones - 1);
                        }
                    } catch (error) {
                        console.error('Error eliminando notificación:', error);
                    }
                },
                
                abrirNotificacion(notificacion) {
                    if (!notificacion.leida) {
                        this.marcarLeida(notificacion);
                    }
                    
                    // Navegar a la acción de la notificación
                    if (notificacion.data && notificacion.data.action_url) {
                        window.location.href = notificacion.data.action_url;
                    }
                    
                    this.mostrarNotificaciones = false;
                },
                
                toggleNotificaciones(event) {
                    event.stopPropagation();
                    this.mostrarNotificaciones = !this.mostrarNotificaciones;
                    if (this.mostrarNotificaciones) {
                        this.cargarNotificaciones();
                    }
                },
                
                cerrarDropdown(event) {
                    if (!event.target.closest('.notificaciones-container')) {
                        this.mostrarNotificaciones = false;
                    }
                },
                
                formatFecha(fecha) {
                    return new Date(fecha).toLocaleDateString('es-ES', {
                        day: 'numeric',
                        month: 'short',
                        hour: '2-digit',
                        minute: '2-digit'
                    });
                }
            }
        }).mount('#app');
    </script>

    <style>
        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            border: 2px solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spinner-border .75s linear infinite;
        }
        
        @keyframes spinner-border {
            to { transform: rotate(360deg); }
        }
        
        .notificaciones-dropdown {
            min-width: 320px;
        }
        
        .notificacion-item {
            transition: all 0.2s ease;
        }
        
        .btn-notificacion {
            transition: all 0.2s ease;
        }
        
        .btn-notificacion:hover {
            background-color: #f3f4f6;
        }
    </style>
</body>
</html>