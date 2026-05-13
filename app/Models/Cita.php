<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = ['paciente_id', 'especialista_id', 'area_id', 'fecha_cita', 'hora_cita', 'estado'];

    // Forzamos a Laravel a buscar también entre los registros inhabilitados
    public function paciente()
    {
        return $this->belongsTo(Paciente::class)->withTrashed();
    }

    public function especialista()
    {
        return $this->belongsTo(Especialista::class)->withTrashed();
    }

    public function area()
    {
        return $this->belongsTo(InfraestructuraArea::class)->withTrashed();
    }
}
