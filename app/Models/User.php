<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name','email','password','role'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

     public function recordatorios()
    {
        return $this->hasMany(Recordatorio::class, 'user_id');
    }

    public function salud()
    {
        return $this->hasMany(Salud::class, 'user_id');
    }

    public function esDoctor(): bool { return $this->role === 'doctor'; }
    public function esPaciente(): bool { return $this->role === 'paciente'; }

    public function pacientes()
    {
    return $this->belongsToMany(User::class, 'doctor_patient', 'doctor_id', 'patient_id')
                ->as('asignacion'); // ahora $p->asignacion->doctor_id, etc.
    }

    public function doctores()
    {
        return $this->belongsToMany(User::class, 'doctor_patient', 'patient_id', 'doctor_id');
    }
    public function saludRegistros()
    {
    return $this->hasMany(\App\Models\SaludRegistro::class, 'patient_id');
    }
    public function medicamentos()
    {
    return $this->hasMany(\App\Models\Medicamento::class, 'patient_id');
    }
}
