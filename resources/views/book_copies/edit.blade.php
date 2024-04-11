<div class="text-center">
    <br><h4 class="card-title">Acervo {{ $book['idBookCopie'] }}</h4><br>
</div>

<br>

@include(
    'components.radio',
    [
        'message' => 'Livro de Referência:',
        'name' => 'reference_book',
        'reference_book' => $book['reference_book']
    ]
)
