<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId');
<<<<<<< HEAD
            $table->integer('Loose')->default(0);
            $table->integer('Pkt2')->default(0);
            $table->integer('Pkt3')->default(0);
            $table->integer('Pkt5')->default(0);        
=======
            $table->integer('Loose');
            $table->integer('Pkt2');
            $table->integer('Pkt3');
            $table->integer('Pkt5');        
>>>>>>> 32f3d92bd0b0394b183590131d8a042f09e79db6
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
        Schema::drop('stats');
    }
}
