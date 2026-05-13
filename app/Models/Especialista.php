<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especialista extends Model
{
    use HasFactory;

    protected $fillable = [
        'cedula_esp',
        'nombre_esp',
        'especialidad',
        'rol_sistema'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}