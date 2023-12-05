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
            $table->date('release_start_date')->nullable()->comment('公開開始日');
            $table->date('release_end_date')->nullable()->comment('公開終了日');
            $table->bigInteger('event_id')->comment('種目ID');
            $table->bigInteger('place_id')->comment('場所ID');
            $table->timestamp('started_at')->comment('開催日時');
            $table->integer('capacity')->comment('募集数');
            $table->decimal('participation_fee', 5, 0)->comment('参加費');
            $table->softDeletes();
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
