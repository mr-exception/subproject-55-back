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
}
