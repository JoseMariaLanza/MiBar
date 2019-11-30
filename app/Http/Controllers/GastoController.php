<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Administración de Cajas
use App\Repositories\ExpensesManagement\ExpensesManagementFacade;

use Carbon\Carbon;

// REPORTING
use Barryvdh\DomPDF\Facade as PDF;

use App\Gasto;

class GastoController extends Controller
{
    /**
     * Inicialización de Fachada
     * 
     * @var ExpensesManagementFacade
     */
    private $expensesManagement;

    public function __construct(ExpensesManagementFacade $expensesManagement)
    {
        $this->middleware('auth');
        $this->expensesManagement = $expensesManagement;
    }

    public function index(Request $request)
    {
        $queryResult = $this->expensesManagement->obtenerGastos($request);
        $periodos = $this->expensesManagement->obtenerEnums();
        $gastos = $this->expensesManagement->separarGastos($queryResult)->paginate();
        $totalGastos = $this->expensesManagement->separaryObtenerTotal($queryResult);

        // fechas
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;

        return view('Gasto.Index', compact('gastos', 'periodos', 'totalGastos', 'fechaInicio', 'fechaFin'));
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
            'Concepto' => 'required',
            'Monto' => 'required',
            'Periodo' => 'required',
            'Descripcion' => 'required'
        ]);
        // $request->request->add(['Fecha']);
        // $request->Fecha = Carbon::now();

        $this->expensesManagement->crearGasto($request);

        return back()->with('mensaje', 'Gasto agregado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->expensesManagement->eliminarGasto($id);
        return back()->with('mensaje', 'Gasto eliminado correctamente');
    }

    public function showReport($fechaInicio, $fechaFin)
    {
        $queryGastos = Gasto::buscar($fechaInicio, $fechaFin)->orderBy('id', 'DESC');

        $queryResult = [];
        $queryResult['gastos'] = $queryGastos;
        $totalQueryGastos = $this->expensesManagement->calcularTotalGastos($queryGastos->get());
        $queryResult['totalQueryGastos'] = $totalQueryGastos;
        $gastos = $this->expensesManagement->separarGastos($queryResult)->get();
        $totalGastos = $this->expensesManagement->separaryObtenerTotal($queryResult);
        
        // Visualización del pdf
        $view = view('Reporting.PDF.Gastos', compact('gastos', 'totalGastos'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('gastos', 'totalGastos');

        // Visualización en vista
        // return view('Reporting.PDF.Gastos', compact('gastos', 'totalGastos'));

        // Descarga
        // $pdf = PDF::loadView('Reporting.PDF.Gastos', compact('gastos', 'totalGastos'));
        // return $pdf->download('gastos-list.pdf');
    }
}
