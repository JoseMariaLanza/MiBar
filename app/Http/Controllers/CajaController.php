<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Administración de Cajas
use App\Repositories\SalesManagement\SalesManagementFacade;
use App\Repositories\SalesManagement\CashManagement\ManageCash;

// Validaciones
// use Illuminate\Validation\Rule;
// use Illuminate\Support\Facades\Validator;
use App\Caja;

class CajaController extends Controller
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

    public function index(Request $request)
    {
        $cajas = $this->salesManagement->obtenerCajas($request)->paginate(5);
        return view('Ventas.Caja.Index', compact('cajas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->Terminal === 'on'){
            $request['Terminal'] = gethostname();
        }
        else
        {
            $request->Terminal = null;
        }

        $request->validate([
            'Nombre_Caja' => 'required|unique:cajas,Nombre_Caja',
            'Forma_Cobro' => 'required',
            'Descripcion' => 'required',
            'Terminal' => 'unique:cajas,Terminal'
        ]);

        $this->salesManagement->crearCaja($request);

        return back()->with('mensaje', 'Caja agregada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $caja = $this->salesManagement->obtenerCaja($id);
        // TODO: Obtener detalles de la caja.
        return view('Caja.Mostrar', compact('caja'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $caja = $this->salesManagement->obtenerCaja($id);
        return view('Ventas.Caja.Editar', compact('caja'));
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
        if($request->Terminal === 'on'){
            $request['Terminal'] = gethostname();
        }
        else
        {
            $request->Terminal = null;
        }

        $request->validate([
            'Nombre_Caja' => 'required',
            'Forma_Cobro' => 'required',
            'Descripcion' => 'required',
            'Terminal' => 'unique:cajas,Terminal'
        ]);

        $this->salesManagement->actualizarCaja($request, $id);
        return back()->with('mensaje', 'Caja actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->salesManagement->eliminarCaja($id);
        return back()->with('mensaje', 'Caja eliminada correctamente');
    }
}
