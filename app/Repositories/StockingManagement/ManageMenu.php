<?php

namespace App\Repositories\StockingManagement;

use Illuminate\Http\Request;

use App\Menu;

class ManageMenu implements IMenuRepository
{

    /**
     * Inicialización Modelo
     * @var Menu
     */
    private $modeloMenu;

    public function __construct(Menu $modeloMenu)
    {
        $this->modeloMenu = $modeloMenu;
    }

    public function getAll()
    {
        return $this->modeloMenu->all();
    }

    public function searchMenuItem(Request $request)
    {
        return $this->modeloMenu->buscar($request->get('texto'));
    }

    public function getById($id)
    {
        return $this->modeloMenu->findOrFail($id);
    }

    public function create(Request $request)
    {
        $crearItem = new $this->modeloMenu;
        $crearItem->Nombre_Plato = $request->Nombre_Plato;
        $crearItem->Precio_Venta = $request->Precio_Venta;
        $crearItem->Descripcion = $request->Descripcion;
        $crearItem->save();
    }

    public function update(Request $request, $id)
    {
        $actualizarItem = $this->getById($id);
        $actualizarItem->Nombre_Plato = $request->Nombre_Plato;
        $actualizarItem->Precio_Venta = $request->Precio_Venta;
        $actualizarItem->Descripcion = $request->Descripcion;
        $actualizarItem->save();
    }

    public function destroy($id)
    {
        $eliminarMenuItem = $this->getById($id);
        $eliminarMenuItem->delete();
    }
}