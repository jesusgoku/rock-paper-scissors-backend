<?php

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

Route::post('/games', 'Api\GameController@store');
Route::get('/games/{id}', 'Api\GameController@show');
Route::post('/games/{id}', 'Api\GameController@update');
