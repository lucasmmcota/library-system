<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'author',
        'book_publisher',
        'edition',
        'volume',
        'year',
        'number_of_copies',
        'ISBN',
        'id_user'
    ];

    /**
     * Method to list the books
     * @access public
     * @param int|null $idBookCopie id of table book_copies
     * @param bool $forLoan
     * @return array array of book copies
     */
    public function lstBook(int $idBookCopie = null, bool $forLoan = false)
    {
        $query = Book::query()
            ->selectRaw("b.id, b.title, b.author, b.book_publisher, b.edition, b.volume, b.year,
                b.number_of_copies, bc.reference_book, b.ISBN, bc.id as idBookCopie,
                CONCAT(bc.id, ' - ', b.title) AS bookDescription"
            )
            ->from('book as b')
            ->join('book_copies as bc', 'b.id', '=', 'bc.id_book')
            ->orderBy('b.title');

        if (!is_null($idBookCopie)) {
            $query->where('bc.id', '=', $idBookCopie);
        }

        if ($forLoan) {
            $query->where('bc.loaned', '=', 0)->where('bc.reference_book', '=', 0);
        }

        return $query->get()->toArray();
    }

    /**
     * Update the number of copies of the book
     * @access public
     * @param int $idBook id of table book
     * @param int $copies number of copies
     * @return int new number of copies
     */
    public function updNumberOfCopies(int $idBook, int $copies)
    {
        $book = Book::findOrFail($idBook);
        $book->update(['number_of_copies' => $book->number_of_copies + $copies]);

        return $book->number_of_copies;
    }
}
