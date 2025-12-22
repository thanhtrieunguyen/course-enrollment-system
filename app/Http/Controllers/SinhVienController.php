<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SinhVien;
use App\Models\LopHoc;
use App\Models\Khoa;
use App\Models\HocKy;
use App\Models\HocKy_SinhVien;

class SinhVienController extends Controller
{
    public function index()
    {
        $query = SinhVien::query();
        $sinhviens = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('sinhvien.index', compact('sinhviens'));
    }

    public function create()
    {
        $lops = LopHoc::all(); // Lấy danh sách các lớp học
        $khoas = Khoa::all();  // Lấy danh sách các khoa
        $hockys = HocKy::all(); // Lấy danh sách các học kỳ
        return view('sinhvien.create', compact('lops', 'khoas', 'hockys'));
    }

    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'mssv' => 'required|unique:sinhvien|max:255',
            'password' => 'required',
            'hoten' => 'required',
            'ngaysinh' => 'required|date',
            'gioitinh' => 'required',
            'malop' => 'required',
            'makhoa' => 'required',
            'quequan' => 'required',
            'mahocky' => 'required',
        ]);

        // Tạo mới sinh viên
        $sinhvien = new SinhVien();
        $sinhvien->mssv = $request->mssv;
        $sinhvien->password = bcrypt($request->password);
        $sinhvien->hoten = $request->hoten;
        $sinhvien->ngaysinh = $request->ngaysinh;
        $sinhvien->gioitinh = $request->gioitinh;
        $sinhvien->malop = $request->malop;
        $sinhvien->makhoa = $request->makhoa;
        $sinhvien->quequan = $request->quequan;

        $sinhvien->save();

        $hocky_sinhvien = new HocKy_SinhVien();
        $hocky_sinhvien->mssv = $request->mssv;
        $hocky_sinhvien->mahocky = $request->mahocky;
        $hocky_sinhvien->trangthai_hocky_sinhvien = 1; // 0: Đã hoàn thành, 1: Đang học, 2: Bảo lưu

        $hocky_sinhvien->save();

        return redirect()->route('sinhvien.index')->with('success', 'Sinh viên mới đã được tạo thành công!');
    }

    public function getLops($makhoa)
    {
        $lops = LopHoc::where('makhoa', $makhoa)->get(); // Lấy danh sách lớp theo khoa
        return response()->json($lops);
    }

    public function edit($mssv)
    {
        $sinhvien = SinhVien::findOrFail($mssv);
        $lops = LopHoc::with('khoa')->get();
        return view('sinhvien.edit', compact('sinhvien', 'lops'));
    }

    public function update(Request $request, $mssv)
    {
        $sinhvien = SinhVien::findOrFail($mssv);
        $lop = LopHoc::where('malop', $request->input('lop'))->first();

        // Kiểm tra giá trị updated_at từ request và database
        if ($request->input('updated_at') != $sinhvien->updated_at) {
            // Nếu không khớp, trả về thông báo lỗi
            return redirect()->back()->with('error', 'Dữ liệu đã thay đổi bởi người khác. Vui lòng tải lại trang và thử lại.');
        }

        if ($request->input('mssv') !== $sinhvien->mssv) {
            $sinhvien->mssv = $request->input('mssv');
        }

        if ($request->input('hoten') !== $sinhvien->hoten) {
            $sinhvien->hoten = $request->input('hoten');
        }

        if ($request->input('ngaysinh') !== $sinhvien->ngaysinh) {
            $sinhvien->ngaysinh = $request->input('ngaysinh');
        }

        if ($request->input('gioitinh') !== $sinhvien->gioitinh) {
            $sinhvien->gioitinh = $request->input('gioitinh');
        }

        if ($request->input('lop') !== $sinhvien->malop) {
            $sinhvien->malop = $lop->malop;
            $sinhvien->makhoa = $lop->makhoa;
        }

        if ($request->input('quequan') !== $sinhvien->quequan) {
            $sinhvien->quequan = $request->input('quequan');
        }

        // Lưu các thay đổi vào cơ sở dữ liệu nếu có sự thay đổi
        if ($sinhvien->isDirty()) {
            $sinhvien->save();
        }


        return redirect()->route('sinhvien.index')->with('success', 'Cập nhật sinh viên thành công');
    }

    public function destroy($mssv)
    {
        $sinhvien = SinhVien::findOrFail($mssv);
        $sinhvien->hocky_sinhvien()->delete();
        $sinhvien->dsdangky()->delete();
        $sinhvien->delete();
        return redirect()->route('sinhvien.index')->with('success', 'Xóa sinh viên thành công');
    }

    public function getStudentInfo($mssv)
    {
        $sinhvien = SinhVien::where('mssv', $mssv)->first();

        if (!$sinhvien) {
            return response()->json(['message' => 'Không tìm thấy sinh viên.'], 404);
        }

        return response()->json([
            'mssv' => $sinhvien->mssv,
            'hoten' => $sinhvien->hoten,
            'ngaysinh' => $sinhvien->ngaysinh,
            'lop' => $sinhvien->lop,
        ]);
    }
}
