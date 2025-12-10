<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Usuario;
use App\Models\Vacante;
use App\Models\ServicioSocial;
use App\Models\Notificacion;
use App\Models\RegistroHorasSS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Constructor para aplicar middleware de autenticación y verificación de admin
     */
    public function __construct()
    {
        // TEMPORAL: Quitar el middleware hasta resolver el problema
        // $this->middleware('auth');
        // $this->middleware(function ($request, $next) {
        //     if (Auth::user()->tipo !== 'admin') {
        //         return redirect('/dashboard')->with('error', 'Acceso no autorizado. Solo para administradores.');
        //     }
        //     return $next($request);
        // });
    }

    // =============================================
    // 🏢 MÉTODOS NUEVOS PARA GESTIÓN DE EMPRESAS
    // =============================================

    /**
     * Dashboard del admin
     */
    public function dashboard()
{
    $data = [
        'totalUsuarios' => Usuario::count(),
        'alumnos' => Usuario::where('tipo', 'alumno')->count(),
        'egresados' => Usuario::where('tipo', 'egresado')->count(),
        'empresasCount' => Usuario::where('tipo', 'empresa')->count(),
        'admins' => Usuario::where('tipo', 'admin')->count(),
        'empresas' => Empresa::count(),
        'vacantes' => Vacante::count(),
        'servicioSocial' => ServicioSocial::count(),
        'empresasPendientesCount' => Empresa::where('estado', 'pendiente')->count(),
        'vacantesPendientesCount' => Vacante::where('estado', 'pendiente')->count(),
        // Opcional: estadísticas adicionales
        'usuariosActivos' => Usuario::where('activo', 1)->count(),
        'usuariosInactivos' => Usuario::where('activo', 0)->count(),
    ];
    
    return view('dashboard.admin', $data);
}

    /**
     * Mostrar todas las empresas
     */
    public function todasLasEmpresas()
    {
        $empresas = Empresa::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Mostrar formulario para crear empresa
     */
    public function crearEmpresa()
    {
        return view('admin.empresas.create');
    }

    public function guardarEmpresa(Request $request)
{
    $request->validate([
        // Campos de la empresa (según tu modelo REAL)
        'nombre_empresa' => 'required|string|max:255',
        'rfc' => 'nullable|string|max:13|unique:empresas,rfc', 
        'direccion' => 'nullable|string',
        'telefono_contacto' => 'required|string|max:20',
        'correo_contacto' => 'required|email|unique:empresas,correo_contacto|unique:users,email',
        'tipo_negocio' => 'nullable|string|max:255',
        'tamano_empresa' => 'nullable|string|max:255', 
        'representante_legal' => 'nullable|string|max:255',
        'puesto_representante' => 'nullable|string|max:255',
        'pagina_web' => 'nullable|url|max:255',
        'descripcion_empresa' => 'nullable|string',
        
        // Campos del usuario administrador
        'admin_nombre' => 'required|string|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);
    
    // Crear usuario administrador (con el mismo email que la empresa)
    $user = Usuario::create([
        'name' => $request->admin_nombre,
        'email' => $request->correo_contacto, // Mismo email que la empresa
        'password' => Hash::make($request->password),
        'role' => 'empresa',
    ]);
    
    // Crear empresa con TODOS los campos correctos
    $empresa = Empresa::create([
        // Información básica
        'nombre_empresa' => $request->nombre_empresa,
        'rfc' => $request->rfc ?: null, // ← Manejar valor null
        'direccion' => $request->direccion,
        'telefono_contacto' => $request->telefono_contacto,
        'correo_contacto' => $request->correo_contacto,
        
        // Información adicional (con valores por defecto si están vacíos)
        'tipo_negocio' => $request->tipo_negocio ?: null,
        'tamano_empresa' => $request->tamano_empresa ?: '', // ← Valor por defecto vacío
        'representante_legal' => $request->representante_legal ?: null,
        'puesto_representante' => $request->puesto_representante ?: null,
        'pagina_web' => $request->pagina_web ?: null,
        'descripcion_empresa' => $request->descripcion_empresa ?: null,
        
        // Relaciones y estado
        'user_id' => $user->id,
        'estado' => 'aprobada', // Aprobada automáticamente por admin
        'revisado_por' => auth()->id(),
        'fecha_revision' => now(),
        'motivo_rechazo' => null,
        
        // Campos de archivos (se dejan null por ahora)
        'logo_path' => null,
        'constancia_fiscal_path' => null,
    ]);
    
    // Asignar empresa al usuario
    $user->empresa_id = $empresa->id;
    $user->save();
    
    // Crear notificación
    Notificacion::create([
        'user_id' => $user->id,
        'titulo' => 'Empresa registrada por administrador',
        'mensaje' => "Tu empresa {$empresa->nombre_empresa} ha sido registrada y aprobada por el administrador. Ya puedes acceder al sistema con tu email: {$empresa->correo_contacto}",
        'tipo' => 'success',
        'leida' => false,
    ]);
    
    return redirect()->route('admin.empresas.todas')
        ->with('success', '✅ Empresa registrada y aprobada exitosamente.');
}
    /**
     * Mostrar detalles de una empresa
     */
    public function mostrarEmpresa(Empresa $empresa)
    {
        $empresa->load(['user', 'vacantes', 'vacantes.postulaciones','serviciosSociales',  // ✅ AGREGAR ESTA LÍNEA
        'serviciosSociales.alumno']);
        return view('admin.empresas.show', compact('empresa'));
    }

    /**
     * Mostrar formulario para editar empresa
     */
    public function editarEmpresa(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
 * Actualizar empresa
 */
public function actualizarEmpresa(Request $request, Empresa $empresa)
{
    $request->validate([
        // Campos del administrador
        'admin_nombre' => 'required|string|max:255',
        
        // Campos de la empresa (obligatorios)
        'nombre_empresa' => 'required|string|max:255',
        'tipo_negocio' => 'required|string',
        'telefono_contacto' => 'required|string|max:20',
        'representante_legal' => 'required|string|max:255',
        
        // Campos de la empresa (opcionales) - RFC AHORA ES NULLABLE
        'rfc' => 'nullable|string|max:13',
        'tamano_empresa' => 'nullable|string',
        'puesto_representante' => 'nullable|string|max:255',
        'direccion' => 'nullable|string',
        'pagina_web' => 'nullable|url',
        'descripcion_empresa' => 'nullable|string',
        
        // Campos de seguridad
        'password' => 'nullable|string|min:8|confirmed',
        
        // Estado
        'estado' => 'required|in:pendiente,aprobada,rechazada',
        'motivo_rechazo' => 'nullable|string',
    ]);

    // 1. Actualizar usuario administrador
    if ($empresa->user) {
        $empresa->user->update([
            'name' => $request->admin_nombre,
        ]);

        // Actualizar contraseña si se proporciona
        if ($request->filled('password')) {
            $empresa->user->update([
                'password' => Hash::make($request->password)
            ]);
        }
    }

    // 2. Actualizar empresa
    $empresa->update([
        'nombre_empresa' => $request->nombre_empresa,
        'tipo_negocio' => $request->tipo_negocio,
        'telefono_contacto' => $request->telefono_contacto,
        'representante_legal' => $request->representante_legal,
        
        // Campos opcionales - incluir incluso si están vacíos
        'rfc' => $request->rfc ?: null,
        'tamano_empresa' => $request->tamano_empresa,
        'puesto_representante' => $request->puesto_representante,
        'direccion' => $request->direccion,
        'pagina_web' => $request->pagina_web,
        'descripcion_empresa' => $request->descripcion_empresa,
        
        // Campos de estado
        'estado' => $request->estado,
        'motivo_rechazo' => $request->estado === 'rechazada' ? $request->motivo_rechazo : null,
        'revisado_por' => auth()->id(),
        'fecha_revision' => now(),
    ]);

    return redirect()->route('admin.empresas.todas')
        ->with('success', 'Empresa actualizada exitosamente.');
}
    /**
     * Eliminar empresa
     */
    public function eliminarEmpresa(Empresa $empresa)
    {
        // Eliminar usuario asociado si existe
        if ($empresa->user) {
            $empresa->user->delete();
        }
        
        $empresa->delete();
        
        return redirect()->route('admin.empresas.todas')
            ->with('success', 'Empresa eliminada exitosamente.');
    }

    // =============================================
    // 💼 MÉTODOS NUEVOS PARA GESTIÓN DE VACANTES
    // =============================================

    /**
     * Mostrar todas las vacantes
     */
    public function todasLasVacantes()
    {
        $vacantes = Vacante::with('empresa')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.vacantes.index', compact('vacantes'));
    }

    /**
     * Mostrar formulario para crear vacante
     */
    public function crearVacante()
    {
        $empresas = Empresa::where('estado', 'aprobada')
            ->orderBy('nombre_empresa')
            ->get();
        
        return view('admin.vacantes.create', compact('empresas'));
    }

    /**
     * Guardar nueva vacante
     */
   public function guardarVacante(Request $request)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'requisitos' => 'required|string',
        'salario' => 'nullable|string|max:100',
        'tipo_contrato' => 'required|in:tiempo_completo,medio_tiempo,practicas,servicio_social', // ← VALORES DEL ENUM
        'modalidad' => 'required|in:presencial,remoto,hibrido',
        'ubicacion' => 'required|string|max:255',
        'fecha_limite' => 'required|date',
        'numero_vacantes' => 'required|integer|min:1',
        'empresa_id' => 'required|exists:empresas,id',
    ]);
    
    // Crear vacante (aprobada automáticamente)
    $vacante = Vacante::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'requisitos' => $request->requisitos,
        'salario' => $request->salario,
        'tipo_contrato' => $request->tipo_contrato, // Ya viene en formato correcto
        'modalidad' => $request->modalidad,
        'ubicacion' => $request->ubicacion,
        'fecha_limite' => $request->fecha_limite,
        'numero_vacantes' => $request->numero_vacantes,
        'empresa_id' => $request->empresa_id,
        'estado' => 'aprobada',
        'aprobada_por' => auth()->id(),
        'fecha_aprobacion' => now(),
        'motivo_rechazo' => null,
        'publicada_por_admin' => true,
    ]);
        
        // Notificar a la empresa
        $empresa = Empresa::find($request->empresa_id);
        if ($empresa && $empresa->user) {
            Notificacion::create([
                'user_id' => $empresa->user->id,
                'titulo' => 'Nueva vacante publicada',
                'mensaje' => "El administrador ha publicado una vacante para tu empresa: {$vacante->titulo}",
                'tipo' => 'info',
                'leida' => false,
            ]);
        }
        
        return redirect()->route('admin.vacantes.todas')
            ->with('success', 'Vacante publicada exitosamente.');
    }

    /**
     * Mostrar detalles de una vacante
     */
    public function mostrarVacante(Vacante $vacante)
{
    
    $vacante->load(['empresa', 'empresa.user', 'postulaciones', 'postulaciones.user']);
    return view('admin.vacantes.mostrar', compact('vacante'));
}

    /**
 * Mostrar formulario para editar vacante
 */
