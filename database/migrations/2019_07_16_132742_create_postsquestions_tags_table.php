<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsquestionsTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postsquestions_tags', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('postquestion_id');
            $table->unsignedBigInteger('tags_id');

            $table->foreign('postquestion_id')->references('id')->on('post_questions')->onDelete('cascade');
            $table->foreign('tags_id')->references('id')->on('tags')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::table('post_questions', function (Blueprint $table) {
            $table->string('slug')->after('judul');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('postsquestions_tags');
    }
}
