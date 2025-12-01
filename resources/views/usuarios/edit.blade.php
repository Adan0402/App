<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario - Bolsa Trabajo ITSZN</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
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
                <a class="nav-link text-white" href="/usuarios">
                    <i class="fas fa-arrow-left me-1"></i>Volver a Usuarios
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
                <li class="breadcrumb-item active"><i class="fas fa-edit"></i> Editar Usuario</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="mb-0"><i class="fas fa-edit me-2"></i>Editar Usuario: {{ $usuario->name }}</h4>
                    </div>
                    <div class="card-body">
                        <form id="editUserForm">
                            @csrf
                            @method('PUT')
                            
                            <!-- Información Básica -->
                            <div class="row mb-4">
                                <div class="col-md-12 text-center mb-3">
                                    @if($usuario->foto_perfil)
                                        <img src="{{ Storage::url($usuario->foto_perfil) }}" 
                                             alt="Avatar" class="user-avatar mb-2">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($usuario->name) }}&background=3498db&color=fff&size=100" 
                                             alt="Avatar" class="user-avatar mb-2">
                                    @endif
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nombre Completo *</label>
                                    <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" name="telefono" class="form-control" value="{{ $usuario->telefono }}">
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Tipo de Usuario *</label>
                                    <select name="tipo" class="form-select" required>
                                        <option value="alumno" {{ $usuario->tipo == 'alumno' ? 'selected' : '' }}>Alumno</option>
                                        <option value="egresado" {{ $usuario->tipo == 'egresado' ? 'selected' : '' }}>Egresado</option>
                                        <option value="empresa" {{ $usuario->tipo == 'empresa' ? 'selected' : '' }}>Empresa</option>
                                        <option value="admin" {{ $usuario->tipo == 'admin' ? 'selected' : '' }}>Administrador</option>
                                    </select>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Dirección</label>
                                    <textarea name="direccion" class="form-control" rows="3">{{ $usuario->direccion }}</textarea>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Estado</label>
                                    <select name="activo" class="form-select">
                                        <option value="1" {{ $usuario->activo ? 'selected' : '' }}>Activo</option>
                                        <option value="0" {{ !$usuario->activo ? 'selected' : '' }}>Inactivo</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Información Académica (solo para alumnos/egresados) -->
                            <div id="infoAcademica" class="mb-4" style="{{ in_array($usuario->tipo, ['alumno', 'egresado']) ? '' : 'display: none;' }}">
                                <h5 class="border-bottom pb-2 mb-3">Información Académica</h5>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Número de Control</label>
                                        <input type="text" name="numero_control" class="form-control" value="{{ $usuario->numero_control }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Carrera</label>
                                        <input type="text" name="carrera" class="form-control" value="{{ $usuario->carrera }}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Semestre</label>
                                        <input type="number" name="semestre" class="form-control" value="{{ $usuario->semestre }}" min="1" max="20">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Promedio</label>
                                        <input type="number" name="promedio" class="form-control" value="{{ $usuario->promedio }}" step="0.01" min="0" max="10">
                                    </div>
                                </div>
                            </div>

                            <!-- Cambio de Contraseña -->
                            <div class="mb-4">
                                <h5 class="border-bottom pb-2 mb-3">Cambiar Contraseña</h5>
                                <div class="alert alert-info">
                                    <small>Deja estos campos en blanco si no deseas cambiar la contraseña.</small>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Nueva Contraseña</label>
                                        <input type="password" name="nueva_password" class="form-control">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="form-label">Confirmar Contraseña</label>
                                        <input type="password" name="nueva_password_confirmation" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" onclick="window.history.back()">
                                    <i class="fas fa-times me-1"></i>Cancelar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>Guardar Cambios
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Axios -->
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
    $(document).ready(function() {
        // Mostrar/ocultar información académica según el tipo de usuario
        $('select[name="tipo"]').on('change', function() {
            const tipo = $(this).val();
            if (tipo === 'alumno' || tipo === 'egresado') {
                $('#infoAcademica').show();
            } else {
                $('#infoAcademica').hide();
            }
        });

        // Enviar formulario
        $('#editUserForm').on('submit', function(e) {
            e.preventDefault();
            
            const userId = {{ $usuario->id }};
            const tipoUsuario = $('select[name="tipo"]').val();
            
            // Preparar datos con tipos correctos
            const datos = {
                name: $('input[name="name"]').val(),
                email: $('input[name="email"]').val(),
                telefono: $('input[name="telefono"]').val(),
                direccion: $('textarea[name="direccion"]').val(),
                tipo: tipoUsuario,
                activo: $('select[name="activo"]').val() === '1' ? true : false, // ✅ Boolean
                _method: 'PUT'
            };
            
            // Solo agregar campos académicos si es alumno/egresado
            if (tipoUsuario === 'alumno' || tipoUsuario === 'egresado') {
                datos.numero_control = $('input[name="numero_control"]').val();
                datos.carrera = $('input[name="carrera"]').val();
                datos.semestre = $('input[name="semestre"]').val() ? parseInt($('input[name="semestre"]').val()) : null;
                datos.promedio = $('input[name="promedio"]').val() ? parseFloat($('input[name="promedio"]').val()) : null;
            }
            
            console.log('Datos a enviar:', datos);
            
            // Enviar datos
            axios.put(`/usuarios/${userId}`, datos)
                .then(response => {
                    alert('Usuario actualizado correctamente');
                    
                    // Si hay nueva contraseña, enviarla también
                    const nuevaPassword = $('input[name="nueva_password"]').val();
                    if (nuevaPassword) {
                        return axios.post(`/usuarios/${userId}/cambiar-password`, {
                            nueva_password: nuevaPassword,
                            nueva_password_confirmation: $('input[name="nueva_password_confirmation"]').val()
                        });
                    }
                    return Promise.resolve();
                })
                .then(passwordResponse => {
                    if (passwordResponse) {
                        alert('Contraseña actualizada correctamente');
                    }
                    window.location.href = '/usuarios';
                })
                .catch(error => {
                    console.error('Error completo:', error);
                    const errorMessage = error.response?.data?.message || 
                                       error.response?.data?.errors ? 
                                       Object.values(error.response.data.errors).flat().join(', ') : 
                                       'Error desconocido';
                    alert('Error al actualizar usuario: ' + errorMessage);
                });
        });
    });
</script>
    </script>
</body>
</html>