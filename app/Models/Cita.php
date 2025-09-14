<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $table = 'citas';

    protected $fillable = [
        'doctor_id','patient_id','titulo','descripcion','fecha','estado'
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function paciente()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}