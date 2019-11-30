<?php

namespace App\Repositories\ExpensesManagement;

use Illuminate\Http\Request;

use App\Gasto;

class ManageExpense implements IExpenseRepository
{
    /**
     * Inicialización Modelo
     * @var Gasto
     */
    private $modeloGasto;

    public function __construct(Gasto $modeloGasto)
    {
        $this->modeloGasto = $modeloGasto;
    }

    public function getAll($request){
        return $this->modeloGasto->buscar($request->get('fechaInicio'), $request->get('fechaFin'))->orderBy('id', 'DESC');
    }

    public function getEnums()
    {
        return $this->modeloGasto->enums();
    }

    public function getById($id)
    {
        return $this->modeloGasto->findOrFail($id);
    }

    public function create(Request $request)
    {
        $nuevoGasto = new $this->modeloGasto();
        $nuevoGasto->Concepto = $request->Concepto;
        $nuevoGasto->Monto = $request->Monto;
        $nuevoGasto->Periodo = $request->Periodo;
        $nuevoGasto->Fecha = $request->Fecha;
        $nuevoGasto->Descripcion = $request->Descripcion;
        $nuevoGasto->save();
    }

    public function update(Request $request, $id)
    {
        $editarGasto = $this->getById($id);
        $editarGasto->Concepto = $request->Concepto;
        $editarGasto->Monto = $request->Monto;
        $editarGasto->Periodo = $request->Periodo;
        $editarGasto->Fecha = $request->Fecha;
        $editarGasto->Descripcion = $request->Descripcion;
        $editarGasto->save();
    }

    public function delete($id)
    {
        $anularGasto = $this->getById($id);
        $anularGasto->delete();
    }
}