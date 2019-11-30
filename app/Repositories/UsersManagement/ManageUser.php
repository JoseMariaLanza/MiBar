<?php

// DISPOSICIÓN ANTERIOR
// namespace App\Repositories;
// use App\Repositories\Users\IUsersRepository;

// ACTUAL
namespace App\Repositories\UsersManagement;

use Illuminate\Http\Request;

// use App\Repositories\ICRUD;
use App\User;
use Caffeinated\Shinobi\Models\Role;
// use App\Empleado;

class ManageUser implements IUserRepository, IEmpleadoRepository // , ICRUD
{
    /**
     * Inicialización Modelo
     * @var User
     */
    private $userModel;
    private $modeloEmpleado;

    public function __construct(User $userModel) // , Empleado $modeloEmpleado)
    {
        $this->userModel = $userModel;
        // $this->modeloEmpleado = $modeloEmpleado;
    }

    public function getAll(Request $request){
        return $this->userModel->buscar($request->get('texto'))->orderBy('id', 'DESC');
    }

    public function getById($id)
    {
        return $this->userModel->findOrFail($id);
    }

    public function create(array $user)
    {
        return $this->userModel->create($user);
    }

    public function update(Request $request, $id)
    {
        $usuarioUpdate = $this->getById($id);
        $usuarioUpdate->name = $request->name;
        $usuarioUpdate->email = $request->email;
        $usuarioUpdate->save();

        // Actualización de Roles
        $usuarioUpdate->roles()->sync($request->get('roles'));
    }

    public function updateRoles(Request $request)
    {
        return roles()->sync($request->get('roles'));
    }

    public function delete($id)
    {
        $user = $this->getById($id);
        $user->delete();
    }
}