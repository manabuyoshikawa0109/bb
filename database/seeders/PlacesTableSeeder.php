<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlacesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');

        DB::table('places')->truncate();

        DB::table('places')->insert(
            [
                [
                    'name' => '寝屋川公園',
                    'official_site_url' => 'http://neyagawa.osaka-park.or.jp/',
                    'google_map_url' => 'https://goo.gl/maps/cGLxNvYxcpLikzFD7',
                ],
                [
                    'name' => '中部緑地庭球場',
                    'official_site_url' => 'https://www.city.higashiosaka.lg.jp/0000003722.html',
                    'google_map_url' => 'https://goo.gl/maps/PfgTUMyQWVcpcQYJA',
                ],
                [
                    'name' => '深北緑地',
                    'official_site_url' => 'https://www.fukakitaryokuchi.jp/',
                    'google_map_url' => 'https://goo.gl/maps/8dfCL1EMJ4xcQnfq8',
                ],
            ]
        );
    }
}
