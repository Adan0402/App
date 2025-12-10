
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