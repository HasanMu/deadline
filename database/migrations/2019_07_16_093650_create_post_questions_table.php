<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul');
            $table->text('konten');
            $table->enum('status', ['Belum Terjawab', 'Kurang Puas', 'Terjawab'])->default('Belum Terjawab');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_questions');
    }
}
