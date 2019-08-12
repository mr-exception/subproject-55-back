<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FriendShip extends Model {
  protected $primary = 'id';
  protected $table = 'friend_ships';
  protected $fillable = ['src_id', 'dst_id', 'src_id_str', 'dst_id_str'];

  public function src() {
    return $this->belongsTo(Person::class, 'src_id');
  }
  public function dst() {
    return $this->belongsTo(Person::class, 'dst_id');
  }
}
