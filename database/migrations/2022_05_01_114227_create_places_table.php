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
        Schema::create('places', function (Blueprint $table) {
            $table->id()->comment('場所ID');
            $table->string('name', 100)->comment('場所名');
            $table->string('court_surface', 100)->nullable()->comment('コートサーフェス');
            $table->string('image_path', 250)->nullable()->comment('画像パス');
            $table->string('official_site_url', 250)->nullable()->comment('公式サイトURL');
            $table->string('google_map_url', 250)->nullable()->comment('GoogleマップのURL');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE places COMMENT '場所マスタ';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('places');
    }
};
