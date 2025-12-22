<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SinhvienSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sinhvien')->delete();
        DB::table('hocky_sinhvien')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Admin Account
        DB::table('sinhvien')->insert([
            'mssv' => 'admin',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'hoten' => 'Hệ thống Quản trị',
            'ngaysinh' => '1990-01-01',
            'gioitinh' => 'Nam',
            'malop' => 1,
            'makhoa' => 'CNTT',
            'quequan' => 'Hà Nội',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $hos = ['Nguyễn', 'Trần', 'Lê', 'Phạm', 'Hoàng', 'Huỳnh', 'Phan', 'Vũ', 'Võ', 'Đặng', 'Bùi', 'Đỗ', 'Hồ', 'Ngô', 'Dương', 'Lý'];
        $dems = ['Văn', 'Thị', 'Đình', 'Thanh', 'Minh', 'Hữu', 'Đức', 'Trọng', 'Kim', 'Anh', 'Ngọc', 'Quốc', 'Tú', 'Xuân', 'Hoàng'];
        $tens = ['An', 'Bình', 'Chi', 'Dũng', 'Em', 'Giang', 'Hương', 'Inh', 'Khánh', 'Linh', 'Minh', 'Nam', 'Oanh', 'Phúc', 'Quang', 'Sơn', 'Tuấn', 'Uyên', 'Vinh', 'Xuân', 'Yến', 'Trình', 'Toàn', 'Khôi', 'Khoa', 'Kiên', 'Hùng', 'Hào', 'Hải', 'Hậu'];
        $ques = ['Hà Nội', 'TP.HCM', 'Đà Nẵng', 'Cần Thơ', 'Hải Phòng', 'Bình Dương', 'Đồng Nai', 'Nghệ An', 'Thanh Hóa', 'Huế', 'Quảng Nam', 'Quảng Ngãi', 'Khánh Hòa', 'Lâm Đồng', 'Tiền Giang'];

        $khoas = ['CNTT', 'KT', 'NN', 'DTVT', 'CB'];
        $lops_by_khoa = [
            'CNTT' => [1, 2, 7],
            'KT' => [3, 4, 8],
            'NN' => [9, 10],
            'DTVT' => [11],
            'CB' => [5, 6, 12]
        ];

        $students = [];
        $hocky_sinhvien = [];

        for ($i = 1; $i <= 100; $i++) {
            $mssv = '22548' . str_pad($i, 5, '0', STR_PAD_LEFT);
            $makhoa = $khoas[array_rand($khoas)];
            $malop = $lops_by_khoa[$makhoa][array_rand($lops_by_khoa[$makhoa])];
            $gt = (rand(0, 5) == 0) ? 'Nữ' : 'Nam'; // Slightly more male for variety

            $students[] = [
                'mssv' => $mssv,
                'password' => Hash::make('123456'),
                'role' => 'user',
                'hoten' => $hos[array_rand($hos)] . ' ' . $dems[array_rand($dems)] . ' ' . $tens[array_rand($tens)],
                'ngaysinh' => rand(2002, 2005) . '-' . str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT) . '-' . str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT),
                'gioitinh' => $gt,
                'malop' => $malop,
                'makhoa' => $makhoa,
                'quequan' => $ques[array_rand($ques)],
                'created_at' => now(),
                'updated_at' => now(),
            ];

            // Enroll in multiple semesters for history
            $semesters = ['HK1-23', 'HK2-23', 'HK1'];
            foreach ($semesters as $hk) {
                $hocky_sinhvien[] = [
                    'mssv' => $mssv,
                    'mahocky' => $hk,
                    'trangthai_hocky_sinhvien' => ($hk == 'HK1' ? '1' : '0'), // 1: Studying, 0: Done
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        // Chunking the insert for better performance
        foreach (array_chunk($students, 50) as $chunk) {
            DB::table('sinhvien')->insert($chunk);
        }
        foreach (array_chunk($hocky_sinhvien, 50) as $chunk) {
            DB::table('hocky_sinhvien')->insert($chunk);
        }
    }
}
