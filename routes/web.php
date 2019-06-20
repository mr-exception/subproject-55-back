<?php

Route::get('/', function () {
  return view('welcome');
});
Route::get('/docs', function(){
  return view('document');
})->name('docs');