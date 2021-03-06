<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});
Route::name('api.')->namespace('Api')->middleware('cors')->group(function () {
  Route::prefix('twitter')->name('twitter.')->group(function () {
    Route::get('/user/{screen_name}', 'TwitterController@user')->name('user');

    Route::get('/followers/{screen_name}', 'TwitterController@followers')->name('followers');
    Route::get('/friends/{screen_name}', 'TwitterController@friends')->name('friends');

    Route::get('/tweets/{screen_name}', 'TwitterController@tweets')->name('tweets');
    Route::get('/retweets/{screen_name}', 'TwitterController@retweets')->name('retweets');

    Route::get('/mentions/{screen_name}', 'TwitterController@mentions')->name('mentions');

    Route::get('/fetch', 'TwitterFetchController@run')->name('fetch');
    Route::get('/clean', 'TwitterFetchController@cleanTasks')->name('clean');
  });
});