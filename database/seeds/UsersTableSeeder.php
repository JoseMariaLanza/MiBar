<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Role;
use App\User;
use App\Empleado;
use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'José María',
            'email' => 'lanza.josemaria@gmail.com',
            'password' => Hash::make('123456789')
        ]);
        Empleado::create([
            'Apellido' => 'Lanza',
            'Nombre' => 'José María',
            'User_Id' => 1
        ]);

        User::create([
            'name' => 'HernanAlb',
            'email' => 'hernanalbarracin_2008@hotmail.com',
            'password' => Hash::make('987654321')
        ]);
        Empleado::create([
            'Apellido' => 'Albarracín',
            'Nombre' => 'Hernán',
            'User_Id' => 2
        ]);

        Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'special' => 'all-access'
        ]);
        Role::create([
            'name' => 'Suspendido',
            'slug' => 'suspendido',
            'description' => 'Usuarios de vacaciones',
            'special' => 'no-access'
        ]);
        Role::create([
            'name' => 'Cajero',
            'slug' => 'cajas.admin',
            'description' => 'Empleado cajero'
        ]);
        
        // Asignación de Administradores
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 2,
        ]);
        // Asignación de permisos para Cajero
        DB::table('permission_role')->insert([
            'permission_id' => 17,
            'role_id' => 3,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 18,
            'role_id' => 3,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 19,
            'role_id' => 3,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 22,
            'role_id' => 3,
        ]);
        DB::table('permission_role')->insert([
            'permission_id' => 15,
            'role_id' => 3,
        ]);
    }
}
