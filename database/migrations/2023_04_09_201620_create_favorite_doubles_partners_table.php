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
        Schema::create('favorite_doubles_partners', function (Blueprint $table) {
            $table->id()->comment('お気に入りダブルスパートナーID');
            $table->bigInteger('user_id')->comment('ユーザーID');
            $table->string('last_name', 100)->comment('苗字');
            $table->string('first_name', 100)->comment('名前');
            $table->string('tel', 13)->comment('電話番号');
            $table->string('zip', 8)->comment('郵便番号');
            $table->string('address', 250)->comment('住所');
            $table->integer('sex')->comment('性別');
            $table->softDeletes();
            $table->timestamps();
        });
        DB::statement("ALTER TABLE favorite_doubles_partners COMMENT 'お気に入りダブルスペア';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('favorite_doubles_partners');
    }
};
