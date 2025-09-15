<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class SaludRegistro extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id', 'doctor_id', 'presion_sistolica', 'presion_diastolica',
        'glucosa_mg_dl', 'frecuencia_cardiaca', 'peso_kg', 'estatura_cm', 'fecha'
    ];

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }
}