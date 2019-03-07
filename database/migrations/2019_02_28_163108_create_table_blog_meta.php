<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBlogMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_metas', function($table){
            $table->engine = 'InnoDB';
            $table->integer('blog_id')->unsigned();
            $table->string('title', 90);
            $table->string('description', 180);
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
        Schema::dropIfExists('blog_metas');
    }
}
