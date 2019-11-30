@section('agregarItem')
    <h1>Agregar Item</h1>

    {!! Form::open(['route' => ['menu.store']]) !!}

        @csrf

        @include('Stocking.Menu.partials.form')
        @yield('formularioMenu')

    {!! Form::close() !!}
@endsection