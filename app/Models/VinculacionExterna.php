<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VinculacionExterna extends Model
{
    protected $table = 'vinculaciones_externas';
    
    protected $fillable = [
    'paciente_id', 
    'tipo_institucion', 
    'nombre_institucion', 
    'contacto_externo', 
    'motivo_referencia', 
    'fecha_vinculacion'
    ];

    public function paciente()
    {
        return $this->belongsTo(Paciente::class);
    }
}