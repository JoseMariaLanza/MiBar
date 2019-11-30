@extends('layouts.app')

@section('content')

<!-- Caja abierta -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">            
                @if (session('mensaje'))
                    <div class="alert alert-success">
                        {{ session('mensaje') }}
                    </div>
                @endif
            @can('ventas.updateState')
            <div class="row justify-content-center">
                <div class="col-md-12">
                    @include('Ventas.Caja.partials.formCerrar')
                    @yield('formularioCerrar')
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>

<!-- Facturar -->
<div class="container">

    <div class="col-md-12">
        <div class="col-md-50">
            @can('ventas.create')
                <div class="row justify-content-center" style="margin-bottom:30px">
                    <div class="col-md-12">
                        
                        <!-- Vue -->
                        <!-- <ventas-facturacion /> -->
                        @include('Ventas.Facturacion.Editar')
                        @yield('editarVenta')
                        
                    </div>
                </div>  
            @endcan
        </div>
    </div>
</div>
@endsection