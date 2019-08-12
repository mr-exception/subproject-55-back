<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model {
  protected $primary = 'id';
  protected $table = 'tasks';
  protected $fillable = ['id_str', 'type', 'status'];

  const PENDING = 1;
  const IN_PROGRESS = 2;
  const FINISHED = 3;
  const FAILD = 4;

  const FETCH_USER = 1;
  const FETCH_FOLLOWINGS = 2;
  const FETCH_FRIENDS = 4;
  const FETCH_TWEETS = 5;
  const FETCH_MENTIONS = 6;

  public function scopeHaveToRun($query) {
    return $query->whereStatus(Task::PENDING);
  }

  public function scopeUserType($query) {
    return $query->whereType(Task::FETCH_USER);
  }
  public function scopeFollowersType($query) {
    return $query->whereType(Task::FETCH_FOLLOWINGS);
  }
  public function scopeFriendsType($query) {
    return $query->whereType(Task::FETCH_FRIENDS);
  }
  public function scopeTweetsType($query) {
    return $query->whereType(Task::FETCH_TWEETS);
  }
  public function scopeMentionsType($query) {
    return $query->whereType(Task::FETCH_MENTIONS);
  }
}
