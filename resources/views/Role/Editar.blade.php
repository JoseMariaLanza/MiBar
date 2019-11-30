@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Editar Rol</span>
                    <a href="{{ route('roles.index', $role->id) }}" class="btn btn-primary btn-sm">Volver a la lista de roles</a>
                </div>
                <div class="card-body">     
                    @if (session('mensaje'))
                        <div class="alert alert-success">
                            {{ session('mensaje') }}
                        </div>
                    @endif

                    {!! Form::model($role, ['route' => ['roles.update', $role->id], 'method' => 'PUT']) !!}

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

                            @include('Role.partials.form')
                            @yield('formularioRol')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection