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

class TipekursiController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function tipekursilist()
    {
        $nama_api='tipekursi list';

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

            $url = 'tipekursi/list';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    $data = [];  

                    $data = json_encode($data);      
                    $data = json_decode($data);   

                    session()->flash('gagal', $result->message);  
                    return redirect('/');
                }
            }else{
                Log::Info($nama_api. ' Terjadi kesalahan '.json_encode($result));
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
            
        return view('tipekursi.list', compact('data'));
    }


    public function tipekursicreate()
    {
        $nama_api='tipekursi create';

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

            $url = 'tipekursi/create';

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
            
        return view('tipekursi.create', compact('data'));
    }

    public function tipekursiinsert(Request $request)
    {
        $nama_api='tipekursi insert';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $file = $request->file('denah_kursi');
            $fileName = $file->getClientOriginalName();

            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "nama_tipekursi" => $request->nama_tipekursi,
                "total_kursi" => $request->total_kursi,
                "denah_kursi" => $fileName,                
            ]; 
            Log::Info('pa '.json_encode($param));
            $url = 'tipekursi/insert';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                    $request->file('denah_kursi')->move("storage/images/", $fileName);
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
            
        return redirect()->route('tipekursi.list');
    }

    public function tipekursiedit($id)
    {
        $nama_api='tipekursi edit';

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

            $url = 'tipekursi/edit';

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
                    return redirect()->route('tipekursi.list'); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan');    
                return redirect()->route('tipekursi.list');    
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return view('tipekursi.edit', compact('user', 'data'));
    }

    public function tipekursiupdate(Request $request)
    {
        $nama_api='tipekursi update';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        $user = $cekAuth['data'];
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            if($request->denah_kursi)
            {
                $file = $request->file('denah_kursi');
                $fileName = $file->getClientOriginalName();
            }else{
                $fileName='';
            }

            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "id" => $request->id,
                "nama_tipekursi" => $request->nama_tipekursi,
                "total_kursi" => $request->total_kursi,
                "denah_kursi" => $fileName,
            ]; 

            $url = 'tipekursi/update';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                    if($request->denah_kursi)
                    {
                        $request->file('denah_kursi')->move("storage/images/", $fileName);
                    }
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
            
        return redirect()->route('tipekursi.list');
    }

    public function tipekursidelete($id)
    {
        $nama_api='tipekursi delete';

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

            $url = 'tipekursi/delete';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);  
                    // hapus gambar lama
                    $old_file = 'storage/images/'.$result->data;
                    File::delete($old_file);
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
            
        
        return redirect()->route('tipekursi.list'); 
    }

    
    


}
