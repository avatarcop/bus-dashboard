<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Login;
use App\Models\User;
use App\Http\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class BusController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function buslist()
    {
        $nama_api='bus list';

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

            $url = 'bus/list';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                    Log::Info('bus '.json_encode($data));
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    $data = [];  

                    $data = json_encode($data);      
                    $data = json_decode($data);   

                    session()->flash('gagal', $result->message);  
                    return redirect('/');
                }
            }else{
                Log::Info($nama_api. ' Terjadi kesalahan ');
                $data = [];  

                $data = json_encode($data);      
                $data = json_decode($data);   

                session()->flash('gagal', 'Terjadi kesalahan');  
                return redirect('/');
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect('login');
        } 
            
        return view('bus.list', compact('data'));
    }


    public function buscreate()
    {
        $nama_api='bus create';

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

            $url = 'bus/create';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                    $data_tipekursi = $result->data_tipekursi;
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
            
        return view('bus.create', compact('data', 'data_tipekursi'));
    }

    public function businsert(Request $request)
    {
        $nama_api='bus insert';

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
                "nama_bus" => $request->nama_bus,
                "tipekursi_id" => $request->tipekursi_id,
                "terminal_berangkat" => $request->terminal_berangkat,
                "terminal_tujuan" => $request->terminal_tujuan,
                "jumlah_kursi" => $request->jumlah_kursi,
                "harga_tiket" => $request->harga_tiket,
                "waktu_berangkat" => $request->waktu_berangkat,
                "estimasi_tiba" => $request->estimasi_tiba,
                "status" => $request->status,
                
            ]; 

            $url = 'bus/insert';

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
            
        return redirect()->route('bus.list');
    }

    public function busedit($id)
    {
        $nama_api='bus edit';

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

            $url = 'bus/edit';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                    $data_po = $result->data_po;
                    $data_tipekursi = $result->data_tipekursi;

                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message); 
                    return redirect()->route('bus.list'); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');    
                return redirect()->route('bus.list');    
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return view('bus.edit', compact('user', 'data', 'data_po', 'data_tipekursi'));
    }

    public function busupdate(Request $request)
    {
        $nama_api='bus update';

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
                "nama_bus" => $request->nama_bus,
                "tipekursi_id" => $request->tipekursi_id,
                "terminal_berangkat" => $request->terminal_berangkat,
                "terminal_tujuan" => $request->terminal_tujuan,
                "jumlah_kursi" => $request->jumlah_kursi,
                "harga_tiket" => $request->harga_tiket,
                "waktu_berangkat" => $request->waktu_berangkat,
                "estimasi_tiba" => $request->estimasi_tiba,
                "status" => $request->status,
            ]; 

            $url = 'bus/update';

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
            
        return redirect()->route('bus.list');
    }

    public function busdelete($id)
    {
        $nama_api='bus delete';

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

            $url = 'bus/delete';

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
            
        
        return redirect()->route('bus.list'); 
    }

    
    


}
