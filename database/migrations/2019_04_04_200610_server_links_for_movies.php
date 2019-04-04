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
            $table->string('server_1')->unique()->nullable();
            $table->string('server_2')->unique()->nullable();
            $table->string('server_3')->unique()->nullable();
            $table->string('server_4')->unique()->nullable();
            $table->string('server_5')->unique()->nullable();
            $table->string('server_6')->unique()->nullable();
            $table->string('server_7')->unique()->nullable();
            $table->string('server_8')->unique()->nullable();
            $table->string('server_9')->unique()->nullable();
            $table->string('server_10')->unique()->nullable();
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
