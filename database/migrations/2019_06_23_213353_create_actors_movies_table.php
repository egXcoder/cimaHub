<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActorsMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actor_movie', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movie_id');
            $table->bigInteger('actor_id');
            $table->timestamps();
            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')
                ->onDelete('Cascade')
                ->onUpdate('No Action');
            $table->foreign('actor_id')
                ->references('id')
                ->on('actors')
                ->onDelete('Cascade')
                ->onUpdate('No Action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actor_movie');
    }
}
