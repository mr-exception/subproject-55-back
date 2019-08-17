<?php

namespace App\Http\Controllers\Api;

use App\Drivers\Twitter;
use App\Http\Controllers\Controller;
use App\Models\FriendShip;
use App\Models\HashTag;
use App\Models\Person;
use App\Models\Task;
use App\Models\Tweet;
use App\Models\TweetHashTag;
use Illuminate\Http\Request;

class TwitterFetchController extends Controller {
  public function run(Request $request) {
    foreach (Task::HaveToRun()->limit(5)->get() as $task) {
      $this->fetchUser($task);
      $this->fetchTweets($task);
      $task->status = Task::FINISHED;
      $task->save();
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
        'id_str' => (property_exists($result, 'id_str') && $result->id_str) ? $result->id_str : 'NuLL',
        'screen_name' => (property_exists($result, 'screen_name') && $result->screen_name) ? $result->screen_name : 'NuLL',
        'location' => (property_exists($result, 'location') && $result->location) ? $result->location : 'NuLL',
        'description' => (property_exists($result, 'description') && $result->description) ? $result->description : 'NuLL',
        'followers_count' => (property_exists($result, 'followers_count') && $result->followers_count) ? $result->followers_count : 0,
        'friends_count' => (property_exists($result, 'friends_count') && $result->friends_count) ? $result->friends_count : 0,
        'registered_at' => \DateTime::createFromFormat("d/M/Y/G:i:s", $date_parts[2] . '/' . $date_parts[1] . '/' . $date_parts[5] . '/' . $date_parts[3])->getTimestamp(),
        'profile_background_color' => (property_exists($result, 'profile_background_color') && $result->profile_background_color) ? $result->profile_background_color : 'NuLL',
        'profile_background_image_url' => (property_exists($result, 'profile_background_image_url') && $result->profile_background_image_url) ? $result->profile_background_image_url : 'NuLL',
        'profile_background_image_url_https' => (property_exists($result, 'profile_background_image_url_https') && $result->profile_background_image_url_https) ? $result->profile_background_image_url_https : 'NuLL',
        'profile_background_tile' => (property_exists($result, 'profile_background_tile') && $result->profile_background_tile) ? $result->profile_background_tile : 'NuLL',
        'profile_image_url_https' => (property_exists($result, 'profile_image_url_https') && $result->profile_image_url_https) ? $result->profile_image_url_https : 'NuLL',
        'profile_banner_url' => (property_exists($result, 'profile_banner_url') && $result->profile_banner_url) ? $result->profile_banner_url : 'NuLL',
        'profile_link_color' => (property_exists($result, 'profile_link_color') && $result->profile_link_color) ? $result->profile_link_color : 'NuLL',
      ])->save();
      Person::updateLatestIds($person);
      echo "fetched user " . $user_id . "\n";
      // now we have to fetch all followers and task them
      $follower_ids = Twitter::fetchFollowersByUserId($user_id);
      if ($follower_ids) {
        foreach ($follower_ids as $fid) {
          $task = Task::whereIdStr($fid)->UserType()->first();
          if (!$task) {
            $task = Task::create([
              'id_str' => $fid,
              'type' => Task::FETCH_USER,
            ]);
          }
          $follower = FriendShip::where([
            'src_id_str' => $fid,
            'dst_id' => $person->id,
          ])->first();
          if (!$follower) {
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
          }
          $following = FriendShip::where([
            'dst_id_str' => $fid,
            'src_id' => $person->id,
          ])->first();
          FriendShip::create([
            'dst_id_str' => $fid,
            'dst_id' => 0,
            'src_id_str' => $person->id_str,
            'src_id' => $person->id,
          ]);
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
    $tweets = Twitter::fetchTweetsByUserId($user_id);
    foreach ($tweets as $tweet) {
      $obj = new Tweet;
      $obj->id_str = $tweet->id_str;
      $obj->text = $tweet->full_text;
      $obj->retweet_count = $tweet->retweet_count;
      $obj->favorite_count = $tweet->favorite_count;
      $obj->lang = $tweet->lang;

      $obj->user_id_str = $tweet->user->id_str;
      $user = Person::where('id_str', $tweet->user->id_str)->first();
      if ($user) {
        $obj->user_id = $user->id;
      } else {
        $obj->user_id = 0;
      }

      if ($tweet->in_reply_to_screen_name) {
        $obj->in_reply_to_screen_name = $tweet->in_reply_to_screen_name;
        $obj->in_reply_to_user_id_str = $tweet->in_reply_to_user_id_str;
        $user = Person::where('id_str', $tweet->in_reply_to_user_id_str)->first();
        if ($user) {
          $obj->in_reply_to_user_id = $user->id;
        } else {
          $obj->in_reply_to_user_id = 0;
        }
      }

      if ($tweet->in_reply_to_status_id_str) {
        $obj->in_reply_to_status_id_str = $tweet->in_reply_to_status_id_str;
        $status = Tweet::where('id_str', $tweet->in_reply_to_status_id_str)->first();
        if ($status) {
          $obj->in_reply_to_status_id = $status->id;
        } else {
          $obj->in_reply_to_status_id = 0;
        }
      }
      $obj->save();
      Tweet::updateLatestIds($obj);
      foreach ($tweet->entities->hashtags as $hashtag) {
        $tag = HashTag::whereTitle($hashtag->text)->first();
        if (!$tag) {
          $tag = HashTag::create(['title' => $hashtag->text]);
        }
        TweetHashTag::create([
          'tweet_id' => $obj->id,
          'tweet_id_str' => $obj->id_str,
          'hash_tag_id' => $tag->id,
        ]);
      }
    }
    echo "fetched " . sizeof($tweets) . " tweets\n";
  }
  public function cleanTasks(Request $request) {
    $count_grouped =  sizeof(Task::select('id_str')->GroupBy('id_str')->get());
    $count = Task::count();
    return $count;
    $step = $request->input('step', 100);
    $tasks = Task::offset($request->input('offset', 0))->limit($step)->get();
    foreach ($tasks as $task) {
      $section = Task::whereIdStr($task->id_str)->get();
      foreach ($section as $k => $sec) {
        if ($k > 0) {
          $sec->delete();
        }
      }
    }
    return $count;
  }
}
