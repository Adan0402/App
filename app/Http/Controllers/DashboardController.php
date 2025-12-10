<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Empresa;
use App\Models\Vacante;
use App\Models\Postulacion;
use App\Models\ServicioSocial;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Variables comunes para todos
        $totalUsuarios = Usuario::count();
        $alumnos = Usuario::where('tipo', 'alumno')->count();
        $empresas = Usuario::where('tipo', 'empresa')->count();
        
        // Variables específicas (inicializadas como null)
        $empresasPendientesCount = null;
        $vacantesPendientesCount = null;
        $totalVacantes = null;
        $misPostulaciones = null;
        $postulacionesPendientes = null;
        $vacantesRecientes = null;
        $empresa = null;
        $totalVacantesEmpresa = null;
        $vacantesActivas = null;
        $totalPostulaciones = null;
        $postulacionesPendientesEmpresa = null;
        $solicitudesServicioSocialPendientes = null;
        
        // Datos para ADMIN
        if ($user->tipo == 'admin') {
            $empresasPendientesCount = Empresa::where('estado', 'pendiente')->count();
            $vacantesPendientesCount = Vacante::where('estado', 'pendiente')->count();
        }
        
        // Datos para ALUMNO
        elseif ($user->tipo == 'alumno') {
            $totalVacantes = Vacante::where('estado', 'aprobada')
                ->where('activa', true)
                ->where('fecha_limite', '>=', now())
                ->count();
            
            $misPostulaciones = Postulacion::where('user_id', $user->id)->count();
            $postulacionesPendientes = Postulacion::where('user_id', $user->id)
                ->where('estado', 'pendiente')
                ->count();
            
            $vacantesRecientes = Vacante::with('empresa')
                ->where('estado', 'aprobada')
                ->where('activa', true)
                ->where('fecha_limite', '>=', now())
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->get();
        }
        
        // Datos para EMPRESA
        elseif ($user->tipo == 'empresa') {
            $empresa = $user->empresa;
            
            if ($empresa) {
                $totalVacantesEmpresa = $empresa->vacantes()->count();
                $vacantesActivas = $empresa->vacantes()
                    ->where('estado', 'aprobada')
                    ->where('activa', true)
                    ->where('fecha_limite', '>=', now())
                    ->count();
                    
                $totalPostulaciones = Postulacion::whereIn('vacante_id', $empresa->vacantes()->pluck('id'))->count();
                $postulacionesPendientesEmpresa = Postulacion::whereIn('vacante_id', $empresa->vacantes()->pluck('id'))
                    ->where('estado', 'pendiente')
                    ->count();
                    
                $solicitudesServicioSocialPendientes = ServicioSocial::where('empresa_id', $empresa->id)
                    ->where('estado', 'solicitado')
                    ->count();
            }
        }
        
        // Retornar vista con TODAS las variables
        return view('dashboard.index', compact(
            'user',
            'totalUsuarios',
            'alumnos',
            'empresas',
            'empresasPendientesCount',
            'vacantesPendientesCount',
            'totalVacantes',
            'misPostulaciones',
            'postulacionesPendientes',
            'vacantesRecientes',
            'empresa',
            'totalVacantesEmpresa',
            'vacantesActivas',
            'totalPostulaciones',
            'postulacionesPendientesEmpresa',
            'solicitudesServicioSocialPendientes'
        ));
    }
}