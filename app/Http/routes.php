<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', ['as' => 'home', 'uses' => 'ChatplayController@main']);

Route::post('/login', ['as' => 'login', 'uses' => 'ChatplayController@login']);
Route::get('/logout', ['as' => 'logout', 'uses' => 'ChatplayController@logout']);

Route::get('/submit_chat', ['as' => 'submit_chat', 'uses' => 'ChatplayController@submitChat']);

Route::get('/users', ['as' => 'users', 'uses' => 'ChatplayController@getUsers']);

Route::get('/messages', ['as' => 'messages', 'uses' => 'ChatplayController@getChats']);