<?php

namespace App\Http\Controllers;

use App\Models\Loan;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @access public
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $arrayNumberOfLoans = [];
        $totalLoans = 0;
        for ($i = 1; $i < 13; $i ++) {
            $loansMonth = $this->getLoanPerMonth($i);

            $totalLoans += $loansMonth;
            $arrayNumberOfLoans[] = $loansMonth;
        }

        return view('dashboard')->with([
            'arrayNumberOfLoans' => $arrayNumberOfLoans,
            'totalLoans' => $totalLoans
        ]);
    }

    /**
     * Return the number os loans in a month
     *
     * @access private
     * @param string $month
     * @return int
     */
    private function getLoanPerMonth(string $month)
    {
        $firstDayOfTheMonth = date('Y-m-01', mktime(0, 0, 0, $month, 1, date('Y')));
        $lastDayOfTheMonth = date('Y-m-t', mktime(0, 0, 0, $month, 1, date('Y')));

        return Loan::whereBetween('loan_date', [$firstDayOfTheMonth, $lastDayOfTheMonth])->count();
    }
}
