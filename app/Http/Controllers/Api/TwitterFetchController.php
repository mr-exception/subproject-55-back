<?php

namespace App\Http\Controllers\Api;

use App\Drivers\Twitter;
use App\Http\Controllers\Controller;
use App\Models\Person;
use App\Models\Task;
use Illuminate\Http\Request;

class TwitterFetchController extends Controller {
  public function run(Request $request) {
    foreach (Task::HaveToRun()->limit(10)->get() as $task) {
      switch ($task->type) {
      case Task::FETCH_USER:
        $this->fetchUser($task);
        break;
      }
    }
    echo "\ndone!";
  }

  /**
   * fetches a user
   * this function does theses steps:
   * 1. fetch the entered user user information
   * 2. add fetch task for all followers and followings
   */
  private function fetchUser(Task $task) {
    $result = Twitter::fetchUserByUserId($task->id_str);
    if ($result) { // user is avialable
      $date = $result->created_at;
      $date_parts = explode(' ', $date);
      $person = Person::create([
        'id_str' => $result->id_str,
        'screen_name' => $result->screen_name,
        'location' => $result->location,
        'description' => $result->description,
        'followers_count' => $result->followers_count,
        'friends_count' => $result->friends_count,
        'registered_at' => \DateTime::createFromFormat("d/M/Y/G:i:s", $date_parts[2] . '/' . $date_parts[1] . '/' . $date_parts[5] . '/' . $date_parts[3])->getTimestamp(),
        'profile_background_color' => $result->profile_background_color,
        'profile_background_image_url' => $result->profile_background_image_url,
        'profile_background_image_url_https' => $result->profile_background_image_url_https,
        'profile_background_tile' => $result->profile_background_tile,
        'profile_image_url_https' => $result->profile_image_url_https,
        'profile_banner_url' => $result->profile_banner_url,
        'profile_link_color' => $result->profile_link_color,
      ]);
      $task->status = Task::FINISHED;
      $task->save();
      // now we have to fetch all followers and task them
      $follower_ids = Twitter::fetchFollowersByUserId($task->id_str);
      if($follower_ids){
        foreach($follower_ids as $fid){
          $task = Task::whereIdStr($fid)->FetchTask()->first();
        }
      }
      // now its following turns
    } else {
      $task->status = Task::FAILED;
      $task->save();
    }
    echo "fetched user " . $task->id_str;
  }
}
