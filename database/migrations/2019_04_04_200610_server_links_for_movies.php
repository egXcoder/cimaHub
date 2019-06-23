<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ServerLinksForMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_links_movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('movie_id')->unsigned();
            $table->string('server_1')->nullable();
            $table->string('server_2')->nullable();
            $table->string('server_3')->nullable();
            $table->string('server_4')->nullable();
            $table->string('server_5')->nullable();
            $table->string('server_6')->nullable();
            $table->string('server_7')->nullable();
            $table->string('server_8')->nullable();
            $table->string('server_9')->nullable();
            $table->string('server_10')->nullable();

            $table->foreign('movie_id')
                    ->references('id')
                    ->on('movies')
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
        Schema::dropIfExists('server_links_movies');

    }
}
