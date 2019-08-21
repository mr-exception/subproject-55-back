<?php

Route::name('web.')->namespace('Web')->group(function () {
  Route::get('/', 'General@home')->name('home');
  Route::get('/search', 'General@search')->name('search');
  Route::get('/learn/{screen_name}/{step}', 'NLP@learn')->name('learn');
  Route::post('/learn/store', 'NLP@storeLearn')->name('store_learn');
  Route::get('/tweets/{screen_name}', 'General@tweets')->name('tweets');
  Route::get('/test', 'NLP@test')->name('test');
});