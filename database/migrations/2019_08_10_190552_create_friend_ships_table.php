<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendShipsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('friend_ships', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('src_id')->index();
      $table->integer('dst_id')->index();
      $table->string('src_id_str', 64)->index();
      $table->string('dst_id_str', 64)->index();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('friend_ships');
  }
}
