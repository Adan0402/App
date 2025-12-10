{{-- Dashboard para admin --}}
<div class="bg-white rounded-lg shadow-md overflow-hidden">
    <!-- Header con color consistente -->
    <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
        <h2 class="text-xl font-bold text-white">👨‍💼 Panel de Administración - ITSZN</h2>
        <p class="text-red-100 text-sm mt-1">Sistema de gestión integral</p>
    </div>

    <div class="p-6">
        <!-- ACCIONES RÁPIDAS - TODAS LAS TARJETAS -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center">
                <span class="bg-red-100 text-red-600 p-2 rounded-lg mr-3">⚡</span>
                Acciones de Administración
            </h3>
            
            <!-- PRIMERA FILA - 4 RECUADROS ORIGINALES + 2 NUEVOS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-4">
                <!-- 👥 Gestionar Usuarios (ORIGINAL) -->
                <a href="/usuarios" 
                   class="group bg-gradient-to-br from-blue-50 to-blue-100 p-4 rounded-lg border border-blue-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">👥</div>
                    <p class="font-semibold text-blue-800">Gestionar Usuarios</p>
                    <p class="text-sm text-blue-600 mt-1">{{ $totalUsuarios ?? 0 }} registrados</p>
                </a>
                
                <!-- 🏢 Validar Empresas (ORIGINAL) -->
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
                
                <!-- 📋 Validar Vacantes (ORIGINAL) -->
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
                
                <!-- 🔔 Notificaciones (ORIGINAL) -->
                <a href="{{ route('notificaciones') }}" 
                   class="group bg-gradient-to-br from-orange-50 to-orange-100 p-4 rounded-lg border border-orange-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔔</div>
                    <p class="font-semibold text-orange-800">Notificaciones</p>
                    <p class="text-sm text-orange-600 mt-1">Gestionar alertas</p>
                </a>

                <!-- 📝 REGISTRAR EMPRESA (NUEVO) -->
                <a href="{{ route('admin.empresas.crear') }}" 
                   class="group bg-gradient-to-br from-teal-50 to-teal-100 p-4 rounded-lg border border-teal-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🏢</div>
                    <p class="font-semibold text-teal-800">Registrar Empresa</p>
                    <p class="text-sm text-teal-600 mt-1">Nueva empresa</p>
                    <div class="mt-2 text-xs text-teal-500">
                        <p>✅ Sin aprobación</p>
                    </div>
                </a>
                
                <!-- ✏️ PUBLICAR VACANTE (NUEVO) -->
                <a href="{{ route('admin.vacantes.crear') }}" 
                   class="group bg-gradient-to-br from-amber-50 to-amber-100 p-4 rounded-lg border border-amber-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">✏️</div>
                    <p class="font-semibold text-amber-800">Publicar Vacante</p>
                    <p class="text-sm text-amber-600 mt-1">Nueva vacante</p>
                    <div class="mt-2 text-xs text-amber-500">
                        <p>🚀 Directo al sistema</p>
                    </div>
                </a>
            </div>

            <!-- SEGUNDA FILA - 2 RECUADROS ORIGINALES + 2 NUEVOS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 max-w-4xl mx-auto">
                <!-- 🎓 Panel Servicio Social (ORIGINAL) -->
                <a href="{{ route('admin.servicio-social.login') }}" 
                   class="group bg-gradient-to-br from-indigo-50 to-indigo-100 p-4 rounded-lg border border-indigo-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🎓</div>
                    <p class="font-semibold text-indigo-800">Panel Servicio Social</p>
                    <p class="text-sm text-indigo-600 mt-1">Acceso coordinador</p>
                    <div class="mt-2 text-xs text-indigo-500">
                        <p>📊 Estadísticas</p>
                    </div>
                </a>

                <!-- 🔧 Soporte Técnico (ORIGINAL) -->
                <a href="{{ route('admin.soporte-tecnico') }}" 
                   class="group bg-gradient-to-br from-gray-50 to-gray-100 p-4 rounded-lg border border-gray-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">🔧</div>
                    <p class="font-semibold text-gray-800">Soporte Técnico</p>
                    <p class="text-sm text-gray-600 mt-1">Sistema y ayuda</p>
                    <div class="mt-2 text-xs text-gray-500">
                        <p>🛠️ Reportar problemas</p>
                    </div>
                </a>

                <!-- 🏢 Gestionar Empresas (NUEVO) -->
                <a href="{{ route('admin.empresas.todas') }}" 
                   class="group bg-gradient-to-br from-emerald-50 to-emerald-100 p-4 rounded-lg border border-emerald-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">📋</div>
                    <p class="font-semibold text-emerald-800">Gestionar Empresas</p>
                    <p class="text-sm text-emerald-600 mt-1">{{ $empresas ?? 0 }} registradas</p>
                    <div class="mt-2 text-xs text-emerald-500">
                        <p>📈 Ver todas</p>
                    </div>
                </a>

                <!-- 💼 Gestionar Vacantes (NUEVO) -->
                <a href="{{ route('admin.vacantes.todas') }}" 
                   class="group bg-gradient-to-br from-violet-50 to-violet-100 p-4 rounded-lg border border-violet-200 hover:shadow-lg transition-all duration-300 text-center hover:transform hover:-translate-y-1">
                    <div class="text-2xl mb-2 group-hover:scale-110 transition-transform">💼</div>
                    <p class="font-semibold text-violet-800">Gestionar Vacantes</p>
                    <p class="text-sm text-violet-600 mt-1">{{ $vacantes ?? 0 }} activas</p>
                    <div class="mt-2 text-xs text-violet-500">
                        <p>📊 Administrar todas</p>
                    </div>
                </a>
            </div>
        </div>

        <!-- 📊 ESTADÍSTICAS - 6 RECUADROS -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-4 mb-8">
            <!-- Usuarios Totales -->
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-blue-500 p-3 rounded-full">
                        <span class="text-white text-xl">👥</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-blue-600 font-medium">Total Usuarios</p>
                        <p class="text-2xl font-bold text-blue-700">{{ $totalUsuarios ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Alumnos -->
            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-green-500 p-3 rounded-full">
                        <span class="text-white text-xl">🎓</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-green-600 font-medium">Alumnos</p>
                        <p class="text-2xl font-bold text-green-700">{{ $alumnos ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- Empresas -->
            <div class="bg-gradient-to-br from-teal-50 to-teal-100 p-6 rounded-lg border border-teal-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-teal-500 p-3 rounded-full">
                        <span class="text-white text-xl">🏢</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-teal-600 font-medium">Empresas</p>
                        <p class="text-2xl font-bold text-teal-700">{{ $empresas ?? 0 }}</p>
                        @if(isset($empresasPendientesCount) && $empresasPendientesCount > 0)
                            <p class="text-xs text-red-600 mt-1">{{ $empresasPendientesCount }} pendientes</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Vacantes -->
            <div class="bg-gradient-to-br from-amber-50 to-amber-100 p-6 rounded-lg border border-amber-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-amber-500 p-3 rounded-full">
                        <span class="text-white text-xl">💼</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-amber-600 font-medium">Vacantes</p>
                        <p class="text-2xl font-bold text-amber-700">{{ $vacantes ?? 0 }}</p>
                        @if(isset($vacantesPendientesCount) && $vacantesPendientesCount > 0)
                            <p class="text-xs text-red-600 mt-1">{{ $vacantesPendientesCount }} pendientes</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Notificaciones -->
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

            <!-- Servicio Social -->
            <div class="bg-gradient-to-br from-indigo-50 to-indigo-100 p-6 rounded-lg border border-indigo-200 shadow-sm">
                <div class="flex items-center">
                    <div class="bg-indigo-500 p-3 rounded-full">
                        <span class="text-white text-xl">📊</span>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm text-indigo-600 font-medium">Servicio Social</p>
                        <p class="text-2xl font-bold text-indigo-700">{{ $servicioSocial ?? 0 }}</p>
                        <p class="text-xs text-indigo-500 mt-1">Registros</p>
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