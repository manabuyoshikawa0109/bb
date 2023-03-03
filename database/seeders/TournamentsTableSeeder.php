<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TournamentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ini_set('memory_limit', '512M');

        DB::table('tournaments')->truncate();

        DB::table('tournaments')->insert(
            [
                [
                    'release_start_date' => null,
                    'release_end_date' => null,
                    'event_id' => 1,
                    'place_id' => 1,
                    'held_at' => Carbon::now(),
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'release_start_date' => Carbon::now(),
                    'release_end_date' => null,
                    'event_id' => 2,
                    'place_id' => 1,
                    'held_at' => Carbon::now(),
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'release_start_date' => Carbon::now(),
                    'release_end_date' => Carbon::now(),
                    'event_id' => 3,
                    'place_id' => 1,
                    'held_at' => Carbon::now(),
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'release_start_date' => Carbon::now(),
                    'release_end_date' => Carbon::now(),
                    'event_id' => 4,
                    'place_id' => 1,
                    'held_at' => Carbon::now(),
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'release_start_date' => null,
                    'release_end_date' => Carbon::now(),
                    'event_id' => 5,
                    'place_id' => 1,
                    'held_at' => Carbon::now(),
                    'applicants' => 18,
                    'entry_fee' => 4400,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
                [
                    'release_start_date' => Carbon::now(),
                    'release_end_date' => Carbon::now(),
                    'event_id' => 6,
                    'place_id' => 1,
                    'held_at' => Carbon::now(),
                    'applicants' => 18,
                    'entry_fee' => 5000,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ],
            ]
        );
    }
}
