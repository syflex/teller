<?php

namespace App\Http\Controllers\Backend\Auth\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Transaction;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $transactions = Transaction::where('officer_id',Auth::user()->id)->paginate(25);
        return view('backend.auth.transaction.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('backend.auth.transaction.credit_create');
    }

    public function debit()
    {
       return view('backend.auth.transaction.debit_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        if($request->get('type')=="credit"){
            Transaction::insert([
                "user_id" => $request->get('id'),
                "transID" => str_replace(".","",microtime(true)).rand(000,999),
                "trans_type" => 'credit',
                "balance_before" => $request->get('wallet'),
                "amount" => $request->get('amount'),
                "balance_after" => ($request->get('wallet') + $request->get('amount')),
                "officer_id" => Auth::user()->id,
                "description" => $request->get('description'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            User::where('id', $request->get('id'))->increment('wallet',$request->get('amount'));
        }elseif ($request->get('type')=="debit"){
            Transaction::insert([
                "user_id" => $request->get('id'),
                "transID" => str_replace(".","",microtime(true)).rand(000,999),
                "trans_type" => 'debit',
                "balance_before" => $request->get('wallet'),
                "amount" => $request->get('amount'),
                "balance_after" => ($request->get('wallet') - $request->get('amount')),
                "officer_id" => Auth::user()->id,
                "description" => $request->get('description'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            User::where('id', $request->get('id'))->decrement('wallet',$request->get('amount'));
            }

            $client = new Client();
            $request = $client->get('https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=yiNERTjxK8H75DITq2Auyrc2ML6faWtcLeGTxVxpkEDo2EtaUFyXaid4wjdA &from=BulkSMSNG&to=07067822618&body=Welcome');
            $response = $request->getBody()->getContents();
            
            return back();
            
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function get_user($account)
    {
        $data = User::where('ac_number',$account)->first();
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
