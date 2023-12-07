<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id()->comment('よくある質問ID');
            $table->integer('category')->nullable()->comment('カテゴリー');
            $table->string('question', 100)->comment('質問');
            $table->string('answer', 500)->comment('回答');
            $table->integer('order')->comment('順番');
            $table->timestamps();
        });
        DB::statement("ALTER TABLE faqs COMMENT 'よくある質問';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faqs');
    }
};
