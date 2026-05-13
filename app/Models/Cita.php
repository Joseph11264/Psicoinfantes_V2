<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_cita',
        'hora_cita',
        'paciente_id',
        'especialista_id',
        'area_id',
        'estado'
    ];

    // Relaciones (Claves Foráneas)
    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }

    public function especialista()
    {
        return $this->belongsTo(Especialista::class);
    }

    public function area()
    {
        return $this->belongsTo(InfraestructuraArea::class, 'area_id');
    }
}