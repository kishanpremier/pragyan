<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersFiledDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
         Schema::table('users', function(Blueprint $table) {
            $table->string('school_name', 255)->nullable()->after('is_term_accept');
            $table->string('schoolcode', 255)->nullable()->after('is_term_accept');
            $table->string('subject', 255)->nullable()->after('is_term_accept');
            $table->string('classes', 255)->nullable()->after('is_term_accept');
            
        });
      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
