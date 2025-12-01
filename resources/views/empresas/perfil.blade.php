<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Empresa - ITSZN Bolsa de Trabajo</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --azul-itszn: #1B396A;
            --azul-itszn-claro: #2D4F8A;
            --verde-itszn: #28a745;
            --naranja-itszn: #fd7e14;
            --gris-itszn: #6c757d;
            --gris-claro: #f8f9fa;
            --gris-medio: #e9ecef;
            --gris-oscuro: #343a40;
        }
        
        /* Header Institucional */
        .header-institucional {
            background: linear-gradient(135deg, var(--azul-itszn) 0%, var(--azul-itszn-claro) 100%);
            border-bottom: 4px solid var(--azul-itszn);
        }
        
        .header-institucional h1, .header-institucional p {
            color: white;
        }
        
        .breadcrumb-item.active {
            color: var(--azul-itszn);
            font-weight: 600;
        }
        
        /* Profile Header Mejorado */
        .profile-header-empresa {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border-radius: 1rem;
            padding: 2.5rem;
            margin-bottom: 2rem;
            border: 1px solid var(--gris-medio);
            position: relative;
            overflow: hidden;
        }
        
        .profile-header-empresa::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'%3E%3Cpath fill='%231B396A' fill-opacity='0.1' d='M0,0 L100,0 L100,100 L0,100 Z'/%3E%3C/svg%3E");
            opacity: 0.5;
        }
        
        /* Avatar de Empresa */
        .avatar-empresa {
            width: 180px;
            height: 180px;
            border: 4px solid white;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            object-fit: cover;
            transition: all 0.3s ease;
        }
        
        .avatar-empresa:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 35px rgba(27, 57, 106, 0.25);
        }
        
        .avatar-upload-btn {
            position: absolute;
            bottom: 15px;
            right: 15px;
            background: var(--azul-itszn);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 3px solid white;
        }
        
        .avatar-upload-btn:hover {
            background: var(--azul-itszn-claro);
            transform: scale(1.1);
        }
        
        /* Navegación Mejorada */
        .nav-pills-itszn .nav-link {
            border-radius: 10px;
            margin-bottom: 10px;
            padding: 1.25rem 1.5rem;
            transition: all 0.3s ease;
            background: white;
            color: var(--gris-oscuro);
            border: 2px solid var(--gris-medio);
            font-weight: 500;
        }
        
        .nav-pills-itszn .nav-link:hover {
            border-color: var(--azul-itszn);
            transform: translateX(5px);
            background: #f8fafc;
        }
        
        .nav-pills-itszn .nav-link.active {
            background: var(--azul-itszn);
            color: white;
            border-color: var(--azul-itszn);
            transform: translateX(8px);
            box-shadow: 0 4px 15px rgba(27, 57, 106, 0.2);
        }
        
        .nav-pills-itszn .nav-link i {
            width: 24px;
            text-align: center;
            font-size: 1.1rem;
            margin-right: 12px;
        }
        
        /* Tarjetas de Información */
        .info-card-empresa {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
            overflow: hidden;
            border-left: 4px solid var(--azul-itszn);
        }
        
        .info-card-empresa:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }
        
        .info-card-empresa .card-header {
            background: white;
            border-bottom: 2px solid var(--gris-medio);
            padding: 1.5rem 1.5rem 1rem;
            font-weight: 600;
            color: var(--azul-itszn);
            font-size: 1.1rem;
        }
        
        .info-card-empresa .card-header i {
            color: var(--azul-itszn);
        }
        
        .info-card-empresa .card-body {
            padding: 1.5rem;
        }
        
        /* Botones ITSZN */
        .btn-itszn {
            background: var(--azul-itszn);
            color: white;
            border: 2px solid var(--azul-itszn);
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-itszn:hover {
            background: var(--azul-itszn-claro);
            border-color: var(--azul-itszn-claro);
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(27, 57, 106, 0.25);
        }
        
        .btn-itszn-secundario {
            background: white;
            color: var(--azul-itszn);
            border: 2px solid var(--azul-itszn);
            padding: 0.75rem 2rem;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-itszn-secundario:hover {
            background: var(--gris-claro);
            transform: translateY(-2px);
        }
        
        /* Formularios Mejorados */
        .form-control-itszn {
            border: 2px solid var(--gris-medio);
            border-radius: 0.75rem;
            padding: 0.875rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control-itszn:focus {
            border-color: var(--azul-itszn);
            box-shadow: 0 0 0 0.25rem rgba(27, 57, 106, 0.15);
        }
        
        .form-label-itszn {
            font-weight: 600;
            color: var(--gris-oscuro);
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }
        
        /* Área de Subida de Archivos */
        .file-upload-area-empresa {
            border: 2px dashed var(--gris-medio);
            border-radius: 1rem;
            padding: 3rem 2rem;
            text-align: center;
            transition: all 0.3s ease;
            cursor: pointer;
            background: var(--gris-claro);
        }
        
        .file-upload-area-empresa:hover {
            border-color: var(--azul-itszn);
            background: #f0f7ff;
        }
        
        .file-upload-area-empresa.dragover {
            border-color: var(--verde-itszn);
            background: #e8f5e9;
        }
        
        /* Badges de Estado */
        .status-badge-itszn {
            padding: 0.5rem 1.25rem;
            border-radius: 2rem;
            font-weight: 600;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .status-activo { 
            background: #d4edda; 
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .status-pendiente { 
            background: #fff3cd; 
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        
        .status-rechazado { 
            background: #f8d7da; 
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        
        /* Estadísticas Horizontales */
        .stats-grid-horizontal {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }
        
        .stat-card-horizontal {
            background: white;
            border-radius: 1rem;
            padding: 1.5rem;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
            border-top: 4px solid var(--azul-itszn);
        }
        
        .stat-card-horizontal:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }
        
        .stat-icon.vacantes { background: #e3f2fd; color: var(--azul-itszn); }
        .stat-icon.activas { background: #e8f5e9; color: var(--verde-itszn); }
        .stat-icon.postulaciones { background: #fff3e0; color: var(--naranja-itszn); }
        .stat-icon.pendientes { background: #fce4ec; color: #d81b60; }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--gris-oscuro);
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            color: var(--gris-itszn);
            font-weight: 500;
        }
        
        /* Animaciones */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .slide-in-right {
            animation: slideInRight 0.5s ease-out;
        }
        
        @keyframes slideInRight {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
        
        /* Alertas Personalizadas */
        .alert-itszn {
            border-radius: 0.75rem;
            border: none;
            padding: 1rem 1.25rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .avatar-empresa {
                width: 140px;
                height: 140px;
            }
            
            .profile-header-empresa {
                padding: 1.5rem;
            }
            
            .nav-pills-itszn .nav-link {
                padding: 1rem 1.25rem;
                font-size: 0.9rem;
            }
            
            .stats-grid-horizontal {
                grid-template-columns: 1fr;
            }
        }
        
        /* Tarjeta de Documentos */
        .document-card {
            border: 2px solid var(--gris-medio);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
            background: white;
        }
        
        .document-card:hover {
            border-color: var(--azul-itszn);
            transform: translateY(-3px);
        }
        
        .document-icon {
            font-size: 3rem;
            color: var(--azul-itszn);
            margin-bottom: 1rem;
        }
        
        /* Separador Elegante */
        .separator {
            height: 2px;
            background: linear-gradient(90deg, transparent, var(--gris-medio), transparent);
            margin: 2rem 0;
        }
    </style>
</head>
<body class="bg-light">
    <!-- Header Institucional -->
    <header class="header-institucional shadow-sm">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark py-3">
                <div class="container-fluid">
                    <a class="navbar-brand fw-bold" href="/dashboard">
                        <i class="fas fa-briefcase me-2"></i>ITSZN Bolsa de Trabajo
                    </a>
                    
                    <div class="navbar-nav ms-auto align-items-center">
                        <a class="nav-link text-white me-3" href="/dashboard">
                            <i class="fas fa-home me-1"></i>Dashboard
                        </a>
                        <a class="nav-link text-white me-3" href="/notificaciones">
                            <i class="fas fa-bell me-1"></i>
                            <span class="badge bg-danger rounded-pill">3</span>
                        </a>
                        <a class="nav-link active text-white fw-bold" href="/empresa/perfil">
                            <i class="fas fa-building me-1"></i>Mi Empresa
                        </a>
                        <div class="nav-item ms-3">
                            <form method="POST" action="/logout" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-light btn-sm">
                                    <i class="fas fa-sign-out-alt me-1"></i>Cerrar Sesión
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Contenido Principal -->
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/dashboard" class="text-decoration-none">
                        <i class="fas fa-home text-azul-itszn"></i> Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item active fw-semibold" aria-current="page">
                    <i class="fas fa-building text-azul-itszn"></i> Perfil de Empresa
                </li>
            </ol>
        </nav>

        <!-- Header del Perfil Mejorado -->
        <div class="profile-header-empresa fade-in">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3 texto-azul-itszn">Perfil de Empresa</h1>
                    <h2 class="fw-bold mb-3">{{ $empresa->nombre_empresa }}</h2>
                    
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <span class="status-badge-itszn status-{{ $empresa->estado }}">
                            <i class="fas fa-circle"></i>
                            Estado: {{ ucfirst($empresa->estado) }}
                        </span>
                        
                        @if($empresa->tipo_negocio)
                            <span class="badge bg-azul-itszn px-3 py-2 rounded-pill">
                                <i class="fas fa-industry me-1"></i>{{ $empresa->tipo_negocio }}
                            </span>
                        @endif
                    </div>
                    
                    @if($empresa->estado == 'rechazada' && $empresa->motivo_rechazo)
                        <div class="alert alert-warning alert-itszn d-inline-block">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            <strong>Motivo de rechazo:</strong> {{ $empresa->motivo_rechazo }}
                        </div>
                    @endif
                </div>
                
                <div class="col-lg-4 text-lg-end text-center mt-lg-0 mt-4">
                    <div class="position-relative d-inline-block">
                        @if($empresa->logo_path)
                            <img src="{{ Storage::url($empresa->logo_path) }}" 
                                 alt="Logo {{ $empresa->nombre_empresa }}" 
                                 class="avatar-empresa rounded-circle">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($empresa->nombre_empresa) }}&background=1B396A&color=fff&size=180&bold=true&font-size=0.5" 
                                 alt="Logo {{ $empresa->nombre_empresa }}" 
                                 class="avatar-empresa rounded-circle">
                        @endif
                        <div class="avatar-upload-btn" data-bs-toggle="modal" data-bs-target="#logoModal">
                            <i class="fas fa-camera"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Horizontales -->
        <div class="stats-grid-horizontal fade-in" style="animation-delay: 0.1s">
            <div class="stat-card-horizontal">
                <div class="stat-icon vacantes">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-number" id="total-vacantes">0</div>
                <div class="stat-label">Total de Vacantes</div>
            </div>
            
            <div class="stat-card-horizontal">
                <div class="stat-icon activas">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-number" id="vacantes-activas">0</div>
                <div class="stat-label">Vacantes Activas</div>
            </div>
            
            <div class="stat-card-horizontal">
                <div class="stat-icon postulaciones">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" id="total-postulaciones">0</div>
                <div class="stat-label">Postulaciones Totales</div>
            </div>
            
            <div class="stat-card-horizontal">
                <div class="stat-icon pendientes">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-number" id="postulaciones-pendientes">0</div>
                <div class="stat-label">Postulaciones Pendientes</div>
            </div>
        </div>

        <div class="row">
            <!-- Menú Lateral Mejorado -->
            <div class="col-lg-3">
                <div class="nav flex-column nav-pills nav-pills-itszn" id="v-pills-tab" role="tablist">
                    <a class="nav-link active slide-in-right" id="v-pills-info-tab" data-bs-toggle="pill" href="#v-pills-info" role="tab">
                        <i class="fas fa-info-circle"></i> Información General
                    </a>
                    <a class="nav-link slide-in-right" style="animation-delay: 0.1s" id="v-pills-contact-tab" data-bs-toggle="pill" href="#v-pills-contact" role="tab">
                        <i class="fas fa-address-book"></i> Contacto
                    </a>
                    <a class="nav-link slide-in-right" style="animation-delay: 0.2s" id="v-pills-legal-tab" data-bs-toggle="pill" href="#v-pills-legal" role="tab">
                        <i class="fas fa-user-tie"></i> Representante Legal
                    </a>
                    <a class="nav-link slide-in-right" style="animation-delay: 0.3s" id="v-pills-docs-tab" data-bs-toggle="pill" href="#v-pills-docs" role="tab">
                        <i class="fas fa-folder-open"></i> Documentos
                    </a>
                    <a class="nav-link slide-in-right" style="animation-delay: 0.4s" id="v-pills-security-tab" data-bs-toggle="pill" href="#v-pills-security" role="tab">
                        <i class="fas fa-shield-alt"></i> Seguridad
                    </a>
                </div>
            </div>

            <!-- Contenido de las Pestañas -->
            <div class="col-lg-9">
                <div class="tab-content" id="v-pills-tabContent">
                    
                    <!-- Pestaña 1: Información General -->
                    <div class="tab-pane fade show active" id="v-pills-info" role="tabpanel">
                        <div class="info-card-empresa fade-in">
                            <div class="card-header">
                                <i class="fas fa-info-circle me-2"></i>Información General de la Empresa
                            </div>
                            <div class="card-body">
                                <form id="empresaInfoForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-building me-1"></i>Nombre de la Empresa *
                                            </label>
                                            <input type="text" name="nombre_empresa" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->nombre_empresa }}" 
                                                   required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-industry me-1"></i>Tipo de Negocio *
                                            </label>
                                            <input type="text" name="tipo_negocio" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->tipo_negocio }}" 
                                                   required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-chart-bar me-1"></i>Tamaño de la Empresa *
                                            </label>
                                            <select name="tamano_empresa" class="form-control form-control-itszn" required>
                                                <option value="">Seleccionar tamaño...</option>
                                                <option value="micro" {{ $empresa->tamano_empresa == 'micro' ? 'selected' : '' }}>
                                                    Micro (1-10 empleados)
                                                </option>
                                                <option value="pequena" {{ $empresa->tamano_empresa == 'pequena' ? 'selected' : '' }}>
                                                    Pequeña (11-50 empleados)
                                                </option>
                                                <option value="mediana" {{ $empresa->tamano_empresa == 'mediana' ? 'selected' : '' }}>
                                                    Mediana (51-250 empleados)
                                                </option>
                                                <option value="grande" {{ $empresa->tamano_empresa == 'grande' ? 'selected' : '' }}>
                                                    Grande (+250 empleados)
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-id-card me-1"></i>RFC
                                            </label>
                                            <input type="text" name="rfc" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->rfc }}" 
                                                   placeholder="ABCD123456XYZ">
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <label class="form-label-itszn">
                                            <i class="fas fa-file-alt me-1"></i>Descripción de la Empresa
                                        </label>
                                        <textarea name="descripcion_empresa" 
                                                  class="form-control form-control-itszn" 
                                                  rows="5"
                                                  placeholder="Describe los servicios, misión, visión y valores de tu empresa...">{{ $empresa->descripcion_empresa }}</textarea>
                                    </div>
                                    
                                    <div class="text-end pt-3 border-top">
                                        <button type="submit" class="btn btn-itszn">
                                            <i class="fas fa-save me-2"></i>Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 2: Información de Contacto -->
                    <div class="tab-pane fade" id="v-pills-contact" role="tabpanel">
                        <div class="info-card-empresa fade-in">
                            <div class="card-header">
                                <i class="fas fa-address-book me-2"></i>Información de Contacto
                            </div>
                            <div class="card-body">
                                <form id="contactoForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-map-marker-alt me-1"></i>Dirección
                                            </label>
                                            <textarea name="direccion" 
                                                      class="form-control form-control-itszn" 
                                                      rows="3"
                                                      placeholder="Dirección completa de la empresa">{{ $empresa->direccion }}</textarea>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-globe me-1"></i>Página Web
                                            </label>
                                            <input type="url" name="pagina_web" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->pagina_web }}" 
                                                   placeholder="https://www.empresa.com">
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-phone me-1"></i>Teléfono de Contacto *
                                            </label>
                                            <input type="tel" name="telefono_contacto" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->telefono_contacto }}" 
                                                   required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-envelope me-1"></i>Correo de Contacto *
                                            </label>
                                            <input type="email" name="correo_contacto" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->correo_contacto }}" 
                                                   required>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end pt-3 border-top">
                                        <button type="submit" class="btn btn-itszn">
                                            <i class="fas fa-save me-2"></i>Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 3: Representante Legal -->
                    <div class="tab-pane fade" id="v-pills-legal" role="tabpanel">
                        <div class="info-card-empresa fade-in">
                            <div class="card-header">
                                <i class="fas fa-user-tie me-2"></i>Representante Legal
                            </div>
                            <div class="card-body">
                                <form id="representanteForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-user me-1"></i>Nombre del Representante *
                                            </label>
                                            <input type="text" name="representante_legal" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->representante_legal }}" 
                                                   required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-briefcase me-1"></i>Puesto del Representante *
                                            </label>
                                            <input type="text" name="puesto_representante" 
                                                   class="form-control form-control-itszn" 
                                                   value="{{ $empresa->puesto_representante }}" 
                                                   required>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info alert-itszn">
                                        <i class="fas fa-info-circle me-2"></i>
                                        Esta información debe coincidir con los documentos legales de la empresa.
                                    </div>
                                    
                                    <div class="text-end pt-3 border-top">
                                        <button type="submit" class="btn btn-itszn">
                                            <i class="fas fa-save me-2"></i>Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 4: Documentos -->
                    <div class="tab-pane fade" id="v-pills-docs" role="tabpanel">
                        <div class="info-card-empresa fade-in">
                            <div class="card-header">
                                <i class="fas fa-folder-open me-2"></i>Documentos de la Empresa
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 mb-4">
                                        <div class="file-upload-area-empresa" id="constanciaUploadArea">
                                            <i class="fas fa-cloud-upload-alt fa-3x text-muted mb-3"></i>
                                            <h5 class="fw-bold">Constancia Fiscal</h5>
                                            <p class="text-muted mb-2">Arrastra o haz clic para subir</p>
                                            <small class="text-muted d-block mb-3">Formato: PDF (Máx. 5MB)</small>
                                            <button class="btn btn-itszn-secundario">
                                                <i class="fas fa-upload me-1"></i>Seleccionar Archivo
                                            </button>
                                            <input type="file" id="constanciaFile" accept=".pdf" style="display: none;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6 mb-4">
                                        <div class="document-card">
                                            <div class="document-icon">
                                                <i class="fas fa-file-pdf"></i>
                                            </div>
                                            <h5 class="fw-bold mb-2">Constancia Fiscal</h5>
                                            
                                            @if($empresa->constancia_fiscal_path)
                                                <p class="text-success mb-3">
                                                    <i class="fas fa-check-circle me-1"></i>Documento subido
                                                </p>
                                                <div class="d-flex gap-2 justify-content-center">
                                                    <a href="{{ Storage::url($empresa->constancia_fiscal_path) }}" 
                                                       target="_blank" 
                                                       class="btn btn-itszn">
                                                        <i class="fas fa-eye me-1"></i> Ver
                                                    </a>
                                                    <a href="{{ Storage::url($empresa->constancia_fiscal_path) }}" 
                                                       download 
                                                       class="btn btn-itszn-secundario">
                                                        <i class="fas fa-download me-1"></i> Descargar
                                                    </a>
                                                </div>
                                            @else
                                                <p class="text-muted mb-3">
                                                    <i class="fas fa-times-circle me-1"></i>Sin documento
                                                </p>
                                                <p class="text-muted small">
                                                    Sube la constancia fiscal para completar tu perfil
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="separator"></div>
                                
                                <div class="alert alert-info alert-itszn">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-info-circle fa-2x me-3"></i>
                                        <div>
                                            <h6 class="fw-bold mb-1">Importante</h6>
                                            <p class="mb-0">Todos los documentos deben estar actualizados y ser legibles. 
                                            La constancia fiscal es obligatoria para publicar vacantes.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña 5: Seguridad -->
                    <div class="tab-pane fade" id="v-pills-security" role="tabpanel">
                        <div class="info-card-empresa fade-in">
                            <div class="card-header">
                                <i class="fas fa-shield-alt me-2"></i>Seguridad y Contraseña
                            </div>
                            <div class="card-body">
                                <form id="securityForm">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-key me-1"></i>Contraseña Actual *
                                            </label>
                                            <div class="input-group">
                                                <input type="password" name="current_password" 
                                                       class="form-control form-control-itszn" 
                                                       required>
                                                <button class="btn btn-outline-secondary" type="button" id="toggleCurrentPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-lock me-1"></i>Nueva Contraseña *
                                            </label>
                                            <div class="input-group">
                                                <input type="password" name="new_password" 
                                                       class="form-control form-control-itszn" 
                                                       required>
                                                <button class="btn btn-outline-secondary" type="button" id="toggleNewPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label-itszn">
                                                <i class="fas fa-lock me-1"></i>Confirmar Contraseña *
                                            </label>
                                            <div class="input-group">
                                                <input type="password" name="new_password_confirmation" 
                                                       class="form-control form-control-itszn" 
                                                       required>
                                                <button class="btn btn-outline-secondary" type="button" id="toggleConfirmPassword">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="alert alert-info alert-itszn">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-info-circle me-2"></i>
                                            <div>
                                                <h6 class="fw-bold mb-1">Requisitos de seguridad</h6>
                                                <ul class="mb-0 ps-3">
                                                    <li>Mínimo 8 caracteres</li>
                                                    <li>Al menos una letra mayúscula</li>
                                                    <li>Al menos una letra minúscula</li>
                                                    <li>Al menos un número</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="text-end pt-3 border-top">
                                        <button type="submit" class="btn btn-itszn">
                                            <i class="fas fa-key me-2"></i>Cambiar Contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal para Cambiar Logo -->
    <div class="modal fade" id="logoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-azul-itszn text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-camera me-2"></i>Cambiar Logo de la Empresa
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-md-6 text-center mb-md-0 mb-4">
                            <div class="position-relative d-inline-block">
                                @if($empresa->logo_path)
                                    <img src="{{ Storage::url($empresa->logo_path) }}" 
                                         alt="Logo actual" 
                                         class="rounded-circle border" 
                                         style="width: 250px; height: 250px; object-fit: cover;">
                                @else
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($empresa->nombre_empresa) }}&background=1B396A&color=fff&size=250&bold=true" 
                                         alt="Logo actual" 
                                         class="rounded-circle border">
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label class="form-label-itszn fw-bold">Subir nuevo logo</label>
                                <input type="file" class="form-control form-control-itszn" 
                                       id="logoInput" accept="image/*">
                            </div>
                            
                            <div class="alert alert-info alert-itszn">
                                <h6 class="fw-bold mb-2">
                                    <i class="fas fa-info-circle me-1"></i>Recomendaciones
                                </h6>
                                <ul class="mb-0 ps-3">
                                    <li>Formato: JPG, PNG, SVG</li>
                                    <li>Tamaño máximo: 2MB</li>
                                    <li>Imagen cuadrada recomendada</li>
                                    <li>Fondo transparente preferible</li>
                                </ul>
                            </div>
                            
                            <div class="text-center mt-4">
                                <div id="logoPreview" class="d-none mb-3">
                                    <h6 class="fw-bold">Vista previa:</h6>
                                    <img id="previewImage" class="rounded-circle border" 
                                         style="width: 120px; height: 120px; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-itszn-secundario" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-itszn" id="guardarLogo">
                        <i class="fas fa-save me-1"></i>Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        class EmpresaPerfilManager {
            constructor() {
                this.init();
            }
            
            init() {
                this.cargarEstadisticas();
                this.bindEvents();
                this.setupDragAndDrop();
                this.setupPasswordToggle();
            }
            
            async cargarEstadisticas() {
                try {
                    const response = await axios.get('/empresa/estadisticas');
                    const stats = response.data;
                    
                    // Actualizar tarjetas de estadísticas
                    document.getElementById('total-vacantes').textContent = stats.total_vacantes || 0;
                    document.getElementById('vacantes-activas').textContent = stats.vacantes_activas || 0;
                    document.getElementById('total-postulaciones').textContent = stats.total_postulaciones || 0;
                    document.getElementById('postulaciones-pendientes').textContent = stats.postulaciones_pendientes || 0;
                    
                } catch (error) {
                    console.error('Error cargando estadísticas:', error);
                }
            }
            
            bindEvents() {
                // Formularios
                document.getElementById('empresaInfoForm')?.addEventListener('submit', (e) => this.guardarFormulario(e, '/empresa/informacion-general'));
                document.getElementById('contactoForm')?.addEventListener('submit', (e) => this.guardarFormulario(e, '/empresa/contacto'));
                document.getElementById('representanteForm')?.addEventListener('submit', (e) => this.guardarFormulario(e, '/empresa/representante'));
                document.getElementById('securityForm')?.addEventListener('submit', (e) => this.cambiarPassword(e));
                
                // Logo
                document.getElementById('guardarLogo')?.addEventListener('click', () => this.subirLogo());
                document.getElementById('logoInput')?.addEventListener('change', (e) => this.previewLogo(e));
                
                // Documentos
                document.getElementById('constanciaUploadArea')?.addEventListener('click', () => document.getElementById('constanciaFile').click());
                document.getElementById('constanciaFile')?.addEventListener('change', (e) => this.subirDocumento(e, 'constancia_fiscal'));
            }
            
            setupDragAndDrop() {
                const constanciaArea = document.getElementById('constanciaUploadArea');
                if (!constanciaArea) return;
                
                constanciaArea.addEventListener('dragover', (e) => {
                    e.preventDefault();
                    constanciaArea.classList.add('dragover');
                });
                
                constanciaArea.addEventListener('dragleave', () => {
                    constanciaArea.classList.remove('dragover');
                });
                
                constanciaArea.addEventListener('drop', (e) => {
                    e.preventDefault();
                    constanciaArea.classList.remove('dragover');
                    
                    const files = e.dataTransfer.files;
                    if (files.length) {
                        const fileInput = document.getElementById('constanciaFile');
                        fileInput.files = files;
                        this.subirDocumento({ target: { files } }, 'constancia_fiscal');
                    }
                });
            }
            
            setupPasswordToggle() {
                const togglePassword = (buttonId, inputName) => {
                    const button = document.getElementById(buttonId);
                    const input = document.querySelector(`input[name="${inputName}"]`);
                    
                    if (button && input) {
                        button.addEventListener('click', () => {
                            const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                            input.setAttribute('type', type);
                            button.querySelector('i').className = type === 'password' ? 'fas fa-eye' : 'fas fa-eye-slash';
                        });
                    }
                };
                
                togglePassword('toggleCurrentPassword', 'current_password');
                togglePassword('toggleNewPassword', 'new_password');
                togglePassword('toggleConfirmPassword', 'new_password_confirmation');
            }
            
            async guardarFormulario(e, endpoint) {
                e.preventDefault();
                const formData = new FormData(e.target);
                const submitBtn = e.target.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                try {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
                    submitBtn.disabled = true;
                    
                    const response = await axios.post(endpoint, formData);
                    this.mostrarAlerta('success', response.data.message);
                    
                } catch (error) {
                    const message = error.response?.data?.message || 'Error al guardar los cambios';
                    this.mostrarAlerta('danger', message);
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }
            
            async cambiarPassword(e) {
                e.preventDefault();
                const formData = new FormData(e.target);
                const submitBtn = e.target.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                try {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Cambiando...';
                    submitBtn.disabled = true;
                    
                    const response = await axios.post('/perfil/password', formData);
                    this.mostrarAlerta('success', response.data.message);
                    e.target.reset();
                    
                } catch (error) {
                    const message = error.response?.data?.message || 'Error al cambiar la contraseña';
                    this.mostrarAlerta('danger', message);
                } finally {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }
            
            async subirLogo() {
                const fileInput = document.getElementById('logoInput');
                const file = fileInput.files[0];
                
                if (!file) {
                    this.mostrarAlerta('warning', 'Selecciona una imagen para el logo');
                    return;
                }
                
                const formData = new FormData();
                formData.append('logo', file);
                
                const modal = bootstrap.Modal.getInstance(document.getElementById('logoModal'));
                const submitBtn = document.getElementById('guardarLogo');
                const originalText = submitBtn.innerHTML;
                
                try {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Subiendo...';
                    submitBtn.disabled = true;
                    
                    const response = await axios.post('/empresa/logo', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                    
                    this.mostrarAlerta('success', response.data.message);
                    
                    if (modal) modal.hide();
                    
                    // Recargar después de 1 segundo para mostrar el nuevo logo
                    setTimeout(() => location.reload(), 1000);
                    
                } catch (error) {
                    const message = error.response?.data?.message || 'Error al subir el logo';
                    this.mostrarAlerta('danger', message);
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }
            }
            
            previewLogo(e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const preview = document.getElementById('previewImage');
                        const previewContainer = document.getElementById('logoPreview');
                        
                        if (preview) {
                            preview.src = e.target.result;
                            previewContainer.classList.remove('d-none');
                        }
                    };
                    reader.readAsDataURL(file);
                }
            }
            
            async subirDocumento(e, tipo) {
                const file = e.target.files[0];
                if (!file) return;
                
                if (!file.type.includes('pdf')) {
                    this.mostrarAlerta('warning', 'Solo se permiten archivos PDF');
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    this.mostrarAlerta('warning', 'El archivo no debe superar los 5MB');
                    return;
                }
                
                const formData = new FormData();
                formData.append(tipo, file);
                
                const uploadArea = document.getElementById('constanciaUploadArea');
                const originalHTML = uploadArea.innerHTML;
                
                try {
                    uploadArea.innerHTML = '<div class="text-center"><i class="fas fa-spinner fa-spin fa-2x mb-3"></i><p>Subiendo documento...</p></div>';
                    
                    const response = await axios.post('/empresa/documento', formData, {
                        headers: { 'Content-Type': 'multipart/form-data' }
                    });
                    
                    this.mostrarAlerta('success', response.data.message);
                    
                    // Actualizar la vista del documento
                    const documentoDiv = document.querySelector('.document-card');
                    if (documentoDiv && response.data.documento_url) {
                        documentoDiv.innerHTML = `
                            <div class="document-icon">
                                <i class="fas fa-file-pdf"></i>
                            </div>
                            <h5 class="fw-bold mb-2">Constancia Fiscal</h5>
                            <p class="text-success mb-3">
                                <i class="fas fa-check-circle me-1"></i>Documento subido
                            </p>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="${response.data.documento_url}" target="_blank" class="btn btn-itszn">
                                    <i class="fas fa-eye me-1"></i> Ver
                                </a>
                                <a href="${response.data.documento_url}" download class="btn btn-itszn-secundario">
                                    <i class="fas fa-download me-1"></i> Descargar
                                </a>
                            </div>
                        `;
                    }
                    
                } catch (error) {
                    const message = error.response?.data?.message || 'Error al subir el documento';
                    this.mostrarAlerta('danger', message);
                } finally {
                    uploadArea.innerHTML = originalHTML;
                }
            }
            
            mostrarAlerta(tipo, mensaje) {
                const alertDiv = document.createElement('div');
                alertDiv.className = `alert alert-${tipo} alert-dismissible fade show position-fixed`;
                alertDiv.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
                
                alertDiv.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${tipo === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
                        <div>${mensaje}</div>
                        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
                    </div>
                `;
                
                document.body.appendChild(alertDiv);
                
                setTimeout(() => {
                    alertDiv.remove();
                }, 5000);
            }
        }

        // Inicializar cuando el documento esté listo
        document.addEventListener('DOMContentLoaded', () => {
            window.empresaPerfilManager = new EmpresaPerfilManager();
        });
    </script>
</body>
</html>