<?php

namespace App\Repositories\SalesManagement\InvoiceManagement;

use Illuminate\Http\Request;

use App\Factura;
use App\FacturaDetalle;

use Carbon\Carbon;

class ManageBill implements IBillRepository
{
    /**
     * Inicialización Modelo
     * @var Factura
     */
    private $modeloFactura;
    private $modeloDetalleFactura;

    public function __construct(Factura $modeloFactura, FacturaDetalle $modeloDetalleFactura)
    {
        $this->modeloFactura = $modeloFactura;
        $this->modeloDetalleFactura = $modeloDetalleFactura;
    }

    public function getBills($request){
        return $this->modeloFactura
        ->buscar($request->get('fechaInicio'), $request->get('fechaFin'))
        ->estado($request->get('estado'))
        ->formaPago($request->get('formaPago'))
        ->orderBy('id', 'DESC');
    }

    public function getDayBills($fechaInicio)
    {
        return $this->modeloFactura->buscarfacturasdia($fechaInicio)->orderBy('Fecha_Emision', 'DESC');
    }

    public function getById($id)
    {
        return $this->modeloFactura->findOrFail($id);
    }

    public function create(Request $request)
    {
        // Quitar comentarios para implementar los campos
        $nuevaFactura = new $this->modeloFactura();
        $nuevaFactura->Caja_Id = $request->Caja_Id; // nullable - No se muestra para el ingreso
        // $nuevaFactura->Usuario_Id = $request->User_Id; // nullable - No se muestra para el ingreso
        // $nuevaFactura->Serie = $request->Serie; // nullable - No se muestra para el ingreso
        // $nuevaFactura->Numero = $request->Numero; // nullable - No se muestra para el ingreso
        $nuevaFactura->Tipo = 'Factura A'; // $request->Tipo; // Temporalmente solo Factura A, después se implementará la selección de tipo de factura
        // mediante $request->Tipo
        // $nuevaFactura->Cliente_Id = $request->Cliente_Id; // nullable - No se muestra para el ingreso
        $nuevaFactura->Fecha_Emision = Carbon::now('America/Argentina/Buenos_Aires'); // $request->Fecha_Emision;
        $nuevaFactura->Estado = 'EN EMISIÓN'; // $request->Estado;
        $nuevaFactura->Total = $request->Total;
        $nuevaFactura->Descripcion = $request->Descripcion;
        $nuevaFactura->save();

        return $nuevaFactura;
    }

    public function createDetail(Request $request)
    {
        $nuevoDetalle = new $this->modeloDetalleFactura();
        $nuevoDetalle->Factura_Id = $request->Factura_Id;
        // Orden_Id
        $nuevoDetalle->Precio_Unitario = $request->Precio_Unitario;
        $nuevoDetalle->Cantidad = $request->Cantidad;
        $nuevoDetalle->Subtotal = $request->Subtotal;
        $nuevoDetalle->Descripcion = $request->Descripcion;
        $nuevoDetalle->Estado = 'REGISTRADA';
        $nuevoDetalle->save();
        return $nuevoDetalle;
    }

    public function getDetails($facturaId)
    {
        return $this->modeloDetalleFactura->buscardetalles($facturaId);
    }

    public function update(Request $request, $id)
    {
        // Quitar comentarios para implementar los campos
        $actualizarFactura = $this->modeloFactura->findOrFail($id);
        // $nuevaFactura->Caja_Id = $request->Caja_Id; // nullable - No se muestra para el ingreso
        // $nuevaFactura->Usuario_Id = $request->User_Id;  // nullable - No se muestra para el ingreso
        // $nuevaFactura->Serie = $request->Serie; // nullable - No se muestra para el ingreso
        // $nuevaFactura->Numero = $request->Numero; // nullable - No se muestra para el ingreso
        $actualizarFactura->Tipo = $request->Tipo;
        // $nuevaFactura->Cliente_Id = $request->Cliente_Id; // nullable - No se muestra para el ingreso
        // $actualizarFactura->Fecha_Emision = $request->Fecha_Emision;
        $actualizarFactura->Estado = $request->Estado;
        $actualizarFactura->Total = $request->Total;
        $actualizarFactura->Descripcion = $request->Descripcion; // nullable pero si se muestra
        $actualizarFactura->save();

        return $actualizarFactura;
    }

    public function updateState(Request $request, $id)
    {
        $actualizarFactura = $this->modeloFactura->findOrFail($id);
        $actualizarFactura->Estado = $request->Estado;
        $actualizarFactura->save();
        return $actualizarFactura;
    }

    public function updateDetail(Request $request, $id)
    {
        $actualizarDetalle = $this->modeloDetalleFactura->findOrFail($id);
        // $actualizarDetalle->Precio_Unitario = $request->Precio_Unitario;
        // $actualizarDetalle->Cantidad = $request->Cantidad;
        // $actualizarDetalle->Descripcion = $request->Descripcion;
        // $actualizarDetalle->Subtotal = $request->Subtotal;
        $actualizarDetalle->Estado = $request->Estado;
        $actualizarDetalle->save();
        return $actualizarDetalle;
    }

    public function anularDetalle($id)
    {
        $detalle = $this->modeloDetalleFactura->findOrFail($id);
        $detalle->Estado = 'ANULADA';
        $detalle->save();

        return $detalle;
    }

    public function destroyDetail($id)
    {
        $deleteDetail = $this->modeloDetalleFactura->findOrFail($id);
        $deleteDetail->delete();
    }

    public function delete($id)
    {
        // NO ELIMINA SINO QUE EDITA EL CAMPO 'Estado' a 'ANULADA'
        $anularFactura = $this->getById($id);
        $anularFactura->Estado = 'ANULADA';
        $anularFactura->save();

        return $anularFactura;
    }

    public function cobrarFactura(Request $request, $id)
    {
        $actualizarFactura = $this->modeloFactura->findOrFail($id);
        $actualizarFactura->Estado = 'FACTURADA';
        $actualizarFactura->Forma_Pago = $request->Forma_Pago;
        $actualizarFactura->save();
        return $actualizarFactura;
    }
}