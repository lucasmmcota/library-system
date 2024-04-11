@extends('layouts.app', ['page' => __('Editar Livro'), 'pageSlug' => 'edit_book'])

@section('content')
<div class="row">
    <div class="col-sm-12">
        @include('components.alerts.success', ['key' => 'success'])
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-2">
                        <a href="{{ route('book.index') }}" class="btn btn-sm btn-primary">Voltar</a>
                    </div>
                    <div class="col-sm-8 text-center">
                        <h4 class="card-title">Editar Livro</h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="form" method="post" action="{{ route('book.update', serialize($book['id'])) }}">
                    <div class="card-body">
                        @csrf
                        @method('put')
                    
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Título do Livro',
                                        'placeholder' => 'Título do Livro',
                                        'name' => 'title',
                                        'maxLength' => 50,
                                        'oldValue' => $book['title'],
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
                                        'oldValue' => $book['author'],
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
                                        'oldValue' => $book['book_publisher'],
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
                                        'oldValue' => $book['year'],
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
                                        'oldValue' => $book['edition'],
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
                                        'oldValue' => $book['volume'],
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
                                        'oldValue' => $book['ISBN'],
                                        'icon' => 'fa-solid fa-barcode'
                                    ]
                                )
                            </div>

                            <div class="col-sm-2 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Número de Cópias',
                                        'name' => 'number_copies',
                                        'oldValue' => $book['numberCopies'],
                                        'readOnly' => true,
                                        'icon' => 'fa-regular fa-copy'
                                    ]
                                )
                            </div>

                            <div class="col-sm-6 text-left">
                                @include(
                                    'components.input',
                                    [
                                        'label' => 'Acervos',
                                        'name' => 'book_copies',
                                        'oldValue' => $book['bookCopies'],
                                        'readOnly' => true,
                                        'icon' => 'fa-regular fa-folder-open'
                                    ]
                                )
                            </div>
                        </div>
                        
                        @include('book_copies.index', ['idBook' => $book['id']])

                        @include(
                            'components.input',
                            [
                                'type' => 'hidden',
                                'name' => 'id_book_copie',
                                'oldValue' => serialize($book['idBookCopie'])
                            ]
                        )
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
