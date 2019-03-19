<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('applications', function(Blueprint $table){
            $table->integer('user_id')->change();
            $table->integer('employer_id')->change();
            $table->integer('job_id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('applications', function(Blueprint $table){
            $table->integer('user_id')->unique()->change();
            $table->integer('employer_id')->unique()->change();
            $table->integer('job_id')->unique()->change();
        });
    }
}
