<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Transaction;
use Auth;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $allUsers = User::count();
            $allTransactions = Transaction::count();
            $totalTransactions = Transaction::sum('amount');
            $totalAmount = User::sum('wallet');
        }elseif(Auth::user()->hasRole('officer')){
            $allUsers = User::where('officer_id',Auth::user()->id)->count();
            $allTransactions = Transaction::where('officer_id',Auth::user()->id)->count();
            $totalTransactions = Transaction::where('officer_id',Auth::user()->id)->sum('amount');
            $totalAmount = User::where('officer_id',Auth::user()->id)->sum('wallet');
        }

        return view('backend.dashboard',compact('allUsers','allTransactions','totalTransactions','totalAmount'));
    }
}
