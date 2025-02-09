<?php

namespace App\Http\Controllers\auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(){
        return view("customer.auth.login");
    }

    public function checkLogin(Request $request){
        $credentials = [
            "email" => $request->email,
            "password" => $request->password,
        ];
    
        $remember = $request->remember;
    
        if(Auth::attempt($credentials, $remember)){
            // Kiểm tra người dùng đã đăng nhập chưa
            if(Auth::check()){
                $user = Auth::user();  // Lấy thông tin người dùng
                // Kiểm tra vai trò người dùng
                if($user->role == 2){
                    return redirect()->intended(""); // Trang dành cho người dùng có role = 2
                } else {
                    return redirect()->intended("admin/users"); // Trang dành cho quản trị viên
                }
            }
        } else {
            return back()->with('error','EMAIL or PASSWORD is incorrect!');
        }
    }
    

    public function logout(){
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken(); 

        return view('customer.auth.login');
    }

    public function registerView(){
        return view('customer.auth.register');
    }

    public function register(Request $request){
        $validated = $request->validate([
            'email'=> 'required|email',
            'password'=> 'required',
            'name' =>'required',
            "con-password"=>"required"
        ]);

        if($validated['password']!=$validated['con-password']){
            return back()->with('error','Confirm password does not match');
        }
        $user = User::create([
            'email'=> $validated['email'],
            'name'=> $validated['name'],
            'password'=> bcrypt($validated['password']),
            'avatar'=>'safsd',
            'role'=> 2,
        ]);

        return redirect()->route('login')->with('success','Register successfully ! Please login now');

    }
}
