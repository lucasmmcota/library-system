@extends('layouts.app', ['page' => __('Controle'), 'pageSlug' => 'loan_control'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('components.alerts.success', ['key' => 'success', 'alert' => 'alert'])
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="card-title">Controle de Empréstimos</h4>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-sm-12">
                        @include(
                            'components.input',
                            [
                                'name' => 'searchInput',
                                'placeholder' => 'Pesquisar Empréstimo',
                                'icon' => 'fa-solid fa-magnifying-glass'
                            ]
                        )
                    </div>
                </div>
            </div>
            <div class="card-body">
                @include('components.table', ['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData])
            </div>
        </div>
    </div>
</div>
@endsection
