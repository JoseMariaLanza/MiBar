<?php

use Illuminate\Database\Seeder;
use App\Caja;

class CajasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crear una sola caja con el nombre Caja 01
        Caja::create([
            'Nombre_Caja' => 'Caja 001',
            'Forma_Cobro' => 'Todas',
            'Estado' => 'CERRADA',
            'Terminal' => gethostname(), // php_uname(),
            'Descripcion' => 'Caja general'
        ]);
    }
}
