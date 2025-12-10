<?php

namespace App\Http\Controllers;

use App\Models\Postulacion;
use App\Models\ServicioSocial;
use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServicioSocialController extends Controller
{
    // MOSTRAR FORMULARIO DE SOLICITUD
    public function crear($postulacion_id)
    {
        $postulacion = Postulacion::with(['vacante', 'vacante.empresa'])
            ->where('id', $postulacion_id)
            ->where('user_id', Auth::id())
            ->where('estado', 'aceptado')
            ->firstOrFail();

        // Verificar que no tenga solicitud previa
        if ($postulacion->tieneSolicitudServicioSocial()) {
            return redirect()->route('alumno.mis-postulaciones')
                ->with('error', 'Ya tienes una solicitud de Servicio Social para esta postulación.');
        }

        return view('servicio_social.crear', compact('postulacion'));
    }

    // GUARDAR SOLICITUD DE SERVICIO SOCIAL
    public function store(Request $request, $postulacion_id)
    {
        $postulacion = Postulacion::with(['vacante', 'vacante.empresa'])
            ->where('id', $postulacion_id)
            ->where('user_id', Auth::id())
            ->where('estado', 'aceptado')
            ->firstOrFail();

        // Validar que no tenga solicitud previa
        if ($postulacion->tieneSolicitudServicioSocial()) {
            return redirect()->route('alumno.mis-postulaciones')
                ->with('error', 'Ya tienes una solicitud de Servicio Social para esta postulación.');
        }

        $request->validate([
            'carrera' => 'required|string|max:255',
            'semestre' => 'required|string|max:50',
            'numero_control' => 'required|string|max:50',
            'fecha_inicio' => 'required|date',
            'fecha_fin_estimada' => 'required|date|after:fecha_inicio',
            'supervisor_empresa' => 'nullable|string|max:255',
            'email_supervisor' => 'nullable|email|max:255',
            'telefono_supervisor' => 'nullable|string|max:20',
            'nombre_proyecto' => 'required|string|max:500',
            'actividades_principales' => 'required|string',
        ]);

        // SANITIZAR CAMPOS DE TEXTO PARA PREVENIR XSS
        $carrera = strip_tags($request->carrera);
        $semestre = strip_tags($request->semestre);
        $numero_control = strip_tags($request->numero_control);
        $supervisor_empresa = $request->supervisor_empresa ? strip_tags($request->supervisor_empresa) : null;
        $telefono_supervisor = $request->telefono_supervisor ? strip_tags($request->telefono_supervisor) : null;
        $nombre_proyecto = strip_tags($request->nombre_proyecto);
        $actividades_principales = strip_tags($request->actividades_principales);

        // Crear solicitud de servicio social CON DATOS SANITIZADOS
        $servicioSocial = ServicioSocial::create([
            'postulacion_id' => $postulacion->id,
            'alumno_id' => Auth::id(),
            'empresa_id' => $postulacion->vacante->empresa_id,
            'vacante_id' => $postulacion->vacante_id,
            'carrera' => $carrera,
            'semestre' => $semestre,
            'numero_control' => $numero_control,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin_estimada' => $request->fecha_fin_estimada,
            'supervisor_empresa' => $supervisor_empresa,
            'email_supervisor' => $request->email_supervisor,
            'telefono_supervisor' => $telefono_supervisor,
            'nombre_proyecto' => $nombre_proyecto,
            'actividades_principales' => $actividades_principales,
            'estado' => 'solicitado',
            'empresa_acepta' => false,
            'jefe_ss_aprueba' => false,
            'fecha_solicitud' => now(),
        ]);

        // ✅ NOTIFICAR AL JEFE DE SERVICIO SOCIAL PRIMERO
        // Usar variable de entorno para mayor flexibilidad
        $emailJefeSS = env('JEFE_SERVICIO_SOCIAL_EMAIL', 'servicio.social@itszn.edu.mx');
        $jefeSS = Usuario::where('email', $emailJefeSS)->first();
        if ($jefeSS) {
            $this->crearNotificacion(
                $jefeSS->id,
                'Nueva solicitud de Servicio Social',
                "El alumno " . htmlspecialchars($servicioSocial->alumno->name, ENT_QUOTES, 'UTF-8') . 
                " ha solicitado Servicio Social en " . htmlspecialchars($servicioSocial->empresa->nombre_empresa, ENT_QUOTES, 'UTF-8') . 
                ". Revisa la solicitud.",
                'info',
                route('admin.servicio-social.show', $servicioSocial->id)
            );
        }

        // ✅ NOTIFICAR A LA EMPRESA (solo informativo, no pueden hacer nada aún)
        $empresaUsers = Usuario::where('empresa_id', $postulacion->empresa_id)->get();
        foreach ($empresaUsers as $user) {
            $this->crearNotificacion(
                $user->id,
                'Nueva solicitud de Servicio Social',
                "El alumno " . htmlspecialchars($servicioSocial->alumno->name, ENT_QUOTES, 'UTF-8') . 
                " ha solicitado que su experiencia en " . htmlspecialchars($servicioSocial->vacante->titulo, ENT_QUOTES, 'UTF-8') . 
                " cuente como Servicio Social. Espera la aprobación del Departamento de Servicio Social.",
                'info',
                route('empresa.servicio-social.show', $servicioSocial->id)
            );
        }

        return redirect()->route('alumno.mis-postulaciones')
            ->with('success', '✅ Solicitud de Servicio Social enviada. Espera la aprobación del Departamento de Servicio Social.');
    }

    // MOSTRAR DETALLES DE SOLICITUD PARA ALUMNO
    public function show($id)
    {
        $servicioSocial = ServicioSocial::with([
            'postulacion', 
            'empresa', 
            'vacante', 
            'jefeServicioSocial',
            'registrosHoras'
        ])
        ->where('alumno_id', Auth::id())
        ->findOrFail($id);

        return view('servicio_social.show', compact('servicioSocial'));
    }

    // MÉTODO PARA CREAR NOTIFICACIONES (SEGURO CONTRA XSS)
    private function crearNotificacion($userId, $titulo, $mensaje, $tipo = 'info', $url = null)
    {
        // Sanitizar títulos y mensajes
        $tituloSanitizado = htmlspecialchars(strip_tags($titulo), ENT_QUOTES, 'UTF-8');
        $mensajeSanitizado = htmlspecialchars(strip_tags($mensaje), ENT_QUOTES, 'UTF-8');
        
        Notificacion::create([
            'user_id' => $userId,
            'titulo' => $tituloSanitizado,
            'mensaje' => $mensajeSanitizado,
            'tipo' => $tipo,
            'leida' => false,
            'url' => $url,
            'created_at' => now(),
        ]);
    }

    // ✅ NUEVO MÉTODO: CANCELAR SOLICITUD (si está pendiente)
    public function cancelar($id)
    {
        $servicioSocial = ServicioSocial::where('alumno_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Solo se puede cancelar si está en estado "solicitado"
        if ($servicioSocial->estado !== 'solicitado') {
            return redirect()->back()
                ->with('error', 'No puedes cancelar esta solicitud porque ya ha sido procesada.');
        }

        // ✅ NOTIFICAR AL JEFE SS
        $emailJefeSS = env('JEFE_SERVICIO_SOCIAL_EMAIL', 'servicio.social@itszn.edu.mx');
        $jefeSS = Usuario::where('email', $emailJefeSS)->first();
        if ($jefeSS) {
            $this->crearNotificacion(
                $jefeSS->id,
                'Solicitud de Servicio Social Cancelada',
                "El alumno " . htmlspecialchars($servicioSocial->alumno->name, ENT_QUOTES, 'UTF-8') . 
                " ha cancelado su solicitud de Servicio Social en " . 
                htmlspecialchars($servicioSocial->empresa->nombre_empresa, ENT_QUOTES, 'UTF-8') . ".",
                'warning',
                route('admin.servicio-social.index')
            );
        }

        // ✅ NOTIFICAR A LA EMPRESA
        $empresaUsers = Usuario::where('empresa_id', $servicioSocial->empresa_id)->get();
        foreach ($empresaUsers as $user) {
            $this->crearNotificacion(
                $user->id,
                'Solicitud de Servicio Social Cancelada',
                "El alumno " . htmlspecialchars($servicioSocial->alumno->name, ENT_QUOTES, 'UTF-8') . 
                " ha cancelado su solicitud de Servicio Social.",
                'warning',
                route('empresa.servicio-social.index')
            );
        }

        // Eliminar la solicitud
        $servicioSocial->delete();

        return redirect()->route('alumno.mis-postulaciones')
            ->with('success', '✅ Solicitud de Servicio Social cancelada correctamente.');
    }

    // ✅ NUEVO MÉTODO: VER PROGRESO DE HORAS
    public function progreso($id)
    {
        $servicioSocial = ServicioSocial::with(['registrosHoras'])
            ->where('alumno_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Solo se puede ver progreso si está aprobado
        if (!in_array($servicioSocial->estado, ['empresa_acepto', 'en_proceso', 'completado'])) {
            return redirect()->back()
                ->with('error', 'Aún no puedes registrar horas. Espera la aprobación completa.');
        }

        $horasCompletadas = $servicioSocial->horas_completadas;
        $horasRequeridas = $servicioSocial->horas_requeridas;
        $porcentaje = $horasRequeridas > 0 ? round(($horasCompletadas / $horasRequeridas) * 100, 2) : 0;

        return view('servicio_social.progreso', compact('servicioSocial', 'horasCompletadas', 'horasRequeridas', 'porcentaje'));
    }

    // ✅ NUEVO MÉTODO: REGISTRAR HORAS (para el futuro)
    public function registrarHoras(Request $request, $id)
    {
        $servicioSocial = ServicioSocial::where('alumno_id', Auth::id())
            ->where('id', $id)
            ->firstOrFail();

        // Validar que esté en estado apropiado para registrar horas
        if (!in_array($servicioSocial->estado, ['empresa_acepto', 'en_proceso'])) {
            return redirect()->back()
                ->with('error', 'No puedes registrar horas en este momento.');
        }

        $request->validate([
            'fecha' => 'required|date',
            'horas_trabajadas' => 'required|integer|min:1|max:12',
            'actividades_realizadas' => 'required|string|max:1000',
            'evidencias' => 'nullable|string',
        ]);

        // SANITIZAR CAMPOS DE TEXTO
        $actividades_realizadas = strip_tags($request->actividades_realizadas);
        $evidencias = $request->evidencias ? strip_tags($request->evidencias) : null;

        // Crear registro de horas CON DATOS SANITIZADOS
        $registroHoras = new \App\Models\RegistroHorasSS([
            'servicio_social_id' => $servicioSocial->id,
            'fecha' => $request->fecha,
            'horas_trabajadas' => $request->horas_trabajadas,
            'actividades_realizadas' => $actividades_realizadas,
            'evidencias' => $evidencias,
            'aprobado_empresa' => false,
            'aprobado_jefe' => false,
        ]);

        $registroHoras->save();

        // Actualizar horas completadas
        $servicioSocial->increment('horas_completadas', $request->horas_trabajadas);
        $servicioSocial->decrement('horas_pendientes', $request->horas_trabajadas);

        // Verificar si completó las horas requeridas
        if ($servicioSocial->horas_completadas >= $servicioSocial->horas_requeridas) {
            $servicioSocial->update([
                'estado' => 'completado',
                'fecha_finalizacion' => now(),
            ]);

            // Notificar completación
            $this->crearNotificacion(
                $servicioSocial->alumno_id,
                '¡Servicio Social Completado! 🎓',
                "Felicidades, has completado tus {$servicioSocial->horas_requeridas} horas de Servicio Social.",
                'success',
                route('servicio-social.show', $servicioSocial->id)
            );
        }

        return redirect()->route('servicio-social.progreso', $servicioSocial->id)
            ->with('success', '✅ Horas registradas correctamente.');
    }
}