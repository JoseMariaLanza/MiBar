@section('modalResultadosBusqueda')

    <div class="modal fade" id="modalresultadosBusqueda" tabindex="-1" role="dialog" aria-labelledby="modalresultadosBusquedaLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalresultadosBusquedaLabel">Resultados de la búsqueda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @include('Stocking.Menu.partials.resultadosBusqueda')
                @yield('resultadosBusqueda')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
            </div>
        </div>
    </div>
@endsection