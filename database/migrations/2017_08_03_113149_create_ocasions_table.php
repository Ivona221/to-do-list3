<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcasionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocasions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('organizer_id')->unsigned();
            $table->string('name');
            $table->string('place');
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('organizer_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('ocasion_user', function(Blueprint $table){
            $table->integer('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('ocasion_id')->unsigned()->index();
            $table->foreign('ocasion_id')->references('id')->on('ocasions')->onDelete('cascade');

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
        Schema::drop('ocasions');
        Schema::drop('ocasion_user');
    }
}
