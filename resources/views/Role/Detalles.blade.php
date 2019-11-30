@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <span>Rol</span>
                        <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary btn-sm">Editar Rol...</a>
                    </div>
                    <div class="card-body">
                        <h1>{{ $role->name }}</h1>
                        <h4>Slug: {{ $role->slug }}</h4>
                        <h4>Descripción: {{ $role->description ? : 'N/A' }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection