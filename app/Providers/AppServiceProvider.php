<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

// Users Management
// use App\Repositories\ICRUD;
use App\Repositories\UsersManagement\IUserRepository;
// use App\Repositories\UsersManagement\IEmpleadoRepository; // Hasta antes de comentar esta línea funcionaba bien
use App\Repositories\UsersManagement\ManageUser;

// Administración de Cajas
use App\Repositories\SalesManagement\CashManagement\ICashRepository;
use App\Repositories\SalesManagement\CashManagement\ManageCash;

// Facturación
use App\Repositories\SalesManagement\InvoiceManagement\IBillRepository;
use App\Repositories\SalesManagement\InvoiceManagement\ManageBill;

// Gastos
use App\Repositories\ExpensesManagement\IExpenseRepository;
use App\Repositories\ExpensesManagement\ManageExpense;

// Stocking
use App\Repositories\StockingManagement\IMenuRepository;
use App\Repositories\StockingManagement\ManageMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        // $this->app->singleton(ICRUD::class, ManageUsers::class);
        $this->app->singleton(IUserRepository::class, ManageUser::class);
        $this->app->bind(ICashRepository::class, ManageCash::class);
        $this->app->bind(IBillRepository::class, ManageBill::class);
        $this->app->bind(IExpenseRepository::class, ManageExpense::class);
        $this->app->bind(IMenuRepository::class, ManageMenu::class);
        // $this->app->singleton(IEmpleadoRepository::class, ManageUser::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}
