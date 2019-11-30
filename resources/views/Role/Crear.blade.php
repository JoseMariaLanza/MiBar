@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">
                    {{ $error }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endforeach
        
            @if (session('mensaje'))
                <div class="alert alert-success">
                    {{ session('mensaje') }}
                </div>
            @endif
                
            {!! Form::open(['route' => ['roles.store']]) !!}
            
            @csrf
            @can('roles.create')
                <div class="row justify-content-center" style="margin-bottom:30px">
                    <div class="col-md-8">
                    <h1>Nuevo rol</h1>
                        @include('Role.partials.form')
                        @yield('formularioRol')
                    </div>
                </div>
            @endcan
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection