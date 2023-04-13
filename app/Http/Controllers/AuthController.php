<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    
    public function login(Request $request) {

        $request->validate([
            'phone' => 'required|regex:/(09)[0-9]{9}/',
            'password' => 'required'
        ]);

        $user = User::where('phone', $request['phone'])->first();
        if($user == null || !Hash::check($request['password'], $user->password))
            return response()->json([
                'status' => 'nok',
                'msg' => 'نام کاربری و یا رمزعبور اشتباه است.'
            ]);

        if($user->status !== User::ACTIVE_STATUS)
            return response()->json([
                'status' => 'nok',
                'msg' => 'حساب کاربری شما غیرفعال است.'
            ]);

        Auth::login($user);
        return response()->json(['status' => 'ok']);
    }

    public function logout(Request $request) {
        Auth::logout($request->user());
        return Redirect::route('home');
    }

    public function signUp(Request $request) {
    
        $validator = [
            'username' => 'required|regex:/(09)[0-9]{9}/|unique:users,phone',
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'password' => 'required|string|min:6',
            'rpassword' => 'required|string|min:6'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator, self::$errors);

        if($request['password'] != $request['rpassword']) {
            return response()->json([
                'status' => 'nok',
                'msg' => 'رمز و تکرار آن یکسان نیست'
            ]);
        }

        $request['password'] = Hash::make($request['password']);
        $request['phone'] = $request['username'];
        
        $activation = Activation::where('phone', $request["phone"])->first();

        if($activation != null) {
            if($activation->vc_expired_at < time())
                $activation->delete();
            else
                return response()->json([
                    "status" => "ok",
                    "reminder" => time() - $activation->vc_expired_at + 120
                ]);
        }

        $rand = self::getVerificationCode();

        $request['verification_code'] = $rand;
        $request['vc_expired_at'] = Carbon::now()->addMinutes(2)->timestamp;

        unset($request['rpassword']);
        unset($request['username']);

        self::sendSMS($request['phone'], 'کد اعتبارسنجی در سامانه هیواد: '  . $rand . ' به ما سر بزنید: https://hivadkids.ir');
        Activation::create($request->toArray());

        return response()->json(['status' => 'ok', 'reminder' => 120]);
    }

    
    public function activate(Request $request) {

        $validator = [
            "verification_code" => 'required|integer',
            'username' => 'required|regex:/(09)[0-9]{9}/|exists:activation,phone'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator, self::$errors);

        $activation = Activation::where('phone', $request["username"])
            ->where('verification_code', $request["verification_code"])->first();

        if($activation == null)
            return response()->json([
                "status" => "nok",
                "msg" => "کد وارد شده نامعتبر است"
            ]);
        else if($activation->vc_expired_at < time())
            return response()->json([
                "status" => "nok",
                "msg" => "کد وارد شده منقضی شده است"
            ]);

        if(
            ($activation->password == '' && $request->user() == null) ||
            ($activation->password != '' && $request->user() != null)
        )
            return abort(401);

        if($activation->password == '') {
            $user = $request->user();
            $user->phone = $activation->phone;
            $user->save();
            
            return response()->json([
                "status" => "ok"
            ]);
        }
        
        $user = new User();

        DB::transaction(function () use ($activation, $user) {

            $user->level = User::USER_ROLE;
            $user->status = User::ACTIVE_STATUS;
            $user->first_name = $activation->first_name;
            $user->last_name = $activation->last_name;
            $user->password = $activation->password;
            $user->phone = $activation->phone;

            $user->save();
            $activation->delete();
            
            Auth::login($user);
        });


        return response()->json([
            "status" => "ok"
        ]);
    }

    
    public function resend(Request $request) {

        $validator = [
            'username' => 'required|regex:/(09)[0-9]{9}/|exists:activation,phone'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator);

        $activation = Activation::where('phone', $request["username"])->first();

        if($activation == null)
            return response()->json([
                "status" => "nok",
                "msg" => "شماره همراه وارد شده نامعتبر است"
            ]);

        else if(time() - $activation->vc_expired_at < 120)
            return response()->json([
                "status" => "nok",
                "msg" => "کد ارسال شده هنوز منقضی نشده است"
            ]);

        $rand = self::getVerificationCode();

        self::sendSMS($request['phone'], 'کد اعتبارسنجی در سامانه هیواد: ' . $rand . ' به ما سر بزنید: https://hivadkids.ir');

        $activation->verification_code = $rand;
        $activation->vc_expired_at = Carbon::now()->addMinutes(2)->timestamp;
        $activation->save();

        return response()->json([
            "status" => "ok"
        ]);
    }

    public function changePass(Request $request)
    {

        $validator = [
            'oldPass' => 'required|string|min:6',
            'newPass' => 'required|string|min:6',
            'confirmNewPass' => 'required|string|min:6'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator, self::$errors);

        if($request['newPass'] != $request['confirmNewPass']) {
            return response()->json([
                'status' => 'nok',
                'msg' => 'رمزعبور جدید و تکرار آن یکسان نیستند'
            ]);
        }

        $user = $request->user();
        if(!Hash::check($request['oldPass'], $user->password)) {
            return response()->json([
                'status' => 'nok',
                'msg' => 'رمزعبور وارد شده نامعتبر است'
            ]);
        }

        $user->password = Hash::make($request['newPass']);
        $user->save();

        return response()->json([
            'status' => 'ok'
        ]);
    }

    public function edit(Request $request) {

        $validator = [
            'phone' => 'nullable|regex:/(09)[0-9]{9}/',
            'first_name' => 'nullable|string|min:2',
            'last_name' => 'nullable|string|min:2'
        ];

        if(self::hasAnyExcept(array_keys($validator), $request->keys()))
            abort(401);

        $request->validate($validator, self::$errors);
        $user = $request->user();

        if($request->has('phone') && $request['phone'] != $user->phone &&
            User::where('phone', $request['phone'])->count() > 0
        )
            return response()->json([
                'status' => 'nok',
                'msg' => 'شماره همراه وارد شده در سامانه موجود است'
            ]);
        
        if(!$request->has('phone') || $request['phone'] == $user->phone) {
            
            $user->first_name = $request->has('first_name') ? $request['first_name'] : $user->first_name;
            $user->last_name = $request->has('last_name') ? $request['last_name'] : $user->last_name;
            $user->save();

            return response()->json(['status' => 'ok']);
        }

        $activation = Activation::where('phone', $request["phone"])->first();

        if($activation != null) {
            if($activation->vc_expired_at < time())
                $activation->delete();
            else
                return response()->json([
                    "status" => "ok",
                    "reminder" => time() - $activation->vc_expired_at + 120
                ]);
        }

        $rand = self::getVerificationCode();

        // self::sendSMS($request['phone'], 'کد اعتبارسنجی در سامانه هیواد: '  . $rand . ' به ما سر بزنید: https://hivadkids.ir');
        Activation::create([
            'first_name' => '',
            'last_name' => '',
            'phone' => $request['phone'],
            'password' => '',
            'verification_code' => $rand,
            'vc_expired_at' => Carbon::now()->addMinutes(2)->timestamp
        ]);

        return response()->json(['status' => 'ok', 'reminder' => 120]);
    }

}
