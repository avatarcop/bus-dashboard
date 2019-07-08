<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Log;
use App\Models\Login;
use App\Models\User;
use App\Http\Helpers\ApiHelper;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function userlist()
    {
        $nama_api='user list';

    	$email = Auth::user()->email;
        $user = \App\Models\Login::where('email', $email)
        ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
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

            $result= ApiHelper::cUserlist($param);
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
                }
            }else{
                Log::Info($nama_api. ' null');
                $data = [];  

			    $data = json_encode($data);      
			    $data = json_decode($data);   
            }

        }else{
            Log::Info($nama_api. ' tidak berhak');
            Auth::logout();
            return redirect('login');
        } 
            
    	return view('user.list', compact('data'));
    }


    public function usercreate()
    {
        $nama_api='user create';

    	$email = Auth::user()->email;
        $user = \App\Models\Login::where('email', $email)
        ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
        ->whereNotNull('token')
        ->whereNotNull('iv')
        ->whereNotNull('key')
        ->orderBy('id', 'desc')
        ->first();
            
    	return view('user.create', compact('user'));
    }

    public function useredit($id)
    {
        $nama_api='user edit';

        $email = Auth::user()->email;
        $user = \App\Models\Login::where('email', $email)
        ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
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
                "id" => $id,
            ]; 

            $result= ApiHelper::cUseredit($param);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $data = $result->data;
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                    return redirect()->route('user_list'); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('Terjadi kesalahan', $result->message);    
                return redirect()->route('user_list'); 
            }

        }else{
            Log::Info($nama_api. ' tidak berhak');
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return view('user.edit', compact('user', 'data'));
    }

    public function userinsert(Request $request)
    {
        $nama_api='user insert';

    	$email = Auth::user()->email;
        $user = \App\Models\Login::where('email', $email)
        ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
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
                "email_reg" => $request->email_reg,
                "name_reg" => $request->name_reg,
                "password_reg" => $request->password_reg,
                "c_password_reg" => $request->c_password_reg,
            ]; 

            $result= ApiHelper::cUserinsert($param);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                    $user = new User;
                    $user->name = $result->data->name;
                    $user->email = $result->data->email;
                    $user->password = $result->data->password;
                    $user->save();
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);   
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('Terjadi kesalahan', $result->message);    
            }

        }else{
            Log::Info($nama_api. ' tidak berhak');
            Auth::logout();
            return redirect()->route('login');
        } 
            
    	return redirect()->route('user_create');
    }

    public function userupdate(Request $request)
    {
        $nama_api='user update';

        $email = Auth::user()->email;
        $user = \App\Models\Login::where('email', $email)
        ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
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
                "email_reg" => $request->email_reg,
                "name_reg" => $request->name_reg,
                "password_reg" => $request->password_reg,
                "c_password_reg" => $request->c_password_reg,
                "id" => $request->id,
            ]; 

            $result= ApiHelper::cUserupdate($param);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    session()->flash('sukses', $result->message);
                    $user = User::where('email', $request->email_old)->orderBy('id', 'desc')->first();
                    $user->name = $result->data->name;
                    $user->email = $result->data->email;
                    $user->password = $result->data->password;
                    $user->save();
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);   
                    return redirect()->route('user_list');
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('Terjadi kesalahan', $result->message);    
                return redirect()->route('user_list');
            }

        }else{
            Log::Info($nama_api. ' tidak berhak');
            Auth::logout();
            return redirect()->route('login');
        } 
            
        return redirect()->route('user_list');
    }

    public function userdelete($id)
    {
        $nama_api='user delete';

        $email = Auth::user()->email;
        $user = \App\Models\Login::where('email', $email)
        ->where('ipaddress', $_SERVER['REMOTE_ADDR'])
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
                "id" => $id,
            ]; 

            $result= ApiHelper::cUserdelete($param);
            $result = json_decode($result);

            if(isset($result->status))
            {
                if($result->status == 1)
                {
                    $email = $result->data->email;
                    $user = User::where('email', $email)->orderBy('id', 'desc')->first();
                    if($user)
                    {
                        $user->delete();
                    }
                    session()->flash('sukses', $result->message);  
                }else{
                    Log::Info($nama_api. ' gagal '.json_encode($result));
                    session()->flash('gagal', $result->message);  
                    return redirect()->route('user_list'); 
                }
            }else{
                Log::Info($nama_api. ' null');
                session()->flash('Terjadi kesalahan', $result->message);    
                return redirect()->route('user_list'); 
            }

        }else{
            Log::Info($nama_api. ' tidak berhak');
            Auth::logout();
            return redirect()->route('login');
        } 
            
        
        return redirect()->route('user_list'); 
    }


}
