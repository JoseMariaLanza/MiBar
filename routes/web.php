<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Empleados
Route::resource('/Empleado', 'EmpleadoController');

Route::get('Empleado/Detalles/{id}', 'EmpleadoController@show')->name('Empleado.Detalles');

Route::get('/Empleado/Editar/{id}', 'EmpleadoController@edit')->name('Empleado.Editar');

Route::put('Empleado/Editar/{id}', 'EmpleadoController@update')->name('Empleado.Actualizar');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
    // Roles
    Route::post('roles/store', 'RoleController@store')->name('roles.store')
        ->middleware('has.permission:roles.create');

    Route::get('roles', 'RoleController@index')->name('roles.index')
        ->middleware('has.permission:roles.index');
        
    Route::get('roles/create', 'RoleController@create')->name('roles.create')
        ->middleware('has.permission:roles.create');

    Route::put('roles/{role}', 'RoleController@update')->name('roles.update')
        ->middleware('has.permission:roles.edit');

    Route::get('roles/{role}', 'RoleController@show')->name('roles.show')
        ->middleware('has.permission:roles.show');

    Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')
        ->middleware('has.permission:roles.destroy');

    Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')
        ->middleware('has.permission:roles.edit');
    
    // Ventas
    Route::resource('/ventas', 'SalesController');

    Route::post('ventas/buscar', 'SalesController@buscar')->name('ventas.buscar')
        ->middleware('has.permission:ventas.index');

    Route::get('ventas/create', 'SalesController@create')->name('ventas.create')
        ->middleware('has.permission:ventas.create');
    
    Route::post('ventas/store', 'SalesController@store')->name('ventas.store')
        ->middleware('has.permission:ventas.create');
        
    Route::post('ventas/storeDetail', 'SalesController@storeDetail')->name('ventas.storeDetail')
        ->middleware('has.permission:ventas.create');

    Route::get('ventas/showDetails/{facturaId}', 'SalesController@showDetails')->name('ventas.showDetails')
        ->middleware('has.permission:ventas.create');
    
    Route::get('ventas/edit/{id}', 'SalesController@edit')->name('ventas.editar')
        ->middleware('has.permission:ventas.edit');

    Route::put('ventas/update/{id}', 'SalesController@update')->name('ventas.update')
        ->middleware('has.permission:ventas.edit');

    Route::post('ventas/buscarMenuItem', 'SalesController@buscarMenuItem')->name('ventas.buscarMenuItem')
        ->middleware('has.permission:ventas.create');
        
    Route::put('ventas/{id}/actualizarEstadoCaja', 'SalesController@actualizarEstadoCaja')->name('ventas.actualizarEstadoCaja')
        ->middleware('has.permission:ventas.edit');

    Route::put('ventas/actualizarDetalleFactura/{id}', 'SalesController@actualizarDetalleFactura')->name('ventas.actualizarDetalleFactura')
        ->middleware('has.permission:ventas.edit');
    
    Route::put('ventas/actualizarEstadoFactura/{id}', 'SalesController@actualizarEstadoFactura')->name('ventas.actualizarEstadoFactura')
        ->middleware('has.permission:ventas.edit');

    Route::put('ventas', 'SalesController@anularDetallesFactura')->name('ventas.anularDetallesFactura')
        ->middleware('has.permission:ventas.edit');

    Route::delete('ventas/eliminarDetalleFactura/{id}', 'SalesController@eliminarDetalleFactura')->name('ventas.eliminarDetalleFactura')
        ->middleware('has.permission:ventas.edit');

    // No definida, ahora se usa anular
    Route::put('ventas/destroy/{id}', 'SalesController@destroy')->name('ventas.destroy')
        ->middleware('has.permission:ventas.destroy');

    Route::put('ventas/anular/{id}', 'SalesController@anular')->name('ventas.anular')
        ->middleware('has.permission:ventas.edit');

    Route::put('ventas/cobrar/{id}', 'SalesController@cobrar')->name('ventas.cobrar')
        ->middleware('has.permission:ventas.edit');

    // Búsqueda de menu
    Route::post('ventas/getMenu', 'SalesController@getMenu')->name('ventas.getMenu')
        ->middleware('has.permission:ventas.create');

    Route::post('ventas/searchMenuItem', 'SalesController@searchMenuItem')->name('ventas.searchMenuItem')
        ->middleware('has.permission:ventas.create');
        
    Route::post('ventas/getEmpleados', 'SalesController@getEmpleados')->name('ventas.getEmpleados')
        ->middleware('has.permission:ventas.create');

    Route::post('ventas/getMesas', 'SalesController@getMesas')->name('ventas.getMesas')
        ->middleware('has.permission:ventas.create');

    Route::post('ventas/createMesa', 'SalesController@createMesa')->name('ventas.createMesa')
        ->middleware('has.permission:mesas.create');

    Route::put('ventas/updateMesa/{id}', 'SalesController@updateMesa')->name('ventas.updateMesa')
        ->middleware('has.permission:mesas.edit');
    
    Route::put('ventas/updateEstadoMesa/{id}', 'SalesController@updateEstadoMesa')->name('ventas.updateEstadoMesa')
        ->middleware('has.permission:mesas.edit');
    
    Route::post('ventas/restoreMesa', 'SalesController@restoreMesa')->name('ventas.restoreMesa')
        ->middleware('has.permission:mesas.edit');

    // Mesas subsystem
    Route::get('mesas', 'MesaController@index')->name('mesas.index')
        ->middleware('has.permission:mesas.index');
    
    Route::post('mesas/store', 'MesaController@store')->name('mesas.store')
        ->middleware('has.permission:mesas.store');

    Route::get('mesas/edit/{id}', 'MesaController@edit')->name('mesas.edit')
        ->middleware('has.permission:mesas.edit');

    Route::put('mesas/update/{id}', 'MesaController@update')->name('mesas.update')
        ->middleware('has.permission:mesas.edit');

    Route::delete('mesas/destroy/{id}', 'MesaController@destroy')->name('mesas.destroy')
        ->middleware('has.permission:mesas.destroy');

    // MENU
    Route::get('menu', 'MenuController@index')->name('menu.index')
        ->middleware('has.permission:menu.index');

    Route::post('menu/store', 'MenuController@store')->name('menu.store')
        ->middleware('has.permission:menu.create');
        
    Route::get('menu/create', 'MenuController@create')->name('menu.create')
        ->middleware('has.permission:menu.create');

    Route::put('menu/update/{id}', 'MenuController@update')->name('menu.update')
        ->middleware('has.permission:menu.edit');

    Route::get('menu/show/{id}', 'MenuController@show')->name('menu.show')
        ->middleware('has.permission:menu.show');

    Route::delete('menu/destroy/{id}', 'MenuController@destroy')->name('menu.destroy')
        ->middleware('has.permission:menu.destroy');

    Route::get('menu/edit/{id}', 'MenuController@edit')->name('menu.edit')
        ->middleware('has.permission:menu.edit');

    // Cajas subsystem
    Route::post('cajas/store', 'CajaController@store')->name('cajas.store')
        ->middleware('has.permission:cajas.create');

    Route::get('cajas', 'CajaController@index')->name('cajas.index')
        ->middleware('has.permission:cajas.index');
        
    Route::get('cajas/create', 'CajaController@create')->name('cajas.create')
        ->middleware('has.permission:cajas.create');

    Route::put('cajas/{id}', 'CajaController@update')->name('cajas.update')
        ->middleware('has.permission:cajas.edit');

    Route::get('cajas/{id}', 'CajaController@show')->name('cajas.show')
        ->middleware('has.permission:cajas.show');

    Route::delete('cajas/{id}', 'CajaController@destroy')->name('cajas.destroy')
        ->middleware('has.permission:cajas.destroy');

    Route::get('cajas/{id}/edit', 'CajaController@edit')->name('cajas.edit')
        ->middleware('has.permission:cajas.edit');

    // Gastos
    Route::get('gastos', 'GastoController@index')->name('gastos.index')
        ->middleware('has.permission:gastos.index');

    Route::post('gastos/create', 'GastoController@store')->name('gastos.create')
        ->middleware('has.permission:gastos.create');

    Route::delete('gastos/{id}', 'GastoController@destroy')->name('gastos.destroy')
        ->middleware('has.permission:gastos.destroy');

    // Users
    Route::get('users', 'UserController@index')->name('users.index')
        ->middleware('has.permission:users.index');
        
    Route::put('users/{id}', 'UserController@update')->name('users.update')
        ->middleware('has.permission:users.edit');

    Route::get('users/{id}', 'UserController@show')->name('users.show')
        ->middleware('has.permission:users.show');

    Route::delete('users/{id}', 'UserController@destroy')->name('users.destroy')
        ->middleware('has.permission:users.destroy');

    Route::get('users/{id}/edit', 'UserController@edit')->name('users.edit');
        // ->middleware('has.permission:users.edit');

    // REPORTING
    Route::get('gastos/showReport/{fechaInicio}/{fechaFin}', 'GastoController@showReport')->name('gastos.pdf');
});