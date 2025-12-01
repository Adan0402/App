<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios - Bolsa Trabajo ITSZN</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }
        .badge-alumno { background: #3498db; }
        .badge-empresa { background: #2ecc71; }
        .badge-admin { background: #e74c3c; }
        .badge-egresado { background: #9b59b6; }
        .table-hover tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.1);
        }
    </style>
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
                <a class="nav-link text-white" href="/notificaciones">
                    <i class="fas fa-bell me-1"></i>Notificaciones
                </a>
                <a class="nav-link text-white" href="/perfil">
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
                <li class="breadcrumb-item"><a href="/dashboard" class="text-decoration-none"><i class="fas fa-home"></i> Dashboard</a></li>
                <li class="breadcrumb-item active"><i class="fas fa-users"></i> Gestión de Usuarios</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h1 class="h3 mb-1"><i class="fas fa-users me-2"></i>Gestión de Usuarios</h1>
                <p class="text-muted mb-0">Administra todos los usuarios del sistema</p>
            </div>
            <div class="d-flex gap-2">
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Buscar usuarios..." id="searchInput">
                    <button class="btn btn-outline-secondary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
                <select class="form-select" style="width: 150px;" id="filterTipo">
                    <option value="">Todos los tipos</option>
                    <option value="alumno">Alumnos</option>
                    <option value="egresado">Egresados</option>
                    <option value="empresa">Empresas</option>
                    <option value="admin">Administradores</option>
                </select>
            </div>
        </div>

        <!-- Estadísticas -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-users fa-2x mb-2"></i>
                        <h4>{{ $usuarios->count() }}</h4>
                        <small>Total Usuarios</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-user-graduate fa-2x mb-2"></i>
                        <h4>{{ $usuarios->where('tipo', 'alumno')->count() }}</h4>
                        <small>Alumnos</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-building fa-2x mb-2"></i>
                        <h4>{{ $usuarios->where('tipo', 'empresa')->count() }}</h4>
                        <small>Empresas</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-danger text-white">
                    <div class="card-body text-center py-3">
                        <i class="fas fa-user-shield fa-2x mb-2"></i>
                        <h4>{{ $usuarios->where('tipo', 'admin')->count() }}</h4>
                        <small>Administradores</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Usuarios -->
        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Lista de Usuarios</h5>
            </div>
            <div class="card-body">
                @if($usuarios->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Usuario</th>
                                    <th>Email</th>
                                    <th>Tipo</th>
                                    <th>Información</th>
                                    <th>Estado</th>
                                    <th>Registro</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @if($usuario->foto_perfil)
                                                <img src="{{ Storage::url($usuario->foto_perfil) }}" 
                                                     alt="Avatar" class="user-avatar me-3">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=3498db&color=fff&size=40" 
                                                     alt="Avatar" class="user-avatar me-3">
                                            @endif
                                            <div>
                                                <strong>{{ $usuario->name }}</strong>
                                                @if($usuario->numero_control)
                                                    <br><small class="text-muted">{{ $usuario->numero_control }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>
                                        @php
                                            $badgeClass = [
                                                'alumno' => 'badge-alumno',
                                                'empresa' => 'badge-empresa', 
                                                'admin' => 'badge-admin',
                                                'egresado' => 'badge-egresado'
                                            ][$usuario->tipo] ?? 'badge-secondary';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ ucfirst($usuario->tipo) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($usuario->tipo == 'alumno' || $usuario->tipo == 'egresado')
                                            <small>
                                                @if($usuario->carrera)
                                                    {{ $usuario->carrera }}<br>
                                                @endif
                                                @if($usuario->semestre)
                                                    Semestre: {{ $usuario->semestre }}<br>
                                                @endif
                                                @if($usuario->promedio)
                                                    Promedio: {{ $usuario->promedio }}
                                                @endif
                                            </small>
                                        @elseif($usuario->tipo == 'empresa' && $usuario->empresa)
                                            <small>
                                                {{ $usuario->empresa->nombre_empresa }}<br>
                                                {{ $usuario->empresa->giro }}
                                            </small>
                                        @else
                                            <small class="text-muted">Sin información adicional</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($usuario->activo)
                                            <span class="badge bg-success">Activo</span>
                                        @else
                                            <span class="badge bg-danger">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <small class="text-muted">
                                            {{ $usuario->created_at->format('d/m/Y') }}<br>
                                            {{ $usuario->created_at->format('H:i') }}
                                        </small>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="/usuario/{{ $usuario->id }}" 
                                               class="btn btn-sm btn-outline-primary" 
                                               title="Ver perfil">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <button class="btn btn-sm btn-outline-warning" 
                                                    title="Editar usuario"
                                                    onclick="editarUsuario({{ $usuario->id }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            @if($usuario->id !== Auth::id())
                                                <button class="btn btn-sm btn-outline-danger" 
                                                        title="Desactivar usuario"
                                                        onclick="cambiarEstado({{ $usuario->id }})">
                                                    <i class="fas fa-ban"></i>
                                                </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fas fa-users fa-4x text-muted mb-3"></i>
                        <h4 class="text-muted">No hay usuarios registrados</h4>
                        <p class="text-muted">No se encontraron usuarios en el sistema.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        // Filtrado y búsqueda
        $(document).ready(function() {
            $('#searchInput, #filterTipo').on('input change', function() {
                const searchText = $('#searchInput').val().toLowerCase();
                const filterTipo = $('#filterTipo').val();
                
                $('tbody tr').each(function() {
                    const row = $(this);
                    const name = row.find('strong').text().toLowerCase();
                    const email = row.find('td:nth-child(2)').text().toLowerCase();
                    const tipo = row.find('.badge').text().toLowerCase();
                    
                    const matchesSearch = name.includes(searchText) || email.includes(searchText);
                    const matchesTipo = !filterTipo || tipo.includes(filterTipo);
                    
                    if (matchesSearch && matchesTipo) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });
        });

        function editarUsuario(id) {
    window.location.href = `/usuarios/${id}/edit`;
}

function cambiarEstado(id) {
    if (confirm('¿Estás seguro de que quieres cambiar el estado de este usuario?')) {
        axios.post(`/usuarios/${id}/cambiar-estado`)
            .then(response => {
                alert(response.data.message);
                location.reload(); // Recargar para ver los cambios
            })
            .catch(error => {
                alert(error.response?.data?.message || 'Error al cambiar estado');
            });
    }
}
    </script>
</body>
</html>