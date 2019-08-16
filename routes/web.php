<?php

Route::name('web.')->namespace('Web')->group(function () {
  Route::get('/', 'General@home')->name('home');
  Route::get('/search', 'General@search')->name('search');
  Route::get('/docs', function () {
    return view('document');
  })->name('docs');
});