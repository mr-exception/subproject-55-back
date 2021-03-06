<?php

namespace Tests\Feature;

use Tests\TestCase;

class TweetsTest extends TestCase {
  public function testSample() {
    $response = $this->json('GET', '/api/twitter/tweets/BarackObama');
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
    $response = $this->json('GET', '/api/twitter/tweets/bababab43535aba');
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
    $response = $this->json('GET', '/api/twitter/tweets/BarackObama', ['count' => 10]);
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'tweets' => [],
    ]);
    $response->assertJsonCount(10, 'tweets');
  }
  public function testPageNumber() {
    $response1 = $this->json('GET', '/api/twitter/tweets/BarackObama', ['count' => 10]);
    $response1->assertSuccessful();
    $response1->assertJsonStructure([
      'ok', 'tweets' => [], 'offset',
    ]);

    $response2 = $this->json('GET', '/api/twitter/tweets/BarackObama', ['count' => 10, 'offset' => $response1->original['offset']]);
    $response1->assertJsonCount(10, 'tweets');
    $response2->assertSuccessful();
    $response2->assertJsonStructure([
      'ok', 'tweets' => [], 'offset',
    ]);

    $last_tweet_of_first_page = $response1->original['tweets'][sizeof($response1->original['tweets']) - 1];
    $first_tweet_of_second_page = $response2->original['tweets'][0];
    $this->assertNotEquals($last_tweet_of_first_page->id_str, $first_tweet_of_second_page->id_str);
    // $response2 = $this->json('GET', '/api/twitter/tweets/BarackObama', ['pagesize' => 1, 'pagenumber' => 2]);
    // $response2->assertJsonCount(1, 'tweets');

    // $this->assertEquals($response1->original['tweets'][1]->id_str, $response2->original['tweets'][0]->id_str);

  }
}
