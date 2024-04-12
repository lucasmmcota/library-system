<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanTermRequest;
use App\Models\LoanTerm;
use Illuminate\Http\Request;

class LoanTermController extends Controller
{
    /**
     * Show the form for creating a new resource.
     * @access public
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create()
    {
        $loanTerm = LoanTerm::query()->latest()->first();

        return view('loan_term.create')->with(['loanTerm' => $loanTerm]);
    }

    /**
     * Store a newly created resource in storage.
     * @access public
     * @param LoanTermRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoanTermRequest $request)
    {
        $validatedData = $request->validated();

        LoanTerm::create([
            'max_renovations' => $validatedData['max_renovations'],
            'days_student' => $validatedData['days_student'],
            'days_teacher' => $validatedData['days_teacher'],
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('loan_term.create')->with('success', 'Configurações definidas com sucesso!');
    }
}
