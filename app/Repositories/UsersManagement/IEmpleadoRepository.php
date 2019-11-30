<?php

namespace App\Repositories\UsersManagement;

use Illuminate\Http\Request;

interface IEmpleadoRepository
{
    public function getAll(Request $request);

    public function getById($id);

    public function create(array $empleado);

    public function update(Request $request, $id);

    public function delete($id);
}