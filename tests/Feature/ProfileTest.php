<?php

namespace Tests\Feature;

use Tests\TestCase;

class ProfileTest extends TestCase {
  public function testSample() {
    $response = $this->json('GET', '/api/twitter/user/BarackObama');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'user' => [
        'id', 'id_str', 'screen_name',
      ],
    ]);
    $response->assertJson([
      'ok' => true,
    ]);
  }
  public function testNotFound() {
    $response = $this->json('GET', '/api/twitter/user/27184612874618276');
    $response->assertSuccessful();
    $response->assertJsonStructure([
      'ok', 'code', 'message',
    ]);
    $response->assertJson([
      'ok' => false,
      'code' => 50,
    ]);
  }
}
