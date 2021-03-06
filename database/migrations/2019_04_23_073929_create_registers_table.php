<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

/**
 * Class CreateRegistersTable.
 */
class CreateRegistersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('vote_id')->unsigned();
            $table->integer('film_id')->unsigned();
            $table->foreign('vote_id')->references('id')->on('votes')
                ->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('film_id')->references('id')->on('films')
                ->onDelete('cascade');
            $table->integer('ticket_number');
            $table->string('best_friend')->nullable();
            $table->integer('ticket_outsite')->default(0);
            $table->string('agree')->nullable();
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
        Schema::drop('registers');
    }
}
