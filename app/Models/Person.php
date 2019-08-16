<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model {
  protected $primary = 'id';
  protected $table = 'people';
  protected $fillable = [
    'id_str', 'screen_name',
    'location', 'description', 'friends_count', 'followers_count', 'registered_at',
    'profile_background_color', 'profile_background_image_url', 'profile_background_image_url_https', 'profile_background_tile', 'profile_image_url_https',
    'profile_banner_url', 'profile_link_color',
  ];
  public static function updateLatestIds(Person $person) {
    Tweet::where('in_reply_to_user_id_str', $person->id_str)->update(['in_reply_to_user_id' => $person->id]);
    Tweet::where('user_id_str', $person->id_str)->update(['user_id' => $person->id]);
    FriendShip::whereSrcIdStr($person->id_str)->update(['src_id' => $person->id]);
    FriendShip::whereDstIdStr($person->id_str)->update(['dst_id' => $person->id]);
  }
}
