<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_contents', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('blog_id')->unsigned();
            $table->text('content');
            $table->foreign('blog_id')->references('id')->on('blogs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_contents');
    }
}
