<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\EnumRepository;

class Gasto extends Model
{
    protected $fillable = [
        'Concepto', 'Monto', 'Periodo', 'Fecha', 'Descripcion'
    ];

    public function scopeBuscar($query, $fechaInicio, $fechaFin) // , $fecha)
    {
        // $query->where('Fecha', $fecha)->get();
        $query->whereBetween('Fecha', [$fechaInicio, $fechaFin])->get();
    }

    public function scopeEnums()
    {
        $enums = new EnumRepository();
        return $enums->getEnumValues('gastos', 'Periodo');
    }
}
