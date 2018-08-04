<?php

namespace App\Http\Controllers\Frontend\User;

use App\Http\Controllers\Controller;
use App\Transaction;
use Auth;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $transactions = Transaction::where('user_id',Auth::user()->id)->paginate(5);
        $officer_transactions = Transaction::where('officer_id',Auth::user()->id)->with('user:id,first_name,last_name,ac_number')->paginate(5);
        return view('frontend.user.dashboard', compact('transactions','officer_transactions'));
    }
}
