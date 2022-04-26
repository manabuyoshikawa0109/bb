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
        Schema::create('admins', function (Blueprint $table) {
            $table->id()->comment('管理者ID');
            $table->string('last_name', 100)->comment('苗字');
            $table->string('first_name', 100)->comment('名前');
            $table->string('email')->unique()->nullable()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 255)->comment('パスワード');
            $table->string('tel', 13)->comment('電話番号');
            $table->string('zip', 8)->nullable()->comment('郵便番号');
            $table->string('address', 255)->nullable()->comment('住所');
            $table->integer('gender_id')->comment('性別ID');
            $table->boolean('is_developer')->default(0)->comment('開発者フラグ');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE admins COMMENT '管理者';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
};
