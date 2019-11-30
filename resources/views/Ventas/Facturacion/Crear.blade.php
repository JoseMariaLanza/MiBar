@section('agregarVenta')

<div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card" style="margin-bottom:30px">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h1>Venta</h1>
                    </div>

                    {!! Form::open(['route' => ['ventas.create'], 'method' => 'GET']) !!}
                        <div class="form-row p-2">
                            <div class="col-auto">
                                <label for="menus" class="my-1 mr-2">Búsqueda:</label>
                            </div>
                            <div class="col-auto">
                                <input class="form-control" type="text" placeholder="Buscar en menú" name="texto"id="busq">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-secondary">Buscar</button>
                            </div>
                            <!-- <div class="col-auto">
                                <button type="submit" class="btn btn-outline-secondary">Cargar menu completo</button>
                            </div> -->
                        </div>
                    {!! Form::close() !!}

                    <!-- Factura -->
                    {!! Form::open(['route' => ['ventas.store']]) !!}
                        <div class="form-inline p-2">
                            <div class="form-group">
                                <label class="my-1 mr-2">Mesas</label>
                                <select class="custom-select my-1 mr-sm-2" name="mesa">
                                    <option value="" selected>Seleccione una mesa</option>
                                    @foreach($mesas as $mesa)
                                        <option value="{{ $mesa }}">{{ $mesa->Descripcion }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label class="my-1 mr-2">Ingrese el sector</label>
                                <input placeholder="Sector" class="form-control my-1 mr-sm-2" name="Sector">
                            </div>
                            
                            <div class="form-group">
                                <label class="my-1 mr-2">Mozo</label>
                                <select class="custom-select my-1 mr-sm-2" id="mozos" name="mozo">
                                    <option value="" selected>Seleccione al mozo</option>
                                    @foreach($mozos as $mozo)
                                        <option value="{{ $mozo }}">{{ $mozo->Nombre . " " . $mozo->Apellido }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        @include('Stocking.Menu.partials.modalResultadosBusqueda')
                        @yield('modalResultadosBusqueda')
                        
                    {!! Form::close() !!}

                    <!-- Búsqueda por fuera para poder ejecutar formulario -->
                    {!! Form::open(['route' => ['ventas.create'], 'method' => 'GET']) !!}
                        <div class="form-row p-2">
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="form-control btn btn-outline-secondary" data-toggle="modal" data-target="#modalresultadosBusqueda">Ver Menú</button>
                                </div>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row-md-10">
                <div class="panel panel-default">
                    <div class="panel-heading d-flex justify-content-between align-items-center">
                        <h1>Ventas del día</h1>
                    </div>
                </div>
            </div>
            @include('Ventas.Facturacion.partials.listaNoFacturadas')
            @yield('listaNoFacturadas')
        </div>

@endsection