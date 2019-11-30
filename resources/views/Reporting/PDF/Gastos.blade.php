<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="row justify-content-center">
        <div class="table-responsive">
            <!-- Gastos -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Concepto</th>
                        <th>Descripción</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($gastos as $item)
                    <tr>
                        <td>{{ $item->Concepto }}</td>
                        <td>{{ $item->Descripcion }}</td>
                        <td>{{ $item->Fecha }}</td>
                        <td>${{ $item->Monto }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <p class="h1 text-right">Total: ${{ $totalGastos }}</p>
    </div>
</body>
</html>