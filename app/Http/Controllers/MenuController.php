<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\StockingManagement\StockingManagementFacade;

class MenuController extends Controller
{
    
    /**
     * Inicialización de Fachada
     * 
     * @var StockingManagementFacade
     */
    private $stockingManagement;

    public function __construct(StockingManagementFacade $stockingManagement)
    {
        $this->middleware('auth');
        $this->stockingManagement = $stockingManagement;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $menu = $this->stockingManagement->buscarMenuItem($request)->orderBy('id', 'DESC')->paginate(10);
        return view('Stocking.Menu.Index', compact('menu'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $request->validate([
            'Nombre_Plato' => 'required|unique:cajas,Nombre_Caja',
            'Precio_Venta' => 'required'
        ]);

        $this->stockingManagement->createMenuItem($request);

        return back()->with('mensaje', 'Item creado correctamente');
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
    public function edit($id)
    {
        $menuItem = $this->stockingManagement->getMenuItem($id);
        return view('Stocking.Menu.Editar', compact('menuItem'));
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
            'Nombre_Plato' => 'required|unique:cajas,Nombre_Caja',
            'Precio_Venta' => 'required'
        ]);

        $this->stockingManagement->updateMenuItem($request, $id);

        // return back()->with('mensaje', 'Item actualizado correctamente');
        
        // Volver a Menú
        $menu = $this->stockingManagement->buscarMenuItem($request)->orderBy('id', 'DESC')->paginate(10);
        return view('Stocking.Menu.Index', compact('menu'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->stockingManagement->deleteMenuItem($id);
        return back()->with('mensaje', 'Item eliminado correctamente');
    }
}
