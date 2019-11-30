<?php

namespace App\Repositories\SalesManagement\CashManagement;

use Illuminate\Http\Request;

use App\Caja;

class ManageCash implements ICashRepository
{
    /**
     * Inicialización Modelo
     * @var Caja
     */
    private $modeloCaja;

    public function __construct(Caja $modeloCaja)
    {
        $this->modeloCaja = $modeloCaja;
    }

    public function getAll($request){
        return $this->modeloCaja->buscar($request->get('texto'))->orderBy('id', 'DESC');
    }

    public function getById($id)
    {
        return $this->modeloCaja->findOrFail($id);
    }

    public function getByTerminal($request){
        return $this->modeloCaja->obtenercaja($request);
    }

    public function create(Request $request)
    {
        $nuevaCaja = new $this->modeloCaja();
        $nuevaCaja->Nombre_Caja = $request->Nombre_Caja;
        $nuevaCaja->Forma_Cobro = $request->Forma_Cobro;
        $nuevaCaja->Estado = 'CERRADA';// $request->Estado;
        // $nuevaCaja->Terminal = gethostname();
        $nuevaCaja->Monto_Inicial = $request->Monto_Inicial;
        $nuevaCaja->Descripcion = $request->Descripcion;
        $nuevaCaja->save();

        // return $this->modeloCaja->create($caja);
    }

    public function update(Request $request, $id)
    {
        $cajaUpdate = $this->getById($id);
        $cajaUpdate->Nombre_Caja = $request->Nombre_Caja;
        $cajaUpdate->Forma_Cobro = $request->Forma_Cobro;
        // $cajaUpdate->Estado = $request->Estado; // Campo no editable desde este método
        $cajaUpdate->Terminal = $request->Terminal;
        $cajaUpdate->Monto_Inicial = $request->Monto_Inicial;
        $cajaUpdate->Descripcion = $request->Descripcion;
        $cajaUpdate->save();
    }

    public function delete($id)
    {
        $eliminarCaja = $this->getById($id);
        $eliminarCaja->delete();
    }

    public function updateState(Request $request, $id)
    {
        $caja = $this->getById($id);
        // $cajaUpdate->Nombre_Caja = $request->Nombre_Caja;
        // $cajaUpdate->Forma_Cobro = $request->Forma_Cobro;
        $caja->Estado = $request->Estado;
        // $cajaUpdate->Terminal = gethostname();
        $caja->Monto_Inicial = $request->Monto_Inicial;
        $caja->Monto_Final = $request->Monto_Final;
        $caja->Fecha_Hora_Apertura = $request->Fecha_Hora_Apertura;
        $caja->Fecha_Hora_Cierre = $request->Fecha_Hora_Cierre;
        $caja->Descripcion = $request->Descripcion;
        $caja->save();

        return $caja;
    }
}