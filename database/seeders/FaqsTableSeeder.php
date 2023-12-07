<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FaqsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');

        DB::table('faqs')->truncate();

        DB::table('faqs')->insert(
            [
                [
                    'question' => 'キャンセル代はいつ頃からかかりますか？',
                    'answer' => 'キャンセル代は試合当日3日前から発生します。前日まではダブルス3,300円・シングルス3,000円、当日キャンセルはダブルス5,000円・シングルス4,400円です。',
                    'order' => 1,
                ],
                [
                    'question' => '1日の試合で最大何種目出場できますか？',
                    'answer' => '1日最大2種目出場できます。3種目以上の出場はできません。',
                    'order' => 2,
                ],
                [
                    'question' => '雨が降った場合はどうなりますか？',
                    'answer' => '当日の朝7時までに試合の有無を登録していただいているLINE、もしくはメールアドレス宛てに連絡させていただきます。',
                    'order' => 3,
                ],
                [
                    'question' => 'コロナで政府より緊急事態宣言がでた場合はどうなりますか？',
                    'answer' => '当大会は市営コートを利用して運営しておりますので、緊急事態宣言により市営コートが使用できなくなった場合は大会を中止することがあります。',
                    'order' => 4,
                ],
                [
                    'question' => '会場の近くにコンビニはありますか？',
                    'answer' => '会場によって近くにコンビニがないところもあります。また試合の進行状況によりコンビニに行く時間がないこともありますので、事前に買ってきていただくことをおすすめしております。',
                    'order' => 5,
                ],
            ]
        );
    }
}
