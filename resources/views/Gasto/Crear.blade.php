@section('agregarGasto')
    <h1>Agregar un gasto</h1>

    {!! Form::open(['route' => ['gastos.create']]) !!}

        @csrf

        @include('Gasto.partials.form')
        @yield('formularioGasto')

    {!! Form::close() !!}
@endsection