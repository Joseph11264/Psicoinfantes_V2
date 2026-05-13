<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfraestructuraArea extends Model
{
    use HasFactory;

    // Especificamos la tabla si Laravel no la pluraliza correctamente
    protected $table = 'infraestructura_areas';

    protected $fillable = [
        'nombre_area',
        'nivel_estimulo',
        'disponibilidad'
    ];

    public function citas()
    {
        return $this->hasMany(Cita::class, 'area_id');
    }
}