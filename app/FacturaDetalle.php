<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FacturaDetalle extends Model
{
    protected $table = 'facturas_detalles';
    protected $fillable = [
        'Factura_Id', 'Orden_Id', 'Precio_Unitario', 'Cantidad', 'Descripcion', 'Subtotal', 'Estado'
    ];

    public function scopeBuscarDetalles($query, $facturaId)
    {
        return $query->where('Factura_Id', $facturaId)->get();
    }
}
