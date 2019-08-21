<?php

namespace App\Http\Controllers\Web;

use App\Drivers\Twitter;
use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use RunTimeException;

class General extends Controller {
  public function home(Request $request) {
    return view('welcome');
  }
  public function search(Request $request) {
    $screen_name = $request->input('screen_name', '');
    try {
      if (time() - session("fetched_users.$screen_name.last_fetch", 0) > 3600 * 4) {
        $person = Twitter::fetchUserByScreenName($screen_name);
        $followers = Twitter::fetchFollowersByScreenName($screen_name);
        $followings = Twitter::fetchFollowingsByScreenName($screen_name);
        $tweets = Twitter::fetchTweetsByScreenName($screen_name);
        $last_fetch = time();

        $fetched_users = $request->session()->get('fetched_users', []);
        $fetched_users[$screen_name] = [
          'person' => $person,
          'followers' => $followers,
          'followings' => $followings,
          'tweets' => $tweets,
          'last_fetch' => $last_fetch,
        ];
        $request->session()->put('fetched_users', $fetched_users);
      }
      // return dd(session("fetched_users.$screen_name.tweets.0"));
      return view('show.person', ['screen_name' => $screen_name]);
    } catch (RunTimeException $e) {
      return redirect()->route('web.home')->with(['failed' => [
        'title' => 'sorry! user not found',
        'message' => 'maybe the entered username is wrong or there is a problem in your connection. make sure that user has not changed username',
      ]]);
    }
  }
  public function followers(Request $request, Person $person) {
    $persons = $person->followers()->paginate(20);
    return view('followers', ['persons' => $persons, 'source' => $person]);
  }
  public function followings(Request $request, Person $person) {
    $persons = $person->followings()->paginate(20);
    return view('followings', ['persons' => $persons, 'source' => $person]);
  }
  public function tweets(Request $request, $screen_name) {
    $tweets = session("fetched_users.$screen_name.tweets", null);
    $person = session("fetched_users.$screen_name.person", null);
    if ($tweets) {
      $total = ceil(sizeof($tweets)/10);
      $tweets = array_splice($tweets, $request->input('page', 0) * 10, 10);
      return view('tweets', ['tweets' => $tweets, 'person' => $person, 'page' => $request->input('page', 0), 'total' => $total]);
    } else {
      return redirect()->route('web.search', ['screen_name' => $screen_name]);
    }

  }
}
