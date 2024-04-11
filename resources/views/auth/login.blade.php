@extends('layouts.app', ['class' => 'login-page', 'page' => __('Entrar'), 'contentClass' => 'login-page'])

@section('content')
    <div class="col-sm-10 text-center ml-auto mr-auto">
        <h3 class="mb-5">Faça o login para acessar o sistema de gerenciamento da biblioteca.</h3>
    </div>
    <div class="col-lg-4 col-sm-6 ml-auto mr-auto">
        <form class="form" method="post" action="{{ route('login') }}">
            @csrf

            <div class="card card-login">
                <div class="card-header">
                    <h1 class="card-title text-center text-info">Entrar</h1>
                </div>
                <div class="card-body">
                    <p>Digite seu e-mail e a senha para entrar.</p>
                    @include(
                            'components.input',
                            [
                                'placeholder' => 'E-mail',
                                'name' => 'email',
                                'maxLength' => 50,
                                'icon' => 'fa-regular fa-envelope'
                            ]
                        )

                        @include(
                            'components.input',
                            [
                                'type' => 'password',
                                'placeholder' => 'Senha',
                                'name' => 'password',
                                'icon' => 'fa-solid fa-lock'
                            ]
                        )
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-info btn-lg btn-block mb-3">Confirmar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
