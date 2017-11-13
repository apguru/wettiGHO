<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWettenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wetten', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
            $table->integer('Betrag');
            $table->integer('HP');
            $table->integer('GP');
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
