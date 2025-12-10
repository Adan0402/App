<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Bolsa Trabajo ITSZN</title>
    
    <!-- TODAS LAS LIBRERÍAS (igual que antes) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://unpkg.com/vue@3/dist/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- ✅ TOKEN CSRF -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-100">
    <div id="app">
        <!-- ✅ HEADER COMPLETO (CON NOTIFICACIONES) -->
        <header class="bg-white shadow-sm border-b border-gray-200">
            <div class="container mx-auto px-4 py-3">
                <div class="flex justify-between items-center">
                    <div class="flex items-center space-x-4">
                        <!-- Logo TecNM -->
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('images/logo-tecnm.png') }}" 
                                 alt="Logo TecNM" 
                                 class="h-12 w-auto">
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
                                <div class="p-4 border-b border-gray-200">
                                    <div class="flex justify-between items-center">
                                        <h3 class="font-semibold text-gray-800">Notificaciones</h3>
                                        <button @click="marcarTodasLeidas" 
                                                class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                            Marcar todas como leídas
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="max-h-96 overflow-y-auto">
                                    <div v-if="cargandoNotificaciones" class="p-8 text-center">
                                        <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600"></div>
                                        <p class="text-gray-500 text-sm mt-2">Cargando notificaciones...</p>
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
                        
                        <!-- Enlaces de navegación -->
                        <div class="flex items-center space-x-4">
                            <a href="/dashboard" 
                               class="text-gray-600 hover:text-blue-600 font-medium transition duration-200 flex items-center">
                                <i class="fas fa-tachometer-alt mr-2"></i>
                                Dashboard
                            </a>
                            <!-- ✅ BOTÓN LOGOUT -->
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-800 font-medium transition duration-200 flex items-center">
                                    <i class="fas fa-sign-out-alt mr-2"></i>
                                    Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- ✅ CONTENIDO SEGÚN TIPO DE USUARIO -->
        <div class="container mx-auto px-4 py-8">
            @if($user->tipo == 'admin')
                @include('dashboard.admin')
            @elseif($user->tipo == 'alumno')
                @include('dashboard.alumno')
            @elseif($user->tipo == 'empresa')
                @include('dashboard.empresa')
            @endif
        </div>
    </div>

    <!-- ✅ SCRIPT VUE CORREGIDO -->
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
                
                // Actualizar contador cada 30 segundos
                this.intervalo = setInterval(() => {
                    this.cargarContador();
                }, 30000);
                
                // Cerrar dropdown al hacer clic fuera
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
                        
                        // ✅ CORRECCIÓN: Maneja diferentes formatos de respuesta
                        if (response.data.notificaciones && response.data.notificaciones.data) {
                            // Formato con paginación: { notificaciones: { data: [...] } }
                            this.notificaciones = response.data.notificaciones.data;
                        } else if (response.data.notificaciones) {
                            // Formato directo: { notificaciones: [...] }
                            this.notificaciones = response.data.notificaciones;
                        } else {
                            this.notificaciones = [];
                        }
                        
                    } catch (error) {
                        console.error('Error cargando notificaciones:', error);
                    } finally {
                        this.cargandoNotificaciones = false;
                    }
                },
                
                async cargarContador() {
                    try {
                        const response = await axios.get('/api/notificaciones/contador');
                        this.contadorNotificaciones = response.data.contador || 0;
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
                    // Marcar como leída al abrir
                    if (!notificacion.leida) {
                        this.marcarLeida(notificacion);
                    }
                    
                    // Redirigir si tiene URL de acción
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
                    if (!fecha) return '';
                    
                    try {
                        const fechaObj = new Date(fecha);
                        return fechaObj.toLocaleDateString('es-ES', {
                            day: 'numeric',
                            month: 'short',
                            hour: '2-digit',
                            minute: '2-digit'
                        });
                    } catch (error) {
                        return fecha;
                    }
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
        
        /* Estilo para notificaciones no leídas */
        .notificacion-no-leida {
            background-color: #f0f9ff;
            border-left: 4px solid #3b82f6;
        }
        
        /* Animación para el contador */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .contador-notificaciones {
            animation: pulse 0.5s ease-in-out;
        }
    </style>
</body>
</html>