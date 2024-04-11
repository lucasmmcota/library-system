@extends('layouts.app', ['page' => __('Editar Membro'), 'pageSlug' => 'edit_member'])

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('member.index') }}" class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-sm-8 text-center">
                        <h4 class="card-title">Editar Membro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('member.update', serialize($member['id'])) }}">
                    <div class="card-body">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Nome Completo',
                                        'placeholder' => 'Nome Completo',
                                        'name' => 'full_name',
                                        'maxLength' => 50,
                                        'oldValue' => $member['full_name'],
                                        'icon' => 'fa-regular fa-user'
                                    ]
                                )
                            </div>
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'E-mail',
                                        'placeholder' => 'E-mail',
                                        'name' => 'email',
                                        'maxLength' => 50,
                                        'oldValue' => $member['email'],
                                        'icon' => 'fa-regular fa-envelope'
                                    ]
                                )
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.select',
                                    [
                                        'id' => 'id_member_type',
                                        'label' => 'Tipo',
                                        'name' => 'id_member_type',
                                        'arrayValue' => $slMemberType,
                                        'oldValue' => $member['id_member_type'],
                                        'icon' => 'fa-solid fa-graduation-cap'
                                    ]
                                )
                            </div>
                            <div class="col-sm-3 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Telefone',
                                        'placeholder' => 'Telefone',
                                        'name' => 'phone',
                                        'maxLength' => 11,
                                        'oldValue' => $member['phone'],
                                        'icon' => 'fas fa-phone'
                                    ]
                                )
                            </div>
                            <div class="col-sm-3 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'CPF',
                                        'placeholder' => 'CPF',
                                        'name' => 'cpf',
                                        'maxLength' => 11,
                                        'oldValue' => $member['cpf'],
                                        'icon' => 'fa-regular fa-address-card'
                                    ]
                                )
                            </div>
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
