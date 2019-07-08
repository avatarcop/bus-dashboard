<?php

namespace App\Http\Helpers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use Log;
use App\Models\MasterSetting;

class ApiHelper extends Controller
{
	public static function cLogin($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/login";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;
    } 

    public static function cLogout($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/logout";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;

    } 

    public static function cUserlist($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/user/list";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;

    } 

    public static function cUserinsert($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/user/insert";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;

    } 

    public static function cUserupdate($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/user/update";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;

    }

     public static function cUserdelete($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/user/delete";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;

    }

    public static function cUseredit($param) 
    {
        $url = self::url_serverapi();
        $url_msg   = MasterSetting::where('setting_name', 'urlerror_message')->first();
        if(!$url_msg)
        {
            $msg = 'url error';
        }else{
            $msg = $url_msg->setting_value;
        }

        if(empty($url))
        {
            return json_encode(array('status' => 0, 'message' => $msg));
        }

        $url = $url."/user/edit";

        $headers = array();
        $headers[]= "Content-Type: application/x-www-form-urlencoded";
        $result = self::http_post($url,$param,$headers);

        return $result;

    }

    public static function url_serverapi()
    {
        $lok = MasterSetting::where('setting_name', 'set_url_lokal')->first();       
        $dev = MasterSetting::where('setting_name', 'set_url_development')->first();    
        $prod = MasterSetting::where('setting_name', 'set_url_production')->first();     
        $urllok = MasterSetting::where('setting_name', 'url_lokal')->first();       
        $urldev = MasterSetting::where('setting_name', 'url_development')->first();
        $urlprod = MasterSetting::where('setting_name', 'url_production')->first();

        if(isset($lok->setting_value) && isset($dev->setting_value) && isset($prod->setting_value) && isset($urllok->setting_value) && isset($urldev->setting_value) && isset($urlprod->setting_value) )
        {
            
            if($lok->setting_value==1 && $prod->setting_value==0 && $prod->setting_value==0)
            {
                $url = $urllok->setting_value;
            }elseif($dev->setting_value==1 && $lok->setting_value==0 && $prod->setting_value==0)
            {
                $url = $urldev->setting_value;
            }elseif($prod->setting_value==1 && $lok->setting_value==0 && $dev->setting_value==0)
            {
                $url = $urldev->setting_value;
            }else{
                $url = '';
                
            }

        }else{
            $url = '';
           
        }

        return $url;

    } 

    public static function get_signature($iv, $key)
    {
        date_default_timezone_set('Asia/Jakarta');
        $data = $_SERVER['REMOTE_ADDR']."|".\Carbon\Carbon::now();

        $encryptSignature = self::enkripsi($key, $data, $iv);
         
        return $encryptSignature; 
        // return $encryptSignature = self::enkripsi($key, $data, $iv);

    }

    public static function enkripsi($key, $data, $iv)
    {
        $OPENSSL_CIPHER_NAME = "aes-128-cbc";
        $CIPHER_KEY_LEN = 16;

        if (strlen($key) < $CIPHER_KEY_LEN)
        {
            $key = str_pad($key, $CIPHER_KEY_LEN, "0"); //0 pad to len 16
        } else if (strlen($key) > $CIPHER_KEY_LEN) {
            $key = substr($str, 0, $CIPHER_KEY_LEN); //truncate to 16 bytes
        }

        $encodedEncryptedData = base64_encode(openssl_encrypt($data, $OPENSSL_CIPHER_NAME, $key, OPENSSL_RAW_DATA, $iv));
        $encodedIV = base64_encode($iv);
        $encryptedPayload = $encodedEncryptedData;

        return $encryptedPayload;
    }


    public static function http_post($url, $param, $headers)
    {
        //set POST variables

        $fields_string = http_build_query($param);

        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.3; WOW64; rv:39.0) Gecko/20100101 Firefox/39.0");
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);

        curl_setopt($ch, CURLOPT_REFERER, $url);
//        curl_setopt($ch, CURLOPT_PUT, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        //execute post
        $result = curl_exec($ch);
        //echo $result;
        //exit;
        //close connection
        curl_close($ch);
        return $result;
    }


}
