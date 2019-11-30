@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Perfil</span>
                        <a href="{{ route('Empleado.Editar', $empleado->id) }}" class="btn btn-primary btn-sm">Editar datos personales...</a>
                    </div>
                    <div class="card-body">
                        <h1>{{ $empleado->Nombre }}</h1>
                        <h4>Apellidos: {{ $empleado->Apellido }}</h4>
                        <h4>Nombres: {{ $empleado->Nombre }}</h4>
                        <h4>Fecha de Nacimiento: {{ $empleado->Fecha_Nacimiento }}</h4>
                        <h4>Teléfono: {{ $empleado->Telefono }}</h4>
                        <h4>Domicilio: {{ $empleado->Domicilio }}</h4>
                        <h4>Descripción: {{ $empleado->Descripcion }}</h4>
                    </div>
                    <div class="card-header d-flex justify-content-between align-items-center">
                            <span>Datos de la cuenta</span>
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Editar datos de la cuenta...</a>
                    </div>
                    <div class="card-body">     
                        <h1>{{ $user->name }}</h1>
                        <h4>Nombre de usuario: {{ $user->name }}</h4>
                        <h4>E-mail: {{ $user->email }}</h4>
                        <h4>Descripción: {{ $user->Descripcion }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection