<?php

namespace App\Http\Controllers;

use App\Models\HocKy_SinhVien;
use App\Models\LopHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\SinhVien;
use App\Models\Khoa;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;



class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('trangchu');
        }

        return view('auth.login');
    }



    public function getLops($makhoa)
    {
        $lops = LopHoc::where('makhoa', $makhoa)->get(); // Lấy danh sách lớp theo khoa
        return response()->json($lops);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('mssv', 'password');

        if (empty($credentials['mssv']) || empty($credentials['password'])) {
            return redirect()->back()->with('error', 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu.');
        }

        $user = SinhVien::where('mssv', $credentials['mssv'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return redirect()->back()->with('error', 'Tên đăng nhập hoặc mật khẩu không đúng.');
        }

        Auth::login($user);
        $request->session()->regenerate();

        if ($user->role === 'admin') {
            $request->session()->put('isAdmin', true);
            return redirect()->route('admin.home');
        }

        if (Auth::check()) {
            $minutes = 60 * 24 * 30;

            $cookie = Cookie::make('login_token', $user->mssv, $minutes);
            Cookie::queue($cookie);

            return redirect()->intended('trangchu')->with('hoten', $user->hoten);
        }

        return redirect()->back()->with('error', 'Đăng nhập không thành công.');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        if ($request->session()->has('isAdmin')) {
            $request->session()->forget('isAdmin');
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        Cookie::queue(Cookie::forget('login_token'));

        Session::flash('message', 'Đăng xuất thành công!');
        return redirect()->route('login');
    }
}
