<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTweetHashTagsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('tweet_hash_tags', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->integer('tweet_id')->index();
      $table->string('tweet_id_str', 64);
      $table->integer('hash_tag_id')->index();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('tweet_hash_tags');
  }
}
