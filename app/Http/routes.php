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
Route::get('home', 'HomeController@index');
Route::get('status', 'HomeController@status');

//if(Auth::check())
//{
//	Route::get('form', 'FormController@index');
//	Route::post('store/card', 'FormController@store_card');
//	Route::post('store/log', 'FormController@store_log');
//}

Route::group(['middleware' => 'auth'], function() {
	Route::get('form/info', 'FormController@index');
	Route::post('store/card', 'FormController@store_card');
	Route::post('store/log', 'FormController@store_log');
});

Route::get('roominfo', 'ListController@room');
Route::get('nameinfo/{room}/{page}', 'ListController@name');
Route::get('dayinfo/{room}/{page}', 'ListController@day');
Route::get('checkinfo/{room}/{page}', 'ListController@check');
Route::get('listinfo/{room}', 'ListController@index');
Route::get('listNameinfo/{id}/{room}/{page}', 'ListController@listName');
Route::get('listDayinfo/{day}/{room}/{page}', 'ListController@listDay');
Route::get('listCheckinfo/{day}/{room}/{page}', 'ListController@listCheck');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
		
Route::get('/', 'WelcomeController@index');
Route::get('{any}', 'WelcomeController@index')->where('any', '.*');
