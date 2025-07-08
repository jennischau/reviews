<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function login(){
        return view('login');
    }
    public function postLogin(Request $request)
    {
        // Xác thực đầu vào
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Thử đăng nhập
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            // Regenerate session để tránh session fixation
            $request->session()->regenerate();
            Activity::create([
                'action'     => 'Đăng nhập thành công qua WEB, số dư '.number_format(Auth::user()->balance ?? 0).'đ',
                'ip_address' => $request->ip(),
                'user_id'    => Auth::user()->id,
            ]);
            // Redirect đến dashboard hoặc trang trước đó
            return redirect()->intended('/');
        }

        // Trường hợp thất bại
        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không chính xác.',
        ])->onlyInput('email');
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
    public function register(){
        return view('register');
    }
    public function postRegister(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Đăng nhập sau khi đăng ký
        auth()->login($user);

        return redirect('/')->with('success', 'Đăng ký thành công');
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required|min:6',
            'new_password' => 'required|confirmed|min:6',
        ],[
            'old_password.required' => 'Vui lòng nhập đẩy đủ thông tin',
            'old_password.min' => 'Vui lòng nhập ít nhất 6 ký tự',
            'new_password.required' => 'Vui lòng nhập đẩy đủ thông tin',
            'new_password.confirmed' => 'Vui lòng nhập lại mật khẩu xác nhận',
            'new_password.min' => 'Vui lòng nhập ít nhất 6 ký tự',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Mật khẩu đã được cập nhật thành công!');
    }
}
