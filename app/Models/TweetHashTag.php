<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TweetHashTag extends Model {
  protected $primary = 'id';
  protected $table = 'tweet_hash_tags';
  protected $fillable = ['tweet_id', 'tweet_id_str', 'hash_tag_id'];
}
