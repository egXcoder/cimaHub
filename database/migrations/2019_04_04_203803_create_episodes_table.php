<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpisodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episodes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('episode_number');
            $table->string('name')->unique();
            $table->float('views');
            $table->bigInteger('series_id')->unsigned();
            $table->bigInteger('server_links')->unsigned();
            $table->timestamps();
            $table->foreign('series_id')
                ->references('id')
                ->on('series')
                ->onUpdate('No Action')
                ->onUpdate('Cascade');
            $table->foreign('server_links')
                ->references('id')
                ->on('server_links_series')
                ->onUpdate('No Action')
                ->onDelete('Cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episodes');
    }
}
