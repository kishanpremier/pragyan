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
            $table->foreign(['class_id','subject_id'])->references(['id','id'])
                  ->on(['class','subject'])->onDelete(['cascade','cascade']);
            $table->string('chapter_name', 255)->nullable();
            $table->timestamps();
           
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
