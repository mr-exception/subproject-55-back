<?php

namespace Tests\Feature;

use Tests\TestCase;

class FriendshipTest extends TestCase {
  public function testFollowers() {
    $response = $this->json('GET', '/api/twitter/followers/BarackObama');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'users' => [[
        'id', 'id_str', 'screen_name',
      ]],
    ]);
    $response->assertJson([
      'ok' => true,
    ]);
  }
  public function testFriends() {
    $response = $this->json('GET', '/api/twitter/friends/BarackObama');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'users' => [[
        'id', 'id_str', 'screen_name',
      ]],
    ]);
    $response->assertJson([
      'ok' => true,
    ]);
  }
  public function testFollowersNotFound() {
    $response = $this->json('GET', '/api/twitter/followers/2738263846284726');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'code', 'message',
    ]);
    $response->assertJson([
      'ok' => false,
      
    ]);
  }
  public function testFriendsNotFound() {
    $response = $this->json('GET', '/api/twitter/friends/2738263846284726');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'code', 'message',
    ]);
    $response->assertJson([
      'ok' => false,
      
    ]);
  }
}
