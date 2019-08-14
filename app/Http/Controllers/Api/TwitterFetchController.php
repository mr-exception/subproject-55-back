<?php

namespace App\Http\Controllers\Api;

use App\Drivers\Twitter;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;

class TwitterFetchController extends Controller {
  public function run(Request $request) {
    foreach (Task::HaveToRun()->limit(5)->get() as $task) {
      $this->fetchUser($task);
      $this->fetchTweets($task);
    }
    echo "\ndone!";
  }

  /**
   * fetches a user
   * this function does these steps:
   * 1. fetch the entered user user information
   * 2. add fetch task for all followers and followings
   */
  private function fetchUser(Task $task) {
    $user_id = $task->id_str;
    $person = Person::whereIdStr($user_id)->first();
    if (!$person) {
      $person = new Person;
    }
    $result = Twitter::fetchUserByUserId($user_id);
    if ($result) { // user is avialable
      $date = $result->created_at;
      $date_parts = explode(' ', $date);
      $person->fill([
        'id_str' => $result->id_str ? $result->id_str : 'NuLL',
        'screen_name' => $result->screen_name ? $result->screen_name : 'NuLL',
        'location' => $result->location ? $result->location : 'NuLL',
        'description' => $result->description ? $result->description : 'NuLL',
        'followers_count' => $result->followers_count ? $result->followers_count : 0,
        'friends_count' => $result->friends_count ? $result->friends_count : 0,
        'registered_at' => \DateTime::createFromFormat("d/M/Y/G:i:s", $date_parts[2] . '/' . $date_parts[1] . '/' . $date_parts[5] . '/' . $date_parts[3])->getTimestamp(),
        'profile_background_color' => $result->profile_background_color ? $result->profile_background_color : 'NuLL',
        'profile_background_image_url' => $result->profile_background_image_url ? $result->profile_background_image_url : 'NuLL',
        'profile_background_image_url_https' => $result->profile_background_image_url_https ? $result->profile_background_image_url_https : 'NuLL',
        'profile_background_tile' => $result->profile_background_tile ? $result->profile_background_tile : 'NuLL',
        'profile_image_url_https' => $result->profile_image_url_https ? $result->profile_image_url_https : 'NuLL',
        'profile_banner_url' => $result->profile_banner_url ? $result->profile_banner_url : 'NuLL',
        'profile_link_color' => $result->profile_link_color ? $result->profile_link_color : 'NuLL',
      ])->save();
      FriendShip::whereSrcIdStr($person->id_str)->update(['src_id' => $person->id]);
      FriendShip::whereDstIdStr($person->id_str)->update(['dst_id' => $person->id]);
      $task->status = Task::FINISHED;
      $task->save();
      echo "fetched user " . $user_id . "\n";
      // now we have to fetch all followers and task them
      $follower_ids = Twitter::fetchFollowersByUserId($user_id);
      if ($follower_ids) {
        foreach ($follower_ids as $fid) {
          $task = Task::whereIdStr($fid)->UserType()->first();
          if (!$task) {
            $task = Task::create(['id_str' => $fid, 'type' => Task::FETCH_USER]);
            FriendShip::create([
              'src_id_str' => $fid,
              'src_id' => 0,
              'dst_id_str' => $person->id_str,
              'dst_id' => $person->id,
            ]);
          }
        }
      }
      echo "added " . sizeof($follower_ids) . " users to task fetch from followers\n";
      // now its following turns
      $following_ids = Twitter::fetchFollowingsByUserId($user_id);
      if ($following_ids) {
        foreach ($following_ids as $fid) {
          $task = Task::whereIdStr($fid)->UserType()->first();
          if (!$task) {
            $task = Task::create([
              'id_str' => $fid,
              'type' => Task::FETCH_USER,
            ]);
            FriendShip::create([
              'dst_id_str' => $fid,
              'dst_id' => 0,
              'src_id_str' => $person->id_str,
              'src_id' => $person->id,
            ]);
          }
        }
      }
      echo "added " . sizeof($following_ids) . " users to task fetch from followings\n";
    } else {
      $task->status = Task::FAILED;
      $task->save();
    }
  }
  /**
   * fetch tweets of a user
   * this function does these steps:
   * 1. fetch timeline of user
   * 2. fetch mentions of user
   */
  public function fetchTweets(Task $task) {
    $user_id = $task->id_str;
    $result = Twitter::fetchTweetsByUserId($user_id);
  }
}
