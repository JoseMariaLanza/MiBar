<?php

namespace App\Repositories\UsersManagement;

use Illuminate\Http\Request;

interface IUserRepository
{
    public function getAll(Request $request);

    public function getById($id);

    public function create(array $user);

    public function update(Request $request, $id);

    public function delete($id);
}