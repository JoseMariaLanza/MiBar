@section('editarVenta')

    <div class="row justify-content-center">
        <div class="col-md-12">            
            @if (session('emisionRechazada'))
                <div class="alert alert-success">
                    {{ session('emisionRechazada') }}
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card" style="margin-bottom:30px">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h1>Venta</h1>
                </div>

                {!! Form::open(['route' => ['ventas.edit', $factura->id], 'method' => 'GET']) !!}
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
                {!! Form::open(['route' => ['ventas.update', $factura->id], 'method' => 'PUT', 'id' => 'formActualizarFactura']) !!}
                    <input type="hidden" value="{{ $factura }}" name="factura">
                    <!-- Descripción y Estado de la factura -->
                    <div class="form-row p-2">
                        <div class="col-auto">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-outline-secondary btn-sm btn-block" data-toggle="modal" data-target="#modalEstadoFactura">Modificar</button>
                                </div>
                                <fieldset disabled>
                                    <input type="text" class="form-control" value="{{ $factura->Estado }}">
                                </fieldset>
                            </div>
                        </div>
                        <div class="col">
                            <input disabled placeholder="Mesa/Mozo/Otras descripciones" class="form-control" rows="2" name="Descripcion" value="{{ $factura->Descripcion }}">
                        </div>
                    </div>
                    <div class="form-row p-2">
                        <div class="col">
                            <div class="form-group">
                                <button type="button" class="form-control btn btn-outline-secondary" data-toggle="modal" data-target="#modalresultadosBusqueda">Ver Menú</button>
                            </div>
                        </div>
                    </div>
                    
                    @include('Stocking.Menu.partials.modalResultadosBusqueda')
                    @yield('modalResultadosBusqueda')
                {!! Form::close() !!}

                <!-- Modal Form para edición de estado de la factura -->
                {!! Form::open(['route' => ['ventas.actualizarEstadoFactura', $factura->id], 'method' => 'PUT']) !!}
                    <input type="hidden" value="{{ $facturas }}" name="facturas">
                    <input type="hidden" value="{{ $factura->Estado }}" name="estadoActual">
                    <input type="hidden" value="{{ $factura }}" name="factura">
                    <div class="modal fade" id="modalEstadoFactura" tabindex="-1" role="dialog" aria-labelledby="modalEstadoFacturaLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalEstadoFacturaLabel">Modificando el estado de la venta</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-2">
                                    <select class="custom-select" name="Estado">
                                        <option value="" selected>Seleccione una opción</option>
                                        <option value="EN EMISIÓN">EMITIR</option>
                                        <option value="ANULADA">ANULAR<Rption>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary" >Aceptar</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                {!! Form::close() !!}

                <div class="card">
                    <div class="card-header">
                        <div class="h1">{{ $mesa[0]->Descripcion }}</div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-ms-4">Descripción del pedido</th>
                                    <th>$ por Unidad</th>
                                    <th>Cantidad</th>
                                    <th>Subtotal</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($detalle as $orden)
                                    <tr>
                                        <td>{{ $orden->Descripcion }}</td>
                                        <td>{{ $orden->Precio_Unitario }}</td>
                                        <td>{{ $orden->Cantidad }}</td>
                                        <td>{{ $orden->Subtotal }}</td>
                                        <td>{{ $orden->Estado }}</td>
                                        <td>
                                            <div class="form-row">
                                                <div class="col">
                                                    <button type="button" class="btn btn-default btn-sm btn-block" data-toggle="modal" data-target="#modal{{ $orden->id }}Orden">Modificar</button>
                                                </div>
                                                {!! Form::open(['route' => ['ventas.actualizarDetalleFactura', $orden->id], 'method' => 'PUT']) !!}
                                                    <input type="hidden" value="{{ $orden }}" name="orden">
                                                    <input type="hidden" value="{{ $factura }}" name="factura">
                                                    <div class="modal fade" id="modal{{ $orden->id }}Orden" tabindex="-1" role="dialog" aria-labelledby="{{ $orden->id }}OrdenLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="{{ $orden->id }}OrdenLabel">Modificando orden</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="input-group mb-2">
                                                                    <select class="custom-select" name="Estado">
                                                                        <option value="" selected>Seleccione una opción</option>
                                                                        <option value="REGISTRADA">REGISTRAR</option>
                                                                        <option value="ANULADA">ANULAR<Rption>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary" >Aceptar</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                                <div class="col">
                                                    <button class="btn btn-danger btn-sm btn-block" data-toggle="modal" data-target="#modal{{ $orden->id }}EliminarOrden">Eliminar</button>
                                                </div>
                                                {!! Form::open(['route' => ['ventas.eliminarDetalleFactura', $orden->id], 'method' => 'DELETE']) !!}
                                                    <input type="hidden" value="{{ $orden->Subtotal }}" name="subtotal">
                                                    <input type="hidden" value="{{ $orden->Estado }}" name="estadoActualOrden">
                                                    <input type="hidden" value="{{ $factura }}" name="factura">
                                                    <div class="modal fade" id="modal{{ $orden->id }}EliminarOrden" tabindex="-1" role="dialog" aria-labelledby="modalEliminarOrdenLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modal{{ $orden->id }}EliminarOrdenLabel">Eliminando la orden</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                                <div class="p-2">
                                                                    <h4>¿Está seguro que desea eliminar la orden?</h4>
                                                                    <h5>Esta acción no se puede deshacer.</h5>
                                                                </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                                <button type="submit" class="btn btn-primary" >Aceptar</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <p class="h1 text-right">Total: ${{ $factura->Total }}</p>
                <div class="form-inline">
                    <div class="form-inline p-2">
                        <button type="button" class="btn btn-danger btn-flex" data-toggle="modal" data-target="#modalAnularOrdenes">Anular todo</button>
                        {!! Form::open(['route' => ['ventas.anularDetallesFactura'], 'method' => 'PUT']) !!}
                            <input type="hidden" value="{{ $detalle }}" name="detalle">
                            <input type="hidden" value="{{ $factura }}" name="factura">
                            <div class="modal fade" id="modalAnularOrdenes" tabindex="-1" role="dialog" aria-labelledby="modalAnularOrdenesLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalAnularOrdenesLabel">ANULANDO ORDENES</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <h4>¿Está seguro que desea anular todas las ordenes?</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary" >Aceptar</button>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                    <div class="form-inline p-2">
                        <a class="btn btn-primary" href="/ventas/create" >Nueva venta</a>
                    </div>
                </div>

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