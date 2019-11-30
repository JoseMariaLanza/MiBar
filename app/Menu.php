<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'Nombre_Plato', 'Precio_Venta', 'Descripcion'
    ];

    public function scopeBuscar($query, $texto)
    {
        if (trim($texto) != ""){
            $textoFormateado = str_replace("-", " ", $texto);
            $textoFormateado = str_replace(".", " ", $textoFormateado);
            $textoFormateado = str_replace("/", " ", $textoFormateado);
            $textoFormateado = str_replace(",", " ", $textoFormateado);
            $textoFormateado = str_replace(";", " ", $textoFormateado);
            $palabras = explode(" ", $textoFormateado);
            
            foreach ($palabras as $palabra){
                // $query->where(\DB::raw("CONCAT(menus.Nombre_Plato, ' ', menus.Descripcion)"), 'LIKE', "%$palabra%");
                $query->where('Nombre_Plato', 'LIKE', "%$palabra%");
            }
        }
    }
}
