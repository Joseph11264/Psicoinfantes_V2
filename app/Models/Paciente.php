<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    use HasFactory;

    // Protegemos la tabla definiendo exactamente qué campos se pueden llenar
    protected $fillable = [
        'ci_rep',
        'nombre_rep',
        'nombre_pac',
        'apellido_pac',
        'fecha_nac'
    ];

    // Relación: Un paciente puede tener muchas citas
    public function citas()
    {
        return $this->hasMany(Cita::class);
    }
}