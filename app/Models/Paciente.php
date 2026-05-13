<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paciente extends Model
{
    use HasFactory;
    use SoftDeletes;

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

    public function vinculaciones()
    {
        return $this->hasMany(VinculacionExterna::class);
    }
    
    public function historias() {
    return $this->hasMany(HistoriaClinica::class)->orderBy('fecha_sesion', 'desc');
    }
}