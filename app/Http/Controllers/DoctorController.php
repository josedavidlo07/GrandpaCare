<?php

namespace App\Http\Controllers;

use App\Models\Medicamento;
use App\Models\User;
use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // Mostrar la vista principal del doctor
    public function index()
    {
        $doctor = Auth::user();
        $totalPacientes = $doctor->pacientes()->count(); // Contar pacientes asignados
        $proximasCitas = Cita::where('doctor_id', $doctor->id)
                            ->where('fecha', '>=', now())
                            ->orderBy('fecha', 'asc')
                            ->limit(5)
                            ->get();

        return view('home.doctor', compact('doctor', 'totalPacientes', 'proximasCitas'));
    }

    // Mostrar el formulario para asignar un paciente
    public function asignarPaciente()
    {
        $doctor = Auth::user();
        // Pacientes no asignados al doctor
        $pacientes = User::whereDoesntHave('pacientes', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->get();

        return view('home.asignar-paciente', compact('pacientes'));
    }

    // Asignar un paciente al doctor
    public function storePaciente(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
        ]);

        $doctor = Auth::user();
        $paciente = User::findOrFail($request->patient_id);

        // Asignar paciente al doctor
        $doctor->pacientes()->attach($paciente->id);

        return redirect()->route('home')->with('success', 'Paciente asignado exitosamente.');
    }

    // Mostrar formulario para asignar medicamento
    public function asignarMedicamento()
    {
        $doctor = Auth::user();
        $pacientes = $doctor->pacientes; // Pacientes del doctor

        return view('home.asignar-medicamento', compact('pacientes'));
    }

    // Asignar medicamento a un paciente
    public function storeMedicamento(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'nombre' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'indicaciones' => 'nullable|string|max:2000',
            'hora' => 'required|date_format:H:i',
        ]);

        $doctor = Auth::user();

        $medicamento = new Medicamento();
        $medicamento->patient_id = $request->patient_id;
        $medicamento->doctor_id = $doctor->id;
        $medicamento->nombre = $request->nombre;
        $medicamento->dosis = $request->dosis;
        $medicamento->indicaciones = $request->indicaciones;
        $medicamento->hora = $request->hora;
        $medicamento->save();

        return redirect()->route('home')->with('success', 'Medicamento asignado exitosamente.');
    }

    public function verPacientes()
    {
    $doctor = Auth::user();
    $pacientes = $doctor->pacientes; // Pacientes asignados al doctor

    return view('home.pacientes', compact('pacientes'));
    }

   public function showPaciente($id)
{
    $doctor = Auth::user();

    // Obtener el paciente asignado por su ID
    $paciente = User::findOrFail($id);

    // Verificar si el paciente está asignado al doctor
    if (!$doctor->pacientes->contains($paciente)) {
        abort(403, 'Este paciente no está asignado a este doctor.');
    }

    // Mostrar la vista con los detalles del paciente
    return view('home.detalles-paciente', compact('paciente'));
    }

    public function gestionarMedicamentos()
    {
    $doctor = Auth::user();
    $medicamentos = Medicamento::where('doctor_id', $doctor->id)->get(); // Obtener todos los medicamentos asignados por este doctor

    return view('home.gestionar-medicamentos', compact('medicamentos'));
    }

    public function editarMedicamento($id)
    {
    $doctor = Auth::user();
    $medicamento = Medicamento::where('doctor_id', $doctor->id)->findOrFail($id); // Buscar el medicamento asignado al doctor

    return view('home.editar-medicamento', compact('medicamento'));
    }

    public function actualizarMedicamento(Request $request, $id)
    {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'dosis' => 'required|string|max:255',
        'hora' => 'required|date_format:H:i',
        'indicaciones' => 'nullable|string|max:2000',
    ]);

    $doctor = Auth::user();
    $medicamento = Medicamento::where('doctor_id', $doctor->id)->findOrFail($id);

    // Actualizar los detalles del medicamento
    $medicamento->update($request->only('nombre', 'dosis', 'hora', 'indicaciones'));

    return redirect()->route('home')->with('success', 'Medicamento actualizado exitosamente.');
    }

    public function eliminarMedicamento($id)
    {
    $doctor = Auth::user();
    $medicamento = Medicamento::where('doctor_id', $doctor->id)->findOrFail($id);

    // Eliminar el medicamento
    $medicamento->delete();

    return redirect()->route('home')->with('success', 'Medicamento eliminado exitosamente.');
    }




}