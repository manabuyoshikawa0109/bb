<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');

        DB::table('events')->truncate();

        DB::table('events')->insert(
            [
                [
                    'name' => '中級ミックスダブルス',
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'start_time' => '9:00',
                    'type_id' => 2,
                ],
                [
                    'name' => '初級チャレンジミックスダブルス',
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'start_time' => '9:00',
                    'type_id' => 2,
                ],
                [
                    'name' => '中級男子ダブルス',
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'start_time' => '9:00',
                    'type_id' => 1,
                ],
                [
                    'name' => '初級男子ダブルス',
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'start_time' => '9:00',
                    'type_id' => 1,
                ],
                [
                    'name' => '中級男子シングルス',
                    'applicants' => 18,
                    'entry_fee' => 4400,
                    'start_time' => '9:00',
                    'type_id' => 0,
                ],
                [
                    'name' => '初級男子シングルス',
                    'applicants' => 18,
                    'entry_fee' => 4400,
                    'start_time' => '10:00',
                    'type_id' => 0,
                ],
                [
                    'name' => '初級女子ダブルス',
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'start_time' => '10:00',
                    'type_id' => 1,
                ],
            ]
        );
    }
}
