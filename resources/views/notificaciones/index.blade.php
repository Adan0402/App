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
            --primary-color: #3498db;
            --success-color: #2ecc71;
            --danger-color: #e74c3c;
            --warning-color: #f39c12;
        }
        
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
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--danger-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.75rem;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .notificacion-item {
            transition: all 0.3s ease;
            cursor: pointer;
            border-radius: 10px;
            margin-bottom: 1rem;
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .notificacion-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }
        
        .notificacion-item.no-leida {
            background: linear-gradient(135deg, #e8f4fd 0%, #ffffff 100%);
            border-left: 4px solid var(--primary-color);
        }
        
        .notificacion-item.leida {
            background: #ffffff;
            border-left: 4px solid #ddd;
        }
        
        .notificacion-actions {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .notificacion-item:hover .notificacion-actions {
            opacity: 1;
        }
        
        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }
        
        .vacante-nueva { background: var(--primary-color); color: white; }
        .postulacion-aceptada { background: var(--success-color); color: white; }
        .postulacion-rechazada { background: var(--danger-color); color: white; }
        .default-icon { background: #95a5a6; color: white; }
        
        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 10px 10px 0 0 !important;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border: none;
        }
        
        .btn-success {
            background: var(--success-color);
            border: none;
        }
        
        .btn-danger {
            background: var(--danger-color);
            border: none;
        }
        
        .user-type-badge {
            background: var(--warning-color);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar Mejorada -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-briefcase me-2"></i>Bolsa Trabajo ITSZN
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/notificaciones">
                            <i class="fas fa-bell me-1"></i>Notificaciones
                            <span id="notification-count" class="notification-badge d-none">0</span>
                        </a>
                    </li>
                </ul>
                
                <div class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" 
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user me-1"></i>
                            <span id="user-name">Usuario</span>
                            <span id="user-type" class="user-type-badge ms-2">Alumno</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="/dashboard"><i class="fas fa-tachometer-alt me-2"></i>Mi Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="/logout" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="fas fa-sign-out-alt me-2"></i>Cerrar Sesión
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </div>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active"><i class="fas fa-bell"></i> Notificaciones</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex justify-content-between align-items-center py-3">
                        <div>
                            <h4 class="mb-0"><i class="fas fa-bell me-2"></i>Mis Notificaciones</h4>
                            <small class="opacity-75">Gestiona todas tus notificaciones en un solo lugar</small>
                        </div>
                        <div>
                            <button id="marcarTodasLeidas" class="btn btn-success btn-sm">
                                <i class="fas fa-check-double me-1"></i> Marcar todas como leídas
                            </button>
                            <button id="eliminarTodas" class="btn btn-danger btn-sm ms-2">
                                <i class="fas fa-trash me-1"></i> Eliminar todas
                            </button>
                            <a href="/dashboard" class="btn btn-primary btn-sm ms-2">
                                <i class="fas fa-arrow-left me-1"></i> Volver al Dashboard
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <!-- Estadísticas -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white">
                                    <div class="card-body text-center py-3">
                                        <i class="fas fa-bell fa-2x mb-2"></i>
                                        <h5 id="total-notificaciones">0</h5>
                                        <small>Total Notificaciones</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-warning text-white">
                                    <div class="card-body text-center py-3">
                                        <i class="fas fa-envelope fa-2x mb-2"></i>
                                        <h5 id="no-leidas-count">0</h5>
                                        <small>No Leídas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white">
                                    <div class="card-body text-center py-3">
                                        <i class="fas fa-check-circle fa-2x mb-2"></i>
                                        <h5 id="leidas-count">0</h5>
                                        <small>Leídas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white">
                                    <div class="card-body text-center py-3">
                                        <i class="fas fa-calendar fa-2x mb-2"></i>
                                        <h5 id="hoy-count">0</h5>
                                        <small>Hoy</small>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Loading -->
                        <div id="loading" class="text-center py-5">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
                            <p class="mt-3 text-muted">Cargando tus notificaciones...</p>
                        </div>
                        
                        <!-- Lista de Notificaciones -->
                        <div id="notificaciones-list" class="d-none">
                            <!-- Las notificaciones se cargarán aquí via JavaScript -->
                        </div>
                        
                        <!-- Sin Notificaciones -->
                        <div id="no-notificaciones" class="text-center py-5 d-none">
                            <div class="py-5">
                                <i class="fas fa-bell-slash fa-4x text-muted mb-4"></i>
                                <h4 class="text-muted">No tienes notificaciones</h4>
                                <p class="text-muted mb-4">Cuando recibas notificaciones, aparecerán aquí.</p>
                                <a href="/dashboard" class="btn btn-primary">
                                    <i class="fas fa-arrow-left me-1"></i> Volver al Dashboard
                                </a>
                            </div>
                        </div>
                        
                        <!-- Paginación -->
                        <nav id="pagination" class="d-none mt-4">
                            <!-- Paginación se cargará aquí -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
            // Esta info podría venir de tu backend o de variables globales
            $('#user-name').text('{{ Auth::user()->name ?? "Usuario" }}');
            $('#user-type').text('{{ Auth::user()->tipo ?? "Usuario" }}'.charAt(0).toUpperCase() + '{{ Auth::user()->tipo ?? "Usuario" }}'.slice(1));
        }
        
        async cargarContador() {
            try {
                const response = await axios.get('/api/notificaciones/contador');
                const contador = response.data.contador;
                
                if (contador > 0) {
                    $('#notification-count').text(contador).removeClass('d-none');
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
            
            const notificacionesHtml = data.notificaciones.data.map(notificacion => {
                const fecha = new Date(notificacion.created_at);
                const iconClass = this.getIconClass(notificacion.tipo);
                const isLeida = notificacion.leida;
                
                return `
                    <div class="notificacion-item ${!isLeida ? 'no-leida' : 'leida'} p-3">
                        <div class="d-flex align-items-start">
                            <div class="notification-icon ${iconClass}">
                                <i class="${this.getIcon(notificacion.tipo)}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <h6 class="mb-1 ${!isLeida ? 'text-dark fw-bold' : 'text-muted'}">${notificacion.titulo}</h6>
                                    <small class="text-muted">${fecha.toLocaleString('es-ES')}</small>
                                </div>
                                <p class="mb-2 ${!isLeida ? 'text-dark' : 'text-muted'}">${notificacion.mensaje}</p>
                                
                                ${notificacion.data && notificacion.data.action_url ? `
                                    <div class="mt-2">
                                        <a href="${notificacion.data.action_url}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-external-link-alt me-1"></i> Ver detalles
                                        </a>
                                    </div>
                                ` : ''}
                            </div>
                            
                            <div class="notificacion-actions ms-3">
                                ${!isLeida ? `
                                    <button class="btn btn-success btn-sm marcar-leida" data-id="${notificacion.id}" title="Marcar como leída">
                                        <i class="fas fa-check"></i>
                                    </button>
                                ` : ''}
                                
                                <button class="btn btn-danger btn-sm eliminar-notificacion mt-1" data-id="${notificacion.id}" title="Eliminar notificación">
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
                'nueva_postulacion_empresa': 'vacante-nueva'
            };
            return iconMap[tipo] || 'default-icon';
        }
        
        getIcon(tipo) {
            const iconMap = {
                'vacante_nueva': 'fas fa-bullhorn',
                'postulacion_aceptada': 'fas fa-check-circle',
                'postulacion_rechazada': 'fas fa-times-circle',
                'nueva_postulacion_empresa': 'fas fa-user-plus'
            };
            return iconMap[tipo] || 'fas fa-bell';
        }
        
        // ... (el resto de tus métodos JavaScript se mantienen igual)
        mostrarPaginacion(pagination) {
            let paginationHtml = '<ul class="pagination justify-content-center">';
            
            if (pagination.current_page > 1) {
                paginationHtml += `
                    <li class="page-item">
                        <a class="page-link pagination-link" href="#" data-page="${pagination.current_page - 1}">
                            <i class="fas fa-chevron-left"></i> Anterior
                        </a>
                    </li>
                `;
            }
            
            for (let page = 1; page <= pagination.last_page; page++) {
                paginationHtml += `
                    <li class="page-item ${page === pagination.current_page ? 'active' : ''}">
                        <a class="page-link pagination-link" href="#" data-page="${page}">${page}</a>
                    </li>
                `;
            }
            
            if (pagination.current_page < pagination.last_page) {
                paginationHtml += `
                    <li class="page-item">
                        <a class="page-link pagination-link" href="#" data-page="${pagination.current_page + 1}">
                            Siguiente <i class="fas fa-chevron-right"></i>
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
                $(`.marcar-leida[data-id="${notificacionId}"]`).closest('.notificacion-item')
                    .removeClass('no-leida').addClass('leida');
                $(`.marcar-leida[data-id="${notificacionId}"]`).remove();
                this.actualizarContadorGlobal();
                this.cargarNotificaciones(this.currentPage); // Recargar para actualizar estadísticas
            } catch (error) {
                console.error('Error marcando notificación como leída:', error);
            }
        }
        
        async marcarTodasLeidas() {
            if (!confirm('¿Marcar todas las notificaciones como leídas?')) return;
            
            try {
                await axios.post('/api/notificaciones/marcar-todas-leidas');
                this.cargarNotificaciones(this.currentPage);
                this.actualizarContadorGlobal();
            } catch (error) {
                console.error('Error marcando todas como leídas:', error);
            }
        }
        
        async eliminarNotificacion(notificacionId) {
            if (!confirm('¿Eliminar esta notificación?')) return;
            
            try {
                await axios.delete(`/api/notificaciones/${notificacionId}`);
                this.cargarNotificaciones(this.currentPage);
                this.actualizarContadorGlobal();
            } catch (error) {
                console.error('Error eliminando notificación:', error);
            }
        }
        
        async eliminarTodas() {
            if (!confirm('¿Eliminar todas las notificaciones? Esta acción no se puede deshacer.')) return;
            
            try {
                await axios.delete('/api/notificaciones');
                this.cargarNotificaciones(1);
                this.actualizarContadorGlobal();
            } catch (error) {
                console.error('Error eliminando todas las notificaciones:', error);
            }
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
                <div class="alert alert-danger text-center">
                    <i class="fas fa-exclamation-triangle fa-2x mb-2"></i>
                    <h5>Error al cargar notificaciones</h5>
                    <p>Intenta recargar la página</p>
                    <button onclick="location.reload()" class="btn btn-primary">Recargar</button>
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