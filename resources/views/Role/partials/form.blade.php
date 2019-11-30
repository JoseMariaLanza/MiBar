@section('formularioRol')

    <div class="form-group">
        {{ Form::text('name', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Rol', 'value' => "old('name')" ]) }}
        {{ Form::text('slug', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'URL Amigable', 'value' => "old('slug')" ]) }}
        {{ Form::text('description', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Descripción', 'value' => "old('description')" ]) }}
    </div>

    <h3>Permiso especial</h3>
    <div class="form-group">
        <label>{{ Form::radio('special', 'all-access') }} Acceso total</label>
        <label>{{ Form::radio('special', 'no-access') }} Ningún acceso</label>
    </div>

    <h3>Roles disponibles</h3>
    <div class="form-group">
        <ul class="list-unstyled">
            @foreach($permissions as $permission)
            <li>
                <label>
                    {{ Form::checkbox('permissions[]', $permission->id, null) }}
                    {{ $permission->name }}
                    <em>({{ $permission->description ? : 'N/A' }})</em>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}

@endsection