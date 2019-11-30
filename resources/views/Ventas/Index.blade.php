@extends('layouts.app')

@section('content')
<div class="container">
    @can('ventas.index')
        <!-- <ventas /> -->

        <!-- Agregar Búsqueda por fechas aquí -->
        <!-- <form role="search" method='GET'> -->
        {!! Form::model(Request::all(), [ 'route' => 'ventas.index', 'method' => 'GET']) !!}
            <nav class="navbar navbar-light bg-light">
            <a class="navbar-brand" href="#">Filtros</a>
                <div class="form-row">
                    <label for="fechaInicio">Desde:</label>
                    <div class="col-auto">
                        <div class="form-goup">
                            {{ Form::date('fechaInicio', $fechaInicio, [ 'class' => 'form-control mb-2', 'value' => "old('fechaInicio')" ]) }}
                        </div>
                    </div>
                    <label for="fechaFin">Hasta:</label>
                    <div class="col-auto">
                        <div class="form-goup">
                            {{ Form::date('fechaFin', $fechaFin, [ 'class' => 'form-control mb-2', 'value' => "old('fechaFin')" ]) }}
                        </div>
                    </div>
                    <label for="estado">Estado</label>
                    <div class="col-auto">
                        <div class="form-goup">
                            {{ Form::select('estado', [
                            null => 'Seleccionar',
                            'FACTURADA' => 'Facturadas',
                            'EN EMISIÓN' => 'Emitidas',
                            'ANULADA' => 'Anuladas'
                            ], null,
                            [ 'class' => 'form-control mb-2', 'value' => "old('estado')" ]) }}
                        </div>
                    </div>
                    <label for="fechaFin">Forma de pago</label>
                    <div class="col-auto">
                        <div class="form-goup">
                            {{ Form::select('formaPago', [
                            null => 'Seleccionar',
                            'EFECTIVO' => 'Efectivo',
                            'TARJETA' => 'Tarjeta'
                            ], null,
                            [ 'class' => 'form-control mb-2', 'value' => "old('formaPago')" ]) }}
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-secondary">Buscar</button>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <a href="{{ route('ventas.index') }}" class="btn btn-outline-secondary">Limpiar</a>
                        </div>
                    </div>
                </div>
            </nav>
        <!-- </form> -->
        {!! Form::close() !!}

        @include('Ventas.Facturacion.partials.listaFacturas')
        @yield('listaFacturas')

        {!! $facturas->appends(Request::only(['fechaInicio', 'fechaFin', 'estado', 'formaPago']))->links() !!}

        <p class="h1 text-right">Total: ${{ $TotalFinalFacturas }}</p>

    @endcan
</div>
@endsection