<?php

namespace App\Http\Controllers;

use App\Models\DSDangKy;
use App\Models\SinhVien;
use App\Models\HocKy;
use App\Models\MonHoc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class DangKyController extends Controller
{
    public function index(Request $request)
    {
        $sinhvien = Auth::user();
        $currentDate = now();

        // lấy học kỳ hiện tại của sinh viên (trạng thái "đang học")
        $currentSemester = DB::table('hocky_sinhvien')
            ->join('hocky', 'hocky_sinhvien.mahocky', '=', 'hocky.mahocky')
            ->where('hocky_sinhvien.mssv', $sinhvien->mssv)
            ->where('hocky_sinhvien.trangthai_hocky_sinhvien', 1)
            ->orderBy('hocky.ngaybatdau', 'desc')
            ->first();

        // níu sinh viên chưa có học kỳ nào, lấy học kỳ gần nhất có trạng thái true
        if (!$currentSemester) {
            $currentSemester = HocKy::where('trangthai', true)
                ->where('ngaybatdau', '<=', $currentDate)
                ->orderBy('ngaybatdau', 'desc')
                ->first();
        }

        if (!$currentSemester) {
            return back()->with('error', 'Hiện tại không có học kỳ nào đang mở đăng ký');
        }

        // lấy danh sách học kỳ từ học kỳ hiện tại trở đi
        $hockyList = HocKy::where('trangthai', true)
            ->where('ngaybatdau', '>=', $currentSemester->ngaybatdau)
            ->orderBy('ngaybatdau', 'desc')
            ->get();

        $selectedType = request('study_type', 'new');
        $selectedHocKy = request('hocky', $currentSemester->mahocky);

        // kiểm tra xem học kỳ được chọn có ok ko
        $selectedSemester = $hockyList->firstWhere('mahocky', $selectedHocKy);

        if ($selectedSemester && $selectedSemester->ngaybatdau > $currentDate) {
            return back()->with('error', 'Học kỳ này chưa mở đăng ký');
        }

        // lấy danh sách môn học đã đăng ký để loại trừ mấy môn đó không cho đăng ký nữa
        $monHocDaDangKy = $sinhvien->dsdangky->pluck('mamonhoc')->toArray();

        // lấy danh sách môn học có thể đăng ký
        $monHocList = MonHoc::where('makhoa', $sinhvien->makhoa)
            ->where('mahocky', $selectedHocKy)
            ->where('trangthai', true)
            ->whereNotIn('mamonhoc', $monHocDaDangKy)
            ->get();

        return view('dangky', compact(
            'sinhvien',
            'hockyList',
            'selectedHocKy',
            'monHocList',
            'selectedType',
            'currentSemester'
        ));
    }

    public function search(Request $request)
    {
        $sinhvien = Auth::user();
        $currentDate = now();
        $searchTerm = $request->input('search');

        $currentSemester = DB::table('hocky_sinhvien')
            ->join('hocky', 'hocky_sinhvien.mahocky', '=', 'hocky.mahocky')
            ->where('hocky_sinhvien.mssv', $sinhvien->mssv)
            ->where('hocky_sinhvien.trangthai_hocky_sinhvien', 'đang học')
            ->orderBy('hocky.ngaybatdau', 'desc')
            ->first();

        if (!$currentSemester) {
            $currentSemester = HocKy::where('trangthai', true)
                ->where('ngaybatdau', '<=', $currentDate)
                ->orderBy('ngaybatdau', 'desc')
                ->first();
        }

        $hockyList = HocKy::where('trangthai', true)
            ->where('ngaybatdau', '>=', $currentSemester->ngaybatdau)
            ->orderBy('ngaybatdau', 'desc')
            ->get();

        $selectedType = request('study_type', 'new');
        $selectedHocKy = request('hocky', $currentSemester->mahocky);

        $monHocDaDangKy = $sinhvien->dsdangky->pluck('mamonhoc')->toArray();

        $monHocList = MonHoc::where('makhoa', $sinhvien->makhoa)
            ->where('mahocky', $selectedHocKy)
            ->where('trangthai', true)
            ->whereNotIn('mamonhoc', $monHocDaDangKy)
            ->where(function ($query) use ($searchTerm) {
                $query->where('mamonhoc', 'like', '%' . $searchTerm . '%')
                    ->orWhere('tenmonhoc', 'like', '%' . $searchTerm . '%')
                    ->orWhere('giangvien', 'like', '%' . $searchTerm . '%')
                    ->orWhere('lichhoc', 'like', '%' . $searchTerm . '%');
            })
            ->get();

        if ($monHocList->isEmpty()) {
            return back()->with('error', 'Không tìm thấy môn học phù hợp với từ khóa ' . $searchTerm . '!');
        }

        return view('dangky', compact(
            'sinhvien',
            'hockyList',
            'selectedHocKy',
            'monHocList',
            'selectedType',
            'currentSemester'
        ))->with('success', 'Đã tìm thấy ' . $monHocList->count() . ' môn học phù hợp');
    }

    public function addMonHoc(Request $request)
    {
        $sinhvien = Auth::user();
        $mamonhoc = $request->input('mamonhoc');

        // Sử dụng transaction để đảm bảo tính toàn vẹn dữ liệu
        return DB::transaction(function () use ($sinhvien, $mamonhoc) {

            $monhoc = MonHoc::where('mamonhoc', $mamonhoc)->lockForUpdate()->first();

            if ($monhoc && $monhoc->dadangky < $monhoc->soluongsinhvien) {
                DB::table('dsdangky')->insert([
                    'mamonhoc' => $mamonhoc,
                    'mssv' => $sinhvien->mssv,
                    'dstenmonhoc' => $monhoc->tenmonhoc,
                    'dsgiangvien' => $monhoc->giangvien,
                    'dssotinchi' => $monhoc->sotinchi,
                ]);

                $monhoc->dadangky += 1;
                $monhoc->save();

                // Trả về thông báo thành công sau khi transaction thành công
                return response()->json([
                    'message' => 'Đăng ký học phần thành công!',
                    'redirect' => route('dangky') // Đảm bảo route đúng
                ], 200);
            } else {
                // Nếu môn học đã hết chỗ, trả về thông báo thất bại
                return response()->json([
                    'message' => 'Môn học đã hết chỗ!'
                ], 400);
            }
        });
    }

    public function addMonHocWithoutTransaction(Request $request)
    {
        $sinhvien = Auth::user();
        $mamonhoc = $request->input('mamonhoc');

        $monhoc = MonHoc::where('mamonhoc', $mamonhoc)->first();

        if ($monhoc && $monhoc->dadangky < $monhoc->soluongsinhvien) {
            usleep(2000000);
            DB::table('dsdangky')->insert([
                'mamonhoc' => $mamonhoc,
                'mssv' => $sinhvien->mssv,
                'dstenmonhoc' => $monhoc->tenmonhoc,
                'dsgiangvien' => $monhoc->giangvien,
                'dssotinchi' => $monhoc->sotinchi,
            ]);

            // Cập nhật số lượng đã đăng ký
            $monhoc->dadangky += 1;
            $monhoc->save();

            // Trả về thông báo thành công
            return response()->json(['message' => 'Đăng ký học phần thành công!', 'redirect' => route('dangky')], 200);
        } else {
            // Thông báo lỗi nếu đã hết chỗ
            return response()->json(['message' => 'Môn học đã hết chỗ!'], 400);
        }
    }


    public function ketQuaDangKy()
    {
        $sinhvien = Auth::user();
        $mssv = $sinhvien->mssv;
        $hoten = $sinhvien->hoten;
        // Lấy danh sách đăng ký của sinh viên
        $dsDangKy = DSDangKy::with('monHoc')
            ->where('mssv', $mssv)
            ->get();

        return view('ketquadangky', compact('sinhvien', 'dsDangKy', 'hoten'));
    }

    public function deleteDangKy($mamonhoc)
    {
        $sinhvien = Auth::user();
        $mssv = $sinhvien->mssv;

        // Lấy thông tin môn học từ bảng monhoc
        $monhoc = DB::table('monhoc')->where('mamonhoc', $mamonhoc)->first();

        // Kiểm tra nếu môn học tồn tại
        if ($monhoc) {
            // Xóa học phần từ bảng `dsdangky` với `mssv` và `mamonhoc` tương ứng
            DB::table('dsdangky')->where([
                ['mssv', '=', $mssv],
                ['mamonhoc', '=', $mamonhoc]
            ])->delete();

            // Cập nhật lại giá trị `dadangky` trong bảng `monhoc`
            $newDaDangKy = $monhoc->dadangky - 1; // Giảm giá trị `dadangky` đi 1
            DB::table('monhoc')->where('mamonhoc', $mamonhoc)->update(['dadangky' => $newDaDangKy]);

            // Chuyển hướng về trang kết quả đăng ký với thông báo thành công
            return redirect()->route('ketquadangky')->with('success', 'Xóa học phần thành công!');
        }

        // Nếu môn học không tồn tại, chuyển hướng với thông báo lỗi
        return redirect()->route('ketquadangky')->with('error', 'Môn học không tồn tại!');
    }
}