public function editarVacante(Vacante $vacante)
{
    $empresas = Empresa::where('estado', 'aprobada')
        ->orderBy('nombre_empresa')
        ->get();
    
    return view('admin.vacantes.edit', compact('vacante', 'empresas'));
}

/**
 * Actualizar vacante
 */
public function actualizarVacante(Request $request, Vacante $vacante)
{
    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'requisitos' => 'required|string',
        'salario' => 'nullable|string|max:100',
        'tipo_contrato' => 'required|in:tiempo_completo,medio_tiempo,practicas,servicio_social',
        'modalidad' => 'required|in:presencial,remoto,hibrido',
        'ubicacion' => 'required|string|max:255',
        'fecha_limite' => 'required|date',
        'numero_vacantes' => 'required|integer|min:1',
        'empresa_id' => 'required|exists:empresas,id',
        'beneficios' => 'nullable|string',
    ]);
    
    // Actualizar vacante
    $vacante->update([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'requisitos' => $request->requisitos,
        'salario' => $request->salario,
        'tipo_contrato' => $request->tipo_contrato,
        'modalidad' => $request->modalidad,
        'ubicacion' => $request->ubicacion,
        'fecha_limite' => $request->fecha_limite,
        'numero_vacantes' => $request->numero_vacantes,
        'empresa_id' => $request->empresa_id,
        'beneficios' => $request->beneficios,
        'es_urgente' => $request->boolean('es_urgente'),
        'estado' => $request->boolean('esta_aprobada') ? 'aprobada' : 'pendiente',
    ]);
    
    // Notificar a la empresa si hubo cambios
    $empresa = Empresa::find($request->empresa_id);
    if ($empresa && $empresa->user) {
        Notificacion::create([
            'user_id' => $empresa->user->id,
            'titulo' => 'Vacante actualizada',
            'mensaje' => "El administrador ha actualizado la vacante: {$vacante->titulo}",
            'tipo' => 'info',
            'leida' => false,
        ]);
    }
    
    return redirect()->route('admin.vacantes.mostrar', $vacante)
        ->with('success', 'Vacante actualizada exitosamente.');
}
    // =============================================
    // 📋 MÉTODOS EXISTENTES (MANTENER)
    // =============================================

    /**
     * Mostrar empresas pendientes de aprobación
     */
    public function empresasPendientes()
    {
        $empresasPendientes = Empresa::with('user')
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.empresas-pendientes', compact('empresasPendientes'));
    }

    /**
     * Aprobar una empresa
     */
    public function aprobarEmpresa(Empresa $empresa)
    {
        $empresa->update([
            'estado' => 'aprobada',
            'revisado_por' => Auth::id(),
            'fecha_revision' => now(),
            'motivo_rechazo' => null,
        ]);

        // ✅ NUEVO: Marcar notificaciones como procesadas
        \App\Http\Controllers\AdminNotificacionController::marcarEmpresaProcesada($empresa->id);

        Notificacion::nuevaEmpresaAprobada($empresa);

        return back()->with('success', "✅ Empresa '{$empresa->nombre_empresa}' aprobada correctamente.");
    }

    /**
     * Rechazar una empresa
     */
    public function rechazarEmpresa(Request $request, Empresa $empresa)
    {
        $request->validate([
            'motivo_rechazo' => 'required|string|min:10|max:500'
        ]);

        $empresa->update([
            'estado' => 'rechazada',
            'revisado_por' => Auth::id(),
            'fecha_revision' => now(),
            'motivo_rechazo' => $request->motivo_rechazo,
        ]);

        Notificacion::nuevaEmpresaRechazada($empresa, $request->motivo_rechazo);

        return back()->with('success', "❌ Empresa '{$empresa->nombre_empresa}' rechazada.");
    }

    /**
     * Gestión de usuarios
     */
    public function gestionarUsuarios()
    {
        $usuarios = Usuario::with('empresa')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.gestionar-usuarios', compact('usuarios'));
    }

    /**
     * Mostrar vacantes pendientes de aprobación
     */
    public function vacantesPendientes()
    {
        $vacantesPendientes = Vacante::with('empresa')
            ->where('estado', 'pendiente')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.vacantes-pendientes', compact('vacantesPendientes'));
    }

    /**
     * Aprobar una vacante
     */
    public function aprobarVacante(Vacante $vacante)
    {
        $vacante->update([
            'estado' => 'aprobada',
            'motivo_rechazo' => null,
        ]);

        // ✅ NUEVO: Marcar notificaciones como procesadas
        \App\Http\Controllers\AdminNotificacionController::marcarVacanteProcesada($vacante->id);

        Notificacion::nuevaVacanteAprobada($vacante);

        return redirect()->route('admin.vacantes.pendientes')
            ->with('success', "✅ Vacante '{$vacante->titulo}' aprobada correctamente.");
    }

    /**
     * Rechazar una vacante
     */
    public function rechazarVacante(Request $request, Vacante $vacante)
    {
        $request->validate([
            'motivo_rechazo' => 'required|string|min:10|max:500'
        ]);

        $vacante->update([
            'estado' => 'rechazada',
            'motivo_rechazo' => $request->motivo_rechazo,
        ]);

        Notificacion::nuevaVacanteRechazada($vacante, $request->motivo_rechazo);

        return redirect()->route('admin.vacantes.pendientes')
            ->with('success', "❌ Vacante '{$vacante->titulo}' rechazada correctamente.");
    }

    // =============================================
    // 🔐 MÉTODOS EXCLUSIVOS PARA SERVICIO SOCIAL
    // =============================================

    /**
     * ✅ MOSTRAR FORMULARIO DE "SUB-LOGIN" PARA SERVICIO SOCIAL
     */
    public function servicioSocialLogin()
    {
        // Si ya es el admin correcto, redirigir directamente
        if (Auth::user()->email === 'servicio.social@itszn.edu.mx') {
            return redirect()->route('admin.servicio-social.index');
        }

        return view('admin.servicio_social.login');
    }

    /**
     * ✅ VERIFICAR CREDENCIALES DE SERVICIO SOCIAL
     */
    public function servicioSocialVerify(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Verificar que sea el email correcto
        if ($request->email !== 'servicio.social@itszn.edu.mx') {
            return redirect()->route('admin.servicio-social.login')
                ->with('error', '❌ Solo el coordinador de Servicio Social puede acceder.');
        }

        // Obtener el usuario real de la base de datos para verificar la contraseña
        $servicioSocialUser = Usuario::where('email', 'servicio.social@itszn.edu.mx')->first();
        
        if (!$servicioSocialUser || !Hash::check($request->password, $servicioSocialUser->password)) {
            return redirect()->route('admin.servicio-social.login')
                ->with('error', '❌ Contraseña incorrecta.');
        }

        // Si las credenciales son correctas, redirigir al panel
        return redirect()->route('admin.servicio-social.index')
            ->with('success', '🔐 Bienvenido al Panel de Servicio Social');
    }

    /**
     * ✅ MÉTODO DE VERIFICACIÓN COMÚN PARA SERVICIO SOCIAL
     */
    private function verificarAccesoServicioSocial()
    {
        if (Auth::user()->email !== 'servicio.social@itszn.edu.mx') {
            abort(403, '❌ Acceso restringido. Solo el Coordinador de Servicio Social puede acceder a esta sección.');
        }
    }

    /**
     * ✅ LISTAR SOLICITUDES DE SERVICIO SOCIAL (CON PAGINACIÓN)
     */
    public function servicioSocialIndex(Request $request)
    {
        $this->verificarAccesoServicioSocial(); // ✅ Agregar verificación de acceso
        
        $query = ServicioSocial::with(['alumno', 'empresa', 'vacante']);
        
        // Aplicar filtro si existe
        if ($request->has('estado') && $request->estado) {
            $query->where('estado', $request->estado);
        }
        
        // ✅ CORREGIDO: Usar paginate() en lugar de get()
        $solicitudes = $query->orderBy('created_at', 'desc')->paginate(15);

        $estadisticas = [
            'total' => ServicioSocial::count(),
            'pendientes' => ServicioSocial::where('estado', 'solicitado')->count(),
            'aprobados' => ServicioSocial::where('estado', 'jefe_aprobo')->count(),
            'en_proceso' => ServicioSocial::where('estado', 'en_proceso')->count(),
            'completados' => ServicioSocial::where('estado', 'completado')->count(),
            'rechazados' => ServicioSocial::where('estado', 'rechazado')->count(),
        ];

        return view('admin.servicio_social.index', compact('solicitudes', 'estadisticas'));
    }

    /**
     * ✅ MOSTRAR DETALLES DE SOLICITUD (ACTUALIZADO)
     */
    public function servicioSocialShow(ServicioSocial $servicioSocial)
    {
        $this->verificarAccesoServicioSocial();

        $servicioSocial->load(['alumno', 'empresa', 'vacante', 'postulacion', 'jefeServicioSocial', 'registrosHoras']);

        // ✅ AGREGAR: Calcular estadísticas para la vista
        $horasAprobadas = $servicioSocial->registrosHoras
            ->where('aprobado_empresa', true)
            ->sum('horas_trabajadas');

        $horasPendientes = $servicioSocial->registrosHoras
            ->where('aprobado_empresa', null)
            ->sum('horas_trabajadas');

        $horasRechazadas = $servicioSocial->registrosHoras
            ->where('aprobado_empresa', false)
            ->sum('horas_trabajadas');

        $progreso = $servicioSocial->horas_requeridas > 0 
            ? round(($servicioSocial->horas_totales / $servicioSocial->horas_requeridas) * 100, 1)
            : 0;

        return view('admin.servicio_social.show', compact(
            'servicioSocial', 
            'horasAprobadas',
            'horasPendientes', 
            'horasRechazadas',
            'progreso'
        ));
    }

    /**
     * ✅ APROBAR SERVICIO SOCIAL
     */
    public function servicioSocialAprobar(Request $request, ServicioSocial $servicioSocial)
    {
        $this->verificarAccesoServicioSocial();

        // Validar que esté en estado solicitado
        if ($servicioSocial->estado !== 'solicitado') {
            return redirect()->back()
                ->with('error', 'Esta solicitud ya ha sido procesada.');
        }

        $request->validate([
            'observaciones_jefe' => 'nullable|string|max:1000',
        ]);

        // Actualizar estado - JEFE APRUEBA PRIMERO
        $servicioSocial->update([
            'estado' => 'jefe_aprobo',
            'jefe_ss_aprueba' => true,
            'jefe_ss_id' => Auth::id(),
            'observaciones_jefe' => $request->observaciones_jefe,
            'fecha_jefe_aprobo' => now(),
        ]);

        // ✅ NOTIFICAR A LA EMPRESA PARA QUE ACEPTE
        $empresaUsers = Usuario::whereHas('empresa', function($query) use ($servicioSocial) {
            $query->where('id', $servicioSocial->empresa_id);
        })->get();
        
        foreach ($empresaUsers as $user) {
            $this->crearNotificacion(
                $user->id,
                'Solicitud de Servicio Social Aprobada - Pendiente de Aceptación',
                "El Servicio Social de {$servicioSocial->alumno->name} ha sido aprobado por el ITSZN. Ahora necesita tu aceptación final.",
                'info',
                route('empresa.servicio-social.show', $servicioSocial->id)
            );
        }

        // ✅ NOTIFICAR AL ALUMNO
        $this->crearNotificacion(
            $servicioSocial->alumno_id,
            'Servicio Social Aprobado por el ITSZN',
            "Tu Servicio Social ha sido aprobado por el Departamento de Servicio Social. Espera la aceptación final de la empresa.",
            'success',
            route('servicio-social.show', $servicioSocial->id)
        );

        return redirect()->route('admin.servicio-social.index')
            ->with('success', '✅ Servicio Social aprobado. Se notificó a la empresa para su aceptación final.');
    }

    /**
     * ✅ RECHAZAR SERVICIO SOCIAL
     */
    public function servicioSocialRechazar(Request $request, ServicioSocial $servicioSocial)
    {
        $this->verificarAccesoServicioSocial();

        // Validar que esté en estado correcto
        if ($servicioSocial->estado !== 'solicitado') {
            return redirect()->back()
                ->with('error', 'Esta solicitud ya ha sido procesada.');
        }

        $request->validate([
            'observaciones_jefe' => 'required|string|max:1000',
        ]);

        // Actualizar estado - RECHAZADO POR JEFE SS
        $servicioSocial->update([
            'estado' => 'rechazado',
            'jefe_ss_aprueba' => false,
            'jefe_ss_id' => Auth::id(),
            'observaciones_jefe' => $request->observaciones_jefe,
        ]);

        // ✅ NOTIFICAR AL ALUMNO
        $this->crearNotificacion(
            $servicioSocial->alumno_id,
            'Servicio Social Rechazado',
            "Tu solicitud de Servicio Social ha sido rechazada por el Departamento de Servicio Social. Motivo: {$request->observaciones_jefe}",
            'error',
            route('servicio-social.show', $servicioSocial->id)
        );

        // ✅ NOTIFICAR A LA EMPRESA
        $empresaUsers = Usuario::whereHas('empresa', function($query) use ($servicioSocial) {
            $query->where('id', $servicioSocial->empresa_id);
        })->get();
        
        foreach ($empresaUsers as $user) {
            $this->crearNotificacion(
                $user->id,
                'Servicio Social Rechazado',
                "La solicitud de Servicio Social de {$servicioSocial->alumno->name} ha sido rechazada por el ITSZN.",
                'warning',
                route('empresa.servicio-social.index')
            );
        }

        return redirect()->route('admin.servicio-social.index')
            ->with('success', '✅ Servicio Social rechazado. Se notificó al alumno y a la empresa.');
    }

    /**
     * ✅ VER REGISTRO DE HORAS
     */
    public function servicioSocialRegistros($servicioSocialId)
    {
        $this->verificarAccesoServicioSocial();

        $servicioSocial = ServicioSocial::with(['registrosHoras', 'alumno', 'empresa'])
            ->findOrFail($servicioSocialId);

        // ✅ CALCULAR BIEN LAS HORAS
        $horasAprobadas = $servicioSocial->registrosHoras
            ->where('aprobado_empresa', true)
            ->sum('horas_trabajadas');

        $horasPendientes = $servicioSocial->registrosHoras
            ->where('aprobado_empresa', null)  // null = PENDIENTE
            ->sum('horas_trabajadas');

        $horasRechazadas = $servicioSocial->registrosHoras
            ->where('aprobado_empresa', false) // false = RECHAZADO
            ->sum('horas_trabajadas');

        // Usar las horas actualizadas del servicio social
        $horasTotales = $servicioSocial->horas_totales;

        $progreso = $servicioSocial->horas_requeridas > 0 
            ? round(($horasTotales / $servicioSocial->horas_requeridas) * 100, 1)
            : 0;

        // Estadísticas corregidas
        $estadisticas = [
            'total_horas' => $horasTotales,
            'horas_aprobadas' => $horasAprobadas,
            'horas_pendientes' => $horasPendientes,
            'horas_rechazadas' => $horasRechazadas,
            'total_registros' => $servicioSocial->registrosHoras->count(),
            'registros_aprobados' => $servicioSocial->registrosHoras->where('aprobado_empresa', true)->count(),
            'progreso' => $progreso,
        ];

        return view('admin.servicio_social.registros', compact('servicioSocial', 'estadisticas'));
    }

    /**
     * 📊 ESTADÍSTICAS GENERALES
     */
    public function servicioSocialEstadisticas()
    {
        $this->verificarAccesoServicioSocial();

        $servicios = ServicioSocial::with(['alumno', 'empresa', 'registrosHoras'])->get();
        
        // Estadísticas básicas
        $estadisticas = [
            'total_servicios' => $servicios->count(),
            'en_proceso' => $servicios->where('estado', 'en_proceso')->count(),
            'completados' => $servicios->where('estado', 'completado')->count(),
            'total_horas' => $servicios->sum('horas_totales'),
        ];

        // Datos para gráficos
        $estadosData = [
            'Solicitado' => $servicios->where('estado', 'solicitado')->count(),
            'En Proceso' => $servicios->where('estado', 'en_proceso')->count(),
            'Completado' => $servicios->where('estado', 'completado')->count(),
            'Rechazado' => $servicios->where('estado', 'rechazado')->count(),
        ];

        // Horas por mes (últimos 6 meses)
        $horasPorMes = [];
        for ($i = 5; $i >= 0; $i--) {
            $mes = now()->subMonths($i)->format('Y-m');
            $horasPorMes[now()->subMonths($i)->format('M Y')] = RegistroHorasSS::whereYear('fecha', now()->subMonths($i)->year)
                ->whereMonth('fecha', now()->subMonths($i)->month)
                ->sum('horas_trabajadas');
        }

        // Servicios con progreso bajo
        $serviciosBajoProgreso = $servicios->filter(function($servicio) {
            return $servicio->progreso_horas < 50 && $servicio->estado == 'en_proceso';
        });

        return view('admin.servicio_social.estadisticas', compact(
            'estadisticas', 
            'estadosData', 
            'horasPorMes',
            'serviciosBajoProgreso'
        ));
    }

    /**
     * 📈 REPORTE GENERAL DE SERVICIO SOCIAL
     */
    public function servicioSocialReporte($servicioSocialId)
    {
        $servicioSocial = ServicioSocial::with(['registrosHoras', 'alumno', 'empresa'])
            ->findOrFail($servicioSocialId);

        // Agrupar horas por mes
        $horasPorMes = $servicioSocial->registrosHoras
            ->groupBy(function($registro) {
                return $registro->fecha->format('Y-m');
            })
            ->map(function($registros) {
                return [
                    'horas_totales' => $registros->sum('horas_trabajadas'),
                    'horas_aprobadas' => $registros->where('aprobado_empresa', true)->sum('horas_trabajadas'),
                    'total_registros' => $registros->count(),
                ];
            });

        return view('admin.servicio_social.reporte', compact('servicioSocial', 'horasPorMes'));
    }

    /**
     * ✅ MÉTODO PARA CREAR NOTIFICACIONES
     */
    private function crearNotificacion($userId, $titulo, $mensaje, $tipo = 'info', $url = null)
    {
        Notificacion::create([
            'user_id' => $userId,
            'titulo' => $titulo,
            'mensaje' => $mensaje,
            'tipo' => $tipo,
            'leida' => false,
            'url' => $url,
            'created_at' => now(),
        ]);
    }
}