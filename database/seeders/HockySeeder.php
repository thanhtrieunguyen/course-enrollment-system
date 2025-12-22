<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HockySeeder extends Seeder
{
    public function run()
    {
        DB::table('hocky')->insert([
            [
                'mahocky' => 'HK1-23',
                'tenhocky' => 'Học kỳ 1',
                'ngaybatdau' => '2023-08-15',
                'ngayketthuc' => '2023-12-31',
                'namhoc' => '2023-2024',
                'trangthai' => false,
            ],
            [
                'mahocky' => 'HK2-23',
                'tenhocky' => 'Học kỳ 2',
                'ngaybatdau' => '2024-01-15',
                'ngayketthuc' => '2024-05-31',
                'namhoc' => '2023-2024',
                'trangthai' => false,
            ],
            [
                'mahocky' => 'HK1',
                'tenhocky' => 'Học kỳ 1',
                'ngaybatdau' => '2024-08-15',
                'ngayketthuc' => '2024-12-31',
                'namhoc' => '2024-2025',
                'trangthai' => true, // Học kỳ đang mở
            ],
            [
                'mahocky' => 'HK2',
                'tenhocky' => 'Học kỳ 2',
                'ngaybatdau' => '2025-01-15',
                'ngayketthuc' => '2025-05-31',
                'namhoc' => '2024-2025',
                'trangthai' => false,
            ]
        ]);
    }
}
