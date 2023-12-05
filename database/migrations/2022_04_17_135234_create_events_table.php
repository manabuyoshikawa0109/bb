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
            $table->integer('type')->comment('種別');
            $table->integer('capacity')->nullable()->comment('募集数');
            $table->decimal('participation_fee', 5, 0)->nullable()->comment('参加費');
            $table->string('start_time', 5)->nullable()->comment('開催時間');
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
