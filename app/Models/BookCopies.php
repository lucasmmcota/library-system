<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCopies extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'book_copies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['id_book', 'reference_book', 'loaned'];

    /**
     * Method to insert book copies
     * @access public
     * @param int $idBook id of book
     * @param int $numberOfCopies number of copies
     * @param int $reference information of about book
     */
    public function insBookCopies($idBook, $numberOfCopies, $reference = 0)
    {
        for ($i = 0; $i < $numberOfCopies; $i++) {
            BookCopies::create(['id_book' => $idBook, 'reference_book' => $reference]);
        }
    }
}
