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
            $table->string('email')->unique()->comment('メールアドレス');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 250)->comment('パスワード');
            $table->integer('role')->comment('権限');
            $table->string('image_path', 250)->nullable()->comment('画像パス');
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
