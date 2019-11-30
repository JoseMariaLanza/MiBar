@section('formularioCaja')
    <div class="form-group">
        {{ Form::text('Nombre_Caja', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Nombre de la Caja. Ej.: Caja 001', 'value' => "old('Nombre_Caja')" ]) }}
        <!-- {{ Form::text('Forma_Cobro', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Forma de cobro', 'value' => "old('Forma_Cobro')" ]) }} -->
        {{ Form::select('Forma_Cobro', [
        'TODAS' => 'Todas las formas de cobro',
        'EFECTIVO' => 'Efectivo',
        'TARJETA' => 'Tarjeta'
        ], null,
        [ 'class' => 'form-control mb-2', 'value' => "old('Forma_Cobro')" ]) }}
        <!-- {{ Form::text('Estado', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Estado', 'value' => "old('Estado')" ]) }} -->
        <!-- {{ Form::select('Estado', [ 'ABIERTA' => 'Abrir', 'CERRADA' => 'Cerrar'], null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Seleccione un estado', 'value' => "old('Estado')" ]) }} -->
        {{ Form::label('Terminal', 'Este dispositivo ') }}
        {{ Form::checkbox('Terminal', 'Terminal' === true ? gethostname() : null) }}
        <!-- {{ Form::number('Monto_Inicial', null, [ 'class' => 'form-control mb-2', 'step' => '0.1', 'placeholder' => 'Monto en caja', 'value' => "old('Monto_Inicial')" ]) }} -->
        {{ Form::text('Descripcion', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Descripción', 'value' => "old('Descripcion')" ]) }}
        {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}
    </div>
@endsection