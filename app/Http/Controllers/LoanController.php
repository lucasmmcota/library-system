<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanRequest;
use App\Models\Book;
use App\Models\BookCopies;
use App\Models\Loan;
use App\Models\LoanTerm;
use App\Models\Member;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $loans = (new Loan())->lstLoan();

        $arrayHeader = $this->getArrayHeader();
        $arrayData = $this->getArrayData($loans);

        return view('loan.index')->with(['arrayHeader' => $arrayHeader, 'arrayData' => $arrayData]);
    }

    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $slMember = array_column((new Member())->lstMember(), 'full_name', 'id');
        $slBook = array_column((new Book())->lstBook(forLoan: true), 'bookDescription', 'idBookCopie');

        return view('loan.create')->with(['slMember' => $slMember, 'slBook' => $slBook]);
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param LoanRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoanRequest $request)
    {
        $validatedData = $request->validated();

        $loanTerm = LoanTerm::query()->latest()->first();

        if (is_null($loanTerm)) {
            return redirect()->route('loan.create')->with([
                'success' => 'Primeiro configure os parâmetros de empréstimo.', 'alert' => 'alert-warning'
            ]);
        }

        $member = Member::findOrFail($validatedData['slMember']);
        $days = $member['id_member_type'] == 1 ? $loanTerm['days_teacher'] : $loanTerm['days_student'];

        Loan::create([
            'id_member' => $validatedData['slMember'],
            'id_book_copies' => $validatedData['slBook'],
            'id_loan_term' => $loanTerm['id'],
            'loan_date' => date('Y-m-d H:i:s'),
            'devolution_date' => date('Y-m-d', strtotime('+' . $days . ' days'))
        ]);

        $bookCopie = BookCopies::findOrFail($validatedData['slBook']);
        $bookCopie->update(['loaned' => 1]);

        return redirect()->route('loan.create')->with('success', 'Empréstimo realizado com sucesso!');
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
     * @param string $id
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $loan = Loan::findOrFail(unserialize($id));
        $loanTerm = LoanTerm::query()->latest()->first();

        if ($loan['number_renovations'] < $loanTerm['max_renovations']) {
            $loanRegister = (new Loan())->lstLoan(unserialize($id));
            $days = $loanRegister[0]['id_member_type'] == 1 ? $loanTerm['days_teacher'] : $loanTerm['days_student'];

            $loan->update([
                'id_loan_term' => $loanTerm['id'],
                'devolution_date' => date('Y-m-d', strtotime($loan['devolution_date'] . '+' . $days . ' days')),
                'number_renovations' => $loan['number_renovations'] + 1
            ]);

            return redirect()->route('loan.index')->with('success', 'Empréstimo renovado com sucesso!');
        }

        return redirect()->route('loan.index')->with([
            'success' => 'O empréstimo já foi renovado o máximo de vezes possível.', 'alert' => 'alert-warning'
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @access public
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function return(string $id)
    {
        $loan = Loan::findOrFail(unserialize($id));
        $loanTerm = LoanTerm::query()->latest()->first();

        $loan->update([
            'id_loan_term' => $loanTerm['id'],
            'return_date' => date('Y-m-d H:i:s'),
            'returned' => 1
        ]);

        $bookCopie = BookCopies::findOrFail($loan['id_book_copies']);
        $bookCopie->update(['loaned' => 0]);

        return redirect()->route('loan.index')->with('success', 'Empréstimo encerrado com sucesso!');
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
     * Method to get table header
     * @access private
     * @return array
     */
    private function getArrayHeader()
    {
        return [
            'Membro',
            'Livro',
            'Acervo',
            'ISBN',
            'Data de Empréstimo',
            'Data de Devolução',
            'Renovar',
            'Encerrar'
        ];
    }

    /**
     * Method to get table data
     * @access private
     * @param array $loans
     * @return array $arrayData
     */
    private function getArrayData($loans)
    {
        $arrayData = [];
        foreach ($loans as $loan) {
            $arrayData[] = [
                'member' => $loan['full_name'],
                'book_title' => $loan['title'],
                'id_book_copie' => $loan['idBookCopie'],
                'isbn' => $loan['ISBN'],
                'loan_date' => $this->getDateBr($loan['loan_date']),
                'devolution_date' => $this->getDateBr($loan['devolution_date']),
                'renew' => $this->getIconRenew($loan['id']),
                'return' => $this->getIconReturn($loan['id'])
            ];
        }

        return $arrayData;
    }

    /**
     * Method to get the renew icon
     * @access private
     * @param string $id
     * @return array
     */
    private function getIconRenew(string $id)
    {
        return $this->getIconModal(
            $id,
            'renew_loan',
            'loan',
            'Renovar Empréstimo',
            'Você realmente deseja renovar este empréstimo?',
            'fa-solid fa-rotate',
            'put'
        );
    }

    /**
     * Method to get the return icon
     * @access private
     * @param string $id
     * @return array
     */
    private function getIconReturn(string $id)
    {
        return $this->getIconModal(
            $id,
            'loan_return',
            'loan_return',
            'Encerrar Empréstimo',
            'Você realmente deseja encerrar este empréstimo?',
            'fa-solid fa-rotate-left',
            'put'
        );
    }
}
