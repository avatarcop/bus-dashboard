<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Login;
use App\Models\User;
use App\Http\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

class CustomerController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function customerlist()
    {
        $nama_api='customer list';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "route" => Route::currentRouteName()
            ]; 

            $url = 'customer/list';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));

                    session()->flash('gagal', $result->message);  
                    return redirect('/');
                }
            }else{
                Log::Info($nama_api. ' Terjadi kesalahan '.json_encode($result));  

                session()->flash('gagal', 'Terjadi kesalahan');  
                return redirect('/');
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect('login');
        } 
            
        return view('customer.list', compact('data'));
    }


    public function customercreate()
    {
        $nama_api='customer create';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        $user = $cekAuth['data'];
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "route" => Route::currentRouteName()
            ]; 

            $url = 'customer/create';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                    return redirect()->back(); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');  
                return redirect()->back();       
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return view('customer.create', compact('data'));
    }

    public function customerinsert(Request $request)
    {
        $nama_api='customer insert';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => $request->password,
                "password_c" => $request->password_c,
                "no_hp" => $request->no_hp,
                "status" => $request->status,
                              
            ]; 
            
            $url = 'customer/insert';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                    return redirect()->back(); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');   
                return redirect()->back(); 
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return redirect()->route('customer.list');
    }

    public function customeredit($id)
    {
        $nama_api='customer edit';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        $user = $cekAuth['data'];
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "id" => $id,
                "route" => Route::currentRouteName()
            ]; 

            $url = 'customer/edit';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;

                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message); 
                    return redirect()->route('customer.list'); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');    
                return redirect()->route('customer.list');    
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return view('customer.edit', compact('user', 'data'));
    }

    public function customerupdate(Request $request)
    {
        $nama_api='customer update';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        $user = $cekAuth['data'];
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth

            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "id" => $request->id,
                "nama" => $request->nama,
                "email" => $request->email,
                "password" => $request->password,
                "password_c" => $request->password_c,
                "no_hp" => $request->no_hp,
                "status" => $request->status,
               
            ]; 

            $url = 'customer/update';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                    
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                    return redirect()->back(); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan'); 
                return redirect()->back(); 
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return redirect()->route('customer.list');
    }

    public function customerdelete($id)
    {
        $nama_api='customer delete';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "id" => $id,
                "route" => Route::currentRouteName()
            ]; 

            $url = 'customer/delete';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);  
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');        
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        
        return redirect()->route('customer.list'); 
    }

    
    


}
