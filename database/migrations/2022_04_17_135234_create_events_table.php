<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id()->comment('種目ID');
            $table->string('name', 100)->comment('種目名');
            $table->integer('applicants')->nullable()->comment('募集数');
            $table->integer('entry_fee')->nullable()->comment('参加費');
            $table->string('start_time', 5)->nullable()->comment('開始時間');
            $table->boolean('is_doubles')->default(0)->comment('ダブルスフラグ');
            $table->boolean('is_mix')->default(0)->comment('ミックスフラグ');
            $table->timestamps();
        });

        DB::statement("ALTER TABLE events COMMENT '種目マスタ';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};