<?php

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (is_dir($dir."/".$object))
                    rrmdir($dir."/".$object);
                else
                    unlink($dir."/".$object);
            }
        }
        rmdir($dir);
    }
}

function persianNumber($i) {

    $arr = ['اول', 'دوم', 'سوم', 'چهارم', 'پنجم', 'ششم', 'هفتم', 'هشتم', 'نهم'];

    return $arr[$i - 1];
}

function myPostIsset($keys) {

    if(is_array($keys)) {

        foreach ($keys as $key) {
            if (!isset($_POST[$key]) || empty($_POST[$key]))
                return false;
        }
    }
    else {
        if (!isset($_POST[$keys]) || empty($_POST[$keys]))
            return false;
    }

    return true;
}

function getValueInfo($key) {

    $values = [
        'adminLevel' => 1, 'userLevel' => 2, 'namayandeLevel' => 3,
    ];

    return $values[$key];

}

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        throw new InvalidArgumentException("$dirPath must be a directory");
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

function jalaliToGregorian($time){
    include_once 'jdate.php';

    $date = explode('/', $time);
    $date = jalali_to_gregorian($date[0], $date[1], $date[2]);

    $str = $date[0];

    if(strlen($date[1]) == 1)
        $str .= "0" . $date[1];
    else
        $str .= $date[1];

    if(strlen($date[2]) == 1)
        $str .= "0" . $date[2];
    else
        $str .= $date[2];

    return $str;
}

function getPast($past) {

    include_once 'jdate.php';

    $jalali_date = jdate("c", $past);

    $date_time = explode('_', $jalali_date);

    $subStr = explode('/', $date_time[0]);

    $month = $subStr[1];
    $day = $subStr[2];

    if(strlen($subStr[1]) == 1)
        $month = "0" . $month;

    if(strlen($subStr[2]) == 1)
        $day = "0" . $day;

    $day = $subStr[0] . $month . $day;

    return $day;
}

function _custom_check_national_code($code) {

    if(!preg_match('/^[0-9]{10}$/',$code))
        return false;

    for($i=0;$i<10;$i++)
        if(preg_match('/^'.$i.'{10}$/',$code))
            return false;
    for($i=0,$sum=0;$i<9;$i++)
        $sum+=((10-$i)*intval(substr($code, $i,1)));
    $ret=$sum%11;
    $parity=intval(substr($code, 9,1));
    if(($ret<2 && $ret==$parity) || ($ret>=2 && $ret==11-$parity))
        return true;
    return false;
}

function makeValidInput($input) {
    $input = addslashes($input);
    $input = trim($input);
    if(get_magic_quotes_gpc())
        $input = stripslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}

function uploadCheck($target_file, $name, $section, $limitSize, $ext, $ext2 = "") {

    $err = "";
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);

    if ($_FILES[$name]["size"] > $limitSize) {
        $limitSize /= 1000000;
        $limitSize .= "MB";
        $err .=  "حداکثر حجم مجاز برای بارگذاری تصویر " .  " <span>" . $limitSize . " </span>" . "می‌باشد" . "<br />";
    }

    $imageFileType = strtolower($imageFileType);

    if(!empty($ext2)) {
        if ($ext != -1 && $imageFileType != $ext && $imageFileType != $ext2)
            $err .= " شما تنها فایل های $ext را می‌توانید در این قسمت آپلود نمایید";
    }
    else {
        if ($ext != -1 && $imageFileType != $ext)
            $err .= " شما تنها فایل های $ext را می‌توانید در این قسمت آپلود نمایید";
    }
    return $err;
}

function upload($target_file, $name, $section) {

    try {
        move_uploaded_file($_FILES[$name]["tmp_name"], $target_file);
    }
    catch (Exception $x) {
        return "اشکالی در آپلود تصویر در قسمت " . $section . " به وجود آمده است" . "<br />";
    }
    return "";
}

function convertDate($created) {

    include_once 'jdate.php';

    if(count(explode(' ', $created)) == 2)
        $created = explode('-', explode(' ', $created)[0]);
    else
        $created = explode('-', $created);

    $created = gregorian_to_jalali($created[0], $created[1], $created[2]);
    return $created[0] . '/' . $created[1] . '/' . $created[2];
}

function getToday() {

    include_once 'jdate.php';

    $jalali_date = jdate("c");

    $date_time = explode('_', $jalali_date);
    $subStr = explode('/', $date_time[0]);

    if(strlen($subStr[1]) == 1)
        $subStr[1] = "0" . $subStr[1];

    if(strlen($subStr[2]) == 1)
        $subStr[2] = "0" . $subStr[2];

    $day = $subStr[0] . $subStr[1] . $subStr[2];

    $time = explode(':', $date_time[1]);

    $time = $time[0] . $time[1];

    return ["date" => $day, "time" => $time];
}

function MiladyToShamsi($time, $date = ""){

    include_once 'jdate.php';

    if(empty($date)) {
        $date = $time->format('Y-m-d');
        $date = explode('-', $date);
    }
    return gregorian_to_jalali($date[0],$date[1],$date[2],'-');
}

function MiladyToShamsiAPI($time){

    include_once 'jdate.php';

    $date = explode('-',explode(" ", $time)[0]);
    return gregorian_to_jalaliAPI($date[0],$date[1],$date[2],'-') . " ساعت " . explode(":", explode(" ", $time)[1])[0];
}

function convertDateToString($date) {

    $subStrD = explode('/', $date);

    if(count($subStrD) == 1)
        $subStrD = explode(',', $date);

    if(strlen($subStrD[1]) == 1)
        $subStrD[1] = "0" . $subStrD[1];

    if(strlen($subStrD[2]) == 1)
        $subStrD[2] = "0" . $subStrD[2];

    return $subStrD[0] . $subStrD[1] . $subStrD[2];
}

function convertTimeToString($time) {
    $subStrT = explode(':', $time);
    return $subStrT[0] . $subStrT[1];
}

function convertStringToTime($time) {
    return $time[0] . $time[1] . ":" . $time[2] . $time[3];
}

function convertStringToDate($date, $spliter = '/') {
    if($date == "")
        return $date;
    return $date[0] . $date[1] . $date[2] . $date[3] . $spliter . $date[4] . $date[5] . $spliter . $date[6] . $date[7];
}

function generateRandomString($length = 20) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function createPayLink($shouldPay, $uId) {

    $rand = generateRandomString();

    while (\App\models\Links::whereVal_($rand)->count() > 0) {
        $rand = generateRandomString();
    }

    $tmp = new \App\models\Links();
    $tmp->should_pay = $shouldPay;
    $tmp->val_ = $rand;
    $tmp->user_id = $uId;
    $tmp->save();

    return $rand;
}