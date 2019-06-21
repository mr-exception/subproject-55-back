<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RunTimeException;
use Twitter;

class TwitterController extends Controller {
  private function handleErrors(RunTimeException $e) {
    switch ($e->getMessage()) {
    case '[63] User has been suspended.':
      return [
        'ok' => false,
        'code' => 63,
        'message' => 'user has been suspended',
      ];
    case '[88] Rate limit exceeded':
      return [
        'ok' => false,
        'code' => 88,
        'message' => 'rate limit exceeded',
      ];
    case '[50] User not found.':
    case '[34] Sorry, that page does not exist.':
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
  public function user(Request $request, $screen_name) {
    try {
      $result = json_decode(Twitter::getUsers(['screen_name' => $screen_name, 'format' => 'json']));
      return [
        'ok' => true,
        'user' => $result,
      ];
    } catch (RunTimeException $e) {
      return $this->handleErrors($e);
    }
  }
  public function followers(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'count' => $request->input('count', 200),
        'format' => 'json',
        'cursor' => $request->input('offset', -1),
        'skip_status' => $request->input('skip_status', true),
        'include_user_entities' => $request->input('include_user_entities', false),
      ];
      $result = json_decode(Twitter::getFollowers($filters));
      return [
        'ok' => true,
        'users' => $result->users,
        'next_offset' => $result->next_cursor_str,
        'prev_offset' => $result->previous_cursor_str,
      ];
    } catch (RunTimeException $e) {
      return $this->handleErrors($e);
    }
  }
  public function friends(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'count' => $request->input('count', 200),
        'format' => 'json',
        'cursor' => $request->input('offset', -1),
        'skip_status' => $request->input('skip_status', true),
        'include_user_entities' => $request->input('include_user_entities', false),
      ];
      $result = json_decode(Twitter::getFriends($filters));
      return [
        'ok' => true,
        'users' => $result->عسثقس,
        'next_offset' => $result->next_cursor_str,
        'prev_offset' => $result->previous_cursor_str,
      ];
    } catch (RunTimeException $e) {
      return $this->handleErrors($e);
    }
  }
  public function tweets(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'tweet_mode' => 'extended',
        'count' => $request->input('count', 200),
        'format' => 'json',
      ];
      if ($request->has('offset') && $request->offset) {
        $filters['max_id'] = $request->offset;
      }
      $result = json_decode(Twitter::getUserTimeline($filters));
      if ($request->has('offset') && $request->offset) {
        array_shift($result);
      }
      $response = [
        'ok' => true,
        'tweets' => $result,
        'offset' => null,
      ];
      if (sizeof($result)) {
        $response['offset'] = $result[sizeof($result) - 1]->id_str;
      }
      return $response;
    } catch (RunTimeException $e) {
      return $this->handleErrors($e);
    }
  }
  public function mentions(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'tweet_mode' => 'extended',
        'count' => $request->input('count', 200),
        'format' => 'json',
      ];
      if ($request->has('offset') && $request->offset) {
        $filters['max_id'] = $request->offset;
      }
      $result = json_decode(Twitter::getMentionsTimeline($filters));
      if ($request->has('offset') && $request->offset) {
        array_shift($result);
      }
      $response = [
        'ok' => true,
        'tweets' => $result,
        'offset' => null,
      ];
      if (sizeof($result)) {
        $response['offset'] = $result[sizeof($result) - 1]->id_str;
      }
      return $response;
    } catch (RunTimeException $e) {
      return $this->handleErrors($e);
    }
  }
  public function retweets(Request $request, $screen_name) {
    try {
      $filters = [
        'screen_name' => $screen_name,
        'tweet_mode' => 'extended',
        'count' => $request->input('count', 200),
        'format' => 'json',
      ];
      if ($request->has('offset') && $request->offset) {
        $filters['max_id'] = $request->offset;
      }
      $result = json_decode(Twitter::getRtsTimeline($filters));
      if ($request->has('offset') && $request->offset) {
        array_shift($result);
      }
      $response = [
        'ok' => true,
        'tweets' => $result,
        'offset' => null,
      ];
      if (sizeof($result)) {
        $response['offset'] = $result[sizeof($result) - 1]->id_str;
      }
      return $response;
    } catch (RunTimeException $e) {
      return $this->handleErrors($e);
    }
  }
}
