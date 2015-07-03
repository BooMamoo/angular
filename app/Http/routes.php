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

//Route::get('/', 'WelcomeController@index');
//Route::get('home', 'HomeController@index');

//if(Auth::check())
//{
//	Route::get('form', 'FormController@index');
//	Route::post('store/card', 'FormController@store_card');
//	Route::post('store/log', 'FormController@store_log');
//}

Route::get('form', 'FormController@index');
Route::post('store/card', 'FormController@store_card');
Route::post('store/log', 'FormController@store_log');
Route::get('room', 'ListController@room');
Route::get('name/{room}/{page}', 'ListController@name');
Route::get('day/{room}/{page}', 'ListController@day');
Route::get('check/{room}/{page}', 'ListController@check');
Route::get('list/{room}', 'ListController@index');
Route::get('listName/{id}/{room}/{page}', 'ListController@listName');
Route::get('listDay/{day}/{room}/{page}', 'ListController@listDay');
Route::get('listCheck/{day}/{room}/{page}', 'ListController@listCheck');


//Route::controllers([
//	'auth' => 'Auth\AuthController',
//	'password' => 'Auth\PasswordController',
//]);

Route::get('/', 'WelcomeController@index');
Route::get('{any}', 'WelcomeController@index')->where('any', '.*');
