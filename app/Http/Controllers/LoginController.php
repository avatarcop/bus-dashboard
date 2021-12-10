<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Login;
use App\Http\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $nama_api='login';
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) 
        {
            // Authentication passed...
            $nama_api='login';
        
            $param  = [
                "email" => $request->email,
                "password" => $request->password
            ]; 

            $url = 'login';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);
            
            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $cek_userlogin = \App\Models\Login::where('email', $result->data->user->email)
                    ->whereNotNull('token')
                    ->orderBy('id', 'desc')
                    ->first();

                    if($cek_userlogin)
                    {
                        $cek_userlogin->delete();

                        $user = new \App\Models\Login;
                        $user->email = $result->data->user->email;
                        $user->token = $result->data->token;
                        $user->ipaddress = $_SERVER['REMOTE_ADDR'];
                        $user->iv = $result->data->iv;
                        $user->key = $result->data->key;
                        $user->save();

                        Log::Info('Login sukses');
                        return redirect()->route('dashboard');
                    }else{
                        //nothing
                    
                        $user = new \App\Models\Login;
                        $user->email = $result->data->user->email;
                        $user->token = $result->data->token;
                        $user->ipaddress = $_SERVER['REMOTE_ADDR'];
                        $user->iv = $result->data->iv;
                        $user->key = $result->data->key;
                        $user->save();

                        Log::Info('Login sukses');
                        return redirect()->route('dashboard');
                    }
                }else{
                    Log::Info($nama_api. ' error '.$result->message);
                    session()->flash('gagal', $result->message);  
                    return redirect()->route('login');
                }
            }else{
                Log::Info($nama_api. ' error Terjadi kesalahan');
                session()->flash('gagal', 'Terjadi kesalahan');  
                return redirect()->route('login');
            }
            
        }else{
            Log::Info($nama_api. ' error User tidak ditemukan');
            session()->flash('gagal', 'User tidak ditemukan');  
            return redirect()->route('login');
        }
        

        
    }

}
