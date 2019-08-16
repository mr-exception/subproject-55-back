<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('tweets', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('id_str', 64);
      $table->string('text', 500);

      $table->string('in_reply_to_status_id_str', 64)->default('NuLL');
      $table->integer('in_reply_to_status_id')->index()->default(0);

      $table->string('in_reply_to_user_id_str', 64)->default('NuLL');
      $table->string('in_reply_to_screen_name', 64)->default('NuLL');
      $table->integer('in_reply_to_user_id')->index()->default(0);

      $table->integer('user_id')->index()->default(0);
      $table->string('user_id_str', 64);

      $table->integer('retweet_count');
      $table->integer('favorite_count');

      $table->string('lang', 32);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('tweets');
  }
}
