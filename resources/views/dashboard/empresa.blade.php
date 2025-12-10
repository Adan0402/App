{{-- Dashboard para empresa --}}
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