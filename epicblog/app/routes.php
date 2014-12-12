<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
});

Route::get('post/index', array('as' => 'post.index', 'uses' => 'PostController@index'));
Route::get('post/show/{id}', array('as' => 'post.show', 'uses' => 'PostController@show'));
Route::get('post/create', array('as' => 'post.create', 'uses' => 'PostController@create'));
Route::get('post/edit/{id}', array('as' => 'post.edit', 'uses' => 'PostController@edit'));
Route::patch('post/edit/{id}', array('as' => 'post.update', 'uses' => 'PostController@update'));

Route::delete('post/delete/{id}', array('as' => 'post.delete', 'uses' => 'PostController@destroy'));
Route::post('post/create', array('as' => 'post.store', 'uses' => 'PostController@store'));


Route::get('user/show/{id}', array('as' => 'user.show', 'uses' => 'UserController@show'));

Route::get('user/create', array('as' => 'user.create', 'uses' => 'UserController@create'));
Route::post('user/create', array('as' => 'user.store', 'uses' => 'UserController@store'));

Route::get('user/login', array('as' => 'user.login', 'uses' => 'UserController@login'));
Route::post('user/login', array('as' => 'user.internalLogin', 'uses' => 'UserController@internalLogin'));

Route::get('user/logout', array('as' => 'user.logout', 'uses' => 'UserController@logout'));