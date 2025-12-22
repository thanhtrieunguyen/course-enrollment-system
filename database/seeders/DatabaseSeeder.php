<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            KhoaSeeder::class,
            LophocSeeder::class,

            HockySeeder::class,
            SinhvienSeeder::class,
            MonhocSeeder::class,
            DsdangkySeeder::class,
        ]);
    }
}
