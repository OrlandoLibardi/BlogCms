<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogHasCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_has_comments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('blog_id')->unsigned();
            $table->integer('comment_id')->unsigned();
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('blog_comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_has_comments');
    }
}
