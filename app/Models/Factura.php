<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable = [
        'cita_id', 
        'fecha_factura', 
        'subtotal', 
        'impuesto_iva', 
        'monto_total', 
        'estado_pago'
    ];

    public function cita() {
        return $this->belongsTo(Cita::class);
    }

    public function paciente() {
        return $this->belongsTo(Paciente::class)->withTrashed();
    }
}