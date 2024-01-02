<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');

        DB::table('information')->truncate();

        $today = Carbon::today();

        $data = [
            [
                'release_start_date' => NULL,
                'release_end_date' => NULL,
            ],
            [
                'release_start_date' => NULL,
                'release_end_date' => NULL,
            ],
            [
                'release_start_date' => NULL,
                'release_end_date' => $today->copy()->addWeeks(3)->format('Y-m-d'),
            ],
            [
                'release_start_date' => NULL,
                'release_end_date' => $today->copy()->addWeeks(3)->format('Y-m-d'),
            ],
            [
                'release_start_date' => $today->format('Y-m-d'),
                'release_end_date' => NULL,
            ],
            [
                'release_start_date' => $today->format('Y-m-d'),
                'release_end_date' => NULL,
            ],
            [
                'release_start_date' => $today->format('Y-m-d'),
                'release_end_date' => $today->copy()->addWeeks(3)->format('Y-m-d'),
            ],
            [
                'release_start_date' => $today->format('Y-m-d'),
                'release_end_date' => $today->copy()->addWeeks(3)->format('Y-m-d'),
            ],
            [
                'release_start_date' => $today->copy()->subWeeks(3)->format('Y-m-d'),
                'release_end_date' => $today->copy()->subDay()->format('Y-m-d'),
            ],
            [
                'release_start_date' => $today->copy()->subWeeks(3)->format('Y-m-d'),
                'release_end_date' => $today->copy()->subDay()->format('Y-m-d'),
            ],
            [
                'release_start_date' => $today->copy()->addWeeks(3)->format('Y-m-d'),
                'release_end_date' => $today->copy()->addWeeks(5)->format('Y-m-d'),
            ],
            [
                'release_start_date' => $today->copy()->addWeeks(3)->format('Y-m-d'),
                'release_end_date' => $today->copy()->addWeeks(5)->format('Y-m-d'),
            ],
        ];

        foreach ($data as $releaseDates) {
            DB::table('information')->insert(
                [
                    'release_start_date' => $releaseDates['release_start_date'],
                    'release_end_date' => $releaseDates['release_end_date'],
                    'subject' => '夏季休業のお知らせ',
                    'body' => '平素は格別のお引き立てをいただき厚くお礼申し上げます。
弊社では、誠に勝手ながら下記日程を夏季休業とさせていただきます。

■夏季休業期間
0000年00月00日(〇)　～　00月00日(〇)

休業期間中にいただいたお問合せについては、営業開始日以降に順次回答させていただきます。
皆様には大変ご不便をおかけいたしますが、何卒ご理解の程お願い申し上げます。',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            );
        }
    }
}
