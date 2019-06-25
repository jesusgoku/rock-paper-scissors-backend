<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('rounds', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('game_id')->unsigned();
      $table->enum('player_one_move', ['rock', 'paper', 'scissors']);
      $table->enum('player_two_move', ['rock', 'paper', 'scissors']);
      $table->smallInteger('player_winner')->nullable();
      $table->timestamps();

      $table
        ->foreign('game_id')
        ->references('id')
        ->on('games');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('rounds');
  }
}
