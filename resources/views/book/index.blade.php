@extends('layouts.app', ['page' => __('Livros'), 'pageSlug' => 'book_control'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('components.alerts.success', ['key' => 'success', 'alert' => 'alert'])
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title">Livros</h4>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-6">
                        @include(
                            'components.input',
                            [
                                'name' => 'searchInput',
                                'placeholder' => 'Pesquisar Livro',
                                'icon' => 'fa-solid fa-magnifying-glass'
                            ]
                        )
                    </div>
                    <div class="col-sm-6 text-right">
                        <a href="{{ route('book.create') }}" class="btn btn-sm btn-primary">Adicionar Livro</a>
                        <a href="#import" data-toggle="modal" class="btn btn-sm btn-primary">Importar Livros</a>
                        <a href="generateTag" target="_blank" title="Gerar todas as etiquetas" class="btn btn-sm btn-primary">Gerar Etiquetas</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.table', ['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData])
            </div>
        </div>
    </div>
</div>

@include(
    'components.modal_import',
    [
        'title' => 'Importar Livros',
        'route' => 'book_import',
        'arrayIsbn' => $arrayIsbn,
        'message' => 'Para realizar a importação dos dados dos membros da sua instituição de ensino você deve criar um'
            . ' arquivo .csv em que a primeira linha é o cabeçalho e as colunas são, respectivamente, os campos:'
            . ' Título do Livro, Autor, Editora, Edição, Volume, Ano, Número de Cópias, Número de Livros de Referência.'
            . ' As demais linhas devem ser os dados a serem inseridos. É importante que todos os dados estejam'
            . ' preenchidos corretamente para evitar a ocorrência de erros.'
    ]
)

<script src="{{ asset('black/js/components/import.js') }}"></script>
<script src="{{ asset('black/js/validation/validator.js') }}"></script>
<script src="{{ asset('black/js/book/import.js') }}"></script>

@endsection
