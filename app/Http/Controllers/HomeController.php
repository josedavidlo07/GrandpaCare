<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cita;
use App\Models\Recomendacion;
use App\Models\SaludRegistro;
use App\Models\Medicamento;
use Illuminate\Support\Facades\Schema;
use App\Models\User;


class HomeController extends Controller
{
    public function __invoke()
    {
        $user = Auth::user();
        if (!$user) return redirect()->route('login');

        // DOCTOR: como ya lo tienes
        if (method_exists($user,'esDoctor') && $user->esDoctor()) {
            $doctor = $user;

            $totalPacientes = Schema::hasTable('doctor_patient')
                ? $doctor->pacientes()->count()
                : 0;

            $proximasCitas = Schema::hasTable('citas')
                ? Cita::where('doctor_id', $doctor->id)
                    ->where('fecha', '>=', now())
                    ->orderBy('fecha', 'asc')
                    ->limit(5)->get()
                : collect();

            return view('home.doctor', compact('doctor','totalPacientes','proximasCitas'));
        }

        // PACIENTE: su panel
        $proximasCitas = Schema::hasTable('citas')
            ? Cita::where('patient_id', $user->id)
                ->where('fecha', '>=', now())
                ->orderBy('fecha', 'asc')
                ->limit(5)->get()
            : collect();

        $salud = Schema::hasTable('salud_registros')
            ? SaludRegistro::where('patient_id', $user->id)
                ->orderBy('fecha','desc')
                ->first()
            : null;

        $meds = Schema::hasTable('medicamentos')
            ? Medicamento::where('patient_id', $user->id)
                ->where('activo', true)
                ->orderBy('hora','asc')
                ->get()
            : collect();

        // Calcula IMC si hay peso y estatura
        $imc = null;
        if ($salud && $salud->peso_kg && $salud->estatura_cm && $salud->estatura_cm > 0) {
            $m = $salud->estatura_cm / 100;
            $imc = $m > 0 ? round($salud->peso_kg / ($m*$m), 1) : null;
        }

        return view('paciente.paciente', compact('user','proximasCitas','salud','imc','meds'));
    }
    public function index()
    {
        return $this->__invoke();
    }
}
