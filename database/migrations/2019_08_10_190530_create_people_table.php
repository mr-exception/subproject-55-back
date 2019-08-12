<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('people', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->string('id_str', 32);
      $table->string('screen_name', 64);
      $table->string('location', 64);
      $table->string('description', 1000);
      $table->integer('followers_count');
      $table->integer('friends_count');
      $table->integer('registered_at');
      $table->string('profile_background_color', 256);
      $table->string('profile_background_image_url', 256);
      $table->string('profile_background_image_url_https', 256);
      $table->string('profile_background_tile', 256);
      $table->string('profile_image_url_https', 256);
      $table->string('profile_banner_url', 256);
      $table->string('profile_link_color', 256);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('people');
  }
}
