<?php

namespace App\Repositories\ExpensesManagement;

use Illuminate\Http\Request;

use App\Repositories\ExpensesManagement\IExpenseRepository;

class ExpensesManagementFacade
{
    /**
    * Inicialización de Interfaz
    * 
    * @var IExpenseRepository
    */
    private $manageExpense;

    public function __construct(IExpenseRepository $manageExpense)
    {
        $this->manageExpense = $manageExpense;
    }

    public function obtenerGastos(Request $request)
    {
        // return $this->manageExpense->getAll($request);
        $gastos = $this->manageExpense->getAll($request);
        $queryResult = [];
        $queryResult['gastos'] = $gastos;
        $totalQueryGastos = $this->calcularTotalGastos($gastos->get()); // con get() abtengo el array para poder recorrerlo
        $queryResult['totalQueryGastos'] = $totalQueryGastos;
        return $queryResult;
    }

    public function separarGastos($queryResult)
    {
        return $queryResult['gastos'];
    }

    public function separaryObtenerTotal($queryResult)
    {
        return $queryResult['totalQueryGastos'];
    }

    public function calcularTotalGastos($gastos)
    {
        $total = 0.00;
        foreach($gastos as $gasto){
            $total += $gasto->Monto;
        }
        return $total;
    }

    public function obtenerEnums()
    {
        return $this->manageExpense->getEnums();
    }

    public function crearGasto(Request $request)
    {
        $this->manageExpense->create($request);
    }

    public function actualizarGasto($request, $id)
    {
        return $this->manageExpense->update($request, $id);
    }

    public function eliminarGasto($id)
    {
        return $this->manageExpense->delete($id);
    }
}