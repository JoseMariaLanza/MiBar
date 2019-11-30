@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if (session('mensaje'))
                <div class="alert alert-success">
                    <h1>{{ session('mensaje') }}</h1>
                </div>
            @endif
            {!! Form::model($caja, ['route' => ['ventas.actualizarEstadoCaja', $caja], 'method' => 'PUT']) !!}
                @csrf
                @if (count($errors)>0)
                    @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">
                            {{ $error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach
                @endif
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="col-md-50">
                            <div class="card" style="margin-bottom:30px">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h1>{{ $caja->Nombre_Caja }}</h1>
                                    @can('ventas.actualizarEstadoCaja')
                                    {{ Form::submit( $caja->Estado === 'CERRADA' ? 'Abrir Caja' : 'Cerrar caja', [ 'class' => 'btn btn-success d-inline', 'type' => 'submit' ]) }}
                                    
                                    @endcan
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <h4>Estado: {{ $caja->Estado }}</h4>
                                        <input name="Estado" type="hidden" value="{{ $caja->Estado }}">
                                        <h4>Forma de Cobro: {{ $caja->Forma_Cobro }}</h4>
                                        <h4>Terminal: {{ $caja->Terminal === gethostname() ? 'Este dispositivo' : $caja->Terminal }}</h4>
                                        {{ Form::hidden('Fecha_Hora_Apertura', null) }}
                                        {{ Form::hidden('Fecha_Hora_Cierre', null) }}
                                        @if($caja->Estado === 'CERRADA')
                                            <h4>Monto inicial en caja: </h4>
                                            {{ Form::number('Monto_Inicial', null, [ 'class' => 'form-control mb-2', 'step' => '0.01', 'placeholder' => 'Monto inicial en caja', 'value' => "old('Monto_Inicial')" ]) }}
                                            {{ Form::hidden('Monto_Final', null) }}
                                        @else
                                            <h4>Monto final en caja: </h4>
                                            {{ Form::hidden('Monto_Inicial', null) }}
                                            {{ Form::number('Monto_Final', null, [ 'class' => 'form-control mb-2', 'step' => '0.01', 'placeholder' => 'Monto final en caja', 'value' => "old('Monto_Final')" ]) }}
                                        @endif
                                        <h4>Descripción: {{ $caja->Descripcion }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>    
</div>
@endsection