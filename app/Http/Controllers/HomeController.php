<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\SinhVien;
use App\Models\MonHoc;
use App\Models\Khoa;
use App\Models\LopHoc;
use App\Models\DSDangKy;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function getHome()
    {
        $sinhvien = Auth::user();
        $hoten = $sinhvien->hoten;

        return view('home', compact('hoten', 'sinhvien'));
    }

    public function getAdminHome()
    {
        $stats = [
            'total_students' => SinhVien::where('role', 'user')->count(),
            'total_courses' => MonHoc::count(),
            'total_khoas' => Khoa::count(),
            'total_classes' => LopHoc::count(),
            'total_registrations' => DSDangKy::count(),
        ];

        // Dữ liệu cho biểu đồ đăng ký theo khoa (ví dụ)
        $registrations_by_khoa = Khoa::withCount('sinhviens')->get();

        // Môn học hot nhất
        $hot_courses = MonHoc::orderBy('dadangky', 'desc')->take(5)->get();

        return view('admin.home', compact('stats', 'registrations_by_khoa', 'hot_courses'));
    }

    public function resetDemoData()
    {
        try {
            Artisan::call('demo:restore-database', [
                '--force' => true,
            ]);

            return redirect()->route('admin.home')->with('success', 'Demo data has been reset.');
        } catch (\Throwable $exception) {
            report($exception);

            return redirect()->route('admin.home')->with('error', 'Could not reset demo data. Please check logs.');
        }
    }
}
