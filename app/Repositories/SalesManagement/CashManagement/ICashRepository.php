<?php

namespace App\Repositories\SalesManagement\CashManagement;

use Illuminate\Http\Request;

interface ICashRepository
{
    public function getAll($request);

    public function getById($id);

    public function getByTerminal(Request $request);

    public function create(Request $caja);

    public function update(Request $request, $id);

    public function updateState(Request $request, $id);

    public function delete($id);
}