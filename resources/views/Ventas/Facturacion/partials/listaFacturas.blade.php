@section('listaFacturas')
    <div class="row justify-content-center">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="col-ms-4">Nº de Factura</th>
                        <th>Descripción</th>
                        <th>Fecha y Hora de la venta</th>
                        <th>Total</th>
                        <th>Forma de pago</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="tableDataFacturas">
                    @foreach($facturas as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->Descripcion }}</td>
                            <td>{{ $item->Fecha_Emision }}</td>
                            <td>${{ $item->Total }}</td>
                            <td>{{ $item->Forma_Pago }}</td>
                            <td>{{ $item->Estado }}</td>
                            <td>
                            {!! Form::open(['route' => ['ventas.editar', $item->id], 'method' => 'GET']) !!}
                                <button class="btn btn-default btn-sm btn-inline">Modificar</button>
                            {!! Form::close() !!}
                            </td>
                            @if($item->Estado === 'EN EMISIÓN')
                                <td>
                                    <div class="form-row">
                                        <div class="col">
                                            <button class="btn btn-danger btn-sm btn-inline" data-toggle="modal" data-target="#modal{{ $item->id }}Anular">Anular</button>
                                        </div>
                                        {!! Form::open(['route' => ['ventas.anular', $item->id], 'method' => 'PUT']) !!}
                                            <div class="modal fade" id="modal{{ $item->id }}Anular" tabindex="-1" role="dialog" aria-labelledby="modal{{ $item->id }}AnularLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modal{{ $item->id }}AnularLabel">ANULANDO LA FACTURA</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h4>¿Está seguro que quiere anular la factura?</h4>
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
                                            <button class="btn btn-success btn-sm btn-inline" data-toggle="modal" data-target="#modal{{ $item->id }}Cobrar">Cobrar</button>
                                        </div>
                                        {!! Form::open(['route' => ['ventas.cobrar', $item->id], 'method' => 'PUT']) !!}
                                        <div class="modal fade" id="modal{{ $item->id }}Cobrar" tabindex="-1" role="dialog" aria-labelledby="modal{{ $item->id }}CobrarLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modal{{ $item->id }}CobrarLabel">Forma de Pago</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                    <div class="form-group">
                                                        <select class="custom-select my-1 mr-sm-2" name="Forma_Pago">
                                                            <option value="" selected>Seleccione una opción</option>
                                                            <option value="EFECTIVO">EFECTIVO</option>
                                                            <option value="TARJETA">TARJETA</option>
                                                        </select>
                                                    </div>
                                                    </form>
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
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection