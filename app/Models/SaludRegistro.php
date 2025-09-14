<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaludRegistro extends Model
{
    use HasFactory;

    protected $table = 'salud_registros';

    protected $fillable = [
        'patient_id','doctor_id','presion_sistolica','presion_diastolica',
        'glucosa_mg_dl','frecuencia_cardiaca','peso_kg','estatura_cm','notas','fecha'
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'peso_kg' => 'decimal:2',
        'estatura_cm' => 'decimal:2',
    ];

    public function paciente() { return $this->belongsTo(User::class, 'patient_id'); }
    public function doctor()   { return $this->belongsTo(User::class, 'doctor_id'); }
}
