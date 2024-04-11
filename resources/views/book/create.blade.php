@extends('layouts.app', ['page' => __('Adicionar Livro'), 'pageSlug' => 'create_book'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('book.index') }}" class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-sm-8 text-center">
                        <h4 class="card-title">Adicionar Livro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('book.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Título do Livro',
                                        'placeholder' => 'Título do Livro',
                                        'name' => 'title',
                                        'maxLength' => 50,
                                        'icon' => 'fa-solid fa-book'
                                    ]
                                )
                            </div>
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Autor',
                                        'placeholder' => 'Autor',
                                        'name' => 'author',
                                        'maxLength' => 50,
                                        'icon' => 'fa-regular fa-user'
                                    ]
                                )
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Editora',
                                        'placeholder' => 'Editora',
                                        'name' => 'book_publisher',
                                        'maxLength' => 30,
                                        'icon' => 'fa-regular fa-building'
                                    ]
                                )
                            </div>
                            <div class="col-sm-2 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Ano',
                                        'placeholder' => 'Ano',
                                        'name' => 'year',
                                        'maxLength' => 5,
                                        'icon' => 'fa-regular fa-calendar-alt'
                                    ]
                                )
                            </div>
                            <div class="col-sm-3 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Edição',
                                        'placeholder' => 'Edição',
                                        'name' => 'edition',
                                        'maxLength' => 9,
                                        'icon' => 'fa-solid fa-pencil'
                                    ]
                                )
                            </div>
                            <div class="col-sm-3 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Volume',
                                        'placeholder' => 'Volume',
                                        'name' => 'volume',
                                        'maxLength' => 9,
                                        'icon' => 'fa-solid fa-layer-group'
                                    ]
                                )
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'ISBN',
                                        'placeholder' => 'ISBN',
                                        'name' => 'ISBN',
                                        'maxLength' => 13,
                                        'icon' => 'fa-solid fa-barcode'
                                    ]
                                )
                            </div>
                            <div class="col-sm-4 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Número de Cópias',
                                        'placeholder' => 'Número de Cópias',
                                        'name' => 'number_of_copies',
                                        'maxLength' => 9,
                                        'icon' => 'fa-regular fa-copy'
                                    ]
                                )
                            </div>
                            <div class="col-sm-4 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Número de Livros de Referência',
                                        'placeholder' => 'Número de Livros de Referência',
                                        'name' => 'number_of_reference_book',
                                        'maxLength' => 9,
                                        'icon' => 'fa-regular fa-bookmark'
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
