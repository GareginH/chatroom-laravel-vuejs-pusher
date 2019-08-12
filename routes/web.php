<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'ChatController@index');
Route::get('/home', 'ChatController@index')->name('home');
//Chat
Route::get('/chat', 'ChatController@index');
Route::get('/chat/{chat}', 'ChatController@chatroom')->name('chatroom')->middleware('canjoinroom');
Route::get('/chat-create/', 'ChatController@create')->name('create');
Route::post('/chat-create/', 'ChatController@store');
//Profile
Route::get('/profile/{user}', 'ProfileController@index')->name('viewprofile');
Route::get('/profile/{user}/edit', 'ProfileController@edit')->name('editprofile');
Route::patch('/profile/{user}', 'ProfileController@update');
//Messages
Route::post('/chat/{chat}', 'MessageController@store');
Route::get('/chat/get/{chat}', 'MessageController@show');
