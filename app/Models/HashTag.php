<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HashTag extends Model {
  protected $primary = 'id';
  protected $table = 'hash_tags';
  protected $fillable = ['title'];
  public function tweets() {
    return $this->belongsToMany(Tweet::class, 'tweet_hash_tags', 'has_tag_id', 'tweet_id');
  }
}
