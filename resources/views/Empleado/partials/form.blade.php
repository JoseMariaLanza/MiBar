@section('formularioEmpleado')
    <div class="form-group">
        {{ Form::text('Apellido', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Apellidos', 'value' => "old('Apellido')" ]) }}
        {{ Form::text('Nombre', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Nombres', 'value' => "old('Nombre')" ]) }}
        {{ Form::date('Fecha_Nacimiento', Carbon\Carbon::now(), [ 'class' => 'form-control mb-2', 'placeholder' => 'Fecha de Nacimiento', 'value' => "old('Fecha_Nacimiento')" ]) }}
        {{ Form::text('Telefono', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Teléfono', 'value' => "old('Telefono')" ]) }}
        {{ Form::text('Domicilio', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Domicilio', 'value' => "old('Domicilio')" ]) }}
        {{ Form::text('Descripcion', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Descripción', 'value' => "old('Descripcion')" ]) }}
        {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}
    </div>
@endsection