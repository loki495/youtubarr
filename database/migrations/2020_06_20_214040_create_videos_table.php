<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->integer('channel_id')->unsigned();
            $table->string('youtube_id',15);
            $table->string('status');
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('image');
            $table->string('thumb');
            $table->integer('duration')->unsigned();
            $table->integer('filesize')->unsigned();
            $table->longtext('extra')->nullable();
            $table->timestamp('published_on');
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
        Schema::dropIfExists('videos');
    }
}
