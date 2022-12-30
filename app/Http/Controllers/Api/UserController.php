<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Dotenv\Parser\Value;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email',
        ]);
        if ($validator->fails()) {
            return response()->json(['statusCode' => 422, 'message' => $validator->errors()]);
        } else if (!isset($data['email']) || !isset($data['password'])) {
            return response()->json(['statusCode' => 404, 'message' => 'Please fill all fields']);
        } else {
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                $user = User::find(Auth::user()->id);
                $token =  $user->createToken('MyApp')->accessToken;
                $user->update(['token' => $token]);
                return response()->json(['statusCode' => 200, 'data' => ['token' => $token]]);
            } else {
                return response()->json(['statusCode' => 401, 'message' => 'Unauthorised']);
            }
        }
    }
    public function logout()
    {
        Auth::user()->token()->revoke();
        return response()->json(['statusCode' => 200, 'message' => 'Đăng xuất thành công']);
    }
    public function register(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'email' => 'email|unique:users,email',
        ]);
        if ($validator->fails()) {
            return response()->json(['statusCode' => 422, 'message' => $validator->errors()]);
        } else if (!isset($data['email']) || !isset($data['password']) || !isset($data['confirm_password']) || !isset($data['name']) || !isset($data['type'])) {
            return response()->json(['statusCode' => 404, 'message' => 'Please fill all fields']);
        } else {
            if ($data['password'] != $data['confirm_password']) {
                return response()->json(['statusCode' => 401, 'message' => 'Password does not match']);
            } else {
                $data['password'] = Hash::make($data['password']);
                $user = User::create($data);
                $token =  $user->createToken('MyApp')->accessToken;
                $user->update(['token' => $token]);
                return response()->json(['statusCode' => 200, 'data' => ['token' => $token]]);
            }
        }
    }
    public function sendEmail(Request $request)
    {
        $data = $request->all();
        if (User::where('email', $data['email'])->count() > 0) {
            $user = User::where('email', $data['email'])->first();
            $otp = rand(100000, 999999);
            $user->update(['otp' => $otp]);
            $mailData = [
                "name" => $user['name'],
                "otp" => $otp
            ];
            Mail::to($data['email'])->send(new \App\Mail\SendMail($mailData));
            return response()->json(['statusCode' => 200, 'data' => ['otp' => $otp]]);
        } else {
            return response()->json(['statusCode' => 401, 'message' => 'Email not exists']);
        }
    }
    public function checkOtp(Request $request)
    {
        $data = $request->all();
        if (User::where('email', $data['email'])->where('otp', $data['otp'])->count() > 0) {
            $user = User::where('email', $data['email'])->first();
            $user->update(['otp' => ""]);
            return response()->json(['statusCode' => 200, 'message' => 'Your OTP is correct']);
        } else {
            return response()->json(['statusCode' => 401, 'message' => 'Your OTP not correct']);
        }
    }
    public function resetPassword(Request $request)
    {
        $data = $request->all();
        if (!isset($data['password']) || !isset($data['confirm_password'])) {
            return response()->json(['statusCode' => 404, 'message' => 'Please fill all fields']);
        } else if ($data['password'] !== $data['confirm_password']) {
            return response()->json(['statusCode' => 401, 'message' => 'Password does not match']);
        } else {
            $user = User::where('email', $data['email'])->first();
            $user->update(['password' => Hash::make($data['password'])]);
            return response()->json(['statusCode' => 200, 'message' => 'Password Reset Success']);
        }
    }
    public function profile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($request->isMethod('POST')) {
            $data = $request->all();
            $user->update($data);
            return response()->json(['statusCode' => 200, 'message' => 'Thay đổi thông tin thành công']);
        }
        return response()->json(['statusCode' => 200, 'data' => ['user' => $user]]);
    }
    public function changePassword(Request $request)
    {
        $data=$request->all();
        $user=User::find(Auth::user()->id);
        if(Hash::check($user['password'], $data['old_password'])){
            if($data['new_password']==$data['confirm_password']){
                $user->update(['password' => Hash::make($data['new_password'])]);
                return response()->json(['statusCode' => 200, 'message' => 'Đổi mật khẩu thành công']);
            }else{
                return response()->json(['statusCode' => 401,'message' => 'Mật khẩu không trùng khớp']);
            }
        }else{
            return response()->json(['statusCode' => 401,'message' => 'Mật khẩu cũ không đúng']);
        }
    }
    // public function registerProfessional(Request $request){
    //     $data=$request->all();
    //     $user=User::find(Auth::user()->id);
    //     $user->update(['type'=>$data['type']]);
    //     return response()->json(['statusCode' => 200,'message' => 'Cập nhật chuyên gia thành công']);
    // }
}
