<?php

namespace App\Repositories\SalesManagement\InvoiceManagement;

use Illuminate\Http\Request;

interface IBillRepository
{
    // public function getBills($fechaInicio, $fechaFin);

    public function getBills($request);

    public function getDayBills($fechaInicio);

    public function getById($id);

    public function create(Request $factura);

    public function createDetail(Request $request);

    public function getDetails($facturaId);

    public function update(Request $request, $id);

    public function updateDetail(Request $request, $id);

    public function destroyDetail($id);

    public function delete($id);

    public function cobrarFactura(Request $request, $id);
}