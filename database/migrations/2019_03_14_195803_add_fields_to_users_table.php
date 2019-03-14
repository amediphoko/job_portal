<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function($table){
            $table->string('last_name');
            $table->string('gender');
            $table->date('dob');
            $table->integer('contacts');
            $table->string('residence');
            $table->string('pro_pic');
            $table->string('qualification');
            $table->string('documents')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function($table){
            $table->dropColumn('last_name');
            $table->dropColumn('gender');
            $table->dropColumn('dob');
            $table->dropColumn('contacts');
            $table->dropColumn('residence');
            $table->dropColumn('pro_pic');
            $table->dropColumn('qualification');
            $table->dropColumn('documents');
        });
    }
}
