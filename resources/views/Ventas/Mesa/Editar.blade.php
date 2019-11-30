@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Editar Caja</span>
                        <a href="{{ route('mesas.index') }}" class="btn btn-primary btn-sm">Volver...</a>
                    </div>
                    <div class="card-body">     
                        @if (session('mensaje'))
                            <div class="alert alert-success">
                                {{ session('mensaje') }}
                            </div>
                        @endif

                        {!! Form::model($mesa, ['route' => ['mesas.update', $mesa->id], 'method' => 'PUT']) !!}

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

                            {{ Form::text('Descripcion', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Descripción', 'value' => "old('Descripcion')" ]) }}
                            <!-- {{ Form::text('Estado', null, [ 'class' => 'form-control mb-2', 'placeholder' => 'Estado', 'value' => "old('Estado')" ]) }} -->
                            {{ Form::submit('Guardar', [ 'class' => 'btn btn-primary btn-block', 'type' => 'submit' ]) }}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection