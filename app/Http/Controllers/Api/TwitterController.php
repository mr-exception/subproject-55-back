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
      $filters = [
        'screen_name' => $screen_name,
        'count' => $request->input('pagesize', 200),
        'format' => 'json',
        'cursor' => $request->input('pagenumber', 1),
        'skip_status' => $request->input('skip_status', true),
        'include_user_entities' => $request->input('include_user_entities', false),
      ];
      $result = json_decode(Twitter::getFollowers($filters))->users;
      foreach ($result as $i => $record) {
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
      $filters = [
        'screen_name' => $screen_name,
        'count' => $request->input('pagesize', 200),
        'format' => 'json',
        'cursor' => $request->input('pagenumber', -1),
        'skip_status' => $request->input('skip_status', true),
        'include_user_entities' => $request->input('include_user_entities', false),
      ];
      $result = json_decode(Twitter::getFriends($filters))->users;
      foreach ($result as $i => $record) {
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
      $filters = [
        'screen_name' => $screen_name,
        'tweet_mode' => 'extended',
        'count' => $request->input('pagesize', 200),
        'format' => 'json',
        'page' => $request->input('pagenumber', 1),
      ];
      if ($request->has('offset') && $request->offset) {
        $filters['max_id'] = $request->offset;
      }

      $result = json_decode(Twitter::getUserTimeline($filters));
      foreach ($result as $i => $record) {
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
  public function mentions(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'tweet_mode' => 'extended',
        'count' => $request->input('pagesize', 200),
        'format' => 'json',
        'page' => $request->input('pagenumber', 1),
      ];
      if ($request->has('offset') && $request->offset) {
        $filters['max_id'] = $request->offset;
      }
      $result = json_decode(Twitter::getMentionsTimeline($filters));
      foreach ($result as $i => $record) {
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
  public function retweets(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'tweet_mode' => 'extended',
        'count' => $request->input('pagesize', 200),
        'format' => 'json',
        'page' => $request->input('pagenumber', 1),
      ];
      if ($request->has('offset') && $request->offset) {
        $filters['max_id'] = $request->offset;
      }
      $result = json_decode(Twitter::getRtsTimeline($filters));
      foreach ($result as $i => $record) {
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
}
