<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Transaction;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = Transaction::with('category')->get();
        $amount_incomeTemp = DB::select( DB::raw("SELECT sum(nominal) as nominal FROM transaction t LEFT JOIN category c ON t.category_id = c.id where c.logging_type LIKE '%pemasukkan%';") );
        $amount_expenditureTemp = DB::select( DB::raw("SELECT sum(nominal) as nominal FROM transaction t LEFT JOIN category c ON t.category_id = c.id where c.logging_type LIKE '%pengeluaran%';") );
        $amount_income = $amount_incomeTemp[0]->nominal;
        $amount_expenditure = $amount_expenditureTemp[0]->nominal;
        $available = $amount_income - $amount_expenditure;
        return view('index',compact('amount_income','amount_expenditure','available'));
    }
}
