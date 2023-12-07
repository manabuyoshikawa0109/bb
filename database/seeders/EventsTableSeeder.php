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
                    'capacity' => 18,
                    'participation_fee' => 5000,
                    'start_time' => '09:00',
                    'type' => 5,
                ],
                [
                    'name' => '初級チャレンジミックスダブルス',
                    'capacity' => 18,
                    'participation_fee' => 5000,
                    'start_time' => '09:00',
                    'type' => 5,
                ],
                [
                    'name' => '中級男子ダブルス',
                    'capacity' => 18,
                    'participation_fee' => 5000,
                    'start_time' => '09:00',
                    'type' => 2,
                ],
                [
                    'name' => '初級男子ダブルス',
                    'capacity' => 18,
                    'participation_fee' => 5000,
                    'start_time' => '09:00',
                    'type' => 2,
                ],
                [
                    'name' => '中級男子シングルス',
                    'capacity' => 18,
                    'participation_fee' => 4400,
                    'start_time' => '09:00',
                    'type' => 1,
                ],
                [
                    'name' => '初級男子シングルス',
                    'capacity' => 18,
                    'participation_fee' => 4400,
                    'start_time' => '10:00',
                    'type' => 1,
                ],
                [
                    'name' => '初級女子ダブルス',
                    'capacity' => 18,
                    'participation_fee' => 5000,
                    'start_time' => '10:00',
                    'type' => 4,
                ],
            ]
        );
    }
}
