<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Http\Requests\CopieRequest;
use App\Models\Book;
use App\Models\BookCopies;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the users
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $books = (new Book())->lstBook();
        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($books);
        $arrayIsbn = Book::query()->pluck('isbn')->toArray();

        return view('book.index')->with([
            'arrayHeader' => $arrayHeader,
            'arrayData' => $arrayData,
            'arrayIsbn' => $arrayIsbn
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        return view('book.create');
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param BookRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(BookRequest $request)
    {
        $validatedData = $request->validated();

        $this->insData($validatedData, $validatedData['number_of_copies'], $validatedData['number_of_reference_book']);

        return redirect()->route('book.index')->with('success', 'Livro(s) adicionado(s) com sucesso!');
    }

    /**
     * Display the specified resource.
     * @access public
     * @param string $id
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function edit(string $id)
    {
        $idBookCopie = unserialize($id);

        $book = ((new Book())->lstBook($idBookCopie))[0];

        $bookCopies = BookCopies::query()->where('id_book', '=', $book['id'])->pluck('id')->toArray();

        $book['numberCopies'] = count($bookCopies);
        $book['bookCopies'] = implode(", ", $bookCopies);

        return view('book.edit')->with('book', $book);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param CopieRequest $request
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CopieRequest $request, string $id)
    {
        $validatedData = $request->validated();

        $book = Book::findOrFail(unserialize($id));

        $book->update([
            'title' => $validatedData['title'],
            'author' => $validatedData['author'],
            'book_publisher' => $validatedData['book_publisher'],
            'edition' => $validatedData['edition'],
            'volume' => $validatedData['volume'],
            'year' => $validatedData['year'],
            'ISBN' => $validatedData['ISBN'],
            'id_user' => auth()->user()->id
        ]);

        $idBookCopie = $request->input('id_book_copie');

        $bookCopie = BookCopies::findOrFail(unserialize($idBookCopie));
        $bookCopie->update(['reference_book' => $request->input('reference_book')]);

        if ($validatedData['copies'] > 0) {
            $modelBookCopies = new BookCopies();

            $modelBookCopies->insBookCopies($book->id, $validatedData['reference_books'], 1);
            $modelBookCopies->insBookCopies($book->id, $validatedData['copies'] - $validatedData['reference_books']);

            (new Book())->updNumberOfCopies($book->id, $validatedData['copies']);
        }

        return redirect()->route('book.edit', ['book' => $idBookCopie])->with('success', 'Livro editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id
     */
    public function destroy(string $id)
    {
        //
    }

    /**
     * Import the specified resource from storage.
     * @access public
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        $file = $request->file('csv-file');
        
        $lines = file($file->getPathname());
        array_shift($lines);

        $lineRemove = json_decode($request->input('invalid-rows'));
        $filteredLines = $this->arrayFilter($lines, $lineRemove);

        foreach ($filteredLines as $line) {
            $columns = explode(';', $line);
            $columns[8] = str_replace("\r\n", '', $columns[8]);

            $this->insData($columns, $columns[6], $columns[7], true);
        }
        
        return redirect()->route('book.index')->with('success', 'Livro(s) importado(s) com sucesso!');
    }

    /**
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return [
            'Acervo',
            'Título',
            'Autor',
            'Editora',
            'Edição',
            'Volume',
            'Ano',
            'Nº de Cópias',
            'Livro de Referência',
            'ISBN',
            'Editar',
            'Excluir',
            'Gerar Etiqueta'
        ];
    }

    /**
     * Method to get table data
     * @access private
     * @param array $books
     * @return array $arrayData
     */
    private function getArrayData($books)
    {
        $arrayData = [];
        foreach ($books as $book) {
            $arrayData[] = [
                'collection' => $book['idBookCopie'],
                'title' => $book['title'],
                'author' => $book['author'],
                'book_publisher' => $book['book_publisher'],
                'edition' => $book['edition'],
                'volume' => $book['volume'],
                'year' => $book['year'],
                'number_of_copies' => $book['number_of_copies'],
                'reference_book' => $book['reference_book'] ? 'Sim' : 'Não',
                'ISBN' => $book['ISBN'],
                'edit' => $this->getIconEdit(serialize($book['idBookCopie']), 'book', 'Editar Livro'),
                'delete' => $this->getIconDelete(
                    $book['idBookCopie'],
                    'delete_book',
                    'book_copies',
                    'Excluir Livro',
                    'Você realmente deseja excluir este livro?'
                ),
                'tag' => $this->getIconNewPage(
                    serialize($book['idBookCopie']),
                    'generateTag',
                    '',
                    'fa fa-file-pdf',
                    '_blank',
                    'Gerar etiqueta'
                )
            ];
        }

        return $arrayData;
    }

    /**
     * Method to insert book and copies
     * @access private
     * @param array $book array with book data
     * @param int $numberOfCopies number of copies
     * @param int $numberOfReferenceBooks number of reference books
     * @param bool $import
     */
    private function insData($book, $numberOfCopies, $numberOfReferenceBooks, $import = false)
    {
        if (!$import) {
            $book = Book::create([
                'title' => $book['title'],
                'author' => $book['author'],
                'book_publisher' => $book['book_publisher'],
                'edition' => $book['edition'],
                'volume' => $book['volume'],
                'year' => $book['year'],
                'number_of_copies' => $book['number_of_copies'],
                'ISBN' => $book['ISBN'],
                'id_user' => auth()->user()->id
            ]);
        } else {
            $book = Book::create([
                'title' => $book[0],
                'author' => $book[1],
                'book_publisher' => $book[2],
                'edition' => $book[3],
                'volume' => $book[4],
                'year' => $book[5],
                'number_of_copies' => $book[6],
                'ISBN' => $book[8],
                'id_user' => auth()->user()->id
            ]);
        }

        $modelBookCopies = new BookCopies();

        $modelBookCopies->insBookCopies($book->id, $numberOfReferenceBooks, 1);
        $modelBookCopies->insBookCopies($book->id, $numberOfCopies - $numberOfReferenceBooks);
    }
}
