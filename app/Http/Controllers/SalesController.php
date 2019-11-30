<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SalesManagement\SalesManagementFacade;
use App\Repositories\SalesManagement\CashManagement\ManageBill;
use App\Caja;
use App\Factura;
use App\FacturaDetalle;
use App\Menu;

//Fechas
use Carbon\Carbon;

// Form accesible
use Collective\Html\Eloquent\FormAccessible;

class SalesController extends Controller
{
    /**
     * Inicialización de Fachada
     * 
     * @var SalesManagementFacade
     */
    private $salesManagement;

    public function __construct(SalesManagementFacade $salesManagement)
    {
        $this->middleware('auth');
        $this->salesManagement = $salesManagement;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $now = Carbon::now();
        if($fechaInicio === null){
            $fechaInicio = $now->timezone('America/Argentina/Buenos_Aires');
        }
        if($fechaFin === null){
            $fechaFin = $now->timezone('America/Argentina/Buenos_Aires');
        }

        $queryResult = $this->salesManagement->obtenerFacturas($request);

        $facturas = $this->salesManagement->separarFacturas($queryResult)->paginate(10);
        $TotalFinalFacturas = $this->salesManagement->separaryObtenerTotal($queryResult);

        return view('Ventas.Index', compact('facturas', 'TotalFinalFacturas', 'fechaInicio', 'fechaFin'));
    }

    public function buscar(Request $request)
    {
        $queryResult = $this->salesManagement->obtenerFacturas($request);

        $facturas = $this->salesManagement->separarFacturas($queryResult)->paginate(10);
        $TotalFinalFacturas = $this->salesManagement->separaryObtenerTotal($queryResult);

        return[
            'pagination' => [
                'total' => $facturas->total(),
                'current_page' => $facturas->currentPage(),
                'per_page' => $facturas->perPage(),
                'last_page' => $facturas->lastPage(),
                'from' => $facturas->firstItem(),
                'to' => $facturas->lastPage()
            ],
            // 'list' => [ //TODO: retornar un array con un elemento $facturas y otro totalFinalFacturas en SalesManagementFacade
            //     // y separarlo aquí en controlador para obtener las dos siguientes variables:
            //     'facturas' => $facturas, // Obtener mediante función en SalesManagementFacade
            //     'TotalFinalFacturas' => $TotalFinalFacturas // Obtener mediante función en SalesManagementFacade
            // ]
            'facturas' => $facturas,
            'TotalFinalFacturas' => $TotalFinalFacturas
        ];
        // return $facturas;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $caja = Caja::where('id', 1)->first();
        if ($caja->Estado === 'CERRADA'){
            return view('Ventas.Caja.partials.formAbrir', compact('caja'));
        }
        else{
            $mesas = $this->getMesas();
            $mozos = $this->getEmpleados();
            // $menu = $this->getMenu();
            // $menu = $this->buscarMenuItem($request);
            $menu = $this->salesManagement->buscarMenuItem($request);
            $fechaInicio = $caja->Fecha_Hora_Apertura;
            $caja->Monto_Final = null;
            $facturas = $this->salesManagement->obtenerFacturasDelDia($fechaInicio)->get();
            return view('Ventas.Crear', compact('caja', 'mesas', 'mozos', 'menu', 'facturas'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'Descripcion' => 'required'
            'mesa' => 'required',
            'Sector' => 'required',
            'mozo' => 'required',
            'menu' => 'required'
        ]);
        $mozoJson = $request->mozo;
        $mozo = json_decode($mozoJson,true);
        
        $nombreCompletoMozo = $mozo['Nombre'] . ' ' . $mozo['Apellido'];
        
        $mesaItemJson = $request->mesa;
        $mesaItem = json_decode($mesaItemJson,true);

        $descripcionFactura = $mesaItem['Descripcion'] . ' // ' . $request->Sector . ' // ' . $nombreCompletoMozo;
        $request['Descripcion'] = $descripcionFactura;

        $now = Carbon::now();
        $request['Fecha_Emision'] = $now->timezone('America/Argentina/Buenos_Aires');

        $menuItemJson = $request->menu;
        $menuItem = json_decode($menuItemJson,true);

        $subTotal = $menuItem['Precio_Venta'] * $request->Cantidad;

        $request['Total'] = $subTotal;
        
        $factura = $this->salesManagement->crearFactura($request);

        $requestMesa = new Request();
        $requestMesa['Estado'] = 'OCUPADA';
        $mesa = $this->actualizarEstadoMesa($requestMesa, $mesaItem['id']);

        $requestDetalle = new Request();
        $requestDetalle['Factura_Id'] = $factura->id;
        $requestDetalle['Descripcion'] = $menuItem['Nombre_Plato'];
        $requestDetalle['Precio_Unitario'] = $menuItem['Precio_Venta'];
        $requestDetalle['Cantidad'] = $request->Cantidad;
        $requestDetalle['Subtotal'] = $subTotal;
        
        $detalleItem = $this->storeDetail($requestDetalle);

        return redirect()->route('ventas.edit', $factura->id);
    }

    public function storeDetail(Request $request){
        return $this->salesManagement->crearDetalleFactura($request);
    }

    public function showDetails($facturaId){
        return $this->salesManagement->obtenerDetallesFactura($facturaId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        // $menu = $this->getMenu();
        // $menu = $this->buscarMenuItem($request);
        $menu = $this->salesManagement->buscarMenuItem($request);
        $factura = $this->getFactura($id);
        $mesa = $this->obtenerMesa($factura->Descripcion);
        $caja = Caja::where('id', 1)->first();
        $fechaInicio = $caja->Fecha_Hora_Apertura;
        $caja->Monto_Final = null;
        $facturas = $this->salesManagement->obtenerFacturasDelDia($fechaInicio)->get();
        $detalle = $this->showDetails($id);
        return view('Ventas.Editar', compact('caja', 'mesa', 'menu', 'factura', 'detalle', 'facturas'));
    }

    public function getFactura($id)
    {
        return $this->salesManagement->obtenerFactura($id);
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
            'menu' => 'required'
        ]);

        $facturaJson = $request->factura;
        $factura = json_decode($facturaJson,true);

        $menuJson = $request->menu;
        $menu = json_decode($menuJson,true);

        $subTotal = $menu['Precio_Venta'] * $request->Cantidad;

        $request['Descripcion'] = $factura['Descripcion'];
        $request['Tipo'] = $factura['Tipo'];
        $request['Estado'] = $factura['Estado'];
        $request['Total'] = $factura['Total'] + $subTotal;
        
        $this->salesManagement->actualizarFactura($request, $id);

        $requestDetalle = new Request();
        $requestDetalle['Factura_Id'] = $factura['id'];
        $requestDetalle['Descripcion'] = $menu['Nombre_Plato'];
        $requestDetalle['Precio_Unitario'] = $menu['Precio_Venta'];
        $requestDetalle['Cantidad'] = $request->Cantidad;
        $requestDetalle['Subtotal'] = $subTotal;
        
        $this->storeDetail($requestDetalle);
        return back();
    }

