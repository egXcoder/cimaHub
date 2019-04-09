<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->text('description');
            $table->string('slug');
            $table->string('image_url');
            $table->double('ratings')->nullable();
            $table->string('quality')->nullable();
            $table->bigInteger('views')->default(0);
            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('server_links')->unsigned();
            $table->timestamps();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('No Action')
                ->onUpdate('No Action');

            $table->foreign('server_links')
                ->references('id')
                ->on('server_links_movies')
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
        Schema::dropIfExists('movies');
    }
}
