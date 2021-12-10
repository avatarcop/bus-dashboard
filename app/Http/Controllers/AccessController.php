<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Login;
use App\Models\User;
use App\Http\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AccessController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function accesscontrollist()
    {
        $nama_api='accesscontrol list';

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

            $url = 'accesscontrol/list';

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
            
    	return view('accesscontrol.list', compact('data'));
    }

    public function accesscontrolcreate()
    {
        $nama_api='accesscontrol create';

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

            $url = 'accesscontrol/create';

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
            
        return view('accesscontrol.create', compact('data'));
    }

    public function accesscontrolinsert(Request $request)
    {
        $nama_api='accesscontrol insert';

        $email = Auth::user()->email;
        $cekAuth = ApiHelper::cekUserAuth($email);
        if($cekAuth['status'] == 1)
        {
            // sukses cek auth
            $param  = [
                "email" => $cekAuth['data']['email'],
                "token" => $cekAuth['data']['token'],
                "signature" => $cekAuth['signature'],
                "role_code" => $request->role_code,
                "role_name" => $request->role_name,
                "routelist" => $request->routelist,
            ]; 

            $url = 'accesscontrol/insert';

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
            
        return redirect()->route('accesscontrol.list');
    }

    public function accesscontroledit($id)
    {
        $nama_api='accesscontrol edit';

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

            $url = 'accesscontrol/edit';

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
            
        return view('accesscontrol.edit', compact('user', 'data'));
    }

    public function accesscontrolupdate(Request $request)
    {
        $nama_api='accesscontrol update';

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
                "role_code" => $request->role_code,
                "role_name" => $request->role_name,
                "routelist" => $request->routelist,
                "id" => $request->id,
            ]; 

            $url = 'accesscontrol/update';

            $result= ApiHelper::hitValidator($param, $url);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                    // update acl di dashboard
                    $user = User::all();
                    foreach ($user as $row) 
                    {
                        if($row->acl_id == $request->id)
                        {
                            Log::Info('Update acl '.$row->email);
                            $updateacl = User::find($row->id);
                            $updateacl->acl = $result->data->route_access_list;
                            $updateacl->update();
                        }
                    }
                    

                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                    $data = $result->data;
                    return view('accesscontrol.edit', compact('user', 'data'));
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('gagal','Terjadi kesalahan'); 
                return redirect()->route('accesscontrol.list');
            }

        }else{
            Log::Info($nama_api. ' tidak berhak, harus register ulang '.$email);
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return redirect()->route('accesscontrol.list');
    }

    public function accesscontroldelete($id)
    {
        $nama_api='accesscontrol delete';

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

            $url = 'accesscontrol/delete';

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
            
        
        return redirect()->route('accesscontrol.list'); 
    }
    


}
