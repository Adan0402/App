<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificaciones - Bolsa Trabajo ITSZN</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <style>
        :root {
            --itszn-primary: #1B396A;
            --itszn-secondary: #2D4F8A;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --info-color: #3b82f6;
        }
        
        /* ANIMACIONES */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        @keyframes slideInRight {
            from { transform: translateX(20px); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        .fade-in {
            animation: fadeIn 0.5s ease-out;
        }
        
        .pulse-soft {
            animation: pulse 2s infinite;
        }
        
        .slide-in-right {
            animation: slideInRight 0.3s ease-out;
        }
        
        /* NAVBAR MEJORADA */
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            background: linear-gradient(135deg, #ffffff, #e2e8f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .navbar-institucional {
            background: linear-gradient(135deg, var(--itszn-primary) 0%, var(--itszn-secondary) 100%);
            box-shadow: 0 4px 20px rgba(27, 57, 106, 0.3);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            border: 2px solid white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        
        /* CARDS Y NOTIFICACIONES */
        .card-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(27, 57, 106, 0.1);
        }
        
        .notificacion-item {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border-radius: 12px;
            margin-bottom: 1rem;
            border: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            overflow: hidden;
        }
        
        .notificacion-item:hover {
            transform: translateY(-3px) scale(1.005);
            box-shadow: 0 8px 25px rgba(27, 57, 106, 0.15);
        }
        
        .notificacion-item.no-leida {
            background: linear-gradient(135deg, #eff6ff, #f8fafc);
            border-left: 4px solid var(--itszn-primary);
            position: relative;
        }
        
        .notificacion-item.no-leida::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--itszn-primary), var(--itszn-secondary));
        }
        
        .notificacion-item.leida {
            background: #ffffff;
            border-left: 4px solid #e5e7eb;
        }
        
        .notification-icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .vacante-nueva { 
            background: linear-gradient(135deg, var(--itszn-primary), var(--itszn-secondary));
            color: white; 
        }
        .postulacion-aceptada { 
            background: linear-gradient(135deg, var(--success-color), #059669);
            color: white; 
        }
        .postulacion-rechazada { 
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            color: white; 
        }
        .servicio-social { 
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
            color: white; 
        }
        .default-icon { 
            background: linear-gradient(135deg, #6b7280, #4b5563);
            color: white; 
        }
        
        /* BOTONES */
        .btn-itszn {
            background: linear-gradient(135deg, var(--itszn-primary), var(--itszn-secondary));
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 12px rgba(27, 57, 106, 0.2);
        }
        
        .btn-itszn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(27, 57, 106, 0.3);
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--success-color), #059669);
            border: none;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            border: none;
        }
        
        .btn-warning {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            border: none;
        }
        
        /* BADGES */
        .user-type-badge {
            background: linear-gradient(135deg, var(--warning-color), #d97706);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.5px;
            text-transform: uppercase;
        }
        
        .badge-nuevo {
            background: linear-gradient(135deg, var(--danger-color), #dc2626);
            font-size: 0.65rem;
            padding: 0.1rem 0.5rem;
            margin-left: 0.5rem;
        }
        
        /* CARD HEADER */
        .card-header-institucional {
            background: linear-gradient(135deg, var(--itszn-primary) 0%, var(--itszn-secondary) 100%);
            color: white;
            border-radius: 12px 12px 0 0 !important;
            padding: 1.5rem !important;
        }
        
        /* STATS CARDS */
        .stat-card {
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .stat-card .card-body {
            padding: 1.5rem;
        }
        
        /* LOADING */
        .spinner-itszn {
            width: 3rem;
            height: 3rem;
            border: 3px solid rgba(27, 57, 106, 0.1);
            border-top-color: var(--itszn-primary);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        
        /* EMPTY STATE */
        .empty-state {
            padding: 4rem 1rem;
            text-align: center;
        }
        
        .empty-state-icon {
            font-size: 4rem;
            background: linear-gradient(135deg, #f1f5f9, #e2e8f0);
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #94a3b8;
        }
        
        /* DROPDOWN */
        .dropdown-menu {
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .dropdown-item {
            border-radius: 8px;
            margin: 0.25rem;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: linear-gradient(135deg, var(--itszn-primary), var(--itszn-secondary));
            color: white;
            transform: translateX(5px);
        }
        
        /* TOAST NOTIFICATIONS */
        .toast-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            animation: slideInRight 0.3s ease-out;
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            .notification-icon {
                width: 40px;
                height: 40px;
                font-size: 0.9rem;
            }
            
            .stat-card .card-body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-50">
    <!-- NAVBAR MEJORADA -->
    <nav class="navbar navbar-expand-lg navbar-institucional navbar-dark shadow-lg">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/dashboard">
                <i class="fas fa-briefcase me-2"></i>
                <span>Bolsa Trabajo ITSZN</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center" href="/dashboard">
                            <i class="fas fa-home me-2"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item position-relative">
                        <a class="nav-link d-flex align-items-center active" href="/notificaciones">
                            <i class="fas fa-bell me-2"></i>
                            <span>Notificaciones</span>
                            <span id="notification-count" class="notification-badge d-none">0</span>
                        </a>
                    </li>
                </ul>
                
                <div class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <div class="me-2">
                                <i class="fas fa-user-circle fa-lg"></i>
                            </div>
                            <div class="d-flex flex-column">
                                <span id="user-name" class="fw-semibold">Usuario</span>
                                <span id="user-type" class="user-type-badge">Alumno</span>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item d-flex align-items-center" href="/dashboard">
                                <i class="fas fa-tachometer-alt me-3"></i>
                                <span>Mi Dashboard</span>
                            </a></li>
                            <li><a class="dropdown-item d-flex align-items-center" href="/perfil">
                                <i class="fas fa-user-edit me-3"></i>
                                <span>Mi Perfil</span>
                            </a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="/logout" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item d-flex align-items-center">
                                        <i class="fas fa-sign-out-alt me-3"></i>
                                        <span>Cerrar Sesión</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="container py-4 fade-in">
        <!-- BREADCRUMB -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb bg-white rounded-lg p-3 shadow-sm">
                <li class="breadcrumb-item">
                    <a href="/dashboard" class="text-decoration-none d-flex align-items-center">
                        <i class="fas fa-home me-2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="breadcrumb-item active d-flex align-items-center">
                    <i class="fas fa-bell me-2"></i>
                    <span>Notificaciones</span>
                </li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-12">
                <div class="card card-glass border-0 overflow-hidden">
                    <!-- CARD HEADER -->
                    <div class="card-header-institucional d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                        <div class="mb-3 mb-md-0">
                            <h2 class="h3 mb-2 fw-bold">
                                <i class="fas fa-bell me-3"></i>
                                Mis Notificaciones
                            </h2>
                            <p class="mb-0 opacity-75">Gestiona todas tus notificaciones en un solo lugar</p>
                        </div>
                        <div class="d-flex flex-wrap gap-2">
                            <button id="marcarTodasLeidas" class="btn btn-success d-flex align-items-center">
                                <i class="fas fa-check-double me-2"></i>
                                <span>Marcar todas</span>
                            </button>
                            <button id="eliminarTodas" class="btn btn-danger d-flex align-items-center">
                                <i class="fas fa-trash-alt me-2"></i>
                                <span>Eliminar todas</span>
                            </button>
                            <a href="/dashboard" class="btn-itszn d-flex align-items-center">
                                <i class="fas fa-arrow-left me-2"></i>
                                <span>Volver</span>
                            </a>
                        </div>
                    </div>
                    
                    <!-- CARD BODY -->
                    <div class="card-body p-4">
                        <!-- ESTADÍSTICAS -->
                        <div class="row g-4 mb-5">
                            <div class="col-md-3 col-6">
                                <div class="stat-card bg-primary text-white">
                                    <div class="card-body text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-bell fa-2x me-3"></i>
                                            <h3 class="mb-0 fw-bold" id="total-notificaciones">0</h3>
                                        </div>
                                        <p class="mb-0 fw-medium opacity-75">Total Notificaciones</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="stat-card bg-warning text-white">
                                    <div class="card-body text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-envelope fa-2x me-3"></i>
                                            <h3 class="mb-0 fw-bold" id="no-leidas-count">0</h3>
                                        </div>
                                        <p class="mb-0 fw-medium opacity-75">No Leídas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="stat-card bg-success text-white">
                                    <div class="card-body text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-check-circle fa-2x me-3"></i>
                                            <h3 class="mb-0 fw-bold" id="leidas-count">0</h3>
                                        </div>
                                        <p class="mb-0 fw-medium opacity-75">Leídas</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="stat-card bg-info text-white">
                                    <div class="card-body text-center">
                                        <div class="d-flex align-items-center justify-content-center mb-3">
                                            <i class="fas fa-calendar-day fa-2x me-3"></i>
                                            <h3 class="mb-0 fw-bold" id="hoy-count">0</h3>
                                        </div>
                                        <p class="mb-0 fw-medium opacity-75">Hoy</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- LOADING -->
                        <div id="loading" class="text-center py-5">
                            <div class="spinner-itszn mx-auto"></div>
                            <p class="mt-4 text-muted fw-medium">Cargando tus notificaciones...</p>
                        </div>
                        
                        <!-- LISTA DE NOTIFICACIONES -->
                        <div id="notificaciones-list" class="d-none">
                            <!-- Las notificaciones se cargarán aquí via JavaScript -->
                        </div>
                        
                        <!-- SIN NOTIFICACIONES -->
                        <div id="no-notificaciones" class="empty-state d-none">
                            <div class="empty-state-icon">
                                <i class="fas fa-bell-slash"></i>
                            </div>
                            <h3 class="h4 mb-3 text-gray-600 fw-bold">No tienes notificaciones</h3>
                            <p class="text-gray-500 mb-4 max-w-md mx-auto">
                                Cuando recibas nuevas notificaciones sobre vacantes, postulaciones o servicio social, aparecerán aquí.
                            </p>
                            <a href="/dashboard" class="btn-itszn d-inline-flex align-items-center">
                                <i class="fas fa-arrow-left me-2"></i>
                                <span>Volver al Dashboard</span>
                            </a>
                        </div>
                        
                        <!-- PAGINACIÓN -->
                        <nav id="pagination" class="d-none mt-5">
                            <!-- Paginación se cargará aquí -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TOAST PARA FEEDBACK -->
    <div id="toast-container" class="position-fixed" style="z-index: 9999; top: 20px; right: 20px;"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
    class NotificacionesManager {
        constructor() {
            this.currentPage = 1;
            this.init();
        }
        
        init() {
            this.cargarInfoUsuario();
            this.cargarNotificaciones();
            this.bindEvents();
            this.cargarContador();
        }
        
        cargarInfoUsuario() {
            $('#user-name').text('{{ Auth::user()->name ?? "Usuario" }}');
            $('#user-type').text('{{ Auth::user()->tipo ?? "Usuario" }}'.charAt(0).toUpperCase() + 
                                '{{ Auth::user()->tipo ?? "Usuario" }}'.slice(1));
        }
        
        async cargarContador() {
            try {
                const response = await axios.get('/api/notificaciones/contador');
                const contador = response.data.contador;
                
                if (contador > 0) {
                    $('#notification-count').text(contador).removeClass('d-none');
                    $('#notification-count').addClass('pulse-soft');
                } else {
                    $('#notification-count').addClass('d-none');
                }
            } catch (error) {
                console.error('Error cargando contador:', error);
            }
        }
        
        async cargarNotificaciones(page = 1) {
            this.currentPage = page;
            
            $('#loading').removeClass('d-none');
            $('#notificaciones-list').addClass('d-none');
            $('#no-notificaciones').addClass('d-none');
            $('#pagination').addClass('d-none');
            
            try {
                const response = await axios.get(`/api/notificaciones?page=${page}`);
                this.mostrarNotificaciones(response.data);
                this.actualizarEstadisticas(response.data);
            } catch (error) {
                console.error('Error cargando notificaciones:', error);
                this.mostrarError();
            }
        }
        
        actualizarEstadisticas(data) {
            const notificaciones = data.notificaciones.data;
            const total = notificaciones.length;
            const noLeidas = notificaciones.filter(n => !n.leida).length;
            const leidas = total - noLeidas;
            const hoy = notificaciones.filter(n => {
                const fecha = new Date(n.created_at);
                const hoy = new Date();
                return fecha.toDateString() === hoy.toDateString();
            }).length;
            
            $('#total-notificaciones').text(total);
            $('#no-leidas-count').text(noLeidas);
            $('#leidas-count').text(leidas);
            $('#hoy-count').text(hoy);
        }
        
        mostrarNotificaciones(data) {
            $('#loading').addClass('d-none');
            
            if (data.notificaciones.data.length === 0) {
                $('#no-notificaciones').removeClass('d-none');
                return;
            }
            
            const notificacionesHtml = data.notificaciones.data.map((notificacion, index) => {
                const fecha = new Date(notificacion.created_at);
                const iconClass = this.getIconClass(notificacion.tipo);
                const isLeida = notificacion.leida;
                const isHoy = new Date(notificacion.created_at).toDateString() === new Date().toDateString();
                const fechaTexto = isHoy ? `Hoy ${fecha.toLocaleTimeString('es-ES', {hour: '2-digit', minute:'2-digit'})}` : 
                                         fecha.toLocaleDateString('es-ES', {weekday: 'short', day: 'numeric', month: 'short'});
                
                return `
                    <div class="notificacion-item ${!isLeida ? 'no-leida' : 'leida'} p-4 slide-in-right" style="animation-delay: ${index * 0.05}s">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon ${iconClass}">
                                <i class="${this.getIcon(notificacion.tipo)} fa-lg"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <div>
                                        <h6 class="mb-1 ${!isLeida ? 'text-dark fw-bold' : 'text-muted'}">
                                            ${notificacion.titulo}
                                            ${!isLeida ? '<span class="badge-nuevo badge">NUEVO</span>' : ''}
                                        </h6>
                                        <p class="mb-2 ${!isLeida ? 'text-dark' : 'text-muted'}">${notificacion.mensaje}</p>
                                    </div>
                                    <small class="text-muted">${fechaTexto}</small>
                                </div>
                                
                                ${notificacion.data && notificacion.data.action_url ? `
                                    <div class="mt-3">
                                        <a href="${notificacion.data.action_url}" class="btn-itszn btn-sm d-inline-flex align-items-center">
                                            <i class="fas fa-external-link-alt me-2"></i>
                                            <span>Ver detalles</span>
                                        </a>
                                    </div>
                                ` : ''}
                            </div>
                            
                            <div class="notificacion-actions ms-3 d-flex flex-column">
                                ${!isLeida ? `
                                    <button class="btn btn-success btn-sm mb-2 marcar-leida" data-id="${notificacion.id}" 
                                            title="Marcar como leída">
                                        <i class="fas fa-check"></i>
                                    </button>
                                ` : ''}
                                
                                <button class="btn btn-danger btn-sm eliminar-notificacion" data-id="${notificacion.id}" 
                                        title="Eliminar notificación">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
            
            $('#notificaciones-list').html(notificacionesHtml).removeClass('d-none');
            
            if (data.notificaciones.links) {
                this.mostrarPaginacion(data.notificaciones);
            }
            
            this.bindNotificacionEvents();
        }
        
        getIconClass(tipo) {
            const iconMap = {
                'vacante_nueva': 'vacante-nueva',
                'postulacion_aceptada': 'postulacion-aceptada',
                'postulacion_rechazada': 'postulacion-rechazada',
                'servicio_social_actualizado': 'servicio-social',
                'nueva_postulacion_empresa': 'vacante-nueva'
            };
            return iconMap[tipo] || 'default-icon';
        }
        
        getIcon(tipo) {
            const iconMap = {
                'vacante_nueva': 'fas fa-bullhorn',
                'postulacion_aceptada': 'fas fa-check-circle',
                'postulacion_rechazada': 'fas fa-times-circle',
                'servicio_social_actualizado': 'fas fa-graduation-cap',
                'nueva_postulacion_empresa': 'fas fa-user-plus'
            };
            return iconMap[tipo] || 'fas fa-bell';
        }
        
        mostrarPaginacion(pagination) {
            let paginationHtml = '<ul class="pagination justify-content-center">';
            
            if (pagination.current_page > 1) {
                paginationHtml += `
                    <li class="page-item">
                        <a class="page-link pagination-link border-0 shadow-sm" href="#" data-page="${pagination.current_page - 1}">
                            <i class="fas fa-chevron-left me-2"></i> Anterior
                        </a>
                    </li>
                `;
            }
            
            const totalPages = pagination.last_page;
            const currentPage = pagination.current_page;
            
            for (let page = 1; page <= totalPages; page++) {
                if (page === 1 || page === totalPages || (page >= currentPage - 1 && page <= currentPage + 1)) {
                    paginationHtml += `
                        <li class="page-item ${page === currentPage ? 'active' : ''}">
                            <a class="page-link pagination-link border-0 shadow-sm" href="#" data-page="${page}">${page}</a>
                        </li>
                    `;
                } else if (page === currentPage - 2 || page === currentPage + 2) {
                    paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                }
            }
            
            if (currentPage < totalPages) {
                paginationHtml += `
                    <li class="page-item">
                        <a class="page-link pagination-link border-0 shadow-sm" href="#" data-page="${currentPage + 1}">
                            Siguiente <i class="fas fa-chevron-right ms-2"></i>
                        </a>
                    </li>
                `;
            }
            
            paginationHtml += '</ul>';
            $('#pagination').html(paginationHtml).removeClass('d-none');
            
            $('.pagination-link').on('click', (e) => {
                e.preventDefault();
                const page = $(e.target).data('page');
                this.cargarNotificaciones(page);
            });
        }
        
        bindEvents() {
            $('#marcarTodasLeidas').on('click', () => this.marcarTodasLeidas());
            $('#eliminarTodas').on('click', () => this.eliminarTodas());
        }
        
        bindNotificacionEvents() {
            $('.marcar-leida').on('click', (e) => {
                const notificacionId = $(e.target).closest('button').data('id');
                this.marcarLeida(notificacionId);
            });
            
            $('.eliminar-notificacion').on('click', (e) => {
                const notificacionId = $(e.target).closest('button').data('id');
                this.eliminarNotificacion(notificacionId);
            });
            
            $('.notificacion-item').on('click', (e) => {
                if (!$(e.target).closest('.notificacion-actions').length && 
                    !$(e.target).is('a') && !$(e.target).closest('a').length) {
                    const notificacionId = $(e.currentTarget).find('.marcar-leida').data('id');
                    if (notificacionId) {
                        this.marcarLeida(notificacionId);
                    }
                }
            });
        }
        
        async marcarLeida(notificacionId) {
            try {
                await axios.post(`/api/notificaciones/${notificacionId}/leida`);
                const $notificacionItem = $(`.marcar-leida[data-id="${notificacionId}"]`).closest('.notificacion-item');
                $notificacionItem.removeClass('no-leida').addClass('leida');
                $notificacionItem.find('.marcar-leida').remove();
                $notificacionItem.find('.badge-nuevo').remove();
                this.actualizarContadorGlobal();
                this.cargarNotificaciones(this.currentPage);
                this.mostrarToast('Notificación marcada como leída', 'success');
            } catch (error) {
                console.error('Error marcando notificación como leída:', error);
                this.mostrarToast('Error al marcar como leída', 'danger');
            }
        }
        
        async marcarTodasLeidas() {
            if (!confirm('¿Marcar todas las notificaciones como leídas?')) return;
            
            try {
                await axios.post('/api/notificaciones/marcar-todas-leidas');
                this.cargarNotificaciones(this.currentPage);
                this.actualizarContadorGlobal();
                this.mostrarToast('Todas las notificaciones marcadas como leídas', 'success');
            } catch (error) {
                console.error('Error marcando todas como leídas:', error);
                this.mostrarToast('Error al marcar todas como leídas', 'danger');
            }
        }
        
        async eliminarNotificacion(notificacionId) {
            if (!confirm('¿Eliminar esta notificación?')) return;
            
            try {
                await axios.delete(`/api/notificaciones/${notificacionId}`);
                this.cargarNotificaciones(this.currentPage);
                this.actualizarContadorGlobal();
                this.mostrarToast('Notificación eliminada', 'success');
            } catch (error) {
                console.error('Error eliminando notificación:', error);
                this.mostrarToast('Error al eliminar notificación', 'danger');
            }
        }
        
        async eliminarTodas() {
            if (!confirm('¿Eliminar todas las notificaciones? Esta acción no se puede deshacer.')) return;
            
            try {
                await axios.delete('/api/notificaciones');
                this.cargarNotificaciones(1);
                this.actualizarContadorGlobal();
                this.mostrarToast('Todas las notificaciones eliminadas', 'success');
            } catch (error) {
                console.error('Error eliminando todas las notificaciones:', error);
                this.mostrarToast('Error al eliminar todas las notificaciones', 'danger');
            }
        }
        
        mostrarToast(mensaje, tipo = 'info') {
            const toastId = 'toast-' + Date.now();
            const bgColor = tipo === 'success' ? 'bg-success' : 
                           tipo === 'danger' ? 'bg-danger' : 
                           tipo === 'warning' ? 'bg-warning' : 'bg-info';
            
            const toastHtml = `
                <div id="${toastId}" class="toast-notification ${bgColor} text-white fade-in">
                    <div class="toast-body d-flex align-items-center">
                        <i class="fas fa-${tipo === 'success' ? 'check-circle' : 
                                          tipo === 'danger' ? 'exclamation-circle' : 
                                          tipo === 'warning' ? 'exclamation-triangle' : 'info-circle'} me-3 fa-lg"></i>
                        <span class="fw-medium">${mensaje}</span>
                        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            `;
            
            $('#toast-container').append(toastHtml);
            
            const toastElement = document.getElementById(toastId);
            const toast = new bootstrap.Toast(toastElement, { delay: 3000 });
            toast.show();
            
            toastElement.addEventListener('hidden.bs.toast', function () {
                $(this).remove();
            });
        }
        
        verificarListaVacia() {
            if ($('#notificaciones-list .notificacion-item').length === 0) {
                $('#notificaciones-list').addClass('d-none');
                $('#no-notificaciones').removeClass('d-none');
                $('#pagination').addClass('d-none');
            }
        }
        
        async actualizarContadorGlobal() {
            await this.cargarContador();
        }
        
        mostrarError() {
            $('#loading').addClass('d-none');
            $('#notificaciones-list').html(`
                <div class="alert alert-danger border-0 shadow-sm rounded-lg">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-exclamation-triangle fa-2x me-3 text-danger"></i>
                        <div>
                            <h5 class="fw-bold mb-1">Error al cargar notificaciones</h5>
                            <p class="mb-2">Intenta recargar la página o contacta con soporte</p>
                            <button onclick="location.reload()" class="btn btn-danger">
                                <i class="fas fa-sync-alt me-2"></i> Recargar página
                            </button>
                        </div>
                    </div>
                </div>
            `).removeClass('d-none');
        }
    }

    // Inicializar cuando el documento esté listo
    $(document).ready(() => {
        window.notificacionesManager = new NotificacionesManager();
    });
    </script>
</body>
</html>