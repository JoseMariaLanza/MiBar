<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Roles Management
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $roles = Role::paginate();

        return view('Role.Index', compact('roles'));
    }

    public function create()
    {
        $permissions = Permission::get();

        return view('Role.Crear', compact('permissions'));
    }

    public function store(Request $request)
    {
        $role = Role::create($request->all());

        // Actualización de permisos
        $role->permissions()->sync($request->get('permissions'));

        return back()->with('mensaje', 'Rol agregado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('Role.Detalles', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $role = Role::findOrFail($id);

        $permissions = Permission::get();

        return view('Role.Editar', compact('role', 'permissions'));
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
            'slug' => 'required'
        ]);

        // Actualización del rol
        $role = Role::findOrFail($id);
        $role->update($request->all());

        // Actualización de permisos
        $role->permissions()->sync($request->get('permissions'));

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
        $role = Role::findOrFail($id);
        $role->delete();
        return back()->with('mensaje', 'Rol eliminado correctamente');
    }
}
