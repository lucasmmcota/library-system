@extends('layouts.app', ['page' => __('Perfil do Usuário'), 'pageSlug' => 'edit_user'])

@section('content')
<div class="row">
    <div class="col-sm-6">
        @include('components.alerts.success', ['key' => 'success'])
        <div class="card">
            <div class="card-header">
                <h5 class="title">Editar Usuário</h5>
            </div>
            <form method="post" action="{{ route('user.update', ['user' => serialize(auth()->user()->id)]) }}" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @method('put')
                    
                    @include(
                        'components.input',
                        [
                            'label' => 'Nome',
                            'placeholder' => 'Nome',
                            'name' => 'name',
                            'oldValue' => auth()->user()->name,
                            'maxLength' => 20,
                            'icon' => 'fa-regular fa-user'
                        ]
                    )

                    @include(
                        'components.input',
                        [
                            'label' => 'Sobrenome',
                            'placeholder' => 'Sobrenome',
                            'name' => 'last_name',
                            'oldValue' => auth()->user()->last_name,
                            'maxLength' => 20,
                            'icon' => 'fa-regular fa-user'
                        ]
                    )

                    @include(
                        'components.input',
                        [
                            'label' => 'E-mail',
                            'placeholder' => 'E-mail',
                            'name' => 'email',
                            'oldValue' => auth()->user()->email,
                            'maxLength' => 50,
                            'icon' => 'fa-regular fa-envelope'
                        ]
                    )

                    @include(
                        'components.input',
                        [
                            'label' => 'CPF',
                            'placeholder' => 'CPF',
                            'name' => 'cpf',
                            'oldValue' => auth()->user()->cpf,
                            'maxLength' => 11,
                            'icon' => 'fa-regular fa-address-card'
                        ]
                    )
                </div>
                <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-round btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-sm-6">
        @include('components.alerts.success', ['key' => 'password_status'])
        <div class="card">
            <div class="card-header">
                <h5 class="title">Alterar Senha</h5>
            </div>
            <form method="post" action="{{ route('user.password') }}" autocomplete="off">
                <div class="card-body">
                    @csrf
                    @method('put')
                    
                    @include(
                        'components.input',
                        [
                            'type' => 'password',
                            'label' => 'Senha Atual',
                            'placeholder' => 'Senha Atual',
                            'name' => 'old_password',
                            'maxLength' => 30,
                            'icon' => 'fa-solid fa-lock'
                        ]
                    )

                    @include(
                        'components.input',
                        [
                            'type' => 'password',
                            'label' => 'Nova Senha',
                            'placeholder' => 'Nova Senha',
                            'name' => 'password',
                            'maxLength' => 30,
                            'icon' => 'fa-solid fa-lock'
                        ]
                    )

                    @include(
                        'components.input',
                        [
                            'type' => 'password',
                            'label' => 'Confirmar Nova Senha',
                            'placeholder' => 'Confirmar Nova Senha',
                            'name' => 'password_confirmation',
                            'maxLength' => 30,
                            'icon' => 'fa-solid fa-lock'
                        ]
                    )
                </div>
                <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-round btn-primary">Alterar Senha</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
