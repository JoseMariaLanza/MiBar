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
                @can('cajas.create')
                <div class="row justify-content-center" style="margin-bottom:30px">
                    <div class="col-md-8">
                        @include('Ventas.Caja.Crear')
                        @yield('agregarCaja')
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
                    <h1>Cajas</h1>
                    <form role="search" class="navban-form navbar-left pull-right" method='GET'>
                        <div class="row justify-content-end" style="margin-bottom:30px">
                            <div class="form-goup">
                                <input type="text" name="texto" class="form-control" placeholder="Búsqueda">
                            </div>
                            <button type="submit" class="btn btn-default">Buscar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($cajas as $item)
                    <div class="col-md-50">
                        <div class="card" style="margin-bottom:30px">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h1>{{ $item->Nombre_Caja }}</h1>
                                @can('cajas.destroy')
                                {!! Form::open(['route' => ['cajas.destroy', $item->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Está seguro que desea eliminar el item?.')">Eliminar...</button>
                                {!! Form::close() !!}
                                @endcan
                            </div>
                            @can('cajas.edit')
                            <a href="{{ route('cajas.edit', $item) }}" class="btn btn-primary btn-sm btn-block">Editar...</a>
                            @endcan
                            <div class="card-body">
                                <h4>Id: {{ $item->id }}</h4>
                                <h4>Caja: {{ $item->Nombre_Caja }}</h4>
                                <h4>Forma de Cobro: {{ $item->Forma_Cobro }}</h4>
                                <h4>Estado: {{ $item->Estado }}</h4>
                                <h4>Monto en caja: {{ $item->Monto_Inicial }}</h4>
                                <h4>Descripción: {{ $item->Descripcion }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$cajas->links()}}
            </div>
        </div>
    </div>
@endsection