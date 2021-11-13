<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('group_id')->unsigned();
            $table->string('subject');
            $table->integer('map')->unsigned()->nullable();
            $table->integer('legend')->unsigned()->nullable();
            $table->text('contents');
            $table->timestamp('limited_at')->nullable();
            $table->bigInteger('created_user_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('tasks', function($table) {
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('created_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
