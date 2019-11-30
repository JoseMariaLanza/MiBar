@section('formularioCerrar')
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
                            <div class="card">
                            <input type="hidden" id="cajaId" value="{{ $caja->id }}">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <div class="form-row-md-2">
                                        <div class="col">
                                            <h1>{{ $caja->Nombre_Caja }}</h1>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        @if($caja->Estado === 'ABIERTA')
                                        
                                        <div class="col-md-5">
                                            <h4>Monto final en caja: </h4>
                                        </div>
                                        
                                        <div class="col">
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">$</span>
                                                </div>
                                            {{ Form::hidden('Monto_Inicial', null) }}
                                            {{ Form::number('Monto_Final', null, [ 'class' => 'form-control', 'step' => '0.1', 'placeholder' => 'Monto final', 'value' => "old('Monto_Final')" ]) }}
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-md-3">
                                            @can('ventas.updateState')
                                            {{ Form::submit( $caja->Estado === 'CERRADA' ? 'Abrir Caja' : 'Cerrar caja', [ 'class' => 'btn btn-danger d-inline', 'type' => 'submit' ]) }}
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                                @if($caja->Estado === 'CERRADA')
                                <div class="card-body">
                                    <div class="form-group">
                                        
                                        
                                        <h4>Estado: {{ $caja->Estado }}</h4>
                                        <input name="Estado" type="hidden" value="{{ $caja->Estado }}">
                                        <h4>Forma de Cobro: {{ $caja->Forma_Cobro }}</h4>
                                        <h4>Terminal: {{ $caja->Terminal === gethostname() ? 'Este dispositivo' : $caja->Terminal }}</h4>
                                        {{ Form::hidden('Fecha_Hora_Apertura', null) }}
                                        {{ Form::hidden('Fecha_Hora_Cierre', null) }}
                                        <h4>Monto inicial en caja: </h4>
                                        {{ Form::number('Monto_Inicial', null, [ 'class' => 'form-control mb-2', 'step' => '0.1', 'placeholder' => 'Monto inicial en caja', 'value' => "old('Monto_Inicial')" ]) }}
                                        {{ Form::hidden('Monto_Final', null) }}
                                        <h4>Descripción: {{ $caja->Descripcion }}</h4>
                                        
                                        <!-- ELSE -->
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>    
</div>
@endsection