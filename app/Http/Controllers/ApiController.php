<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Login;
use App\Http\Helpers\ApiHelper;

class ApiController extends Controller
{
    
    public function vLogin(Request $request)
    {
        $nama_api='login';
        
        $param  = [
            "email" => $request->email,
            "password" => $request->password
        ]; 

        $result= ApiHelper::cLogin($param);
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
                }else{
                    //nothing
                }
                    $user = new \App\Models\Login;
                    $user->email = $result->data->user->email;
                    $user->token = $result->data->token;
                    $user->ipaddress = $_SERVER['REMOTE_ADDR'];
                    $user->iv = $result->data->iv;
                    $user->key = $result->data->key;
                    $user->save();

                return view('index', compact('user'));
            }else{
                Log::Info($nama_api. ' error');
                return redirect()->route('login');
            }
        }

        
    }

    public function vLogout()
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        $user = Login::where('ipaddress', $ip)
        ->whereNotNull('token')
        ->whereNotNull('iv')
        ->whereNotNull('key')
        ->orderBy('id', 'desc')
        ->first();

        if($user)
        {
            $nama_api = 'logout';
            $signature = ApiHelper::get_signature($user->iv, $user->key);
        
            $param  = [
                "email" => $user->email,
                "token" => $user->token,
                "signature" => $signature,
            ]; 

            $result= ApiHelper::cLogout($param);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    Log::Info('delete '.$user->id);
                    $user = $user->delete();

                    return redirect()->route('login');
                }else{
                    Log::Info($nama_api. ' gagal logout');
                    return redirect()->route('dashboard');
                }
            }else{
                Log::Info($nama_api. ' gagal logout');
                 return redirect()->route('dashboard');
            }

        }else{
            Log::Info($nama_api. ' tidak berhak logout');
            return redirect()->route('login');
        }
    }


}
