<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function __construct()
    {
        // Limitar intentos de actualización
        $this->middleware('throttle:10,1')->only(['update', 'cambiarPassword']);
    }
    
    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id,
            'telefono' => 'nullable|string|max:20',
            'direccion' => 'nullable|string|max:500',
            'tipo' => 'required|in:alumno,egresado,empresa,admin',
            'activo' => 'required|boolean',
            'numero_control' => 'nullable|string|max:50',
            'carrera' => 'nullable|string|max:255',
            'semestre' => 'nullable|integer|min:1|max:20',
            'promedio' => 'nullable|numeric|min:0|max:10',
        ]);

        // SANITIZAR INPUTS (protección extra)
        $datos = [
            'name' => strip_tags($request->name),
            'email' => $request->email,
            'telefono' => $request->telefono ? strip_tags($request->telefono) : null,
            'direccion' => $request->direccion ? strip_tags($request->direccion) : null,
            'tipo' => $request->tipo,
            'activo' => (bool)$request->activo,
        ];

        if (in_array($request->tipo, ['alumno', 'egresado'])) {
            $datos['numero_control'] = $request->numero_control ? strip_tags($request->numero_control) : null;
            $datos['carrera'] = $request->carrera ? strip_tags($request->carrera) : null;
            $datos['semestre'] = $request->semestre ? (int)$request->semestre : null;
            $datos['promedio'] = $request->promedio ? (float)$request->promedio : null;
        } else {
            $datos['numero_control'] = null;
            $datos['carrera'] = null;
            $datos['semestre'] = null;
            $datos['promedio'] = null;
        }

        $usuario->update($datos);

        return response()->json([
            'success' => true,
            'message' => htmlspecialchars('Usuario actualizado correctamente', ENT_QUOTES, 'UTF-8')
        ]);
    }

    public function cambiarEstado($id)
    {
        $usuario = Usuario::findOrFail($id);

        if ($usuario->id === auth()->id()) {
            return response()->json([
                'success' => false,
                'message' => htmlspecialchars('No puedes desactivar tu propio usuario', ENT_QUOTES, 'UTF-8')
            ], 422);
        }

        $usuario->update([
            'activo' => !$usuario->activo
        ]);

        return response()->json([
            'success' => true,
            'message' => htmlspecialchars('Estado del usuario actualizado correctamente', ENT_QUOTES, 'UTF-8'),
            'nuevo_estado' => $usuario->activo ? 'activo' : 'inactivo'
        ]);
    }

    public function cambiarPassword(Request $request, $id)
    {
        $request->validate([
            'nueva_password' => 'required|string|min:8|confirmed',
        ]);

        // Validar fortaleza de contraseña (opcional pero recomendado)
        if (strlen($request->nueva_password) < 8) {
            return response()->json([
                'success' => false,
                'message' => 'La contraseña debe tener al menos 8 caracteres'
            ], 422);
        }

        $usuario = Usuario::findOrFail($id);
        $usuario->update([
            'password' => Hash::make($request->nueva_password)
        ]);

        return response()->json([
            'success' => true,
            'message' => htmlspecialchars('Contraseña actualizada correctamente', ENT_QUOTES, 'UTF-8')
        ]);
    }
}