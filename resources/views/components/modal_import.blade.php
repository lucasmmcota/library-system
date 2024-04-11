<div id="import" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content bg-dark">
            <div class="modal-header">
                <h5 class="modal-title mx-auto" id="myModalLabel" style="color:white; font-size: 24px;">
                    {{ $title }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form" id="import-form" method="post" action="{{ $route }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div style="color: white;">{{ $message }}</div><br>
                    <div class="form-group">
                        <label class="text-primary">Clique para escolher arquivo</label>
                        <input type="file" id="csv-file" name="csv-file" onchange="updateFileName(this)">
                    </div>
                    <div id="csv-rows"></div>
                    @if (!empty($arrayEmail) && !empty($arrayCpf) && !empty($arrayPhone) && !empty($arrayMemberType))
                    <input type="hidden" id="array-email" name="array-email" value="{{ json_encode($arrayEmail) }}">
                    <input type="hidden" id="array-cpf" name="array-cpf" value="{{ json_encode($arrayCpf) }}">
                    <input type="hidden" id="array-phone" name="array-phone" value="{{ json_encode($arrayPhone) }}">
                    <input type="hidden" id="array-member-type" name="array-member-type" value="{{ json_encode($arrayMemberType) }}">
                    @elseif (!empty($arrayIsbn))
                    <input type="hidden" id="array-isbn" name="array-isbn" value="{{ json_encode($arrayIsbn) }}">
                    @endif
                    <input type="hidden" id="invalid-rows" name="invalid-rows">
                </div>
                <div class="modal-footer">
                    <button type="submit" name="submit-csv" class="btn btn-primary mx-auto">
                        Importar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
