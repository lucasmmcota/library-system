@extends('layouts.app', ['pageSlug' => 'home'])

@if (empty(auth()->user()->id))
    @section('content')
        <div class="header py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-sm-6">
                            <h1 class="text-white">Seja bem-vindo(a) ao SGBib!</h1>
                            <p class="text-lead text-light">
                                O SGBib é um sistema de gerenciamento de bibliotecas simples e eficiente.
                            </p>
                            <p class="text-lead text-light">
                                Faça o login no sistema para conseguir realizar empréstimos e devoluções. Além disso,
                                também é possível cadastrar livros e membros da sua instituição de ensino para
                                um melhor controle.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@endif
