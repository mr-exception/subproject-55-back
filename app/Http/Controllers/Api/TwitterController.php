<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RunTimeException;
use Twitter;

class TwitterController extends Controller {
  public function user(Request $request, $screen_name) {
    try {
      $result = json_decode(Twitter::getUsers(['screen_name' => $screen_name, 'format' => 'json']));
      unset($result->entities);
      unset($result->status);
      return [
        'ok' => true,
        'user' => $result,
      ];
    } catch (RunTimeException $e) {
      switch ($e->getMessage()) {
      case '[50] User not found.':
        return [
          'ok' => false,
          'code' => 50,
          'message' => 'user not found',
        ];
      default:
        return [
          'ok' => false,
          'code' => 0,
          'message' => $e->getMessage(),
        ];
      }
    }
  }
  public function followers(Request $request, $screen_name) {
    try {
      $result = json_decode(Twitter::getFollowers(['screen_name' => $screen_name, 'count' => 200, 'format' => 'json', 'page' => $request->input('p', 1)]))->users;
      foreach ($result as $i => $record) {
        unset($result[$i]->status);
        unset($result[$i]->entities);
      }
      return [
        'ok' => true,
        'users' => $result,
      ];
    } catch (RunTimeException $e) {
      switch ($e->getMessage()) {
      case '[50] User not found.':
        return [
          'ok' => false,
          'code' => 50,
          'message' => 'user not found',
        ];
      default:
        return [
          'ok' => false,
          'code' => 0,
          'message' => $e->getMessage(),
        ];
      }
    }
  }
  public function friends(Request $request, $screen_name) {
    try {
      $result = json_decode(Twitter::getFriends(['screen_name' => $screen_name, 'count' => 200, 'format' => 'json', 'page' => $request->input('p', 1)]))->users;
      foreach ($result as $i => $record) {
        unset($result[$i]->status);
        unset($result[$i]->entities);
      }
      return [
        'ok' => true,
        'users' => $result,
      ];
    } catch (RunTimeException $e) {
      switch ($e->getMessage()) {
      case '[50] User not found.':
        return [
          'ok' => false,
          'code' => 50,
          'message' => 'user not found',
        ];
      default:
        return [
          'ok' => false,
          'code' => 0,
          'message' => $e->getMessage(),
        ];
      }
    }
  }
  public function tweets(Request $request, $screen_name) {
    try {
      $result = json_decode(Twitter::getUserTimeline(['screen_name' => $screen_name, 'tweet_mode' => 'extended', 'count' => 200, 'format' => 'json', 'page' => $request->input('p', 1)]));
      foreach($result as $i=>$record){
        unset($result[$i]->user);
        // unset($result[$i]->entities);
        unset($result[$i]->retweeted_status);
        // unset($result[$i]->extended_entities);
      }
      return [
        'ok' => true,
        'tweets' => $result,
      ];
    } catch (RunTimeException $e) {
      switch ($e->getMessage()) {
      case '[50] User not found.':
        return [
          'ok' => false,
          'code' => 50,
          'message' => 'user not found',
        ];
      default:
        return [
          'ok' => false,
          'code' => 0,
          'message' => $e->getMessage(),
        ];
      }
    }
  }
  public function tweet(Request $request, $id) {
    try {
      $result = Twitter::getTweet($id, ['trim_user' => true, 'tweet_mode' => 'extended']);
      return [
        'ok' => true,
        'tweet' => $result,
      ];
    } catch (RunTimeException $e) {
      switch ($e->getMessage()) {
      case '[50] User not found.':
        return [
          'ok' => false,
          'code' => 50,
          'message' => 'user not found',
        ];
      default:
        return [
          'ok' => false,
          'code' => 0,
          'message' => $e->getMessage(),
        ];
      }
    }
  }
}
