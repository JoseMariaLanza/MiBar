@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
    
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
            
                    @if (session('mensaje'))
                        <div class="alert alert-success">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                @can('gastos.create')
                <div class="row justify-content-center" style="margin-bottom:30px">
                    <div class="col-md-8">
                        @include('Gasto.Crear')
                        @yield('agregarGasto')
                    </div>
                    
                </div>
                @endcan
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row-md-10">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Gastos</h1>
                    <form role="search" class="navban-form navbar-left pull-right" method='GET'>
                        <div class="row justify-content-end" style="margin-bottom:30px">
                            <div class="col-md-2">Desde: </div>
                            <div class="form-goup">
                                {{ Form::date('fechaInicio', Carbon\Carbon::now(), [ 'class' => 'form-control mb-2', 'value' => "old('fechaInicio')" ]) }}
                            </div>
                            <div class="col-md-1">Hasta: </div>
                            <div class="form-goup">
                                {{ Form::date('fechaFin', Carbon\Carbon::now(), [ 'class' => 'form-control mb-2', 'value' => "old('fechaFin')" ]) }}
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="table-responsive">
                <!-- Gastos -->
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Concepto</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Monto</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($gastos as $item)
                        <tr>
                            <td>{{ $item->Concepto }}</td>
                            <td>{{ $item->Descripcion }}</td>
                            <td>{{ $item->Fecha }}</td>
                            <td>${{ $item->Monto }}</td>
                            <td>
                            @can('gastos.destroy')
                                {!! Form::open(['route' => ['gastos.destroy', $item->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Está seguro que desea eliminar el item?.')">Eliminar...</button>
                                {!! Form::close() !!}
                            @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{$gastos->links()}}
            </div>
            <!-- <div class="panel-heading d-flex justify-content-between align-items-center">
                <h1 class="d-flex">Total: ${{ $totalGastos }}</h1>
            </div> -->
        </div>
        <p class="h1 text-right">Total: ${{ $totalGastos }}</p>
        
        {!! Form::open(['route' => ['gastos.pdf', $fechaInicio, $fechaFin], 'method' => 'GET', 'class' => 'd-inline']) !!}
            <button type="submit" class="btn btn-primary btn-md">Imprimir</button>
        {!! Form::close() !!}

        <!-- {!! Form::open(['route' => ['gastos.pdf', $fechaInicio, $fechaFin], 'method' => 'GET', 'class' => 'd-inline']) !!}
            <button type="submit" class="btn btn-primary btn-md">Imprimir</button>
        {!! Form::close() !!} -->

    </div>
@endsection