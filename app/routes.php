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

		Route::controller( 'clients' , 'Clients\ClientsController');
		Route::controller( 'profile' , 'Profile\ProfileController' );
	//});

	Route::get( 'settings' , 'Settings\SettingsController@getIndex' );

	Route::group(array('prefix' => 'settings/tags'), function()
	{
		Route::get('/', 'ClientTags\ClientTagsController@getIndex');
		Route::controller('clients', 'ClientTags\ClientTagsController');
		Route::controller('opportunities', 'OpportunityTags\OpportunityTagsController');
	});

	Route::group(array('prefix' => 'settings/users'), function()
	{
		Route::controller('/', 'User\UserController');
	});

	Route::group(array('prefix' => 'settings/screen'), function()
	{
		Route::controller('/', 'Settings\ScreensController');
	});

	Route::group(array('prefix' => 'settings/email'), function()
	{		
		//Route::controller('/', 'Email\EmailController');
		Route::controller('/', 'Settings\EmailController');
	});

	Route::group(array('prefix' => 'settings/custom-fields'), function()
	{
		Route::controller('/', 'CustomFieldTabs\CustomFieldTabsController');
	});

	Route::group(array('prefix' => 'settings/custom-forms'), function()
	{
		Route::controller('/', 'CustomForms\CustomFormsController');
	});


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
