<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCountTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('video_count', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chapter_content_id');
            $table->integer('user_id');
            $table->string('count');
            $table->timestamps();
            $table->foreign('chapter_content_id')
                    ->references('id')->on('chapter_content')
                    ->onDelete('cascade');

            $table->foreign('user_id')
                    ->references('id')->on('users')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('video_count');
    }

}
