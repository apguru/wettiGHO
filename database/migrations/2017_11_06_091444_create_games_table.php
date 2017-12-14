<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function(Blueprint $table){
           $table->increments('id');
           $table->integer('matchId');
           $table->integer('leagueId');
           $table->string('heim');
           $table->string('gast');
           $table->integer('hp');
           $table->integer('gp');
           $table->boolean('done');
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
        Schema::drop('games');
    }
}
