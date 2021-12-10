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

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
            ]; 

            $url = 'logout';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $user = Login::find($cekAuth['data']['id']);
                    $user->delete();

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
