<?php

namespace App\Console\Commands;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class RestoreDemoDatabase extends Command
{
    protected $signature = 'demo:restore-database {--force : Run without confirmation}';

    protected $description = 'Restore the public demo database to its seeded state.';

    public function handle(): int
    {
        if (! $this->option('force') && ! $this->confirm('Restore the demo database now?')) {
            $this->info('Cancelled.');

            return self::SUCCESS;
        }

        $this->info('Restoring demo database...');

        mt_srand((int) env('DEMO_RESET_SEED', 202405));

        $this->disableForeignKeyChecks();

        try {
            foreach ($this->tablesToReset() as $table) {
                DB::table($table)->truncate();
            }
        } finally {
            $this->enableForeignKeyChecks();
        }

        Artisan::call('db:seed', [
            '--class' => DatabaseSeeder::class,
            '--force' => true,
        ]);

        $this->line(Artisan::output());
        $this->info('Demo database restored.');

        return self::SUCCESS;
    }

    private function tablesToReset(): array
    {
        return [
            'dsdangky',
            'hocky_sinhvien',
            'user_tokens',
            'monhoc',
            'sinhvien',
            'lophoc',
            'khoa',
            'hocky',
        ];
    }

    private function disableForeignKeyChecks(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0');
        }
    }

    private function enableForeignKeyChecks(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1');
        }
    }
}
