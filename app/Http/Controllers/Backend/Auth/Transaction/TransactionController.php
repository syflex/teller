<?php

namespace App\Http\Controllers\Backend\Auth\Transaction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Transaction;
use Auth;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use DB;
use Excel;
use PDF;

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
        if(Auth::user()->isAdmin()){
            $transactions = Transaction::with('user:id,first_name,last_name')->paginate(25);
        }elseif(Auth::user()->hasRole('officer')){
            $transactions = Transaction::where('officer_id',Auth::user()->id)->with('user:id,first_name,last_name')->paginate(25);
        }
        return view('backend.auth.transaction.index', compact('transactions'));
    }

//    public function view(): View
//    {
//        return view('exports.invoices', [
//            'invoices' => Invoice::all()
//        ]);
//    }

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
            $balance = ($request->get('wallet') + $request->get('amount'));
            $phone = $request->get('phone');
            $amount = $request->get('amount');
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

            $client = new Client();
            $request = $client->get('https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=yiNERTjxK8H75DITq2Auyrc2ML6faWtcLeGTxVxpkEDo2EtaUFyXaid4wjdA &from=Agro-OTG&to='.$phone.'&body=Your account has been Credited with '.$amount.' '.'your balance is '.$balance);
            $response = $request->getBody()->getContents();

        }elseif ($request->get('type')=="debit"){
            $balance = ($request->get('wallet') + $request->get('amount'));
            $phone = $request->get('phone');
            $amount = $request->get('amount');
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
            $client = new Client();
            $request = $client->get('https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=yiNERTjxK8H75DITq2Auyrc2ML6faWtcLeGTxVxpkEDo2EtaUFyXaid4wjdA &from=Agro-OTG&to='.$phone.'&body=Your account has been Debited with '.$amount.' '.'your balance is '.$balance);
            $response = $request->getBody()->getContents();
            }

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function downloadExcel($type)
    {
        $data = Transaction::get()
                ->toArray();

        Excel::create('Student', function($excel) use($data) {
            $excel->sheet('ExportFile', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');

    }

    public function downloadUserExcel($type)
    {
        $data = User::get()->toArray();

        Excel::create('Student', function($excel) use($data) {
            $excel->sheet('ExportFile', function($sheet) use($data) {
                $sheet->fromArray($data);
            });
        })->export('xls');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function importExcel(Request $request)
    {
        $request->validate([
            'import_file' => 'required'
        ]);

        $path = $request->file('import_file')->getRealPath();
        $data = Excel::load($path)->get();

        if($data->count()){
            foreach ($data as $key => $value) {
                $arr[] = ['title' => $value->title, 'description' => $value->description];
            }

            if(!empty($arr)){
                Item::insert($arr);
            }
        }

        return back()->with('success', 'Insert Record successfully.');
    }


    public function generatePDF()
    {
        $transactions = Transaction::where('officer_id',Auth::user()->id)->with('user:id,first_name,last_name')->paginate(25);
        
        $pdf = PDF::loadView('backend.auth.transaction.pdf', compact('transactions'));
        $pdf->getDomPDF()->get_option('enable_html5_parser');
        return $pdf->download('transaction.pdf');
        // return view('backend.auth.transaction.pdf', compact('transactions'));
    }
}
