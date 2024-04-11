<div id="{{ $idModal }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="myModalLabel" style="color:white; font-size: 24px;">
                    {{ $title }}
                </h5>
            </div>
            <form class="form" method="post" action="{{ $route }}">
                @csrf
                @method($method)
                <div class="modal-body">
                    <div class="alert">{{ $message }}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">
                        Cancelar
                    </button>
                    @if ($method == 'put')
                        <button type="submit" class="btn btn-primary" aria-hidden="true">
                            Confirmar
                        </button>
                    @else
                        <button type="submit" class="btn btn-danger" aria-hidden="true">Excluir</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>