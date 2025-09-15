<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;

class CitaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if (method_exists($user,'esDoctor') && $user->esDoctor()) {
            $items = Cita::with('paciente')
                ->where('doctor_id', $user->id)
                ->orderBy('fecha','desc')->paginate(10);
        } else {
            // Paciente ve solo sus citas
            $items = Cita::with('doctor')
                ->where('patient_id', $user->id)
                ->orderBy('fecha','desc')->paginate(10);
        }

        return view('citas.index', compact('items','user'));
    }

    public function create()
    {
        $user = Auth::user();
        if (!method_exists($user,'esDoctor') || !$user->esDoctor()) {
            abort(403, 'Solo el doctor puede crear citas.');
        }
        // lista de pacientes asignados a este doctor
        $pacientes = $user->pacientes()
        ->select('users.id', 'users.name', 'users.email')
        ->orderBy('users.name')
        ->get();
        return view('citas.create', compact('pacientes'));
    }

    public function store(Request $request)
    {
    // Obtener el usuario autenticado
    $user = Auth::user();

    // Validar si es doctor
    if (!method_exists($user, 'esDoctor') || !$user->esDoctor()) {
        abort(403, 'Solo el doctor puede crear citas.');
    }

    // Validar los datos del formulario
    $data = $request->validate([
        'patient_id' => ['required', 'exists:users,id'], // Aseguramos que el paciente existe en la base de datos
        'titulo' => ['required', 'string', 'max:255'],
        'descripcion' => ['nullable', 'string', 'max:2000'],
        'fecha' => ['required', 'date'],
        'estado' => ['nullable', 'string', 'max:50'],
    ]);

    // Verificar que el paciente esté asignado al doctor
    $esMiPaciente = $user->pacientes()->where('users.id', $data['patient_id'])->exists();
    if (!$esMiPaciente) {
        abort(403, 'Ese paciente no está asignado a este doctor.');
    }

    // Asignamos el doctor a la cita y definimos el estado por defecto si no está presente
    $data['doctor_id'] = $user->id;
    $data['estado'] = $data['estado'] ?? 'programada'; // Si no tiene estado, se asigna 'programada' por defecto

    // Crear la cita en la base de datos
    $cita = Cita::create($data);

    // Asignar el paciente al doctor en la tabla pivote (opcional si no se hace en el formulario)
    // Si usas la relación muchos a muchos, puedes asignar el paciente aquí también si lo necesitas
    // $user->pacientes()->attach($data['patient_id']); // Esto solo si no estás usando el campo 'patient_id' para guardarlo en la tabla 'citas'

    // Redirigir con un mensaje de éxito
    return redirect()->route('citas.index')->with('success', 'Cita creada con éxito.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $cita = Cita::findOrFail($id);

        if ($user->esDoctor() && $cita->doctor_id !== $user->id) {
            abort(403);
        }
        if ($user->esPaciente() && $cita->patient_id !== $user->id) {
            abort(403);
        }

        return view('citas.show', compact('cita','user'));
    }

    public function edit($id)
    {
        $user = Auth::user();
        if (!$user->esDoctor()) {
            abort(403, 'Solo el doctor puede editar citas.');
        }
        $cita = Cita::findOrFail($id);
        if ($cita->doctor_id !== $user->id) {
            abort(403);
        }
        $pacientes = $user->pacientes()
        ->select('users.id', 'users.name', 'users.email')
        ->orderBy('users.name')
        ->get();
        return view('citas.edit', compact('cita','pacientes'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        if (!$user->esDoctor()) {
            abort(403, 'Solo el doctor puede actualizar citas.');
        }
        $cita = Cita::findOrFail($id);
        if ($cita->doctor_id !== $user->id) {
            abort(403);
        }

        $data = $request->validate([
            'patient_id' => ['required','exists:users,id'],
            'titulo' => ['required','string','max:255'],
            'descripcion' => ['nullable','string','max:2000'],
            'fecha' => ['required','date'],
            'estado' => ['required','string','max:50'],
        ]);

        $esMiPaciente = $user->pacientes()->where('users.id', $data['patient_id'])->exists();
        if (!$esMiPaciente) {
            abort(403, 'Ese paciente no está asignado a este doctor.');
        }

        $cita->update($data);

        return redirect()->route('citas.show', $cita->id)->with('success','Cita actualizada.');
    }

    public function destroy($id)
    {
        $user = Auth::user();
        if (!$user->esDoctor()) {
            abort(403, 'Solo el doctor puede eliminar citas.');
        }
        $cita = Cita::findOrFail($id);
        if ($cita->doctor_id !== $user->id) {
            abort(403);
        }
        $cita->delete();
        return redirect()->route('citas.index')->with('success','Cita eliminada.');
    }
}
