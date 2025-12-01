<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de {{ $usuario->name }} - Bolsa Trabajo ITSZN</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-briefcase me-2"></i>Bolsa Trabajo ITSZN
            </a>
            
            <div class="navbar-nav ms-auto">
                <a class="nav-link text-white" href="/dashboard">
                    <i class="fas fa-home me-1"></i>Dashboard
                </a>
                <a class="nav-link text-white" href="/usuarios">
                    <i class="fas fa-arrow-left me-1"></i>Volver
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenido Principal -->
    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item"><a href="/usuarios" class="text-decoration-none"><i class="fas fa-users"></i> Usuarios</a></li>
                <li class="breadcrumb-item active"><i class="fas fa-user"></i> {{ $usuario->name }}</li>
            </ol>
        </nav>

        <div class="row">
            <div class="col-md-4">
                <!-- Tarjeta de Información Básica -->
                <div class="card shadow-sm mb-4">
                    <div class="card-body text-center">
                        @if($usuario->foto_perfil)
                            <img src="{{ Storage::url($usuario->foto_perfil) }}" 
                                 alt="Avatar" class="rounded-circle mb-3" style="width: 150px; height: 150px; object-fit: cover;">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=3498db&color=fff&size=150" 
                                 alt="Avatar" class="rounded-circle mb-3">
                        @endif
                        
                        <h4>{{ $usuario->name }}</h4>
                        <p class="text-muted">{{ $usuario->email }}</p>
                        
                        @php
                            $badgeClass = [
                                'alumno' => 'bg-primary',
                                'empresa' => 'bg-success', 
                                'admin' => 'bg-danger',
                                'egresado' => 'bg-purple'
                            ][$usuario->tipo] ?? 'bg-secondary';
                        @endphp
                        <span class="badge {{ $badgeClass }} mb-2">
                            {{ ucfirst($usuario->tipo) }}
                        </span>
                        
                        @if($usuario->activo)
                            <span class="badge bg-success">Activo</span>
                        @else
                            <span class="badge bg-danger">Inactivo</span>
                        @endif
                    </div>
                </div>

                <!-- Información de Contacto -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-address-card me-2"></i>Información de Contacto</h6>
                    </div>
                    <div class="card-body">
                        @if($usuario->telefono)
                            <p><strong><i class="fas fa-phone me-2"></i>Teléfono:</strong><br>{{ $usuario->telefono }}</p>
                        @endif
                        @if($usuario->direccion)
                            <p><strong><i class="fas fa-map-marker-alt me-2"></i>Dirección:</strong><br>{{ $usuario->direccion }}</p>
                        @endif
                        <p><strong><i class="fas fa-calendar me-2"></i>Registro:</strong><br>{{ $usuario->created_at->format('d/m/Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <!-- Información Específica por Tipo -->
                <div class="card shadow-sm mb-4">
                    <div class="card-header">
                        <h6 class="mb-0">
                            <i class="fas fa-info-circle me-2"></i>
                            Información 
                            @if($usuario->tipo == 'alumno' || $usuario->tipo == 'egresado')
                                Académica
                            @elseif($usuario->tipo == 'empresa')
                                de Empresa
                            @else
                                del Usuario
                            @endif
                        </h6>
                    </div>
                    <div class="card-body">
                        @if($usuario->tipo == 'alumno' || $usuario->tipo == 'egresado')
                            <div class="row">
                                @if($usuario->numero_control)
                                    <div class="col-md-6 mb-3">
                                        <strong>Número de Control:</strong><br>
                                        {{ $usuario->numero_control }}
                                    </div>
                                @endif
                                @if($usuario->carrera)
                                    <div class="col-md-6 mb-3">
                                        <strong>Carrera:</strong><br>
                                        {{ $usuario->carrera }}
                                    </div>
                                @endif
                                @if($usuario->semestre)
                                    <div class="col-md-6 mb-3">
                                        <strong>Semestre:</strong><br>
                                        {{ $usuario->semestre }}
                                    </div>
                                @endif
                                @if($usuario->promedio)
                                    <div class="col-md-6 mb-3">
                                        <strong>Promedio:</strong><br>
                                        {{ $usuario->promedio }}
                                    </div>
                                @endif
                            </div>
                            
                            @if($usuario->habilidades && count($usuario->habilidades) > 0)
                                <div class="mt-3">
                                    <strong>Habilidades:</strong><br>
                                    @foreach($usuario->habilidades as $habilidad)
                                        <span class="badge bg-light text-dark border me-1 mb-1">{{ $habilidad }}</span>
                                    @endforeach
                                </div>
                            @endif
                            
                        @elseif($usuario->tipo == 'empresa' && $usuario->empresa)
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <strong>Nombre de la Empresa:</strong><br>
                                    {{ $usuario->empresa->nombre_empresa }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>RFC:</strong><br>
                                    {{ $usuario->empresa->rfc }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Giro:</strong><br>
                                    {{ $usuario->empresa->giro }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Representante Legal:</strong><br>
                                    {{ $usuario->empresa->representante_legal }}
                                </div>
                                <div class="col-12 mb-3">
                                    <strong>Dirección de la Empresa:</strong><br>
                                    {{ $usuario->empresa->direccion }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Teléfono de Contacto:</strong><br>
                                    {{ $usuario->empresa->telefono_contacto }}
                                </div>
                                <div class="col-md-6 mb-3">
                                    <strong>Correo de Contacto:</strong><br>
                                    {{ $usuario->empresa->correo_contacto }}
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No hay información adicional disponible.</p>
                        @endif
                    </div>
                </div>

                <!-- Estadísticas -->
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h6 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Estadísticas</h6>
                    </div>
                    <div class="card-body">
                        @if($usuario->tipo == 'alumno' || $usuario->tipo == 'egresado')
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <h4>{{ $usuario->postulaciones->count() }}</h4>
                                    <small class="text-muted">Postulaciones</small>
                                </div>
                                <div class="col-md-4">
                                    <h4>{{ $usuario->postulaciones->where('estado', 'aceptado')->count() }}</h4>
                                    <small class="text-muted">Aceptadas</small>
                                </div>
                                <div class="col-md-4">
                                    <h4>{{ $usuario->postulaciones->where('estado', 'pendiente')->count() }}</h4>
                                    <small class="text-muted">Pendientes</small>
                                </div>
                            </div>
                        @elseif($usuario->tipo == 'empresa' && $usuario->empresa)
                            <div class="row text-center">
                                <div class="col-md-4">
                                    <h4>{{ $usuario->empresa->vacantes->count() }}</h4>
                                    <small class="text-muted">Vacantes Publicadas</small>
                                </div>
                                <div class="col-md-4">
                                    <h4>{{ $usuario->empresa->vacantes->where('estado', 'activa')->count() }}</h4>
                                    <small class="text-muted">Vacantes Activas</small>
                                </div>
                                <div class="col-md-4">
                                    <h4>0</h4>
                                    <small class="text-muted">Postulaciones Recibidas</small>
                                </div>
                            </div>
                        @else
                            <p class="text-muted">No hay estadísticas disponibles para este tipo de usuario.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>