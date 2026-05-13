<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnostico extends Model
{
    protected $fillable = ['paciente_id', 'patologia', 'derivacion', 'fecha_emision'];
}
