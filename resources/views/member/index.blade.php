@extends('layouts.app', ['page' => __('Membros'), 'pageSlug' => 'member_control'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('components.alerts.success', ['key' => 'success', 'alert' => 'alert'])
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-6">
                        <h4 class="card-title">Membros</h4>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-7">
                        @include(
                            'components.input',
                            [
                                'name' => 'searchInput',
                                'placeholder' => 'Pesquisar Membro',
                                'icon' => 'fa-solid fa-magnifying-glass'
                            ]
                        )
                    </div>
                    <div class="col-sm-5 text-right">
                        <a href="{{ route('member.create') }}" class="btn btn-sm btn-primary">Adicionar Membro</a>
                        <a data-target="#import" data-toggle="modal" class="btn btn-sm btn-primary">Importar Membros</a>
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
        'title' => 'Importar Membros',
        'route' => 'member_import',
        'arrayEmail' => $arrayEmail,
        'arrayCpf' => $arrayCpf,
        'arrayPhone' => $arrayPhone,
        'message' => 'Para realizar a importação dos dados dos membros da sua instituição de ensino você deve criar um'
            . ' arquivo .csv em que a primeira linha é o cabeçalho e as colunas são, respectivamente, os campos:'
            . ' Nome Completo, Código do Tipo (1 = Professor(a) ou 2 = Aluno(a)), E-mail, Telefone (Somente números),'
            . ' CPF (Somente números). As demais linhas devem ser os dados a serem inseridos. É importante que todos'
            . ' os dados estejam preenchidos corretamente para evitar a ocorrência de erros.'
    ]
)

<script src="{{ asset('black/js/components/import.js') }}"></script>
<script src="{{ asset('black/js/validation/validator.js') }}"></script>
<script src="{{ asset('black/js/member/import.js') }}"></script>

@endsection
