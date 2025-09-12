<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Salud;
use Illuminate\Support\Facades\Auth;

class SaludController extends Controller
{
    /**
     * Mostrar todos los registros de salud del usuario.
     */
    public function index()
    {
        // Obtener todos los registros de salud del usuario autenticado
        $salud = Salud::where('user_id', Auth::id())->get();

        return response()->json($salud);
    }

    /**
     * Registrar un nuevo dato de salud.
     */
    public function store(Request $request)
    {
    // Validación de los datos
    $validated = $request->validate([
        'presion_arterial' => 'required|numeric',
        'glucosa' => 'required|numeric',
    ]);

    // Crear el registro de salud
    $salud = Salud::create([
        'presion_arterial' => $request->presion_arterial,
        'glucosa' => $request->glucosa,
        'user_id' => Auth::id(),
        'fecha' => now(),
    ]);

    return redirect()->route('salud.index')->with('success', 'Registro de salud creado con éxito');
    }

    /**
     * Mostrar un registro de salud específico.
     */
    public function show($id)
    {
        // Buscar el registro de salud por id
        $salud = Salud::where('user_id', Auth::id())->findOrFail($id);

        return response()->json($salud);
    }

    /**
     * Actualizar un registro de salud.
     */
    public function update(Request $request, $id)
    {
        // Validación de los datos
        $validated = $request->validate([
            'presion_arterial' => 'sometimes|required|numeric',
            'glucosa' => 'sometimes|required|numeric',
        ]);

        // Buscar el registro de salud
        $salud = Salud::where('user_id', Auth::id())->findOrFail($id);

        // Actualizar el registro de salud
        $salud->update($request->only(['presion_arterial', 'glucosa']));

        return response()->json([
            'message' => 'Datos de salud actualizados con éxito',
            'data' => $salud
        ]);
    }

    /**
     * Eliminar un registro de salud.
     */
    public function destroy($id)
    {
        // Buscar el registro de salud
        $salud = Salud::where('user_id', Auth::id())->findOrFail($id);

        // Eliminar el registro de salud
        $salud->delete();

        return response()->json(['message' => 'Registro de salud eliminado con éxito']);
    }
}