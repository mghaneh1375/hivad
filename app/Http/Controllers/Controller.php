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

    protected static $errors = [
        'img.required' => 'لطفا تصویر را آپلود نمایید',
        'priority.required' => 'لطفا اولویت را وارد نمایید',
        'is_imp.required' => 'لطفا اینکه آیا در صفحه نخست نمایش داده شود را مشخص کنید',
        'category_id.required' => 'لطفا دسته موردنظر خود را وارد نمایید',
        'f.required' => 'لطفا فایل موردنظر خود را وارد نمایید ',
        'description.required' => 'لطفا توضیحات موردنظر خود را وارد نمایید',
        'digest.required' => 'لطفا خلاصه موردنظر خود را وارد نمایید',
        'title.required' => 'لطفا عنوان موردنظر خود را وارد نمایید'
    ];
    
}
