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
}
