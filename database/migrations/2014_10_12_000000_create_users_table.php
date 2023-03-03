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
        Schema::create('users', function (Blueprint $table) {
            $table->id()->comment('ユーザーID');
            $table->string('last_name', 100)->comment('苗字');
            $table->string('first_name', 100)->comment('名前');
            $table->string('email', 250)->unique()->nullable()->comment('メールアドレス'); // nullableは消す
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 250)->comment('パスワード');
            $table->string('tel', 13)->comment('電話番号');
            $table->string('zip', 8)->nullable()->comment('郵便番号'); // nullableは消す
            $table->string('address', 250)->nullable()->comment('住所'); // nullableは消す
            $table->integer('gender')->comment('性別');
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });

        DB::statement("ALTER TABLE users COMMENT 'ユーザー';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
