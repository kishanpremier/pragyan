<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChapterTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('chapter', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('class_id');
            $table->integer('subject_id');
            $table->string('chapter_name', 255)->nullable();
            $table->timestamps();
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
        Schema::dropIfExists('chapter');
    }

}
