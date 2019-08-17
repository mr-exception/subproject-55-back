<?php

namespace App\Drivers;

use Twitter as TW;

class Twitter {
  public static function fetchUserByUserId(string $user_id) {
    $result = json_decode(TW::getUsers(['user_id' => $user_id, 'format' => 'json']));
    return $result;
  }
  public static function fetchFollowersByUserId(string $user_id) {
    $result = json_decode(TW::getFollowersIds(['user_id' => $user_id, 'format' => 'json']));
    return $result->ids;
  }
  public static function fetchFollowingsByUserId(string $user_id) {
    $result = json_decode(TW::getFriendsIds(['user_id' => $user_id, 'format' => 'json']));
    return $result->ids;
  }
  public static function fetchTweetsByUserId(string $user_id) {
    $result = json_decode(TW::getUserTimeline(['user_id' => $user_id, 'format' => 'json', 'count' => 200, 'tweet_mode' => 'extended']));
    return $result;
  }
  public static function fetchUserByScreenName(string $screen_name) {
    $result = json_decode(TW::getUsers(['screen_name' => $screen_name, 'format' => 'json']));
    return $result;
  }
  public static function fetchFollowersByScreenName(string $screen_name) {
    $result = json_decode(TW::getFollowersIds(['screen_name' => $screen_name, 'format' => 'json']));
    return $result->ids;
  }
  public static function fetchFollowingsByScreenName(string $screen_name) {
    $result = json_decode(TW::getFriendsIds(['screen_name' => $screen_name, 'format' => 'json']));
    return $result->ids;
  }
  public static function fetchTweetsByScreenName(string $screen_name) {
    $result = json_decode(TW::getUserTimeline(['screen_name' => $screen_name, 'format' => 'json', 'count' => 200, 'tweet_mode' => 'extended']));
    return $result;
  }
}
