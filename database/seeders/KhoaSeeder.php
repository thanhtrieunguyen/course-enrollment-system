<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhoaSeeder extends Seeder
{
    public function run()
    {
        DB::table('khoa')->insert([
            ['makhoa' => 'CNTT', 'tenkhoa' => 'Công nghệ thông tin'],
            ['makhoa' => 'KT', 'tenkhoa' => 'Kinh tế & Quản trị'],
            ['makhoa' => 'NN', 'tenkhoa' => 'Ngoại ngữ'],
            ['makhoa' => 'DTVT', 'tenkhoa' => 'Điện tử viễn thông'],
            ['makhoa' => 'DTVDT', 'tenkhoa' => 'Đào tạo và dạy nghề'],
            ['makhoa' => 'CB', 'tenkhoa' => 'Khoa học cơ bản'],
        ]);
    }
}
