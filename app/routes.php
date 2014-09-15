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
Route::get( 'login' , 'AuthController@getIndex' );
Route::post( 'login' , 'AuthController@postAuth' );
Route::get( 'logout' , 'AuthController@getLogout' );
Route::get( 'confirmcode/{confirm_code}' , 'AuthController@getConfirmAuthCode' );
Route::controller( 'register' , 'RegisterController' );
Route::group(array('before' => 'auth'), function()
{
	//Route::group(array('prefix' => 'dashboard'), function()
	//{
		Route::get( 'dashboard' , 'Dashboard\DashboardController@getIndex' );
		Route::get( 'settings' , 'Settings\SettingsController@getIndex' );
		Route::controller( 'profile' , 'Profile\ProfileController' );
	//});
});

Route::get('testmail', function()
{
	$data = array('to'=>'John Smith');
	Mail::send('emails.welcome', $data, function($message) use ($data)
	{
		$message->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'));
		$message->to('allan.paul.casilum@gmail.com', $data['to'])->subject('Welcome!');
	});
	//echo \Config::get('mail.from.address');
});
