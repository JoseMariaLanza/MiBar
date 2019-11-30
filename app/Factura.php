<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Factura extends Model
{
    protected $fillable = [
        'Caja_Id', 'Usuario_Id', 'Serie', 'Numero', 'Tipo', 'Cliente_Id', 'Fecha_Emision', 'Estado', 'Total', 'Descripcion'
    ];

    public function scopeBuscarFacturasDia($query, $fechaInicio)
    {
        return $query->whereBetween('Fecha_Emision', [$fechaInicio, Carbon::now()]);
    }

    public function scopeBuscar($query, $fechaInicio, $fechaFin)
    {
        $fechaInicio = $fechaInicio . ' 19:00:00';
        $fechaFin = $fechaFin . ' 08:00:00';
        $query->whereBetween('Fecha_Emision', [$fechaInicio, $fechaFin])->get();
    }

    public function scopeEstado($query, $estado)
    {
        $query->where('Estado', 'LIKE', $estado)->get();
    }

    public function scopeFormaPago($query, $formaPago)
    {
        $query->where('Forma_Pago', 'LIKE', '%'.$formaPago.'%')
        ->orWhereNull('Forma_Pago')
        ->get();
    }

}
