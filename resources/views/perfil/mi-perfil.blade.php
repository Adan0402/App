<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil - Bolsa Trabajo ITSZN</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <style>
        :root {
            --primary: #1B396A; /* Azul ITSZN */
            --success: #2ecc71;
            --warning: #f39c12;
            --danger: #e74c3c;
            --dark: #2c3e50;
            --light: #ecf0f1;
        }
        
        .profile-header {
            background: linear-gradient(135deg, var(--primary) 0%, #2D4F8A 100%);
            color: white;
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }
        
        .profile-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(50%, -50%);
        }
        
        .avatar-container {
            position: relative;
            display: inline-block;
        }
        
        .avatar-img {
            width: 150px;
            height: 150px;
            border: 5px solid white;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            object-fit: cover;
        }
        
        .avatar-upload {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: var(--success);
            color: white;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .avatar-upload:hover {
            transform: scale(1.1);
            background: #27ae60;
        }
        
        .nav-pills-custom .nav-link {
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 15px 20px;
            transition: all 0.3s ease;
            border: none;
            background: var(--light);
            color: var(--dark);
        }
        
        .nav-pills-custom .nav-link.active {
            background: var(--primary);
            color: white;
            transform: translateX(5px);
        }
        
        .nav-pills-custom .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }
        
        .info-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }
        
        .info-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }
        
        .info-card .card-header {
            background: white;
            border-bottom: 2px solid var(--light);
            border-radius: 15px 15px 0 0 !important;
            padding: 1.5rem;
            font-weight: 600;
            color: var(--dark);
        }
        
        .skill-badge {
            background: var(--light);
            color: var(--dark);
            padding: 8px 15px;
            border-radius: 20px;
            margin: 5px;
            display: inline-block;
            border: 1px solid #ddd;
            cursor: pointer;
        }
        
        .skill-badge:hover {
            background: var(--danger);
            color: white;
        }
        
        .skill-badge .remove-skill {
            margin-left: 8px;
            font-weight: bold;
        }
        
        .tab-content {
            min-height: 500px;
        }
        
        .stats-card {
            text-align: center;
            padding: 1.5rem;
            border-radius: 15px;
            color: white;
            margin-bottom: 1rem;
        }
        
        .stats-card.primary { background: var(--primary); }
        .stats-card.success { background: var(--success); }
        .stats-card.warning { background: var(--warning); }
        .stats-card.danger { background: var(--danger); }
        
        .btn-primary-custom {
            background: var(--primary);
            border: none;
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
        }
        
        .btn-primary-custom:hover {
            background: #2D4F8A;
            transform: translateY(-2px);
        }
        
        .form-control-custom {
            border: 2px solid var(--light);
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control-custom:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(27, 57, 106, 0.25);
        }
        
        .file-upload-area {
            border: 2px dashed #ddd;
            border-radius: 10px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .file-upload-area:hover {
            border-color: var(--primary);
            background: #f8f9fa;
        }
        
        .file-upload-area.dragover {
            border-color: var(--success);
            background: #d4edda;
        }

        /* Estadísticas en horizontal */
        .horizontal-stats {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .horizontal-stats .stats-card {
            flex: 1;
            margin-bottom: 0;
        }

        @media (max-width: 768px) {
            .horizontal-stats {
                flex-direction: column;
            }
        }
    </style>
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background-color: #1B396A;">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-briefcase me-2"></i>Bolsa Trabajo ITSZN
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="/dashboard">
                    <i class="fas fa-home me-1"></i>Menu Princiapl
                </a>
                <a class="nav-link text-white" href="/notificaciones">
                    <i class="fas fa-bell me-1"></i>Notificaciones
                </a>
                <a class="nav-link active text-white" href="/perfil">
                    <i class="fas fa-user me-1"></i>Mi Perfil
                </a>
                <form method="POST" action="/logout" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-light btn-sm">
                        <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none"><i class="fas fa-home"></i> Menu Principal</a></li>
                <li class="breadcrumb-item active"><i class="fas fa-user"></i> Mi Perfil</li>
            </ol>
        </nav>

        <!-- Header del Perfil -->
        <div class="profile-header">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-5 fw-bold mb-2">Mi Perfil</h1>
                    <p class="lead mb-0">Gestiona tu información personal, académica y profesional</p>
                </div>
                <div class="col-md-4 text-end">
                    <div class="avatar-container">
                        @if($usuario->foto_perfil)
                            <img src="{{ Storage::url($usuario->foto_perfil) }}" alt="Avatar" class="avatar-img rounded-circle">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=1B396A&color=fff&size=150" 
                                 alt="Avatar" class="avatar-img rounded-circle">
                        @endif
                        <div class="avatar-upload" data-bs-toggle="modal" data-bs-target="#avatarModal">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas en Horizontal -->
        <div class="horizontal-stats">
            <div class="stats-card primary">
                <i class="fas fa-paper-plane fa-2x mb-2"></i>
                <h4 id="total-postulaciones">0</h4>
                <small>Postulaciones</small>
            </div>
            <div class="stats-card success">
                <i class="fas fa-check-circle fa-2x mb-2"></i>
                <h4 id="postulaciones-aceptadas">0</h4>
                <small>Aceptadas</small>
            </div>
            <div class="stats-card warning">
                <i class="fas fa-clock fa-2x mb-2"></i>
                <h4 id="postulaciones-pendientes">0</h4>
                <small>Pendientes</small>
            </div>
            <div class="stats-card danger">
                <i class="fas fa-times-circle fa-2x mb-2"></i>
                <h4 id="postulaciones-rechazadas">0</h4>
                <small>Rechazadas</small>
            </div>
        </div>

        <div class="row">
            <!-- Menú Lateral -->
            <div class="col-md-3">
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist">
                    <a class="nav-link active" id="v-pills-info-tab" data-bs-toggle="pill" href="#v-pills-info" role="tab">
                        <i class="fas fa-user-circle"></i> Información Personal
                    </a>
                    <a class="nav-link" id="v-pills-academic-tab" data-bs-toggle="pill" href="#v-pills-academic" role="tab">
                        <i class="fas fa-graduation-cap"></i> Información Académica
                    </a>
                    <a class="nav-link" id="v-pills-skills-tab" data-bs-toggle="pill" href="#v-pills-skills" role="tab">
                        <i class="fas fa-star"></i> Habilidades
                    </a>
                    <a class="nav-link" id="v-pills-cv-tab" data-bs-toggle="pill" href="#v-pills-cv" role="tab">
                        <i class="fas fa-file-pdf"></i> Mi CV
                    </a>
                    <a class="nav-link" id="v-pills-security-tab" data-bs-toggle="pill" href="#v-pills-security" role="tab">
                        <i class="fas fa-shield-alt"></i> Seguridad
                    </a>
                    <a class="nav-link" id="v-pills-stats-tab" data-bs-toggle="pill" href="#v-pills-stats" role="tab">
                        <i class="fas fa-chart-bar"></i> Estadísticas Detalladas
                    </a>
                </div>
            </div>

            <!-- Contenido de las Pestañas -->
            <div class="col-md-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- Pestaña 1: Información Personal -->
                    <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel">
                        <div class="info-card">
                            <div class="card-header">
                                <i class="fas fa-user-circle me-2"></i>Información Personal
                            </div>
                            <div class="card-body">
                                <form id="personalInfoForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nombre Completo *</label>
                                            <input type="text" name="name" class="form-control form-control-custom" 
                                                   value="{{ $usuario->name }}" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Correo Electrónico *</label>
                                            <input type="email" name="email" class="form-control form-control-custom" 
                                                   value="{{ $usuario->email }}" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Teléfono</label>
                                            <input type="tel" name="telefono" class="form-control form-control-custom" 
                                                   value="{{ $usuario->telefono }}" placeholder="+52 871 123 4567">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Número de Control</label>
                                            <input type="text" name="numero_control" class="form-control form-control-custom" 
                                                   value="{{ $usuario->numero_control }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label class="form-label">Dirección</label>
                                            <textarea name="direccion" class="form-control form-control-custom" rows="3" 
                                                      placeholder="Dirección completa">{{ $usuario->direccion }}</textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary-custom">
                                            <i class="fas fa-save me-1"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 2: Información Académica -->
                    <div class="tab-pane fade" id="v-pills-academic" role="tabpanel">
                        <div class="info-card">
                            <div class="card-header">
                                <i class="fas fa-graduation-cap me-2"></i>Información Académica
                            </div>
                            <div class="card-body">
                                <form id="academicInfoForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Carrera</label>
                                            <input type="text" name="carrera" class="form-control form-control-custom" 
                                                   value="{{ $usuario->carrera }}" placeholder="Ingeniería en Sistemas Computacionales">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Semestre</label>
                                            <input type="number" name="semestre" class="form-control form-control-custom" 
                                                   value="{{ $usuario->semestre }}" min="1" max="20" placeholder="8">
                                        </div>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Promedio</label>
                                            <input type="number" name="promedio" class="form-control form-control-custom" 
                                                   value="{{ $usuario->promedio }}" step="0.01" min="0" max="10" placeholder="8.5">
                                        </div>
                                    </div>
                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary-custom">
                                            <i class="fas fa-save me-1"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 3: Habilidades -->
                    <div class="tab-pane fade" id="v-pills-skills" role="tabpanel">
                        <div class="info-card">
                            <div class="card-header">
                                <i class="fas fa-star me-2"></i>Mis Habilidades
                            </div>
                            <div class="card-body">
                                <form id="skillsForm">
                                    @csrf
                                    <div class="mb-4">
                                        <label class="form-label">Agregar Nueva Habilidad</label>
                                        <div class="input-group">
                                            <input type="text" id="nuevaHabilidad" class="form-control form-control-custom" 
                                                   placeholder="Ej: JavaScript, React, PHP...">
                                            <button type="button" id="agregarHabilidad" class="btn btn-primary-custom">
                                                <i class="fas fa-plus me-1"></i> Agregar
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Mis Habilidades:</label>
                                        <div id="listaHabilidades" class="mt-2">
                                            @if($usuario->habilidades && count($usuario->habilidades) > 0)
                                                @foreach($usuario->habilidades as $habilidad)
                                                    <span class="skill-badge">
                                                        {{ $habilidad }}
                                                        <span class="remove-skill" data-skill="{{ $habilidad }}">×</span>
                                                    </span>
                                                @endforeach
                                            @else
                                                <p class="text-muted">No has agregado habilidades aún.</p>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" name="habilidades" id="habilidadesInput" 
                                           value="{{ $usuario->habilidades ? json_encode($usuario->habilidades) : '[]' }}">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 4: Mi CV -->
                    <div class="tab-pane fade" id="v-pills-cv" role="tabpanel">
                        <div class="info-card">
                            <div class="card-header">
                                <i class="fas fa-file-pdf me-2"></i>Mi Curriculum Vitae
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="file-upload-area" id="cvUploadArea">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <h5>Subir CV</h5>
                                            <p class="text-muted">Arrastra tu archivo aquí o haz clic para seleccionar</p>
                                            <small class="text-muted">Formatos: PDF, DOC, DOCX (Máx. 5MB)</small>
                                            <input type="file" id="cvFile" accept=".pdf,.doc,.docx" style="display: none;">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div id="cvInfo" class="text-center">
                                            @if($usuario->cv_path)
                                                <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                                                <h5>CV Actual</h5>
                                                <p class="text-muted">Archivo subido: {{ basename($usuario->cv_path) }}</p>
                                                <a href="{{ Storage::url($usuario->cv_path) }}" target="_blank" class="btn btn-primary-custom me-2">
                                                    <i class="fas fa-eye me-1"></i> Ver CV
                                                </a>
                                                <a href="{{ Storage::url($usuario->cv_path) }}" download class="btn btn-success">
                                                    <i class="fas fa-download me-1"></i> Descargar
                                                </a>
                                            @else
                                                <i class="fas fa-file fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">No hay CV subido</h5>
                                                <p class="text-muted">Sube tu CV para completar tu perfil</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 5: Seguridad -->
                    <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                        <div class="info-card">
                            <div class="card-header">
                                <i class="fas fa-shield-alt me-2"></i>Seguridad y Contraseña
                            </div>
                            <div class="card-body">
                                <form id="securityForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Contraseña Actual *</label>
                                            <input type="password" name="current_password" class="form-control form-control-custom" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Nueva Contraseña *</label>
                                            <input type="password" name="new_password" class="form-control form-control-custom" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label">Confirmar Contraseña *</label>
                                            <input type="password" name="new_password_confirmation" class="form-control form-control-custom" required>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info">
                                        <i class="fas fa-info-circle me-2"></i>
                                        La contraseña debe tener al menos 8 caracteres, incluir mayúsculas, minúsculas y números.
                                    </div>
                                    
                                    <div class="text-end">
                                        <button type="submit" class="btn btn-primary-custom">
                                            <i class="fas fa-key me-1"></i> Cambiar Contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 6: Estadísticas Detalladas -->
                    <div class="tab-pane fade" id="v-pills-stats" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="info-card">
                                    <div class="card-header">
                                        <i class="fas fa-chart-bar me-2"></i>Estadísticas Detalladas
                                    </div>
                                    <div class="card-body">
                                        <div class="horizontal-stats">
                                            <div class="stats-card primary">
                                                <i class="fas fa-paper-plane fa-2x mb-2"></i>
                                                <h4 id="stats-total">0</h4>
                                                <small>Total Postulaciones</small>
                                            </div>
                                            <div class="stats-card warning">
                                                <i class="fas fa-clock fa-2x mb-2"></i>
                                                <h4 id="stats-pendientes">0</h4>
                                                <small>Pendientes</small>
                                            </div>
                                            <div class="stats-card success">
                                                <i class="fas fa-check-circle fa-2x mb-2"></i>
                                                <h4 id="stats-aceptadas">0</h4>
                                                <small>Aceptadas</small>
                                            </div>
                                            <div class="stats-card danger">
                                                <i class="fas fa-times-circle fa-2x mb-2"></i>
                                                <h4 id="stats-rechazadas">0</h4>
                                                <small>Rechazadas</small>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center mt-4">
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar bg-warning" id="progress-pendientes" style="width: 0%">Pendientes</div>
                                                <div class="progress-bar bg-success" id="progress-aceptadas" style="width: 0%">Aceptadas</div>
                                                <div class="progress-bar bg-danger" id="progress-rechazadas" style="width: 0%">Rechazadas</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Cambiar Avatar -->
    <div class="modal fade" id="avatarModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Cambiar Foto de Perfil</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        @if($usuario->foto_perfil)
                            <img src="{{ Storage::url($usuario->foto_perfil) }}" alt="Avatar" class="rounded-circle mb-3" style="width: 200px; height: 200px; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=1B396A&color=fff&size=200" 
                                 alt="Avatar" class="rounded-circle mb-3">
                        @endif
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Subir nueva imagen</label>
                        <input type="file" class="form-control" id="fotoPerfilInput" accept="image/*">
                    </div>
                    <div class="alert alert-info">
                        <small>Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary-custom" id="guardarFoto">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        class PerfilManager {
            constructor() {
                this.habilidades = @json($usuario->habilidades ?? []);
                this.init();
            }
            
            init() {
                this.cargarEstadisticas();
                this.bindEvents();
                this.actualizarHabilidadesInput();
            }
            
            async cargarEstadisticas() {
                try {
                    const response = await axios.get('/perfil/estadisticas');
                    const stats = response.data;
                    
                    // Actualizar tarjetas horizontales
                    $('#total-postulaciones').text(stats.total_postulaciones);
                    $('#postulaciones-aceptadas').text(stats.postulaciones_aceptadas);
                    $('#postulaciones-pendientes').text(stats.postulaciones_pendientes);
                    $('#postulaciones-rechazadas').text(stats.postulaciones_rechazadas);
                    
                    // Actualizar estadísticas detalladas
                    $('#stats-total').text(stats.total_postulaciones);
                    $('#stats-pendientes').text(stats.postulaciones_pendientes);
                    $('#stats-aceptadas').text(stats.postulaciones_aceptadas);
                    $('#stats-rechazadas').text(stats.postulaciones_rechazadas);
                    
                    // Actualizar progress bar
                    const total = stats.total_postulaciones || 1;
                    const pendientesPct = (stats.postulaciones_pendientes / total) * 100;
                    const aceptadasPct = (stats.postulaciones_aceptadas / total) * 100;
                    const rechazadasPct = (stats.postulaciones_rechazadas / total) * 100;
                    
                    $('#progress-pendientes').css('width', pendientesPct + '%');
                    $('#progress-aceptadas').css('width', aceptadasPct + '%');
                    $('#progress-rechazadas').css('width', rechazadasPct + '%');
                    
                } catch (error) {
                    console.error('Error cargando estadísticas:', error);
                }
            }
            
            bindEvents() {
                // Formulario de información personal
                $('#personalInfoForm').on('submit', (e) => this.guardarInformacionPersonal(e));
                
                // Formulario de información académica
                $('#academicInfoForm').on('submit', (e) => this.guardarInformacionAcademica(e));
                
                // Formulario de seguridad
                $('#securityForm').on('submit', (e) => this.cambiarPassword(e));
                
                // Habilidades
                $('#agregarHabilidad').on('click', () => this.agregarHabilidad());
                $('#nuevaHabilidad').on('keypress', (e) => {
                    if (e.which === 13) {
                        e.preventDefault();
                        this.agregarHabilidad();
                    }
                });
                $(document).on('click', '.remove-skill', (e) => this.eliminarHabilidad(e));
                
                // Foto de perfil
                $('#guardarFoto').on('click', () => this.subirFotoPerfil());
                $('#fotoPerfilInput').on('change', (e) => this.previewFoto(e));
                
                // CV
                $('#cvUploadArea').on('click', () => $('#cvFile').click());
                $('#cvFile').on('change', (e) => this.subirCV(e));
                
                // Drag and drop para CV
                this.setupDragAndDrop();
            }
            
            async guardarInformacionPersonal(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                
                try {
                    const response = await axios.post('/perfil/informacion', formData);
                    this.mostrarAlerta('success', response.data.message);
                } catch (error) {
                    this.mostrarAlerta('danger', error.response?.data?.message || 'Error al guardar');
                }
            }
            
            async guardarInformacionAcademica(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                
                try {
                    const response = await axios.post('/perfil/informacion', formData);
                    this.mostrarAlerta('success', response.data.message);
                } catch (error) {
                    this.mostrarAlerta('danger', error.response?.data?.message || 'Error al guardar');
                }
            }
            
            async cambiarPassword(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                
                try {
                    const response = await axios.post('/perfil/password', formData);
                    this.mostrarAlerta('success', response.data.message);
                    e.target.reset();
                } catch (error) {
                    this.mostrarAlerta('danger', error.response?.data?.message || 'Error al cambiar contraseña');
                }
            }
            
            agregarHabilidad() {
                const nuevaHabilidad = $('#nuevaHabilidad').val().trim();
                if (nuevaHabilidad && !this.habilidades.includes(nuevaHabilidad)) {
                    this.habilidades.push(nuevaHabilidad);
                    this.actualizarListaHabilidades();
                    $('#nuevaHabilidad').val('');
                    this.guardarHabilidades();
                }
            }
            
            eliminarHabilidad(e) {
                const habilidad = $(e.target).data('skill');
                this.habilidades = this.habilidades.filter(h => h !== habilidad);
                this.actualizarListaHabilidades();
                this.guardarHabilidades();
            }
            
            actualizarListaHabilidades() {
                const lista = $('#listaHabilidades');
                lista.empty();
                
                if (this.habilidades.length === 0) {
                    lista.html('<p class="text-muted">No has agregado habilidades aún.</p>');
                } else {
                    this.habilidades.forEach(habilidad => {
                        lista.append(`
                            <span class="skill-badge">
                                ${habilidad}
                                <span class="remove-skill" data-skill="${habilidad}">×</span>
                            </span>
                        `);
                    });
                }
            }
            
            async guardarHabilidades() {
                try {
                    await axios.post('/perfil/habilidades', {
                        habilidades: this.habilidades
                    });
                    this.actualizarHabilidadesInput();
                } catch (error) {
                    this.mostrarAlerta('danger', 'Error al guardar habilidades');
                }
            }
            
            actualizarHabilidadesInput() {
                $('#habilidadesInput').val(JSON.stringify(this.habilidades));
            }
            
            async subirFotoPerfil() {
                const fileInput = $('#fotoPerfilInput')[0];
                if (!fileInput.files.length) {
                    this.mostrarAlerta('warning', 'Selecciona una imagen');
                    return;
                }
                
                const formData = new FormData();
                formData.append('foto_perfil', fileInput.files[0]);
                
                try {
                    const response = await axios.post('/perfil/foto', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                    
                    this.mostrarAlerta('success', response.data.message);
                    $('#avatarModal').modal('hide');
                    
                    // Recargar la página para mostrar la nueva foto
                    setTimeout(() => location.reload(), 1000);
                    
                } catch (error) {
                    this.mostrarAlerta('danger', error.response?.data?.message || 'Error al subir foto');
                }
            }
            
            previewFoto(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        $('#avatarModal .rounded-circle').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            }
            
            async subirCV(e) {
                const file = e.target.files[0];
                if (!file) return;
                
                const formData = new FormData();
                formData.append('cv', file);
                
                try {
                    const response = await axios.post('/perfil/cv', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                    
                    this.mostrarAlerta('success', response.data.message);
                    
                    // Actualizar información del CV
                    $('#cvInfo').html(`
                        <i class="fas fa-file-pdf fa-3x text-danger mb-3"></i>
                        <h5>CV Actual</h5>
                        <p class="text-muted">Archivo subido: ${file.name}</p>
                        <a href="${response.data.cv_url}" target="_blank" class="btn btn-primary-custom me-2">
                            <i class="fas fa-eye me-1"></i> Ver CV
                        </a>
                        <a href="${response.data.cv_url}" download class="btn btn-success">
                            <i class="fas fa-download me-1"></i> Descargar
                        </a>
                    `);
                    
                } catch (error) {
                    this.mostrarAlerta('danger', error.response?.data?.message || 'Error al subir CV');
                }
            }
            
            setupDragAndDrop() {
                const cvArea = $('#cvUploadArea')[0];
                
                cvArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    $(cvArea).addClass('dragover');
                });
                
                cvArea.addEventListener('dragleave', () => {
                    $(cvArea).removeClass('dragover');
                });
                
                cvArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    $(cvArea).removeClass('dragover');
                    
                    const files = e.dataTransfer.files;
                    if (files.length) {
                        $('#cvFile')[0].files = files;
                        this.subirCV({ target: { files: files } });
                    }
                });
            }
            
            mostrarAlerta(tipo, mensaje) {
                const alert = $(`
                    <div class="alert alert-${tipo} alert-dismissible fade show position-fixed" 
                         style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                        ${mensaje}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `);
                
                $('body').append(alert);
                
                setTimeout(() => {
                    alert.alert('close');
                }, 5000);
            }
        }

        // Inicializar cuando el documento esté listo
        $(document).ready(() => {
            window.perfilManager = new PerfilManager();
        });
    </script>
</body>
</html>