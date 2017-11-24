<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->integer('gameID');
            $table->integer('Betrag');
            $table->integer('HP');
            $table->integer('GP');
            $table->boolean('ausgewertet');
            $table->dateTime('spielTag');
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
        Schema::drop('wetten');
    }
}
