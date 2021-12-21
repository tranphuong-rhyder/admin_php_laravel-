<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    public function getLogin() {
        if(Auth::check()) {
            // dd(Auth::check());
            return redirect('/admin');
        }
        return view('admin.layouts.login');
    }

    public function postLogin(Request $request) {
        try {
            $arr = ['email' => $request->email, 'password' => $request->password ];
            $remember_me = $request->has('remember_me') ? true : false;
            // dd(Auth::attempt($arr,$remember_me));
            if(Auth::attempt($arr,$remember_me)){
                return redirect('admin')->with('success','Đăng nhập thành công !');;
            }
            else return redirect('login')->with('error','Sai tài khoản hoặc mật khẩu!');
        } catch (\Exception $e) {
            Log::info($e);
            return redirect()->back()->with('error', 'Đăng nhập thất bại');
        }
    }

    public function logout()
    {
        // Session::flush();

        Auth::logout();

        return redirect('login');
    }
}
