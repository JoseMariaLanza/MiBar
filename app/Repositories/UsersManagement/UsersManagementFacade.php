<?php

namespace App\Repositories\UsersManagement;

use Illuminate\Http\Request;
use App\Empleado;

class UsersManagementFacade
{
    /**
    * Inicialización de Interfaz
    * 
    * @var IUserRepository
    */
    private $manageUser;

    public function __construct(IUserRepository $manageUser)//ICRUD $manageUsers)
    {
        $this->manageUser = $manageUser;
    }
    
    public function crearUsuario(array $usuario)
    {
        $nuevoUsuario = $this->manageUser->create($usuario);
        $empleado = [
            'Nombre' => $usuario['name'],
            'User_Id' => $nuevoUsuario['id'],
        ];
        $this->crearEmpleadoYEditar($empleado);
        return $nuevoUsuario;
    }

    public function crearEmpleadoYEditar($empleado)// array $usuario)
    {
        Empleado::create($empleado); // separar luego a una clase ManageEmpleado
        // Empleado::create([
        //     'Nombre' => $usuario['name'],
        //     'User_Id' => $usuario['id']
        // ]);
    }

    public function obtenerUsuarios(Request $request)
    {
        return $this->manageUser->getAll($request);
    }

    public function obtenerUsuario($id)
    {
        return $this->manageUser->getById($id);
        // $usuario = $this->getById($id);
        // $empleado = $this->obtenerEmpleado($id); // Lo llamo desde el controlador
        // return $usuario;
    }

    public function obtenerEmpleado($id)
    {
        // return Empleado::findOrFail($id); // separar luego a una clase ManageEmpleado
        return Empleado::ObtenerEmpleadoPorIdDeUsuario($id);
    }

    public function actualizarUsuario($request, $id)
    {
        $this->manageUser->update($request, $id);
    }

    public function actualizarEmpleado(Request $request, $id)
    {
        $empleadoUpdate = Empleado::findOrFail($id);
        $empleadoUpdate->Apellido = $request->Apellido;
        $empleadoUpdate->Nombre = $request->Nombre;
        $empleadoUpdate->Fecha_Nacimiento = $request->Fecha_Nacimiento;
        $empleadoUpdate->Telefono = $request->Telefono;
        $empleadoUpdate->Domicilio = $request->Domicilio;
        $empleadoUpdate->Descripcion = $request->Descripcion;
        $empleadoUpdate->save();
    }

    public function eliminarUsuarioEmpleado($id)
    {
        $empleadoDelete = Empleado::findOrFail($id);
        $empleadoDelete->delete();
        $this->manageUser->delete($id);
    }
}