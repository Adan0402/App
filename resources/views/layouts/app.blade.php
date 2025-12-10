<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- ✅ TOKEN DE SEGURIDAD (IMPORTANTE) -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Bolsa Trabajo ITSZN')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- ✅ BIBLIOTECAS NECESARIAS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        
        /* Estilo para el header */
        .header-app {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        
        /* Botón de logout */
        .btn-logout {
            background-color: #ef4444;
            color: white;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.2s;
            border: none;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-logout:hover {
            background-color: #dc2626;
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-gray-50">
    
    <!-- ✅ HEADER CON BOTÓN DE CERRAR SESIÓN -->
    <header class="header-app text-white">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo y nombre -->
                <div class="flex items-center space-x-3">
                    <i class="fas fa-briefcase text-2xl"></i>
                    <div>
                        <h1 class="text-xl font-bold">Bolsa de Trabajo ITSZN</h1>
                        <p class="text-sm text-blue-100 opacity-80">Sistema de empleo y servicio social</p>
                    </div>
                </div>
                
                <!-- Información del usuario y logout -->
                <div class="flex items-center space-x-4">
                    @auth
                    <!-- Nombre del usuario -->
                    <div class="hidden md:block text-right">
                        <p class="font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-sm text-blue-100">
                            @if(Auth::user()->tipo == 'admin')
                                👑 Administrador
                            @elseif(Auth::user()->tipo == 'empresa')
                                🏢 Empresa
                            @elseif(Auth::user()->tipo == 'alumno')
                                🎓 Estudiante
                            @else
                                👤 Usuario
                            @endif
                        </p>
                    </div>
                    
                    <!-- Botón de Cerrar Sesión -->
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="btn-logout">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="hidden sm:inline">Cerrar Sesión</span>
                        </button>
                    </form>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- CONTENIDO PRINCIPAL -->
    <main class="container mx-auto px-4 py-8">
        @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
        @endif
        
        @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- ✅ AXIOS PARA PETICIONES AJAX -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    
    <!-- ✅ CONFIGURACIÓN DE SEGURIDAD PARA TODAS LAS PETICIONES -->
    <script>
        // Obtener el token CSRF del meta tag
        const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
        
        // Configurar jQuery para enviar el token automáticamente
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': csrfToken
            }
        });
        
        // Configurar Axios para enviar el token automáticamente
        axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        
        // Confirmación antes de cerrar sesión (opcional)
        document.addEventListener('DOMContentLoaded', function() {
            const logoutForm = document.querySelector('form[action*="logout"]');
            if (logoutForm) {
                logoutForm.addEventListener('submit', function(e) {
                    if (!confirm('¿Estás seguro de que quieres cerrar sesión?')) {
                        e.preventDefault();
                    }
                });
            }
            
            // Manejar errores 419 (sesión expirada)
            document.addEventListener('ajaxError', function(event) {
                if (event.detail.xhr.status === 419) {
                    alert('Tu sesión ha expirado. Serás redirigido al login.');
                    window.location.href = '/login';
                }
            });
        });
        
        // Función para hacer peticiones seguras
        function makeRequest(url, method = 'GET', data = {}) {
            return axios({
                method: method,
                url: url,
                data: data,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        }
    </script>
    
    <!-- Scripts específicos de cada página -->
    @stack('scripts')
    
    <!-- ✅ FOOTER OPCIONAL -->
    <footer class="bg-gray-800 text-white py-6 mt-12">
        <div class="container mx-auto px-4 text-center">
            <p class="text-gray-400">
                <i class="fas fa-graduation-cap mr-2"></i>
                Instituto Tecnológico Superior de Zacatecas Norte
            </p>
            <p class="text-sm text-gray-500 mt-2">
                Sistema de Bolsa de Trabajo & Servicio Social • {{ date('Y') }}
            </p>
        </div>
    </footer>
</body>
</html>