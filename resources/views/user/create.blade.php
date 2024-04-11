@extends('layouts.app', ['page' => __('Adicionar Usuário'), 'pageSlug' => 'create_user'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-sm-8 text-center">
                        <h4 class="card-title">Adicionar Usuário</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('user.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Nome',
                                        'placeholder' => 'Nome',
                                        'name' => 'name',
                                        'maxLength' => 20,
                                        'icon' => 'fa-regular fa-user'
                                    ]
                                )
                            </div>
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Sobrenome',
                                        'placeholder' => 'Sobrenome',
                                        'name' => 'last_name',
                                        'maxLength' => 20,
                                        'icon' => 'fa-regular fa-user'
                                    ]
                                )
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'E-mail',
                                        'placeholder' => 'E-mail',
                                        'name' => 'email',
                                        'maxLength' => 50,
                                        'icon' => 'fa-regular fa-envelope'
                                    ]
                                )
                            </div>
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'CPF',
                                        'placeholder' => 'CPF',
                                        'name' => 'cpf',
                                        'maxLength' => 11,
                                        'icon' => 'fa-regular fa-address-card'
                                    ]
                                )
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Senha',
                                        'type' => 'password',
                                        'placeholder' => 'Senha',
                                        'name' => 'password',
                                        'maxLength' => 30,
                                        'icon' => 'fa-solid fa-lock'
                                    ]
                                )
                            </div>
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Confirmar Senha',
                                        'type' => 'password',
                                        'placeholder' => 'Confirmar Senha',
                                        'name' => 'password_confirmation',
                                        'maxLength' => 30,
                                        'icon' => 'fa-solid fa-lock'
                                    ]
                                )
                            </div>
                        </div>
                    </div>
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary btn-round btn-lg">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