    public function actualizarEstadoFactura(Request $request, $id)
    {
        if ($this->salesManagement->comprobarMesaUnica($request) === 'LIBRE')
        {
            $factura = $this->salesManagement->actualizarEstadoFactura($request, $id);
            $mesa = $this->obtenerMesa($factura->Descripcion);
            $requestMesa = new Request();
            if ($request['Estado'] === 'ANULADA')
            {
                $requestMesa['Estado'] = 'LIBRE';
            }
            else
            {
                $requestMesa['Estado'] = 'OCUPADA';
            }
            $this->actualizarEstadoMesa($requestMesa, $mesa[0]['id']);
        }
        else if($request->Estado === 'ANULADA')
        {
            $factura = $this->salesManagement->actualizarEstadoFactura($request, $id);
            $mesa = $this->obtenerMesa($factura->Descripcion);
            $requestMesa = new Request();
            $requestMesa['Estado'] = 'LIBRE';
            $this->actualizarEstadoMesa($requestMesa, $mesa[0]['id']);
        }
        else{
            return back()->with('emisionRechazada', 'Ya hay una venta con la mesa registrada, no puede emitir esta factura');
        }
        return back();
    }

    public function actualizarDetalleFactura(Request $request, $id)
    {
        $this->salesManagement->actualizarDetalleFactura($request, $id);
        return back();
    }

