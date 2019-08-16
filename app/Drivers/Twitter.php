<?php

namespace App\Drivers;

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
  public static function fetchFollowingsByUserId(string $user_id) {
    try {
      $result = json_decode(TW::getFriendsIds(['user_id' => $user_id, 'format' => 'json']));
      return $result->ids;
    } catch (RunTimeException $e) {
      return null;
    }
  }
  public static function fetchTweetsByUserId(string $user_id) {
    try {
      $result = json_decode(TW::getUserTimeline(['user_id' => $user_id, 'format' => 'json', 'count' => 200, 'tweet_mode' => 'extended']));
      return $result;
    } catch (RunTimeException $e) {
      return null;
    }
  }
}
