<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;

class PacienteDemoDatosSeeder extends Seeder
{
    public function run(): void
    {
        $doctor   = User::where('role','doctor')->first();
        $paciente = User::where('role','paciente')->first();
        if (!$doctor || !$paciente) return;

        // Registro de salud
        DB::table('salud_registros')->insert([
            'patient_id' => $paciente->id,
            'doctor_id'  => $doctor->id,
            'presion_sistolica'  => 126,
            'presion_diastolica' => 82,
            'glucosa_mg_dl'      => 98,
            'frecuencia_cardiaca'=> 74,
            'peso_kg'            => 72.3,
            'estatura_cm'        => 170.0,
            'notas'              => 'Control general.',
            'fecha'              => Carbon::now()->subDay(),
            'created_at'         => now(),
            'updated_at'         => now(),
        ]);

        // Medicamentos
        DB::table('medicamentos')->insert([
            [
                'patient_id' => $paciente->id,
                'doctor_id'  => $doctor->id,
                'nombre'     => 'Losartán',
                'dosis'      => '50 mg',
                'indicaciones'=> 'Tomar con agua en la mañana.',
                'hora'       => '08:00:00',
                'activo'     => true,
                'fecha_inicio'=> now()->toDateString(),
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'patient_id' => $paciente->id,
                'doctor_id'  => $doctor->id,
                'nombre'     => 'Metformina',
                'dosis'      => '850 mg',
                'indicaciones'=> 'Con el desayuno.',
                'hora'       => '09:00:00',
                'activo'     => true,
                'fecha_inicio'=> now()->toDateString(),
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
