<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoanTermRequest;
use App\Models\LoanTerm;
use Illuminate\Http\Request;

class LoanTermController extends Controller
{
    /**
     * Display a listing of the resource.
     * @access public
     */
    public function index()
    {
        //
    }

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
     */
    public function update(Request $request, string $id)
    {
        //
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
}
