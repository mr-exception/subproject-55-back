<?php

namespace Tests\Feature;

use Tests\TestCase;

class MentionsTest extends TestCase {
  public function testSample() {
    $response = $this->json('GET', '/api/twitter/mentions/BarackObama');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'tweets' => [[
        'id', 'id_str', 'full_text',
      ]],
    ]);
    $response->assertJson([
      'ok' => true,
    ]);
  }
  public function testNotFound() {
    $response = $this->json('GET', '/api/twitter/mentions/bababab43535aba');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'code', 'message',
    ]);
    $response->assertJson([
      'ok' => false,
      'code' => 50,
    ]);
  }
  public function testCount() {
    $response = $this->json('GET', '/api/twitter/mentions/BarackObama', ['count' => 10]);
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'tweets' => [],
    ]);
    $response->assertJsonCount(10, 'tweets');
  }
  public function testPageNumber() {
    $response1 = $this->json('GET', '/api/twitter/mentions/BarackObama', ['count' => 10]);
    $response1->assertSuccessful();
    $response1->assertJsonStructure([
      'ok', 'tweets' => [], 'offset',
    ]);

    $response2 = $this->json('GET', '/api/twitter/mentions/BarackObama', ['count' => 10, 'offset' => $response1->original['offset']]);
    $response1->assertJsonCount(10, 'tweets');
    $response2->assertSuccessful();
    $response2->assertJsonStructure([
      'ok', 'tweets' => [], 'offset',
    ]);

    $last_tweet_of_first_page = $response1->original['tweets'][sizeof($response1->original['tweets']) - 1];
    $first_tweet_of_second_page = $response2->original['tweets'][0];
    $this->assertNotEquals($last_tweet_of_first_page->id_str, $first_tweet_of_second_page->id_str);

  }
}
