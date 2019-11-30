<?php

namespace App;

use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable, HasrolesAndPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function empleado(){
        return $this->hasOne(Empleado::class);
    }

    public function scopeBuscar($query, $texto){
        
        if (trim($texto) != ""){
            $textoFormateado = str_replace("-", " ", $texto);
            $textoFormateado = str_replace(".", " ", $textoFormateado);
            $textoFormateado = str_replace("/", " ", $textoFormateado);
            $textoFormateado = str_replace(",", " ", $textoFormateado);
            $textoFormateado = str_replace(";", " ", $textoFormateado);
            $palabras = explode(" ", $textoFormateado);
            
            foreach ($palabras as $palabra){
                $query->where(\DB::raw("CONCAT(users.name, ' ', users.email)"), 'LIKE', "%$palabra%");
            }
        }
    }
}
