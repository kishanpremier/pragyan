<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->string('user_type', 255)->nullable()->comment('1-teacher,0-parent')->after('id');
            $table->string('age', 255)->after('id');
            $table->string('gender', 255)->comment('1-male,0-female')->after('id');
            $table->string('mobile', 255)->after('id');
            $table->string('state', 255)->after('id');
            $table->string('district', 255)->after('id');
                     
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
