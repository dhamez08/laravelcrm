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
Route::get( '/' , 'HomeController@getIndex' );
Route::get('testmail', function()
{
	Mail::send('emails.welcome', array('key' => 'value'), function($message)
	{
		$message->to('allan.paul.casilum@gmail.com', 'John Smith')->subject('Welcome!');
	});
});
Route::controller( 'login' , 'AuthController' );
Route::controller( 'logout' , 'AuthController' );
Route::controller( 'register' , 'RegisterController' );
Route::group(array('before' => 'auth'), function()
{
	Route::group(array('prefix' => 'dashboard'), function()
	{
		Route::get( '/' , 'Dashboard\DashboardController@getIndex' );
	});
});