    public function anularDetallesFactura(Request $request)
    {
        $detalleJson = $request->detalle;
        $detalle = json_decode($detalleJson,true);
        $factura = new Factura();
        $totalDetalles = 0;
        foreach($detalle as $orden)
        {
            if ($orden['Estado'] === 'REGISTRADA')
            {
                $totalDetalles += $orden['Subtotal'];
                $this->salesManagement->anularDetalle($request, $orden['id']);
            }
        }
        $facturaJson = $request->factura;
        $factura = json_decode($facturaJson,true);
        $facturaId = $factura['id'];

        $requestFactura = new Request();
        $requestFactura['Tipo'] = $factura['Tipo'];
        $requestFactura['Estado'] = $factura['Estado'];
        $requestFactura['Total'] = $factura['Total'];
        $requestFactura['Descripcion'] = $factura['Descripcion'];

        $requestFactura['Total'] -= $totalDetalles;

        $this->salesManagement->actualizarFactura($requestFactura, $facturaId);
        
        return back();
    }

    public function eliminarDetalleFactura(Request $request, $id) // anteriormente destroy
    {
        $facturaJson = $request->factura;
        $factura = json_decode($facturaJson,true);

        $facturaId = $factura['id'];

        $requestFactura = new Request();
        $requestFactura['Tipo'] = $factura['Tipo'];
        $requestFactura['Estado'] = $factura['Estado'];
        $requestFactura['Total'] = $factura['Total'];
        $requestFactura['Descripcion'] = $factura['Descripcion'];

        if($request->estadoActualOrden != 'ANULADA')
        {
            $requestFactura['Total'] -= $request->subtotal;
        }
        
        $this->salesManagement->actualizarFactura($requestFactura, $facturaId);
        $this->salesManagement->eliminarDetalleFactura($id);
        return back();
    }

    public function actualizarEstadoCaja(Request $request, $id)
    {
        if($request->Estado === 'CERRADA')
        {
            $request->validate([
                'Monto_Inicial' => 'required'
            ]);
            $request->Estado = 'ABIERTA';
            $request->Fecha_Hora_Apertura = Carbon::now('America/Argentina/Buenos_Aires');
        }
        else{
            $request->validate([
                'Monto_Final' => 'required'
            ]);
            $request->Estado = 'CERRADA';
            $request->Fecha_Hora_Cierre = Carbon::now('America/Argentina/Buenos_Aires');
        }
        $this->salesManagement->actualizarEstadoCaja($request, $id);
        return redirect()->route('ventas.create');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }

    public function anular(Request $request, $id) // anteriormente destroy
    {
        $factura = $this->salesManagement->anularFactura($id);
        $mesa = $this->obtenerMesa($factura->Descripcion);
        $requestMesa = new Request();
        $requestMesa['Estado'] = 'LIBRE';
        $this->actualizarEstadoMesa($requestMesa, $mesa[0]['id']);

        return back();
    }

    public function cobrar(Request $request, $id)
    {
        $request->validate([
            'Forma_Pago' => 'required'
        ]);
        
        $factura = $this->salesManagement->cobrarFactura($request, $id);
        $mesa = $this->obtenerMesa($factura->Descripcion);
        $requestMesa = new Request();
        $requestMesa['Estado'] = 'LIBRE';
        $this->actualizarEstadoMesa($requestMesa, $mesa[0]['id']);
        return back();
    }

    public function getMenu()
    {
        return $this->salesManagement->getMenu();
    }

    // MÉTODO SIN USAR
    // public function buscarMenuItem(Request $request)
    // {
    //     $menu = $this->salesManagement->buscarMenuItem($request);
    //     return view('Stocking.Menu.partials.modalResultadosBusqueda', compact('menu'));
    // }

    public function getEmpleados()
    {
        return $this->salesManagement->obtenerEmpleados();
    }

    public function getMesas()
    {
        return $this->salesManagement->obtenerMesas()->get();
    }

    public function obtenerMesa($descripcionFactura)
    {
        return $this->salesManagement->obtenerMesa($descripcionFactura)->get();
    }

    public function actualizarEstadoMesa(Request $request, $id)
    {
        return $this->salesManagement->actualizarEstadoMesa($request, $id)->get();
    }

    public function restoreMesa(Request $request)
    {
        return $this->salesManagement->restaurarMesa($request);
    }

    public function createMesa()
    {
        return $this->salesManagement->crearMesa();
    }

    public function updateMesa(Request $request, $id)
    {
        return $this->salesManagement->actualizarMesa($request, $id);
    }
}
