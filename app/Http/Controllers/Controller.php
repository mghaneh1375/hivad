<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

include_once __DIR__ . '/Common.php';

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function hasAnyExcept($expected, $real) {

        foreach ($real as $itr) {
            if(!in_array($itr, $expected))
                return true;
        }

        return false;
    }

    public static function getIp(){
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public static function sendSMS($phone, $msg)
    {

        if(1 == 1)
            return true;

        ini_set("soap.wsdl_cache_enabled", "0");
        $sms_client = new \SoapClient('http://payamak-service.ir/SendService.svc?wsdl', array('encoding'=>'UTF-8'));

        try {
            $parameters['userName'] = "mt.09338795335";
            $parameters['password'] = "wkf*434";
            $parameters['fromNumber'] = "500022200";
            $parameters['toNumbers'] = array($phone);
            $parameters['messageContent'] = $msg;
            $parameters['isFlash'] = false;
            $recId = array(0);
            $status = 0x0;
            $parameters['recId'] = &$recId ;
            $parameters['status'] = &$status ;
            $sms_client->SendSMS($parameters)->SendSMSResult;
            return true;
        } 
        catch (\Exception $e) 
        {
            //dd('Caught exception: ',  $e->getMessage(), "\n");
            return false;
        }
    }

    public static function translate_day($day) {

        switch($day) {
            case "sat":
                return "شنبه";
            case "sun":
                return "یک شنبه";
            case "mon":
                return "دوشنبه";
            case "tue":
                return "سه شنبه";
            case "wed":
                return "چهارشنبه";
            case "thr":
                return "پنج شنبه";
            default:
                return "جمعه";
        }

    }

    public static function translate_num_day($day) {

        switch($day) {
            case "sat":
                return 0;
            case "sun":
                return 1;
            case "mon":
                return 2;
            case "tue":
                return 3;
            case "wed":
                return 4;
            case "thr":
                return 5;
            default:
                return 6;
        }

    }

    protected static $errors = [
        'img.required' => 'لطفا تصویر را آپلود نمایید',
        'priority.required' => 'لطفا اولویت را وارد نمایید',
        'is_imp.required' => 'لطفا اینکه آیا در صفحه نخست نمایش داده شود را مشخص کنید',
        'category_id.required' => 'لطفا دسته موردنظر خود را وارد نمایید',
        'f.required' => 'لطفا فایل موردنظر خود را وارد نمایید ',
        'description.required' => 'لطفا توضیحات موردنظر خود را وارد نمایید',
        'digest.required' => 'لطفا خلاصه موردنظر خود را وارد نمایید',
        'title.required' => 'لطفا عنوان موردنظر خود را وارد نمایید',
        'username.unique' => 'شماره همراه وارد شده در سیستم موجود است',
        'username.regex' => 'شماره همراه وارد شده نامعتبر است',
        'phone.regex' => 'شماره همراه وارد شده نامعتبر است',
        'password.*' => 'رمزعبور باید حداقل 6 کاراکتر باشد',
        'rpassword.*' => 'تکرار رمزعبور باید حداقل 6 کاراکتر باشد',
        'oldPass.*' => 'رمزعبور باید حداقل 6 کاراکتر باشد',
        'newPass.*' => 'رمزعبور جدید باید حداقل 6 کاراکتر باشد',
        'confirmNewPass.*' => 'تکرار رمزعبور باید حداقل 6 کاراکتر باشد',
        'first_name.*' => 'لطفا نام خود را وارد نمایید',
        'last_name.*' => 'لطفا نام خانوادگی خود را وارد نمایید',
        'verification_code.required' => 'لطفا کد اعتبارسنجی را وارد نمایید',
        'verification_code.integer' => 'کد اعتبارسنجی وارد شده نامعتبر است',
    ];
    
    static function getVerificationCode() {
        try {
            return random_int(10000, 99999);
        } catch (\Exception $e) {
            return "35655";
        }
    }
    
    public static function MiladyToShamsi2($ts){
        include_once 'jdate.php';
        return jdate('l d F سال Y', "", $ts);
    }
    
    public static function getToday(){
        include_once 'jdate.php';
        return jdate('D', "", time());
    }

}
