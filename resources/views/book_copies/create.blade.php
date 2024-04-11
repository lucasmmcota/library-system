<div class="text-center">
    <br><h4 class="card-title">Adicionar Cópias</h4><br>
</div>

<div class="row">
    <div class="col-sm-6 text-left">
        @include(
            'components.input',
            [
                'label' => 'Quantidade de Cópias',
                'placeholder' => 'Quantidade de Cópias',
                'name' => 'copies',
                'icon' => 'fa-regular fa-copy'
            ]
        )
    </div>
    <div class="col-sm-6 text-left">
        @include(
            'components.input',
            [
                'label' => 'Quantidade de Referência',
                'placeholder' => 'Quantidade de Referência',
                'name' => 'reference_books',
                'icon' => 'fa-regular fa-bookmark'
            ]
        )
    </div>
</div>
