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
    $response = $this->json('GET', '/api/twitter/tweets/BarackObama', ['pagesize' => 10]);
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'tweets' => [],
    ]);
    $response->assertJsonCount(10, 'tweets');
  }
  public function testPageNumber(){
    $response1 = $this->json('GET', '/api/twitter/tweets/BarackObama', ['pagesize' => 2, 'pagenumber' => 1]);
    $response2 = $this->json('GET', '/api/twitter/tweets/BarackObama', ['pagesize' => 1, 'pagenumber' => 2]);
    $response1->assertSuccessful();
    $response1->assertJsonStructure([
      'ok', 'tweets' => [],
    ]);
    $response1->assertJsonCount(2, 'tweets');

    $response2->assertSuccessful();
    $response2->assertJsonStructure([
      'ok', 'tweets' => [],
    ]);
    $response2->assertJsonCount(1, 'tweets');

    $this->assertEquals($response1->original['tweets'][1]->id_str, $response2->original['tweets'][0]->id_str);

  }
}
