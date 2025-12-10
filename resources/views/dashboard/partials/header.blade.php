<nav class="bg-white shadow-md mb-6">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <!-- Logo -->
            <div>
                <a href="{{ url('/') }}" class="text-xl font-bold text-blue-700">
                    Bolsa de Trabajo ITSZN
                </a>
            </div>
            
            <!-- Menú derecho -->
            <div class="flex items-center space-x-6">
                <!-- Notificaciones -->
                <div class="relative">
                    <button @click="toggleNotifications" 
                            class="relative p-2 text-gray-600 hover:text-blue-600 transition">
                        <i class="fas fa-bell text-xl"></i>
                        <span v-if="contadorNotificaciones > 0" 
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{-- Usamos Vue.js para el contador --}}
                            @{{ contadorNotificaciones }}
                        </span>
                    </button>
                    
                    <!-- Dropdown de notificaciones -->
                    <div v-if="showNotificationsDropdown" 
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-200">
                        <div class="p-4 border-b border-gray-200">
                            <h3 class="font-semibold text-gray-800">Notificaciones</h3>
                        </div>
                        
                        <div class="max-h-96 overflow-y-auto">
                            <div v-if="cargandoNotificaciones" class="p-4 text-center">
                                <div class="inline-block animate-spin rounded-full h-6 w-6 border-b-2 border-blue-600"></div>
                            </div>
                            
                            <div v-else-if="notificaciones.length === 0" class="p-8 text-center">
                                <i class="fas fa-bell-slash text-gray-300 text-3xl mb-2"></i>
                                <p class="text-gray-500">No hay notificaciones</p>
                            </div>
                            
                            <div v-else>
                                <div v-for="notificacion in notificaciones.slice(0, 10)" 
                                     :key="notificacion.id"
                                     :class="['p-4 border-b border-gray-100 hover:bg-gray-50 cursor-pointer transition', 
                                             { 'bg-blue-50': !notificacion.leida }]"
                                     @click="abrirNotificacion(notificacion)">
                                    <div class="flex items-start">
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800 text-sm mb-1 flex items-center">
                                                <span v-if="!notificacion.leida" 
                                                      class="bg-blue-500 rounded-full w-2 h-2 mr-2"></span>
                                                @{{ notificacion.titulo }}
                                            </h4>
                                            <p class="text-gray-600 text-sm">@{{ notificacion.mensaje }}</p>
                                            <p class="text-gray-400 text-xs mt-2">
                                                @{{ formatFecha(notificacion.created_at) }}
                                            </p>
                                        </div>
                                        <div class="flex space-x-1 ml-2">
                                            <button v-if="!notificacion.leida" 
                                                    @click.stop="marcarLeida(notificacion)"
                                                    class="text-green-600 hover:text-green-800 p-1"
                                                    title="Marcar como leída">
                                                <i class="fas fa-check text-sm"></i>
                                            </button>
                                            <button @click.stop="eliminarNotificacion(notificacion)"
                                                    class="text-red-600 hover:text-red-800 p-1"
                                                    title="Eliminar">
                                                <i class="fas fa-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-3 border-t border-gray-200 text-center">
                            <a href="{{ route('notificaciones') }}" 
                               class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                Ver todas las notificaciones
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Usuario -->
                <div class="relative">
                    <button @click="toggleUserMenu" 
                            class="flex items-center space-x-2 text-gray-700 hover:text-blue-600">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-blue-600"></i>
                        </div>
                        <span class="hidden md:inline">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>
                    
                    <!-- Dropdown de usuario -->
                    <div v-if="showUserMenu" 
                         class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-md py-2 z-50">
                        <a href="{{ route('perfil') }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-user mr-2"></i> Mi Perfil
                        </a>
                        <a href="{{ url('/dashboard') }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-gray-100">
                            <i class="fas fa-home mr-2"></i> Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-sign-out-alt mr-2"></i> Cerrar Sesión
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>