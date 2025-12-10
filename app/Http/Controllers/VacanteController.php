<?php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Empresa;
use App\Models\Notificacion;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VacanteController extends Controller
{
    public function __construct()
    {
        // Rate limiting para prevenir spam
        $this->middleware('throttle:5,1')->only(['store', 'update']);
    }
    
    public function create()
    {
        $user = Auth::user();
        
        if ($user->tipo !== 'empresa') {
            return redirect('/dashboard')->with('error', 'Solo las empresas pueden publicar vacantes.');
        }
        
        if (!$user->empresa) {
            return redirect('/empresa/completar-datos')
                ->with('error', 'Primero debes completar los datos de tu empresa.');
        }
        
        if ($user->empresa->estado !== 'aprobada') {
            return redirect('/dashboard')->with('error', 'Tu empresa debe estar aprobada para publicar vacantes.');
        }

        return view('vacantes.create', compact('user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        if ($user->tipo !== 'empresa' || !$user->empresa || $user->empresa->estado !== 'aprobada') {
            return redirect('/dashboard')->with('error', 'No tienes permisos para publicar vacantes.');
        }

        // Validar y sanitizar
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|min:50|max:5000',
            'requisitos' => 'required|string|min:30|max:2000',
            'beneficios' => 'nullable|string|max:1000',
            'tipo_contrato' => 'required|in:tiempo_completo,medio_tiempo,practicas,freelance,proyecto',
            'salario_min' => 'nullable|numeric|min:0|max:9999999',
            'salario_max' => 'nullable|numeric|min:0|max:9999999',
            'salario_mostrar' => 'boolean',
            'ubicacion' => 'required|string|max:255',
            'modalidad' => 'required|in:presencial,remoto,hibrido',
            'nivel_experiencia' => 'required|in:sin_experiencia,junior,mid,senior',
            'vacantes_disponibles' => 'required|integer|min:1|max:100',
            'fecha_limite' => 'required|date|after:today|before:+1 year',
        ]);

        if ($validated['salario_min'] && $validated['salario_max'] && 
            $validated['salario_min'] > $validated['salario_max']) {
            return back()->withErrors(['salario_min' => 'El salario mínimo no puede ser mayor al máximo.']);
        }

        try {
            // SANITIZAR antes de guardar
            $vacante = Vacante::create([
                'empresa_id' => $user->empresa->id,
                'titulo' => strip_tags($validated['titulo']),
                'descripcion' => strip_tags($validated['descripcion']),
                'requisitos' => strip_tags($validated['requisitos']),
                'beneficios' => $validated['beneficios'] ? strip_tags($validated['beneficios']) : null,
                'tipo_contrato' => $validated['tipo_contrato'],
                'salario_min' => $validated['salario_min'],
                'salario_max' => $validated['salario_max'],
                'salario_mostrar' => $validated['salario_mostrar'] ?? true,
                'ubicacion' => strip_tags($validated['ubicacion']),
                'modalidad' => $validated['modalidad'],
                'nivel_experiencia' => $validated['nivel_experiencia'],
                'vacantes_disponibles' => $validated['vacantes_disponibles'],
                'fecha_limite' => $validated['fecha_limite'],
                'estado' => 'pendiente',
                'activa' => true,
            ]);

            // Notificaciones (mantener igual)
            $alumnos = Usuario::where('tipo', 'alumno')->get();
            foreach ($alumnos as $alumno) {
                Notificacion::crearVacanteNueva($alumno, $vacante);
            }

            $admins = Usuario::where('tipo', 'admin')->get();
            foreach ($admins as $admin) {
                Notificacion::nuevaVacanteCreada($vacante, $admin->id);
            }

            return redirect()->route('vacantes.index')
                ->with('success', '✅ Vacante publicada correctamente. Está pendiente de aprobación.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al publicar la vacante: ' . $e->getMessage());
        }
    }

    public function index()
    {
        $user = Auth::user();
        
        if ($user->tipo !== 'empresa' || !$user->empresa) {
            return redirect('/dashboard')->with('error', 'No tienes permisos para ver esta página.');
        }

        $vacantes = $user->empresa->vacantes()
            ->latest()
            ->get();

        return view('vacantes.index', compact('user', 'vacantes'));
    }

    public function edit(Vacante $vacante)
    {
        $user = Auth::user();
        
        if ($user->tipo !== 'empresa' || !$user->empresa) {
            return redirect('/dashboard')->with('error', 'No tienes permisos para editar vacantes.');
        }
        
        if ($vacante->empresa_id !== $user->empresa->id) {
            return redirect('/dashboard')->with('error', 'No tienes permisos para editar esta vacante.');
        }
        
        if (!in_array($vacante->estado, ['pendiente', 'aprobada'])) {
            return redirect()->route('vacantes.index')
                ->with('error', 'No puedes editar una vacante rechazada o cerrada.');
        }

        return view('vacantes.edit', compact('user', 'vacante'));
    }

    public function update(Request $request, Vacante $vacante)
    {
        $user = Auth::user();
        
        if ($user->tipo !== 'empresa' || !$user->empresa || $vacante->empresa_id !== $user->empresa->id) {
            return redirect('/dashboard')->with('error', 'No tienes permisos para editar esta vacante.');
        }
        
        if (!in_array($vacante->estado, ['pendiente', 'aprobada'])) {
            return redirect()->route('vacantes.index')
                ->with('error', 'No puedes editar una vacante rechazada o cerrada.');
        }

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|min:50|max:5000',
            'requisitos' => 'required|string|min:30|max:2000',
            'beneficios' => 'nullable|string|max:1000',
            'tipo_contrato' => 'required|in:tiempo_completo,medio_tiempo,practicas,freelance,proyecto',
            'salario_min' => 'nullable|numeric|min:0|max:9999999',
            'salario_max' => 'nullable|numeric|min:0|max:9999999',
            'salario_mostrar' => 'boolean',
            'ubicacion' => 'required|string|max:255',
            'modalidad' => 'required|in:presencial,remoto,hibrido',
            'nivel_experiencia' => 'required|in:sin_experiencia,junior,mid,senior',
            'vacantes_disponibles' => 'required|integer|min:1|max:100',
            'fecha_limite' => 'required|date|after:today|before:+1 year',
        ]);

        if ($validated['salario_min'] && $validated['salario_max'] && 
            $validated['salario_min'] > $validated['salario_max']) {
            return back()->withErrors(['salario_min' => 'El salario mínimo no puede ser mayor al máximo.']);
        }

        try {
            $vacante->update([
                'titulo' => strip_tags($validated['titulo']),
                'descripcion' => strip_tags($validated['descripcion']),
                'requisitos' => strip_tags($validated['requisitos']),
                'beneficios' => $validated['beneficios'] ? strip_tags($validated['beneficios']) : null,
                'tipo_contrato' => $validated['tipo_contrato'],
                'salario_min' => $validated['salario_min'],
                'salario_max' => $validated['salario_max'],
                'salario_mostrar' => $validated['salario_mostrar'] ?? true,
                'ubicacion' => strip_tags($validated['ubicacion']),
                'modalidad' => $validated['modalidad'],
                'nivel_experiencia' => $validated['nivel_experiencia'],
                'vacantes_disponibles' => $validated['vacantes_disponibles'],
                'fecha_limite' => $validated['fecha_limite'],
                'estado' => 'pendiente',
            ]);

            return redirect()->route('vacantes.index')
                ->with('success', '✅ Vacante actualizada correctamente. Está pendiente de nueva aprobación.');

        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la vacante: ' . $e->getMessage());
        }
    }

    public function destroy(Vacante $vacante)
    {
        $user = Auth::user();
        
        if ($user->tipo !== 'empresa' || !$user->empresa || $vacante->empresa_id !== $user->empresa->id) {
            return redirect('/dashboard')->with('error', 'No tienes permisos para eliminar esta vacante.');
        }

        // Validar si tiene postulaciones activas
        if ($vacante->postulaciones()->whereIn('estado', ['pendiente', 'revision'])->exists()) {
            return redirect()->route('vacantes.index')
                ->with('error', 'No puedes eliminar esta vacante porque tiene postulaciones activas.');
        }

        try {
            $titulo = htmlspecialchars($vacante->titulo, ENT_QUOTES, 'UTF-8');
            $vacante->delete();

            return redirect()->route('vacantes.index')
                ->with('success', "✅ Vacante '{$titulo}' eliminada correctamente.");

        } catch (\Exception $e) {
            return redirect()->route('vacantes.index')
                ->with('error', 'Error al eliminar la vacante: ' . $e->getMessage());
        }
    }
}