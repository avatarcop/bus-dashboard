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

class TransaksiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function transaksilist()
    {
        $nama_api='transaksi list';

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

            $url = 'transaksi/list';

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
            
        return view('transaksi.list', compact('data'));
    }

    public function transaksinotif()
    {
        $nama_api='transaksi notif';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "route" => 'transaksi.notifikasi'
            ]; 

            $url = 'transaksi/notifikasi';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                }
            }else{
                Log::Info($nama_api. ' Terjadi kesalahan '.json_encode($result));  
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect('login');
        } 
            
        return json_encode($data);
    }


    public function transaksicreate()
    {
        $nama_api='transaksi create';

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

            $url = 'transaksi/create';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                    $data_bus = $result->data_bus;
                    $data_tipekursi = $result->data_tipekursi;
                    $data_customer = $result->data_customer;

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
            
        return view('transaksi.create', compact('data', 'data_bus', 'data_tipekursi','data_customer'));
    }

    public function transaksiinsert(Request $request)
    {
        $nama_api='transaksi insert';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "po_id" => $request->po_id,
                "bus_id" => $request->bus_id,
                "nomor_kursi" => $request->nomor_kursi,
                "penumpang" => $request->penumpang,
                "no_hp" => $request->no_hp,                              
                "cust_id" => $request->cust_id,                              
            ]; 
            
            $url = 'transaksi/insert';

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
            
        return redirect()->route('transaksi.list');
    }

    public function transaksiedit($id)
    {
        $nama_api='transaksi edit';

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

            $url = 'transaksi/edit';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                    $data_po = $result->data_po;
                    $data_bus = $result->data_bus;
                    $data_tipekursi = $result->data_tipekursi;
                    $data_customer = $result->data_customer;
                    $data_kursisisa = $result->data_kursisisa;
                    Log::Info('data '.json_encode($data));

                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message); 
                    return redirect()->route('transaksi.list'); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');    
                return redirect()->route('transaksi.list');    
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return view('transaksi.edit', compact('user', 'data', 'data_po', 'data_bus', 'data_tipekursi', 'data_customer', 'data_kursisisa'));
    }

    public function transaksiupdate(Request $request)
    {
        $nama_api='transaksi update';

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
                "po_id" => $request->po_id,
                "bus_id" => $request->bus_id,
                "nomor_kursi" => $request->nomor_kursi,
                "nomor_kursi_lama" => $request->nomor_kursi_lama,
                "penumpang" => $request->penumpang,
                "no_hp" => $request->no_hp,                              
                "cust_id" => $request->cust_id,   
               
            ]; 

            $url = 'transaksi/update';

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
            
        return redirect()->route('transaksi.list');
    }

    public function transaksidelete($id)
    {
        $nama_api='transaksi delete';

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

            $url = 'transaksi/delete';

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
            
        
        return redirect()->route('transaksi.list'); 
    }



    public function transaksibayar($id)
    {
        $nama_api='transaksi bayar';

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

            $url = 'transaksi/bayar';

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
            
        
        return redirect()->route('transaksi.list'); 
    }

    
    


}
