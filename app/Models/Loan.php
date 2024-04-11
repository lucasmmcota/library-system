<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'loan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_member',
        'id_book_copies',
        'id_loan_term',
        'number_renovations',
        'loan_date',
        'devolution_date',
        'return_date',
        'returned'
    ];

    /**
     * Method to list the loans
     * @access public
     * @param string $idLoan
     * @param string $idMember
     * @param string $idBookCopie
     * @return array array of loans
     */
    public function lstLoan(string $idLoan = null, string $idMember = null, string $idBookCopie = null)
    {
        $query = Loan::query()
            ->select('l.id', 'l.loan_date', 'l.devolution_date', 'l.return_date', 'm.full_name', 'b.title', 'b.ISBN',
                'bc.id as idBookCopie', 'm.id_member_type')
            ->from('loan as l')
            ->join('member as m', 'l.id_member', '=', 'm.id')
            ->join('book_copies as bc', 'l.id_book_copies', '=', 'bc.id')
            ->join('book as b', 'bc.id_book', '=', 'b.id')
            ->where('l.returned', '=', '0')
            ->orderBy('l.loan_date');

        if (!is_null($idLoan)) {
            $query->where('l.id', '=', $idLoan);
        }

        if (!is_null($idMember)) {
            $query->where('l.id_member', '=', $idMember);
        }

        if (!is_null($idBookCopie)) {
            $query->where('l.id_book_copies', '=', $idBookCopie);
        }
        
        return $query->get()->toArray();
    }
}
