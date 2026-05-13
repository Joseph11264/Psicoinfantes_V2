<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriaClinica extends Model
{
    protected $table = 'historia_clinicas';
    
    protected $fillable = [
        'paciente_id', 
        'especialista_id', 
        'fecha_sesion', 
        'observaciones', 
        'diagnostico_evolutivo'
    ];

    // La nota pertenece a un paciente
    public function paciente() {
        return $this->belongsTo(Paciente::class);
    }

    // La nota fue escrita por un especialista
    public function especialista() {
        return $this->belongsTo(Especialista::class);
    }
}