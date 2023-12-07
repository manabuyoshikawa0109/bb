<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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

        DB::table('admins')->insert(
            [
                [
                    'last_name' => '溝口',
                    'first_name' => '涼',
                    'email' => 'test@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 1,
                    'remember_token' => Str::random(10),
                ],
                [
                    'last_name' => '吉川',
                    'first_name' => '学',
                    'email' => 'm.y.ichinishi.tennis@gmail.com',
                    'password' => Hash::make('password'),
                    'role' => 2,
                    'remember_token' => Str::random(10),
                ],
            ]
        );
    }
}
