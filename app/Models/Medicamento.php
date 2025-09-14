<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicamento extends Model
{
    use HasFactory;

    protected $table = 'medicamentos';

    protected $fillable = [
        'patient_id','doctor_id','nombre','dosis','indicaciones','hora',
        'activo','fecha_inicio','fecha_fin'
    ];

    protected $casts = [
        'hora' => 'datetime:H:i',
        'activo' => 'boolean',
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
    ];

    public function paciente() { return $this->belongsTo(User::class, 'patient_id'); }
    public function doctor()   { return $this->belongsTo(User::class, 'doctor_id'); }
}
