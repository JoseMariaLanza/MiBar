<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SalesManagement\SalesManagementFacade;
use App\Mesa;

class MesaController extends Controller
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
    public function index()
    {
        $mesas = Mesa::obtenertodas()->orderBy('id', 'DESC')->paginate(10);
        return view('Ventas.Mesa.Index', compact('mesas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mesaCreada = $this->salesManagement->crearMesa();
        $request->Numero = $mesaCreada->id;
        $request->Estado = 'LIBRE';
        $request->Descripcion = 'Mesa '.$mesaCreada->id;
        $this->salesManagement->actualizarMesa($request, $mesaCreada->id);
        return back()->with('mensaje', 'Mesa creada correctamente');
    }

    public function edit($id)
    {
        $mesa = Mesa::findOrFail($id);
        return view('Ventas.Mesa.Editar', compact('mesa'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Descripcion' => 'required'
        ]);

        $actualizarMesa = Mesa::findOrFail($id);
        $actualizarMesa->Descripcion = $request->Descripcion;
        $actualizarMesa->save();
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
        $eliminarMesa = Mesa::findOrFail($id);
        $eliminarMesa->delete();
        return back()->with('mensaje', 'Mesa eliminada correctamente');
    }
}
