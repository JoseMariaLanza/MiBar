<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuarios
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ver en detalle cada usuario del sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Editar cualquier dato de un usuario del sistema',
        ]);
        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Eliminar cualquier usuario del sistema',
        ]);
        
        // Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de rol',
            'slug'          => 'roles.show',
            'description'   => 'Ver en detalle cada rol del sistema',
        ]);
        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Editar cualquier dato de un rol del sistema',
        ]);
        Permission::create([
            'name'          => 'Eliminar rol',
            'slug'          => 'roles.destroy',
            'description'   => 'Eliminar cualquier rol del sistema',
        ]);

        // Cajas
        Permission::create([
            'name'          => 'Navegar cajas',
            'slug'          => 'cajas.index',
            'description'   => 'Lista y navega todas las cajas del sistema',
        ]);
        Permission::create([
            'name'          => 'Ver detalle de caja',
            'slug'          => 'cajas.show',
            'description'   => 'Ver en detalle cada caja del sistema',
        ]);
        Permission::create([
            'name'          => 'Creación de cajas',
            'slug'          => 'cajas.create',
            'description'   => 'Editar cualquier dato de una caja del sistema',
        ]);
        Permission::create([
            'name'          => 'Edición de cajas',
            'slug'          => 'cajas.edit',
            'description'   => 'Editar cualquier dato de una caja del sistema',
        ]);
        Permission::create([
            'name'          => 'Eliminar caja',
            'slug'          => 'cajas.destroy',
            'description'   => 'Eliminar cualquier caja del sistema',
        ]);
        Permission::create([
            'name'          => 'Actualizar el estado de la caja',
            'slug'          => 'ventas.updateState',
            'description'   => 'Abrir o cerrar una caja del sistema',
        ]);
        Permission::create([
            'name'          => 'Visualizar ventas',
            'slug'          => 'ventas.index',
            'description'   => 'Puede visualizar las ventas realizadas',
        ]);
        Permission::create([
            'name'          => 'Ingresar una venta en el sistema',
            'slug'          => 'ventas.create',
            'description'   => 'Creación de facturas y detalles',
        ]);
        Permission::create([
            'name'          => 'Modificar una venta',
            'slug'          => 'ventas.edit',
            'description'   => 'Puede modificar cualquier venta del sistema',
        ]);
        Permission::create([
            'name'          => 'Anular facturas',
            'slug'          => 'ventas.destroy',
            'description'   => 'Puede anular cualquier venta del sistema',
        ]);
        Permission::create([
            'name'          => 'Visualizar mesas',
            'slug'          => 'mesas.index',
        ]);
        Permission::create([
            'name'          => 'Creación de mesas',
            'slug'          => 'mesas.create',
        ]);
        Permission::create([
            'name'          => 'Edición de mesa',
            'slug'          => 'mesas.edit',
            'description'   => 'Puede editar las mesas',
        ]);
        Permission::create([
            'name'          => 'Eliminar mesa',
            'slug'          => 'mesas.destroy',
            'description'   => 'Puede eliminar una mesa',
        ]);
        Permission::create([
            'name'          => 'Visualizar menu',
            'slug'          => 'menu.index',
            'description'   => 'Puede ver los items que conforman el menú',
        ]);
        Permission::create([
            'name'          => 'Creación de item',
            'slug'          => 'menu.create',
            'description'   => 'Puede crear un item el cual forma parte de un menú',
        ]);
        Permission::create([
            'name'          => 'Eliminación de item',
            'slug'          => 'menu.destroy',
            'description'   => 'Puede eliminar un item el cual forma parte de un menú',
        ]);
        Permission::create([
            'name'          => 'Edición de item',
            'slug'          => 'menu.edit',
            'description'   => 'Puede editar un item el cual forma parte de un menú',
        ]);
    }
}
