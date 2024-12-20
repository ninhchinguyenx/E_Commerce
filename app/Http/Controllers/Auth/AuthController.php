<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function showLoginAdminForm()
    {
        return view('auth.loginAdmin');
    }
    public function showRegisterForm()
{
    return view('auth.register');
}

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if (!$user->is_active) {
                Auth::logout();
                toastr()->error('Tài khoản này chưa được kích hoạt!');
                return back();
            }

            $request->session()->regenerate();
            if($request->loginAdmin == 1){
                toastr()->success('Đăng nhập thành công.');
                return redirect('/admin');
            }else{
                toastr()->success('Đăng nhập thành công.');
                return redirect('/');
            }
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        toastr()->success('Đăng xuất thành công!');
        return redirect('/login');
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:3',
        ]);
        // Tạo người dùng mới
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Tự động đăng nhập sau khi đăng ký
        Auth::attempt($request->only('email', 'password'));

        // Chuyển hướng đến trang dashboard
        toastr()->success('Đăng ký thành công.');
        return redirect()->route('home');
    }
}
