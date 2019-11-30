<?php

namespace App\Repositories\SalesManagement;

use Illuminate\Http\Request;

use App\Repositories\SalesManagement\CashManagement\ICashRepository;
use App\Repositories\SalesManagement\InvoiceManagement\IBillRepository;
use App\Repositories\StockingManagement\IMenuRepository;
use App\CajaDetalle;
use App\Apertura;
use App\AperturaDetalle;
use App\Cierre;
use App\CierreDetalle;
use App\AperturaCierre;
use App\Menu;
use App\Empleado;

use App\Mesa;

use Illuminate\Support\Collection;

class SalesManagementFacade
{
    /**
    * Inicialización de Interfaz
    *
    * @var ICashRepository
    * @var IBillRepository
    * @var IMenuRepository
    * @var IEmployeeRepository
    */
    private $manageCash;
    private $manageBill;
    private $manageMenu;
    private $manageEmployee;

    public function __construct(ICashRepository $manageCash, IBillRepository $manageBill, IMenuRepository $manageMenu)
    {
        $this->manageCash = $manageCash;
        $this->manageBill = $manageBill;
        $this->manageMenu = $manageMenu;
    }

    public function obtenerCajas(Request $request)
    {
        return $this->manageCash->getAll($request);
    }

    public function obtenerCajaDeTerminal(Request $request)
    {
        return $this->manageCash->getByTerminal($request);
    }

    public function crearCaja(Request $request)
    {
        $this->manageCash->create($request);
    }

    public function agregarDetalleCaja(CajaDetalle $detalle)
    {
        CajaDetalle::create($detalle);
    }

    public function obtenerCaja($id)
    {
        return $this->manageCash->getById($id);
    }

    public function obtenerDetallesCaja($id)
    {
        return CajaDetalle::findOrFail($id); // Llamado desde el controlador
    }

    public function actualizarCaja($request, $id)
    {
        return $this->manageCash->update($request, $id);
    }

    public function actualizarEstadoCaja(Request $request, $id)
    {
        return $this->manageCash->updateState($request, $id);
    }

    public function actualizarDetallesCaja(Request $request, $id)
    {
        // No implementado
    }

    public function eliminarCaja($id)
    {
        $this->manageCash->delete($id);
    }

    // Facturación

    public function obtenerFactura($id)
    {
        return $this->manageBill->getById($id);
    }

    public function actualizarFactura(Request $request, $id)
    {
        $this->manageBill->update($request, $id);
    }

    public function actualizarEstadoFactura(Request $request, $id)
    {
        return $this->manageBill->updateState($request, $id);
    }

    public function comprobarMesaUnica(Request $request)
    {
        $facturaJson = $request->factura;
        $factura = json_decode($facturaJson,true);
        $mesaFactura = $this->obtenerMesa($factura['Descripcion'])->get();

        $mesas = Mesa::all();
        foreach($mesas as $mesa)
        {
            if ($mesaFactura[0]->id === $mesa->id)
            {
                return $mesa->Estado;
            }
        }
    }

    public function actualizarDetalleFactura(Request $request, $id)
    {
        $ordenJson = $request->orden;
        $orden = json_decode($ordenJson,true);

        if ($orden['Estado'] != $request->Estado)
        {
            $this->manageBill->updateDetail($request, $id);

            $facturaJson = $request->factura;
            $factura = json_decode($facturaJson,true);
            $facturaId = $factura['id'];

            $requestFactura = new Request();
            $requestFactura['Tipo'] = $factura['Tipo'];
            $requestFactura['Estado'] = $factura['Estado'];
            $requestFactura['Total'] = $factura['Total'];
            $requestFactura['Descripcion'] = $factura['Descripcion'];

            if ($request->Estado === 'REGISTRADA') // if ($detalle['Estado'] === 'ANULADA')
            {
                $requestFactura['Total'] += $orden['Subtotal'];
            }
            else
            {
                $requestFactura['Total'] -= $orden['Subtotal'];
            }

            $this->actualizarFactura($requestFactura, $facturaId);
        }
    }

