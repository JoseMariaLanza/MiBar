<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

// Users Management
use App\Repositories\UsersManagement\UsersManagementFacade;
use App\Repositories\UsersManagement\ManageUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = 'ventas'; // '/Empleado/Editar/{id}';
    // protected $redirectTo = '/Empleado/Editar/{id}';
    protected function redirectTo()
    {
        $userId = auth()->user()->id;
        return '/Empleado/Editar/'.$userId;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Inicialización de Fachada
     * 
     * @var UsersManagementFacade // IUsersRepository //ICRUD
     */
    private $usersManagement;

    public function __construct(UsersManagementFacade $usersManagement)//ICRUD $manageUsers)
    {
        $this->middleware('guest');
        $this->usersManagement = $usersManagement;
        // $this->user = auth()->user();
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Repositories\UsersManagement\UsersManagmentFacade
     */
    protected function create(array $data)
    {
        $user =  $this->usersManagement->crearUsuario([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
        $idUsuario = $user->id;
        return $user;
    }
}
