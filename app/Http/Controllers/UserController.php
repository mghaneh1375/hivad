<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\State;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller {

    public function namayandeha() {

        $val = getValueInfo('namayandeLevel');
        $users = User::whereLevel($val)->get();
        foreach ($users as $user) {

            $city = City::whereId($user->city_id);
            if($city == null)
                return Redirect::to('profile');

            $user->city = $city->name;
            $user->state = State::whereId($city->state_id)->name;

        }

        return view('admin.users', array('mode' => $val, 'users' => $users));
    }

    public function addNamayande() {
        return view('admin.addUser', array('url' => route('addNamayande'), 'states' => State::all()));
    }

    public function doAddNamayande() {

        $msg = $username = $password = $firstName = $lastName = $phoneNum =
            $NID = $rpassword = $sex = "";

        if (isset($_POST["doAdd"])) {

            $username = makeValidInput($_POST["username"]);
            $password = makeValidInput($_POST["password"]);
            $rpassword = makeValidInput($_POST["rpassword"]);
            $firstName = makeValidInput($_POST["firstName"]);
            $lastName = makeValidInput($_POST["lastName"]);
            $phoneNum = makeValidInput($_POST["phoneNum"]);
            $NID = makeValidInput($_POST["NID"]);
            $sex = makeValidInput($_POST["sex"]);
            $city = makeValidInput($_POST["city"]);

            if(User::whereUsername($username)->count() > 0) {
                $msg .= "نام کاربری وارد شده در سامانه موجود است" . "<br/>";
            }

            if($password != $rpassword) {
                $msg .= "رمزعبور با تکرار آن یکسان نیست" . "<br/>";
            }

            if(User::whereNid($NID)->count() > 0) {
                $msg .= "کد ملی وارد شده در سامانه موجود است" . "</br>";
            }

            if(!_custom_check_national_code($NID)) {
                $msg .= "کد ملی وارد شده نامعتبر است" . "<br/>";
            }

            if(User::wherePhoneNum($phoneNum)->count() > 0) {
                $msg .= "شماره همراه وارد شده در سامانه موجود است" . "</br>";
            }

            if(empty($msg)) {

                try {

                    $user = new User();

                    $user->username = $username;
                    $user->first_name = $firstName;
                    $user->last_name = $lastName;
                    $user->password = Hash::make($password);
                    $user->nid = $NID;
                    $user->phone_num = $phoneNum;
                    $user->sex = $sex;
                    $user->status = 1;
                    $user->city_id = $city;
                    $user->level = getValueInfo('namayandeLevel');

                    if(isset($_FILES["img"]) && !empty($_FILES["img"]["name"])) {
                        $file = Input::file('img');
                        $Image = time() . '_' . $file->getClientOriginalName();

                        $destenationpath = __DIR__ . '/../../../public/usersPic/';
                        $file->move($destenationpath, $Image);
                        $user->img = $Image;
                    }

                    $user->save();
                }
                catch (\Exception $x) {
                    dd($x);
                    $msg = "خطایی در انجام عملیات مورد نظر رخ داده است";
                }

                if(empty($msg))
                    return Redirect::route('namayandeha');
            }
        }

        return view('admin.addUser', array('url' => route('addNamayande'), "msg" => $msg,
            "username" => $username, 'states' => State::all(), "NID" => $NID,
            "phoneNum" => $phoneNum, "sex" => $sex, "firstName" => $firstName, "lastName" => $lastName));
    }

    public function toggleStatusUser() {

        if(myPostIsset("uId") && myPostIsset("redirectRoute")) {

            $user = User::whereId(makeValidInput($_POST["uId"]));
            if($user == null)
                return Redirect::route("home");

            $user->status = !$user->status;
            $user->save();

            return Redirect::route(makeValidInput($_POST["redirectRoute"]));
        }

        return Redirect::route("home");
    }
}
