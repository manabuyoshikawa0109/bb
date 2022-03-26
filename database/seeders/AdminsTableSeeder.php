<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');
        
        DB::table('admins')->truncate();

        $path = 'database/sql/admins.sql';
        $this->command->info("START：{$path}");
        DB::unprepared(file_get_contents($path));
    }
}
