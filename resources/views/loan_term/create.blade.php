@extends('layouts.app', ['page' => __('Configurações'), 'pageSlug' => 'loan_config'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('components.alerts.success', ['key' => 'success'])
        <div class="card ">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-8">
                        <h4 class="card-title">Configurações de Empréstimo</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('loan_term.store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            @include(
                                'components.input',
                                [
                                    'label' => 'Dias de empréstimo para aluno',
                                    'placeholder' => 'Dias de empréstimo para aluno',
                                    'name' => 'days_student',
                                    'maxLength' => 11,
                                    'oldValue' => !empty($loanTerm) ? $loanTerm['days_student'] : '',
                                    'icon' => 'fa-regular fa-calendar-days'
                                ]
                            )
                        </div>
                        <div class="col-sm-4">
                            @include(
                                'components.input',
                                [
                                    'label' => 'Dias de empréstimo para professor',
                                    'placeholder' => 'Dias de empréstimo para professor',
                                    'name' => 'days_teacher',
                                    'maxLength' => 11,
                                    'oldValue' => !empty($loanTerm) ? $loanTerm['days_teacher'] : '',
                                    'icon' => 'fa-regular fa-calendar-days'
                                ]
                            )
                        </div>
                        <div class="col-sm-4">
                            @include(
                                'components.input',
                                [
                                    'label' => 'Número máximo de renovações',
                                    'placeholder' => 'Número máximo de renovações',
                                    'name' => 'max_renovations',
                                    'maxLength' => 11,
                                    'oldValue' => !empty($loanTerm) ? $loanTerm['max_renovations'] : '',
                                    'icon' => 'fas fa-sync'
                                ]
                            )
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
