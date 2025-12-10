<?php
// app/Http/Controllers/AdminEmpresaController.php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminEmpresaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:admin'); // Asegúrate de tener este middleware
    }

    /**
     * Mostrar lista de empresas
     */
    public function index()
    {
        $empresas = Empresa::with('user')->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.empresas.index', compact('empresas'));
    }

    /**
     * Mostrar formulario de registro
     */
    public function create()
    {
        return view('admin.empresas.create');
    }

    public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'rfc' => 'nullable|string|max:13|unique:empresas,rfc', // ← Cambia aquí también
        'direccion' => 'nullable|string',
        'telefono' => 'nullable|string|max:20',
        'email' => 'required|email|unique:empresas,email',
        'giro' => 'nullable|string|max:255',
        
        // Datos del usuario admin
        'admin_nombre' => 'required|string|max:255',
        'admin_email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
        
        'esta_aprobada' => 'nullable|boolean',
    ]);

    // Crear usuario administrador de la empresa
    $user = User::create([
        'name' => $request->admin_nombre,
        'email' => $request->admin_email,
        'password' => Hash::make($request->password),
        'role' => 'empresa',
    ]);

    // Crear empresa
    $empresa = Empresa::create([
        'nombre' => $request->nombre,
        'rfc' => $request->rfc ?: null, // ← Asegurar que sea null si está vacío
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'giro' => $request->giro,
        'user_id' => $user->id,
        'esta_aprobada' => $request->has('esta_aprobada') ? 1 : 0,
        'aprobada_por' => auth()->id(),
        'fecha_aprobacion' => $request->has('esta_aprobada') ? now() : null,
    ]);

    // Asignar empresa al usuario
    $user->empresa_id = $empresa->id;
    $user->save();

    return redirect()->route('admin.empresas.index')
        ->with('success', 'Empresa registrada exitosamente.');
}

    /**
     * Mostrar detalles de empresa
     */
    public function show(Empresa $empresa)
    {
        return view('admin.empresas.show', compact('empresa'));
    }

    /**
     * Mostrar formulario de edición
     */
    public function edit(Empresa $empresa)
    {
        return view('admin.empresas.edit', compact('empresa'));
    }

    /**
 * Actualizar empresa
 */
public function update(Request $request, Empresa $empresa)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'rfc' => [
            'nullable',  // ← CAMBIA 'required' POR 'nullable'
            'string',
            'max:13',
            Rule::unique('empresas')->ignore($empresa->id),
        ],
        'direccion' => 'nullable|string',
        'telefono' => 'nullable|string|max:20',
        'email' => [
            'required',
            'email',
            Rule::unique('empresas')->ignore($empresa->id),
        ],
        'giro' => 'nullable|string|max:255',
        'esta_aprobada' => 'nullable|boolean',
    ]);

    $data = $request->only([
        'nombre', 'rfc', 'direccion', 'telefono', 
        'email', 'giro'
    ]);

    // Si RFC está vacío, establecerlo como null
    if (empty($data['rfc'])) {
        $data['rfc'] = null;
    }

    if ($request->has('esta_aprobada') && !$empresa->esta_aprobada) {
        $data['esta_aprobada'] = 1;
        $data['aprobada_por'] = auth()->id();
        $data['fecha_aprobacion'] = now();
    } elseif (!$request->has('esta_aprobada') && $empresa->esta_aprobada) {
        $data['esta_aprobada'] = 0;
        $data['aprobada_por'] = null;
        $data['fecha_aprobacion'] = null;
    }

    $empresa->update($data);

    return redirect()->route('admin.empresas.index')
        ->with('success', 'Empresa actualizada exitosamente.');
}

    /**
     * Aprobar empresa
     */
    public function aprobar(Empresa $empresa)
    {
        $empresa->update([
            'esta_aprobada' => 1,
            'aprobada_por' => auth()->id(),
            'fecha_aprobacion' => now(),
        ]);

        return redirect()->back()
            ->with('success', 'Empresa aprobada exitosamente.');
    }

    /**
     * Eliminar empresa
     */
    public function destroy(Empresa $empresa)
    {
        // Eliminar usuario asociado
        if ($empresa->user) {
            $empresa->user->delete();
        }
        
        $empresa->delete();

        return redirect()->route('admin.empresas.index')
            ->with('success', 'Empresa eliminada exitosamente.');
    }
}