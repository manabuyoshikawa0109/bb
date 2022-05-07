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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id()->comment('大会ID');
            $table->boolean('is_released')->default(0)->comment('公開フラグ');
            $table->bigInteger('event_id')->comment('種目ID');
            $table->bigInteger('place_id')->comment('場所ID');
            $table->date('date')->comment('開催日');
            $table->string('start_time', 5)->comment('開始時間');
            $table->integer('applicants')->comment('募集数');
            $table->integer('entry_fee')->comment('参加費');
            $table->boolean('is_doubles')->default(0)->comment('ダブルスフラグ');
            $table->boolean('is_mix')->default(0)->comment('ミックスフラグ');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE tournaments COMMENT '大会情報';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tournaments');
    }
};
