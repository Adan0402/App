<?php
// app/Http/Controllers/AdminVacanteController.php

namespace App\Http\Controllers;

use App\Models\Vacante;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminVacanteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin');
    }

    /**
     * Mostrar lista de todas las vacantes
     */
    public function index()
    {
        $vacantes = Vacante::with(['empresa', 'empresa.user'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.vacantes.index', compact('vacantes'));
    }

    /**
     * Mostrar formulario para crear vacante
     */
    public function create()
    {
        $empresas = Empresa::where('esta_aprobada', 1)
            ->orderBy('nombre')
            ->get();
        
        return view('admin.vacantes.create', compact('empresas'));
    }

    /**
     * Guardar nueva vacante
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'requisitos' => 'required|string',
            'salario' => 'nullable|string|max:100',
            'tipo_contrato' => 'required|string|max:50',
            'modalidad' => 'required|in:presencial,remoto,hibrido',
            'ubicacion' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'numero_vacantes' => 'required|integer|min:1',
            'empresa_id' => 'required|exists:empresas,id',
            'esta_aprobada' => 'nullable|boolean',
            'es_urgente' => 'nullable|boolean',
        ]);

        // Crear vacante
        $vacante = Vacante::create([
            'titulo' => $validated['titulo'],
            'descripcion' => $validated['descripcion'],
            'requisitos' => $validated['requisitos'],
            'salario' => $validated['salario'],
            'tipo_contrato' => $validated['tipo_contrato'],
            'modalidad' => $validated['modalidad'],
            'ubicacion' => $validated['ubicacion'],
            'fecha_limite' => $validated['fecha_limite'],
            'numero_vacantes' => $validated['numero_vacantes'],
            'empresa_id' => $validated['empresa_id'],
            'esta_aprobada' => $request->has('esta_aprobada') ? 1 : 0,
            'aprobada_por' => auth()->id(),
            'fecha_aprobacion' => $request->has('esta_aprobada') ? now() : null,
            'es_urgente' => $request->has('es_urgente') ? 1 : 0,
            'publicada_por_admin' => true,
        ]);

        return redirect()->route('admin.vacantes.index')
            ->with('success', 'Vacante publicada exitosamente.');
    }

    /**
     * Mostrar detalles de vacante
     */
    public function show(Vacante $vacante)
    {
        $vacante->load(['empresa', 'empresa.user', 'postulaciones', 'postulaciones.alumno']);
        return view('admin.vacantes.show', compact('vacante'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Vacante $vacante)
    {
        $empresas = Empresa::where('esta_aprobada', 1)
            ->orderBy('nombre')
            ->get();
        
        return view('admin.vacantes.edit', compact('vacante', 'empresas'));
    }

    /**
     * Actualizar vacante
     */
    public function update(Request $request, Vacante $vacante)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'requisitos' => 'required|string',
            'salario' => 'nullable|string|max:100',
            'tipo_contrato' => 'required|string|max:50',
            'modalidad' => 'required|in:presencial,remoto,hibrido',
            'ubicacion' => 'required|string|max:255',
            'fecha_limite' => 'required|date',
            'numero_vacantes' => 'required|integer|min:1',
            'empresa_id' => 'required|exists:empresas,id',
            'esta_aprobada' => 'nullable|boolean',
            'es_urgente' => 'nullable|boolean',
        ]);

        $data = $validated;

        // Manejar aprobación
        if ($request->has('esta_aprobada') && !$vacante->esta_aprobada) {
            $data['esta_aprobada'] = 1;
            $data['aprobada_por'] = auth()->id();
            $data['fecha_aprobacion'] = now();
        } elseif (!$request->has('esta_aprobada') && $vacante->esta_aprobada) {
            $data['esta_aprobada'] = 0;
            $data['aprobada_por'] = null;
            $data['fecha_aprobacion'] = null;
        }

        $vacante->update($data);

        return redirect()->route('admin.vacantes.show', $vacante)
            ->with('success', 'Vacante actualizada exitosamente.');
    }

    /**
     * Cambiar estado de aprobación
     */
    public function toggleAprobacion(Vacante $vacante)
    {
        $vacante->update([
            'esta_aprobada' => !$vacante->esta_aprobada,
            'aprobada_por' => !$vacante->esta_aprobada ? auth()->id() : null,
            'fecha_aprobacion' => !$vacante->esta_aprobada ? now() : null,
        ]);

        $status = $vacante->esta_aprobada ? 'aprobada' : 'rechazada';
        
        return redirect()->back()
            ->with('success', "Vacante {$status} exitosamente.");
    }

    /**
     * Eliminar vacante
     */
    public function destroy(Vacante $vacante)
    {
        $vacante->delete();

        return redirect()->route('admin.vacantes.index')
            ->with('success', 'Vacante eliminada exitosamente.');
    }

    /**
     * Marcar como urgente
     */
    public function toggleUrgente(Vacante $vacante)
    {
        $vacante->update([
            'es_urgente' => !$vacante->es_urgente,
        ]);

        $status = $vacante->es_urgente ? 'marcada como urgente' : 'quitada de urgentes';
        
        return redirect()->back()
            ->with('success', "Vacante {$status}.");
    }
}