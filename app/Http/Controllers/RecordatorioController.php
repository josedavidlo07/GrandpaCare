<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recordatorio;
use Illuminate\Support\Facades\Auth;

class RecordatorioController extends Controller
{
    /**
     * Mostrar una lista de los recordatorios.
     */
    public function index()
    {
        // Obtener todos los recordatorios del usuario autenticado
        $recordatorios = Recordatorio::where('user_id', Auth::id())->get();

        return response()->json($recordatorios);
    }

    /**
     * Almacenar un nuevo recordatorio.
     */
   public function store(Request $request)
{
    // Validación de los datos
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'fecha' => 'required|date',
    ]);

    // Crear el recordatorio
    $recordatorio = Recordatorio::create([
        'titulo' => $request->titulo,
        'descripcion' => $request->descripcion,
        'fecha' => $request->fecha,
        'user_id' => Auth::id(),  // Asignar el usuario autenticado
    ]);

    return redirect()->route('recordatorios.index')->with('success', 'Recordatorio creado con éxito');
}

    /**
     * Mostrar un recordatorio específico.
     */
    public function show($id)
    {
        // Buscar el recordatorio por id
        $recordatorio = Recordatorio::where('user_id', Auth::id())->findOrFail($id);

        return response()->json($recordatorio);
    }

    /**
     * Actualizar un recordatorio existente.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos
        $validated = $request->validate([
            'titulo' => 'sometimes|required|string|max:255',
            'descripcion' => 'sometimes|required|string',
            'fecha' => 'sometimes|required|date',
        ]);

        // Buscar el recordatorio
        $recordatorio = Recordatorio::where('user_id', Auth::id())->findOrFail($id);

        // Actualizar el recordatorio
        $recordatorio->update($request->only(['titulo', 'descripcion', 'fecha']));

        return response()->json([
            'message' => 'Recordatorio actualizado con éxito',
            'data' => $recordatorio
        ]);
    }

    /**
     * Eliminar un recordatorio.
     */
    public function destroy($id)
    {
        // Buscar el recordatorio
        $recordatorio = Recordatorio::where('user_id', Auth::id())->findOrFail($id);

        // Eliminar el recordatorio
        $recordatorio->delete();

        return response()->json(['message' => 'Recordatorio eliminado con éxito']);
    }
}