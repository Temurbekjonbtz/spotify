<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\PlaylistController;
use  App\Http\Controllers\SongsController;
use  App\Http\Controllers\ArtistController;
use  App\Http\Controllers\AlbumsController;

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
Route::apiResource('/album/{album}/song', 'App\Http\Controllers\SongsController');
Route::apiResource('/album', 'App\Http\Controllers\AlbumsController');
Route::apiResource('/playlist', 'App\Http\Controllers\PlaylistController');
Route::apiResource('/song','App\Http\Controllers\SongsController');
Route::get('/playlistsongs/{playlist}', [PlaylistController::class, 'songs']);
Route::get('/songall', [SongsController::class, 'getAllSongs']);
Route::post('/playlistsongs', [PlaylistController::class,'storesong']);
Route::delete('/playlistsongs', [PlaylistController::class,'deletesongfromplaylist']);
Route::apiResource('/artist', 'App\Http\Controllers\ArtistController');
Route::post('/subscribe/{artist}', [ArtistController::class,'subscribe']);
Route::delete('/subscribe/{artist}', [ArtistController::class,'unSubscribe']);
Route::post('updateartist/{artist}',[ArtistController::class,'updateArtist']);
Route::post('updatealbum/{album}',[AlbumsController::class,'updateAlbum']);
Route::post('updatesong/{song}',[SongsController::class,'updateSong']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('signup', 'App\Http\Controllers\AuthController@signup');
    Route::post('update', 'App\Http\Controllers\AuthController@update');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');

});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
