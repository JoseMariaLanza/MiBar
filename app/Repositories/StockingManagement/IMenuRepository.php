<?php

namespace App\Repositories\StockingManagement;

use Illuminate\Http\Request;

interface IMenuRepository
{
    public function getAll();

    public function searchMenuItem(Request $request);

    public function getById($id);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function destroy($id);
}