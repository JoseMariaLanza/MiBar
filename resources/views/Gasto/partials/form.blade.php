@section('formularioGasto')
    <div class="form-group">
        <!-- {{ Form::text('Concepto', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Concepto', 'value' => "old('Concepto')" ]) }} -->
        {{ Form::select('Concepto', [
            'Mercaderia' => 'Mercadería',
            'Babida' => 'Bebida',
            'Insumos' => 'Insumos',
            'Limpieza' => 'Limpieza',
            'Extras' => 'Extras',
            'Empleados' => 'Empleados',
            'Servicios' => 'Servicios'
        ], null,
        [ 'class' => 'form-control mb-2', 'placeholder' => 'Concepto', 'value' => "old('Concepto')" ]) }}

        {{ Form::number('Monto', null, [ 'class' => 'form-control mb-2', 'step' => '0.01', 'placeholder' => 'Monto del gasto', 'value' => "old('Monto')" ]) }}
        {{ Form::select('Periodo', $periodos, null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Seleccione una opción' ]) }}
        {{ Form::date('Fecha', Carbon\Carbon::now(), [ 'class' => 'form-control mb-2', 'value' => "old('Fecha')" ]) }}
        {{ Form::text('Descripcion', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Descripción', 'value' => "old('Descripcion')" ]) }}
        {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}
    </div>
@endsection