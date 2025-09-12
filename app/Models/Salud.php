<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Salud extends Model
{
    use HasFactory;

    protected $fillable = ['presion_arterial', 'glucosa', 'user_id', 'fecha'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
