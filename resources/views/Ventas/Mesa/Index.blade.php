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
                @can('mesas.create')
                <div class="row justify-content-center" style="margin-bottom:30px">
                    <div class="col">
                        {!! Form::open(['route' => ['mesas.store'], 'class' => 'd-inline']) !!}
                            @csrf
                            <button class="btn btn-success btn-sm" type="submit">Crear mesa nueva...</button>
                        {!! Form::close() !!}
                    </div>
                    
                </div>
                @endcan
            </div>
        </div>
    

    <div class="row justify-content-center">
        <div class="table-responsive">
            <!-- Mesas -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nº Real</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($mesas as $item)
                    <tr>
                        <td>{{ $item->Numero }}</td>
                        <td>{{ $item->Descripcion }}</td>
                        <td>{{ $item->Estado }}</td>
                        <td>
                        @can('mesas.edit')
                            {!! Form::open(['route' => ['mesas.edit', $item->id], 'method' => 'GET', 'class' => 'd-inline']) !!}
                                @csrf
                                <button class="btn btn-default btn-sm" type="submit">Editar...</button>
                            {!! Form::close() !!}
                        @endcan
                        @can('mesas.destroy')
                            {!! Form::open(['route' => ['mesas.destroy', $item->id], 'method' => 'DELETE', 'class' => 'd-inline']) !!}
                                @csrf
                                <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('¿Está seguro que desea eliminar esta mesa?.')">Eliminar...</button>
                            {!! Form::close() !!}
                        @endcan
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{$mesas->links()}}
        </div>
    </div>
    </div>
@endsection