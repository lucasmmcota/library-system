<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookCopies;
use App\Models\Loan;

class BookCopiesController extends Controller
{
    /**
     * Remove the specified resource from storage.
     * @access public
     * @param string $id serialized id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $idBookCopie = unserialize($id);

        if (empty((new Loan())->lstLoan(idBookCopie: $idBookCopie))) {
            $bookCopie = BookCopies::findOrFail($idBookCopie);

            $idBook = $bookCopie->id_book;

            Loan::where('id_book_copies', $idBookCopie)->delete();
            $bookCopie->delete();

            $book = new Book();
            $copies = $book->updNumberOfCopies($idBook, -1);

            if ($copies == 0) {
                $book = Book::findOrFail($idBook);
                $book->delete();

                $msg = 'Livro excluído com sucesso!';
            } else {
                $msg = 'Cópia excluída com sucesso!';
            }

            return redirect()->route('book.index')->with('success', $msg);
        }

        return redirect()->route('book.index')->with([
            'success' => 'Não foi possível excluir, o livro está emprestado.',
            'alert' => 'alert-warning'
        ]);
    }
}
