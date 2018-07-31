<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Transaction;

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
        $allUsers = User::count();
        $allTransactions = Transaction::count();
        $totalTransactions = Transaction::sum('amount');
        $totalAmount = User::sum('wallet');
        return view('backend.dashboard',compact('allUsers','allTransactions','totalTransactions','totalAmount'));
    }
}
