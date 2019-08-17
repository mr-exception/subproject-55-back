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
    // try {
      $person = Twitter::fetchUserByScreenName($screen_name);
      return $person;
      $followers = Twitter::fetchFollowersByScreenName($screen_name);
      $followings = Twitter::fetchFollowingsByScreenName($screen_name);
      $tweets = Twitter::fetchTweetsByScreenName($screen_name);

      $fetched_users = $request->session()->get('fetched_users', []);
      $fetched_users[$screen_name] = compact($person, $followers, $followings, $tweets);

      return view('show.person', ['person' => $person]);
    // } catch (RunTimeException $e) {
      return redirect()->route('web.home')->with(['failed' => [
        'title' => 'sorry! user not found',
        'message' => 'maybe the entered username is wrong or there is a problem in your connection. make sure that user has not changed username',
      ]]);
    // }
  }
  public function followers(Request $request, Person $person) {
    $persons = $person->followers()->paginate(20);
    return view('followers', ['persons' => $persons, 'source' => $person]);
  }
  public function followings(Request $request, Person $person) {
    $persons = $person->followings()->paginate(20);
    return view('followings', ['persons' => $persons, 'source' => $person]);
  }
  public function tweets(Request $request, Person $person) {
    $tweets = $person->tweets()->paginate(20);
    return view('tweets', ['tweets' => $tweets, 'source' => $person]);
  }
}
