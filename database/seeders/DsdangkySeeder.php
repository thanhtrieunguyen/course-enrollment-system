<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\SinhVien;
use App\Models\MonHoc;

class DsdangkySeeder extends Seeder
{
    public function run()
    {
        $students = SinhVien::where('role', 'user')->get();
        $monhocs = MonHoc::all();

        $registrations = [];

        foreach ($students as $student) {
            // Each student registers for 3-5 random courses from their faculty or CB
            $eligibleCourses = $monhocs->filter(function ($m) use ($student) {
                return $m->makhoa == $student->makhoa || $m->makhoa == 'CB';
            })->shuffle()->take(rand(3, 5));

            foreach ($eligibleCourses as $course) {
                $registrations[] = [
                    'mssv' => $student->mssv,
                    'mamonhoc' => $course->mamonhoc,
                    'dstenmonhoc' => $course->tenmonhoc,
                    'dsgiangvien' => $course->giangvien,
                    'dssotinchi' => $course->sotinchi,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                // Update dadangky count manually in DB
                DB::table('monhoc')->where('mamonhoc', $course->mamonhoc)->increment('dadangky');
            }
        }

        foreach (array_chunk($registrations, 50) as $chunk) {
            DB::table('dsdangky')->insert($chunk);
        }
    }
}