    public function anularDetalle(Request $request, $id)
    {
        return $this->manageBill->anularDetalle($id);
    }

    public function eliminarDetalleFactura($id)
    {
        $this->manageBill->destroyDetail($id);
    }

    public function obtenerFacturas(Request $request)
    {
        $facturas = $this->manageBill->getBills($request);
        $queryResult = [];
        $queryResult['facturas'] = $facturas;
        $totalQueryFacturas = $this->calcularTotalVentas($facturas->get()); // con get() abtengo el array para poder recorrerlo
        $queryResult['totalQueryFacturas'] = $totalQueryFacturas;
        return $queryResult;
    }

    public function separarFacturas($queryResult)
    {
        return $queryResult['facturas'];
    }

    public function separaryObtenerTotal($queryResult)
    {
        return $queryResult['totalQueryFacturas'];
    }

    public function calcularTotalVentas($facturas)
    {
        $total = 0.00;
        foreach($facturas as $factura){
            if($factura->Estado == 'FACTURADA'){
                $total += $factura->Total;
            }
        }
        return $total;
    }

    public function obtenerFacturasDelDia($fechaInicio)
    {
        return $this->manageBill->getDayBills($fechaInicio);
    }

    public function crearFactura(Request $request)
    {
        return $this->manageBill->create($request);
    }

    public function crearDetalleFactura(Request $request)
    {
        return $this->manageBill->createDetail($request);
    }

    public function obtenerDetallesFactura($facturaId)
    {
        return $this->manageBill->getDetails($facturaId);
    }

    public function anularFactura($id)
    {
        return $this->manageBill->delete($id);
    }

    public function cobrarFactura(Request $request, $id)
    {
        return $this->manageBill->cobrarFactura($request, $id);
    }

    public function getMenu()
    {
        return $this->manageMenu->getAll();
    }

    public function buscarMenuItem(Request $request)
    {
        return $this->manageMenu->searchMenuItem($request)->get();
    }

    public function obtenerEmpleados()
    {
        return Empleado::all();
    }

    public function obtenerMesas()
    {
        return Mesa::buscar();
    }

    public function actualizarEstadoMesa(Request $request, $id)
    {
        $actualizarEstado = Mesa::findOrFail($id);
        $actualizarEstado->Estado = $request->Estado;
        $actualizarEstado->save();
        return $actualizarEstado;
    }

    public function restaurarMesa(Request $request)
    {
        return Mesa::buscarpornombre($request->get('texto'))->get();
    }

    public function obtenerMesa($descripcionFactura)
    {
        return Mesa::buscarpornombre($descripcionFactura);
    }

    public function crearMesa()
    {
        $crearMesa = new Mesa();
        $crearMesa->save();
        return $crearMesa;
        // $crearMesa->Numero = $crearMesa->id;
        // $crearMesa->Descripcion = 'Mesa ' + $crearMesa->id;
        // $crearMesa->save();
        // return $crearMesa;
        // $idNuevaMesa = $crearMesa->id;
        // return $actualizarMesa = Mesa::findOrFail($idNuevaMesa);
        // $actualizarMesa->Numero = $idNuevaMesa;
        // $actualizarMesa->Descripcion = 'Mesa ' + $idNuevaMesa;
        // $actualizarMesa->Estado = 'LIBRE';
        // $actualizarMesa->save();
        // return $actualizarMesa;
    }

    public function actualizarMesa(Request $request, $id)
    {
        $actualizarMesa = Mesa::findOrFail($id);
        $actualizarMesa->Numero = $request->Numero;
        $actualizarMesa->Descripcion = $request->Descripcion;
        $actualizarMesa->Estado = $request->Estado;
        $actualizarMesa->save();
        return $actualizarMesa;
    }
}