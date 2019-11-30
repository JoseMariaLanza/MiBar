@section('resultadosBusqueda')
<div class="form-group">
    <div class="table-responsive">
        <table class="table table-hover">
            <div class="form-group">
                <select class="custom-select my-1 mr-sm-2" size="20" name="menu">
                    @foreach($menu as $platoArticuloMenu)
                        <option value="{{ $platoArticuloMenu }}">{{ $platoArticuloMenu->Nombre_Plato }}</option>
                    @endforeach
                </select>
            </div>
        </table>
    </div>
    <label for="cant" class="my-1 mr-2">Cantidad</label>
    <input type="number" step="0.001" min="0.001" placeholder="Cantidad" class="form-control my-1 mr-sm-2" id="cant" name="Cantidad" value="1">
</div>
@endsection