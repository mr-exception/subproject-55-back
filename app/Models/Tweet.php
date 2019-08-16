<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model {
  protected $primary = 'id';
  protected $table = 'tweets';
  protected $fillable = [
    'id_str', 'text',
    'in_reply_to_status_id_str', 'in_reply_to_status_id',
    'in_reply_to_user_id_str', 'in_reply_to_screen_name', 'in_reply_to_user_id',
    'user_id', 'user_id_str',
    'retweet_count', 'favorite_count',
    'lang',
  ];

  public function hash_tags() {
    return $this->belongsToMany(HashTag::class, 'tweet_hash_tags', 'tweet_id', 'hash_tag_id');
  }
  public static function updateLatestIds(Tweet $tweet) {
    Tweet::where('in_reply_to_status_id_str', $tweet->id_str)->update(['in_reply_to_status_id' => $tweet->id]);
  }
}
