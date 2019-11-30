<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mesa extends Model
{
    protected $fillable = [
        'Numero', 'Descripcion'
    ];

    public function scopeBuscar($query)
    {
        $query->where('Estado', 'LIBRE');
    }

    public function scopeBuscarPorNombre($query, $texto)
    {
        if (trim($texto) != ""){
            $palabras = explode(" // ", $texto);
            
            return $query->where('Descripcion', $palabras[0]);
        }
    }

    public function scopeObtenerTodas($query)
    {
        $query->get();
    }
}
