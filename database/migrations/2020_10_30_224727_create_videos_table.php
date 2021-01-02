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
            $table->string('class');
            $table->string('chapter');
            $table->string('section');
            $table->string('title');
            $table->integer('video_id');
            $table->boolean('active')->default(true);
            $table->text('path');
            $table->string('class_key');
            $table->string('chapter_key');
            $table->string('section_key');
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
