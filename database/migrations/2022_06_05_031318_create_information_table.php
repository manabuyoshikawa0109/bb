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
        Schema::create('information', function (Blueprint $table) {
            $table->id()->comment('お知らせID');
            $table->date('release_start_date')->comment('公開開始日');
            $table->date('release_end_date')->nullable()->comment('公開終了日');
            $table->date('date')->comment('日付');
            $table->string('subject', 100)->comment('件名');
            $table->string('body', 1000)->nullable()->comment('本文');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE information COMMENT 'お知らせ';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information');
    }
};
