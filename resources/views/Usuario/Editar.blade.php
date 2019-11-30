@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Datos de la cuenta</span>
                        @can('users.index')
                            <a href="{{ route('users.index', $user->id) }}" class="btn btn-primary btn-sm">Ir a la lista de usuarios</a>
                        @endcan
                        
                            <a href="{{ route('Empleado.Detalles', $user->id) }}" class="btn btn-primary btn-sm">Ir a detalles</a>
                        
                    </div>
                    <div class="card-body">     
                        @if (session('mensaje'))
                            <div class="alert alert-success">
                                {{ session('mensaje') }}
                            </div>
                        @endif

                        {!! Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT']) !!}

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

                            @include('Usuario.partials.form')
                            @yield('formularioUser')

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection