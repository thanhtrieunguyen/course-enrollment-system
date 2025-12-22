<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonhocSeeder extends Seeder
{
    public function run()
    {
        $courses = [
            // CNTT
            ['mamonhoc' => 'COMP101', 'tenmonhoc' => 'Cơ sở lập trình', 'giangvien' => 'ThS. Nguyễn Văn A', 'sotinchi' => 3, 'soluongsinhvien' => 60, 'makhoa' => 'CNTT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'COMP102', 'tenmonhoc' => 'Cấu trúc dữ liệu', 'giangvien' => 'TS. Trần Thị B', 'sotinchi' => 4, 'soluongsinhvien' => 50, 'makhoa' => 'CNTT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'COMP201', 'tenmonhoc' => 'Lập trình Web', 'giangvien' => 'ThS. Lê Văn C', 'sotinchi' => 3, 'soluongsinhvien' => 40, 'makhoa' => 'CNTT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'COMP301', 'tenmonhoc' => 'Trí tuệ nhân tạo', 'giangvien' => 'PGS.TS Phạm Văn D', 'sotinchi' => 3, 'soluongsinhvien' => 30, 'makhoa' => 'CNTT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'COMP302', 'tenmonhoc' => 'An toàn thông tin', 'giangvien' => 'ThS. Hoàng Văn E', 'sotinchi' => 3, 'soluongsinhvien' => 35, 'makhoa' => 'CNTT', 'mahocky' => 'HK1'],

            // Kinh tế
            ['mamonhoc' => 'ECON101', 'tenmonhoc' => 'Kinh tế vi mô', 'giangvien' => 'ThS. Phan Văn F', 'sotinchi' => 3, 'soluongsinhvien' => 70, 'makhoa' => 'KT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'ECON102', 'tenmonhoc' => 'Kinh tế vĩ mô', 'giangvien' => 'TS. Huỳnh Thị G', 'sotinchi' => 3, 'soluongsinhvien' => 70, 'makhoa' => 'KT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'ECON201', 'tenmonhoc' => 'Kế toán tài chính', 'giangvien' => 'ThS. Đặng Văn H', 'sotinchi' => 4, 'soluongsinhvien' => 50, 'makhoa' => 'KT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'ECON301', 'tenmonhoc' => 'Quản trị nhân sự', 'giangvien' => 'ThS. Bùi Thị I', 'sotinchi' => 3, 'soluongsinhvien' => 45, 'makhoa' => 'KT', 'mahocky' => 'HK1'],

            // Ngoại ngữ
            ['mamonhoc' => 'LANG101', 'tenmonhoc' => 'Tiếng Anh cơ bản 1', 'giangvien' => 'Ms. Jane Doe', 'sotinchi' => 3, 'soluongsinhvien' => 40, 'makhoa' => 'NN', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'LANG102', 'tenmonhoc' => 'Tiếng Anh cơ bản 2', 'giangvien' => 'Mr. John Smith', 'sotinchi' => 3, 'soluongsinhvien' => 40, 'makhoa' => 'NN', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'LANG201', 'tenmonhoc' => 'Tiếng Anh chuyên ngành', 'giangvien' => 'ThS. Vũ Văn J', 'sotinchi' => 2, 'soluongsinhvien' => 35, 'makhoa' => 'NN', 'mahocky' => 'HK1'],

            // Điện tử
            ['mamonhoc' => 'ELEC101', 'tenmonhoc' => 'Mạch điện tử 1', 'giangvien' => 'ThS. Ngô Văn K', 'sotinchi' => 3, 'soluongsinhvien' => 50, 'makhoa' => 'DTVT', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'ELEC201', 'tenmonhoc' => 'Vi xử lý', 'giangvien' => 'TS. Đỗ Văn L', 'sotinchi' => 4, 'soluongsinhvien' => 40, 'makhoa' => 'DTVT', 'mahocky' => 'HK1'],

            // Cơ bản
            ['mamonhoc' => 'MATH101', 'tenmonhoc' => 'Giải tích 1', 'giangvien' => 'TS. Lý Văn M', 'sotinchi' => 3, 'soluongsinhvien' => 100, 'makhoa' => 'CB', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'MATH102', 'tenmonhoc' => 'Đại số tuyến tính', 'giangvien' => 'ThS. Thái Văn N', 'sotinchi' => 3, 'soluongsinhvien' => 80, 'makhoa' => 'CB', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'PHYS101', 'tenmonhoc' => 'Vật lý đại cương', 'giangvien' => 'ThS. Nguyễn Văn O', 'sotinchi' => 3, 'soluongsinhvien' => 80, 'makhoa' => 'CB', 'mahocky' => 'HK1'],
            ['mamonhoc' => 'POLI101', 'tenmonhoc' => 'Triết học Mác-Lênin', 'giangvien' => 'ThS. Lê Thị P', 'sotinchi' => 3, 'soluongsinhvien' => 120, 'makhoa' => 'CB', 'mahocky' => 'HK1'],
        ];

        foreach ($courses as $key => $course) {
            $courses[$key]['lichhoc'] = 'Thứ ' . rand(2, 7) . ', ' . rand(7, 15) . 'h00-' . rand(16, 20) . 'h00';
            $courses[$key]['dadangky'] = 0;
            $courses[$key]['created_at'] = now();
            $courses[$key]['updated_at'] = now();
        }

        DB::table('monhoc')->insert($courses);
    }
}
