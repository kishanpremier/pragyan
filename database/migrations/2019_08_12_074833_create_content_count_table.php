<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentCountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_count', function (Blueprint $table) {
            $table->increments('id');
            $table->string('content_id');
            $table->string('user_id');
            $table->string('view_time');
             $table->foreign('content_id')->references('id')->on('chapter_content');
             $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('content_count');
    }
}
