<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VacanteController;
use App\Http\Controllers\PostulacionController;
use App\Http\Controllers\EmpresaPostulacionController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\ServicioSocialController;
use App\Http\Controllers\ServicioSocialEmpresaController;
use App\Http\Controllers\RegistroHorasController;  
use App\Models\Usuario;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\CheckServicioSocialAdmin;

// Ruta principal → Login
Route::get('/', function () {
    return redirect('/login');
});

// RUTAS PÚBLICAS DE AUTENTICACIÓN
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// RUTAS PROTEGIDAS (requieren autenticación)
Route::middleware(['auth'])->group(function () {
    
    // 🔥 DASHBOARD PRINCIPAL
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $totalUsuarios = Usuario::count();
        $alumnos = Usuario::where('tipo', 'alumno')->count();
        $empresas = Usuario::where('tipo', 'empresa')->count();
        
        if ($user->tipo == 'admin') {
            $empresasPendientesCount = \App\Models\Empresa::where('estado', 'pendiente')->count();
            $vacantesPendientesCount = \App\Models\Vacante::where('estado', 'pendiente')->count();
            return view('dashboard', compact('totalUsuarios', 'alumnos', 'empresas', 'user', 'empresasPendientesCount', 'vacantesPendientesCount'));
        }
        
        return view('dashboard', compact('totalUsuarios', 'alumnos', 'empresas', 'user'));
    })->name('dashboard');

    // 👥 RUTAS DE USUARIOS
    Route::get('/usuarios', function () {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    });

    Route::get('/usuario/{id}', function ($id) {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.show', compact('usuario'));
    });

    // 🏢 RUTAS DE EMPRESAS
    Route::get('/empresa/completar-datos', [EmpresaController::class, 'create'])->name('empresa.create');
    Route::post('/empresa/completar-datos', [EmpresaController::class, 'store'])->name('empresa.store');

    // ✅ RUTAS DE VACANTES PARA EMPRESAS
    Route::prefix('empresa')->group(function () {
        Route::get('/vacantes/create', [VacanteController::class, 'create'])->name('vacantes.create');
        Route::post('/vacantes', [VacanteController::class, 'store'])->name('vacantes.store');
        Route::get('/vacantes', [VacanteController::class, 'index'])->name('vacantes.index');
        Route::get('/vacantes/{vacante}/edit', [VacanteController::class, 'edit'])->name('vacantes.edit');
        Route::put('/vacantes/{vacante}', [VacanteController::class, 'update'])->name('vacantes.update');
        Route::delete('/vacantes/{vacante}', [VacanteController::class, 'destroy'])->name('vacantes.destroy');
    });

    // 🛠️ RUTAS DE ADMINISTRACIÓN
    Route::prefix('admin')->group(function () {
        // Empresas
        Route::get('/empresas-pendientes', [AdminController::class, 'empresasPendientes'])->name('admin.empresas.pendientes');
        Route::post('/empresas/{empresa}/aprobar', [AdminController::class, 'aprobarEmpresa'])->name('admin.empresas.aprobar');
        Route::post('/empresas/{empresa}/rechazar', [AdminController::class, 'rechazarEmpresa'])->name('admin.empresas.rechazar');
        Route::get('/empresas', [AdminController::class, 'todasLasEmpresas'])->name('admin.empresas.todas');
        
        // Usuarios
        Route::get('/usuarios', [AdminController::class, 'gestionarUsuarios'])->name('admin.usuarios');
        
        // Vacantes
        Route::get('/vacantes-pendientes', [AdminController::class, 'vacantesPendientes'])->name('admin.vacantes.pendientes');
        Route::post('/vacantes/{vacante}/aprobar', [AdminController::class, 'aprobarVacante'])->name('admin.vacantes.aprobar');
        Route::post('/vacantes/{vacante}/rechazar', [AdminController::class, 'rechazarVacante'])->name('admin.vacantes.rechazar');
    });

    // 👨‍🎓 RUTAS PARA ALUMNOS
    Route::prefix('alumno')->group(function () {
        Route::get('/vacantes', [PostulacionController::class, 'index'])->name('alumno.vacantes');
        Route::get('/vacantes/{vacante}/postular', [PostulacionController::class, 'create'])->name('alumno.postular');
        Route::post('/vacantes/{vacante}/postular', [PostulacionController::class, 'store'])->name('alumno.postular.store');
        Route::get('/mis-postulaciones', [PostulacionController::class, 'misPostulaciones'])->name('alumno.mis-postulaciones');
        Route::get('/postulaciones/{postulacion}/descargar-cv', [PostulacionController::class, 'descargarCv'])->name('alumno.descargar-cv');
        Route::get('/postulaciones/{postulacion}/descargar-solicitud', [PostulacionController::class, 'descargarSolicitud'])->name('alumno.descargar-solicitud');
    });

    // 🏢 RUTAS PARA GESTIÓN DE POSTULACIONES
    Route::prefix('empresa')->group(function () {
        Route::get('/postulaciones', [EmpresaPostulacionController::class, 'index'])->name('empresa.postulaciones');
        Route::get('/postulaciones/{postulacion}', [EmpresaPostulacionController::class, 'show'])->name('empresa.postulacion.show');
        Route::post('/postulaciones/{postulacion}/aprobar', [EmpresaPostulacionController::class, 'aprobar'])->name('empresa.postulacion.aprobar');
        Route::post('/postulaciones/{postulacion}/rechazar', [EmpresaPostulacionController::class, 'rechazar'])->name('empresa.postulacion.rechazar');
        Route::get('/postulaciones/{postulacion}/descargar-cv', [EmpresaPostulacionController::class, 'descargarCv'])->name('empresa.postulacion.descargar-cv');
        Route::get('/postulaciones/{postulacion}/descargar-solicitud', [EmpresaPostulacionController::class, 'descargarSolicitud'])->name('empresa.postulacion.descargar-solicitud');
        Route::get('/vacantes/{vacante}/postulaciones', [EmpresaPostulacionController::class, 'porVacante'])->name('empresa.postulaciones.vacante');
    });

    // 🔔 RUTAS DE NOTIFICACIONES - VISTA HTML
    Route::prefix('notificaciones')->group(function () {
        Route::get('/', [NotificacionController::class, 'index'])->name('notificaciones');
    });

    // 🔔 RUTAS API PARA NOTIFICACIONES (JSON)
    Route::prefix('api/notificaciones')->group(function () {
        Route::get('/', [NotificacionController::class, 'getNotificaciones'])->name('api.notificaciones');
        Route::post('/{notificacion}/leida', [NotificacionController::class, 'marcarLeida'])->name('api.notificaciones.leida');
        Route::post('/marcar-todas-leidas', [NotificacionController::class, 'marcarTodasLeidas'])->name('api.notificaciones.marcar-todas');
        Route::get('/contador', [NotificacionController::class, 'contador'])->name('api.notificaciones.contador');
        Route::delete('/{notificacion}', [NotificacionController::class, 'destroy'])->name('api.notificaciones.destroy');
    });

    // RUTAS DE PERFIL
    Route::prefix('perfil')->group(function () {
        Route::get('/', [PerfilController::class, 'index'])->name('perfil');
        Route::post('/informacion', [PerfilController::class, 'actualizarInformacion'])->name('perfil.informacion');
        Route::post('/habilidades', [PerfilController::class, 'actualizarHabilidades'])->name('perfil.habilidades');
        Route::post('/password', [PerfilController::class, 'cambiarPassword'])->name('perfil.password');
        Route::post('/foto', [PerfilController::class, 'subirFoto'])->name('perfil.foto');
        Route::post('/cv', [PerfilController::class, 'subirCV'])->name('perfil.cv');
        Route::get('/estadisticas', [PerfilController::class, 'estadisticas'])->name('perfil.estadisticas');
    });

    // RUTAS PARA GESTIÓN DE USUARIOS
    Route::prefix('usuarios')->group(function () {
        Route::get('/{id}/edit', [UsuarioController::class, 'edit'])->name('usuarios.edit');
        Route::put('/{id}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::post('/{id}/cambiar-estado', [UsuarioController::class, 'cambiarEstado'])->name('usuarios.cambiar-estado');
        Route::post('/{id}/cambiar-password', [UsuarioController::class, 'cambiarPassword'])->name('usuarios.cambiar-password');
    });

    // RUTAS DE PERFIL DE EMPRESA
    Route::prefix('empresa')->group(function () {
        Route::get('/perfil', [EmpresaController::class, 'perfil'])->name('empresa.perfil');
        Route::post('/informacion-general', [EmpresaController::class, 'actualizarInformacionGeneral'])->name('empresa.informacion-general');
        Route::post('/contacto', [EmpresaController::class, 'actualizarContacto'])->name('empresa.contacto');
        Route::post('/representante', [EmpresaController::class, 'actualizarRepresentante'])->name('empresa.representante');
        Route::post('/logo', [EmpresaController::class, 'subirLogo'])->name('empresa.logo');
        Route::post('/constancia-fiscal', [EmpresaController::class, 'subirConstanciaFiscal'])->name('empresa.constancia-fiscal');
        Route::get('/estadisticas', [EmpresaController::class, 'estadisticas'])->name('empresa.estadisticas');
    });

    // RUTAS DE SERVICIO SOCIAL
    Route::prefix('servicio-social')->group(function () {
        Route::get('/crear/{postulacion_id}', [ServicioSocialController::class, 'crear'])
            ->name('servicio-social.crear');
        Route::post('/store/{postulacion_id}', [ServicioSocialController::class, 'store'])
            ->name('servicio-social.store');
        Route::get('/{id}', [ServicioSocialController::class, 'show'])
            ->name('servicio-social.show');
             Route::post('/{id}/cancelar', [ServicioSocialController::class, 'cancelar'])
        ->name('servicio-social.cancelar');
    });

    // ✅ RUTAS DE SERVICIO SOCIAL PARA EMPRESA
    Route::prefix('empresa')->group(function () {
        Route::get('/servicio-social', [ServicioSocialEmpresaController::class, 'index'])
            ->name('empresa.servicio-social.index');
        Route::get('/servicio-social/{servicioSocial}', [ServicioSocialEmpresaController::class, 'show'])
            ->name('empresa.servicio-social.show');
        Route::post('/servicio-social/{servicioSocial}/aprobar', [ServicioSocialEmpresaController::class, 'aprobar'])
            ->name('empresa.servicio-social.aprobar');
        Route::post('/servicio-social/{servicioSocial}/rechazar', [ServicioSocialEmpresaController::class, 'rechazar'])
            ->name('empresa.servicio-social.rechazar');
        
        // ✅ RUTAS DE EMPRESA PARA REGISTROS DE HORAS (MOVIDAS DENTRO DEL GRUPO EMPRESA)
        Route::get('/servicio-social/{servicioSocial}/registros-horas', [ServicioSocialEmpresaController::class, 'registrosHoras'])
            ->name('empresa.servicio-social.registros-horas');
        Route::post('/registro-horas/{registro}/aprobar', [ServicioSocialEmpresaController::class, 'aprobarRegistro'])
            ->name('empresa.registro-horas.aprobar');
        Route::post('/registro-horas/{registro}/rechazar', [ServicioSocialEmpresaController::class, 'rechazarRegistro'])
            ->name('empresa.registro-horas.rechazar');
    });

    // RUTAS PARA EL "SUB-LOGIN" DE SERVICIO SOCIAL (ACCESIBLE POR TODOS LOS ADMINS)
    Route::prefix('admin')->group(function () {
        Route::get('/servicio-social/login', [AdminController::class, 'servicioSocialLogin'])
            ->name('admin.servicio-social.login');
        Route::post('/servicio-social/verify', [AdminController::class, 'servicioSocialVerify'])
            ->name('admin.servicio-social.verify');
    });

    // RUTAS EXCLUSIVAS PARA EL COORDINADOR DE SERVICIO SOCIAL
Route::middleware([CheckServicioSocialAdmin::class])->prefix('admin/servicio-social')->group(function () {
    // ✅ RUTAS SIN PARÁMETROS (PRIMERO)
    Route::get('/', [AdminController::class, 'servicioSocialIndex'])
        ->name('admin.servicio-social.index');
    Route::get('/estadisticas', [AdminController::class, 'servicioSocialEstadisticas'])
        ->name('admin.servicio-social.estadisticas');
    
    // ✅ RUTAS CON PARÁMETROS (DESPUÉS)
    Route::get('/{servicioSocial}', [AdminController::class, 'servicioSocialShow'])
        ->name('admin.servicio-social.show');
    Route::post('/{servicioSocial}/aprobar', [AdminController::class, 'servicioSocialAprobar'])
        ->name('admin.servicio-social.aprobar');
    Route::post('/{servicioSocial}/rechazar', [AdminController::class, 'servicioSocialRechazar'])
        ->name('admin.servicio-social.rechazar');
    Route::get('/{servicioSocial}/registros', [AdminController::class, 'servicioSocialRegistros'])
        ->name('admin.servicio-social.registros');
    Route::get('/{servicioSocial}/reporte', [AdminController::class, 'servicioSocialReporte'])
        ->name('admin.servicio-social.reporte');
});

    // RUTAS DE REGISTRO DE HORAS PARA ALUMNOS
    Route::prefix('servicio-social')->group(function () {
        Route::get('/{servicioSocial}/registro-horas', [RegistroHorasController::class, 'index'])
            ->name('servicio-social.registro-horas');
        Route::get('/{servicioSocial}/registrar-horas', [RegistroHorasController::class, 'create'])
            ->name('servicio-social.registrar-horas');
        Route::post('/{servicioSocial}/registrar-horas', [RegistroHorasController::class, 'store'])
            ->name('servicio-social.registrar-horas.store');
        Route::get('/registro/{registro}', [RegistroHorasController::class, 'show'])
            ->name('servicio-social.registro.show');
        Route::get('/{servicioSocial}/reporte-mensual', [RegistroHorasController::class, 'reporteMensual'])
            ->name('servicio-social.reporte-mensual');
        Route::delete('/registro/{registro}', [RegistroHorasController::class, 'destroy'])
            ->name('servicio-social.registro.destroy');
    });

    // ✅ AGREGAR ESTA RUTA NUEVA - SOPORTE TÉCNICO
Route::prefix('admin')->group(function () {
    // ... tus otras rutas admin existentes ...
    
    // ✅ NUEVA RUTA PARA SOPORTE TÉCNICO
    Route::get('/soporte-tecnico', function () {
        return view('admin.soporte_tecnico');
    })->name('admin.soporte-tecnico');
});

}); // ← CIERRE DEL GRUPO AUTH