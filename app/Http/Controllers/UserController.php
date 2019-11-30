<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Users Management
use App\Repositories\UsersManagement\UsersManagementFacade;
use App\Repositories\UsersManagement\ManageUsers;

// Roles Management
use Caffeinated\Shinobi\Models\Role;

class UserController extends Controller
{
    /**
     * Inicialización de Fachada
     * 
     * @var UsersManagementFacade
     */
    private $usersManagement;

    public function __construct(UsersManagementFacade $usersManagement)
    {
        $this->middleware('auth');
        $this->usersManagement = $usersManagement;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = $this->usersManagement->obtenerUsuarios($request)->paginate(5);
        return view('Usuario.Index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->usersManagement->obtenerUsuario($id);
        // dd($user);
        $empleado = $this->usersManagement->obtenerEmpleado($id);
        // dd($empleado);
        return view('Usuario.Detalles', compact('user', 'empleado'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Roles del sistema
        $roles = Role::get();

        $user = $this->usersManagement->obtenerUsuario($id);
        $empleado = $this->usersManagement->obtenerEmpleado($id);
        return view('Usuario.Editar', compact('user', 'empleado', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required'
        ]);

        // Actualización del usuario
        $this->usersManagement->actualizarUsuario($request, $id);

        return back()->with('mensaje', 'Cambios guardados correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->usersManagement->eliminarUsuarioEmpleado($id);
        return back()->with('mensaje', 'Usuario eliminado correctamente');
    }
}
