<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Log;
use App\Models\Login;
use App\Http\Helpers\ApiHelper;

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
    public function dashboard()
    {
        return view('index');
    }

    public function logout()
    {
        $nama_api='logout';

        $user = Login::where('ipaddress', $_SERVER['REMOTE_ADDR'])
        ->whereNotNull('token')
        ->whereNotNull('iv')
        ->whereNotNull('key')
        ->orderBy('id', 'desc')
        ->first();

        if($user)
        {
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

                    Auth::logout();
                    return redirect('login');
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
            Auth::logout();
            return redirect('login');
        }

        
    }
}
