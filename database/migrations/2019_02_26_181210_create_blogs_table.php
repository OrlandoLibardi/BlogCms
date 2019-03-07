<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->string('alias');
            $table->text('content');
            $table->boolean('status')->default(false);
            $table->boolean('featured')->default(false);
            $table->integer('type')->default(1)->comment('1=default, 2=video, 3=gallery');
            $table->dateTime('publish_at');
            $table->dateTime('unpublished_at')->nullable(true);
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
        Schema::dropIfExists('blogs');
    }
}
