<?php

namespace App\Repositories\ExpensesManagement;

use Illuminate\Http\Request;

interface IExpenseRepository
{
    public function getAll($request);

    public function getEnums();

    public function getById($id);

    public function create(Request $caja);

    public function update(Request $request, $id);

    public function delete($id);
}