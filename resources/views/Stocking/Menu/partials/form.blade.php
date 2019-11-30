@section('formularioMenu')
    <div class="form-group">
        {{ Form::text('Nombre_Plato', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Nombre del Plato/Artículo. Ej1.: Hamburguesa especial, Ej1.: Cerveza 750ml', 'value' => "old('Nombre_Plato')" ]) }}
        {{ Form::Number('Precio_Venta', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Precio de venta', 'step' => '0.001', 'min' => '0.001', 'value' => "old('Precio_Venta')" ]) }}
        {{ Form::text('Descripcion', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Descripción', 'value' => "old('Descripcion')" ]) }}
        {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}
    </div>
@endsection