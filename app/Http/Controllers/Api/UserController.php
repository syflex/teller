<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Auth\User; 
use Illuminate\Support\Facades\Auth; 
use Validator;

class UserController extends Controller
{
    
    public $successStatus = 200;

/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(){ 
        \Log::info('entered login method');
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            
            \Log::info('validated');

            $user = Auth::user(); 
            $token = $user->createToken('teller')-> accessToken; 
            $success['token'] = "Bearer"." ".$token; 
            $success['user'] = $user; 
            return response()->json(['success' => $success], $this-> successStatus); 
        } 
        else{ 
            \Log::info('error');
            return response()->json(['error'=>'Unauthorised'], 401); 
        } 
    }


/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request){ 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'password_confirmation' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
                    return response()->json(['error'=>$validator->errors()], 401);            
                }
                $input = $request->all(); 
                $input['password'] = bcrypt($input['password']); 
                $user = User::create($input); 
                $token = $user->createToken('teller')-> accessToken; 
                $success['token'] = "Bearer"." ".$token; 
                $success['user'] = $user; 
        return response()->json(['success'=>$success], $this-> successStatus); 
     }


/** 
     * get user details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function user(Request $request){
        $user = Auth::user();
        return response()->json(['success' => $user], $this-> successStatus);
    } 

    public function get_balance($id)
    {
        $data = User::where('ac_number',$id)->first();
        return $data;
    }

     /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  


}
