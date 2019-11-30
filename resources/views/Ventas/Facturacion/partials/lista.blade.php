@extends('layouts.app')

@section('content')
@foreach($detallesFactura as $detalleFactura)
    <tr>
        <td>{{ $detalleFactura->Descripcion }}</td>
        <td>{{ $detalleFactura->Precio_Unitario }}</td>
        <td>{{ $detalleFactura->Cantidad }}</td>
        <td>{{ $detalleFactura->Subtotal }}</td>
        <td>
        <!-- @can('factura.edit') -->
            <a href="{{ route('ventas.create', $detalleFactura) }}" class="btn btn-primary btn-sm btn-block">Quitar</a>
        <!-- @endcan -->
        </td>
    </tr>
@endforeach
@endsection