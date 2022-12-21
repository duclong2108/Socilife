<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
class AdminController extends Controller
{
    public function login(Request $request){
        // dd(Hash::make(1));
        if($request->isMethod('post')){
            $data=$request->all();
            if(Auth::guard('admin')->attempt(['email'=>$data['email'], 'password'=>$data['password']])){
                return redirect('/admin/dashboard')->with('success_message', 'Đăng nhập thành công');
            }else{
                return redirect()->back()->with('error_message', 'Đăng nhập không thành công!');
            }
        }
        return View('login');
    }
    public function dashboard(Request $request){
        $admin=Admin::find(Auth::guard('admin')->user()->id);
        return View('dashboard', compact('admin'));
    }
    public function logout(Request $request){
        Auth::guard('admin')->logout();
        return redirect('/admin')->with('success_message', 'Đăng xuất thành công');
    }
    public function account(Request $request){
        $admin=Admin::find(Auth::guard('admin')->user()->id);
        if($request->isMethod('post')){
            $data=$request->all();
            if(isset($data['password'])&&isset($data['confirm_password'])){
                if($data['password']==$data['confirm_password']){
                    $data['password']=Hash::make($data['password']);
                    $admin->update($data);
                    return redirect()->back()->with('success_message', 'Cập nhật thành công!');
                }else{
                    return redirect()->back()->with('error_message', 'Mật khẩu không giống nhau!');
                }
            }else{
                return redirect()->back()->with('error_message', 'Vui lòng điền đầy đủ thông tin!');
            }
        }
        return View('account', compact('admin'));
    }
}
