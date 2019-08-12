<?php

namespace App\Drivers;

use App\Models\Person;
use Twitter as TW;

class Twitter {
  public static function fetchUserByUserId(string $user_id) {
    try {
      $result = json_decode(TW::getUsers(['user_id' => $user_id, 'format' => 'json']));
      return $result;
    } catch (RunTimeException $e) {
      return null;
    }
  }
  public static function fetchFollowersByUserId(string $user_id) {
    try {
      $result = json_decode(TW::getFollowersIds(['user_id' => $user_id, 'format' => 'json']));
      return $result->ids;
    } catch (RunTimeException $e) {
      return null;
    }
  }
}
