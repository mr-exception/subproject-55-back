<?php

Route::get('/', function () {
  return view('welcome');
});
Route::get('/userTimeline', function () {
  return Twitter::getUserTimeline(['screen_name' => 'thujohn', 'count' => 20, 'format' => 'json']);
});