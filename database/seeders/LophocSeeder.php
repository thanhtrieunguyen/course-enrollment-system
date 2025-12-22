<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LophocSeeder extends Seeder
{
    public function run()
    {
        $data = [
            // CNTT
            ['malop' => 1, 'tenlop' => '22CNTT01', 'makhoa' => 'CNTT'],
            ['malop' => 2, 'tenlop' => '22CNTT02', 'makhoa' => 'CNTT'],
            ['malop' => 7, 'tenlop' => '23CNTT01', 'makhoa' => 'CNTT'],
            // Kinh tế
            ['malop' => 3, 'tenlop' => '22KT01', 'makhoa' => 'KT'],
            ['malop' => 4, 'tenlop' => '22KT02', 'makhoa' => 'KT'],
            ['malop' => 8, 'tenlop' => '23KT01', 'makhoa' => 'KT'],
            // Ngoại ngữ
            ['malop' => 9, 'tenlop' => '22NN01', 'makhoa' => 'NN'],
            ['malop' => 10, 'tenlop' => '23NN01', 'makhoa' => 'NN'],
            // Điện tử
            ['malop' => 11, 'tenlop' => '22DT01', 'makhoa' => 'DTVT'],
            // Cơ bản
            ['malop' => 5, 'tenlop' => '22CB01', 'makhoa' => 'CB'],
            ['malop' => 6, 'tenlop' => '22CB02', 'makhoa' => 'CB'],
            ['malop' => 12, 'tenlop' => '23CB01', 'makhoa' => 'CB'],
        ];

        DB::table('lophoc')->insert($data);
    }
}
