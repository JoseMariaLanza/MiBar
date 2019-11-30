@section('formularioUser')
    <div class="form-group">
        {{ Form::text('name', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Nombre de Usuario', 'value' => "old('name')" ]) }}
        {{ Form::text('email', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'E-mail', 'value' => "old('email')" ]) }}
        {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}
    </div>
    @can('roles.edit')
    <h3>Roles disponibles</h3>
    <div class="form-group">
        <ul class="list-unstyled">
            @foreach($roles as $role)
            <li>
                <label>
                    {{ Form::checkbox('roles[]', $role->id, null) }}
                    {{ $role->name }}
                    <em>({{ $role->description ? : 'N/A' }})</em>
                </label>
            </li>
            @endforeach
        </ul>
    </div>
    @endcan

@endsection