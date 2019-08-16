<?php

Route::name('web.')->namespace('Web')->group(function () {
  Route::get('/', 'General@home')->name('home');
  Route::get('/search', 'General@search')->name('search');
  Route::get('/followers/{person}', 'General@followers')->name('followers');
  Route::get('/followings/{person}', 'General@followings')->name('followings');
  Route::get('/tweets/{person}', 'General@tweets')->name('tweets');
  Route::get('/docs', function () {
    return view('document');
  })->name('docs');
});