<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Caja extends Model
{
    protected $fillable = [
        'Nombre_Caja', 'Forma_Cobro', 'Estado', 'Terminal', 'Monto_Inicial', 'Monto_Final', 'Fecha_Hora_Apertura', 'Fecha_Hora_Cierre', 'Descripcion'
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
                $query->where(\DB::raw("CONCAT(cajas.nombre_caja, ' ', cajas.descripcion)"), 'LIKE', "%$palabra%");
            }
        }
    }

    // Obtiene la caja que pertenece a esta terminal
    public function scopeObtenerCaja($query)
    {
        $query->where('terminal', gethostname())->get();
    }
}
