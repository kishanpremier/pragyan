<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterContentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('chapter_content', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('chapter_id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->string('content_title', 255)->nullable();
            $table->string('content_type', 255)->nullable();
            $table->string('content_short_desc', 255)->nullable();
            $table->string('content_link', 255)->nullable();
            $table->timestamps();
            $table->foreign('chapter_id')
                    ->references('id')->on('chapter')
                    ->onDelete('cascade');
            $table->foreign('class_id')
                    ->references('id')->on('class')
                    ->onDelete('cascade');
            $table->foreign('subject_id')
                    ->references('id')->on('subject')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('chapter_content');
    }

}
