<?php

namespace App\Repositories\StockingManagement;

use Illuminate\Http\Request;

use App\Repositories\StockingManagement\IMenuRepository;

class StockingManagementFacade
{
    /**
    * Inicialización de Interfaz
    * 
    * @var IMenuRepository
    *
    */
    private $manageMenu;

    public function __construct(IMenuRepository $manageMenu)
    {
        $this->manageMenu = $manageMenu;
    }

    public function getMenu()
    {
        return $this->manageMenu->getAll();
    }

    public function buscarMenuItem(Request $request)
    {
        return $this->manageMenu->searchMenuItem($request);
    }

    public function getMenuItem($id)
    {
        return $this->manageMenu->getById($id);
    }

    public function createMenuItem(Request $request)
    {
        $this->manageMenu->create($request);
    }

    public function updateMenuItem(Request $request, $id)
    {
        $this->manageMenu->update($request, $id);
    }

    public function deleteMenuItem($id)
    {
        $this->manageMenu->destroy($id);
    }
}