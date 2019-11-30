@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row-md-10">
            <div class="panel panel-default">
                <div class="panel-heading d-flex justify-content-between align-items-center">
                    <h1>Roles del sistema</h1>
                    <div class="form-group inline-block">
                        @can('roles.create')
                            <a href="{{ route('roles.create') }}" class="btn btn-success btn-md">Crear rol</a>
                        @endcan
                    </div>
                </div>
                <form role="search" class="navban-form navbar-left pull-right" method='GET'>
                    <div class="row justify-content-end" style="margin-bottom:30px">
                        <div class="form-goup">
                            <input type="text" name="texto" class="form-control" placeholder="Búsqueda">
                        </div>
                        <button type="submit" class="btn btn-default">Buscar</button>
                    </div>
                </form>
                <div class="panel-body">
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                @foreach($roles as $item)
                    <div class="col-md-50">
                        <div class="card" style="margin-bottom:30px">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h1>{{ $item->name }}</h1>
                                @can('roles.destroy')
                                {!! Form::open(['route' => ['roles.destroy', $item->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                    @csrf
                                    <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Está seguro que desea eliminar el item?.')">Eliminar...</button>
                                {!! Form::close() !!}
                                @endcan
                            </div>
                            @can('roles.show')
                                <a href="{{ route('roles.show', $item->id) }}" class="btn btn-secondary btn-sm btn-block">Ver...</a>
                            @endcan
                            @can('roles.edit')
                                <a href="{{ route('roles.edit', $item->id) }}" class="btn btn-primary btn-sm btn-block">Editar...</a>
                            @endcan
                            <div class="card-body">
                                <h4>Id: {{ $item->id }}</h4>
                                <h4>Caja: {{ $item->name }}</h4>
                                <h4>Descripción: {{ $item->description }}</h4>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{$roles->links()}}
            </div>
        </div>
    </div>
@endsection