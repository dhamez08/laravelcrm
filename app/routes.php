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
Route::get('medialibrary', function()
{
	\MediaLibrary\MediaLibraryController::get_instance()->getDisplay(0);
});
Route::get( 'login' , 'AuthController@getIndex' );
Route::post( 'login' , 'AuthController@postAuth' );
Route::get( 'logout' , 'AuthController@getLogout' );
Route::get( 'confirmcode/{confirm_code}' , 'AuthController@getConfirmAuthCode' );
Route::controller( 'register' , 'RegisterController' );
Route::get( 'marketing/sms-receipt' , 'Marketing\MarketingController@getSmsReceipt' );
Route::group(array('before' => 'auth'), function()
{
	Route::controller( 'clients' , 'Clients\ClientsController');
	Route::controller( 'profile' , 'Profile\ProfileController' );
	Route::controller( 'document-library' , 'DocumentLibraries\DocumentLibrariesController' );
	Route::controller( 'pipeline' , 'Pipeline\PipelineController' );
	Route::controller( 'task' , 'Task\TaskController');
	Route::controller( 'calendar' , 'Calendar\CalendarController');
	Route::controller( 'notes' , 'Notes\NotesController');
	Route::controller( 'file' , 'File\ClientFileController');
	Route::controller( 'email', 'Email\EmailController');
	Route::controller( 'messages', 'Messages\MessagesController' );
	Route::get( 'client-messages/{client_id}', 'Messages\MessagesController@getIndex' );
	Route::controller( 'sms', 'SMS\SMSController' );
	Route::get( 'settings' , 'Settings\SettingsController@getIndex' );
	Route::controller('client-tag', 'ClientTags\ClientTagsController');
	Route::controller('marketing', 'Marketing\MarketingController');
	Route::controller('smsfile', 'SMSFiles\SMSFilesController');
	Route::group(array('prefix' => 'clients'), function()
	{
		Route::controller( '/' , 'Clients\ClientsController' );
		Route::controller( 'create' , 'Clients\ClientsController' );
	});

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

	Route::group(array('prefix' => 'settings/user-custom-fields'), function()
	{
		Route::controller('/', 'CustomFields\CustomFieldsController');
	});

	Route::group(array('prefix' => 'settings/task-label'), function()
	{
		Route::controller('/', 'Settings\TaskLabelController');
	});

	Route::controller('custom-tab','CustomTab\CustomTabController');
	Route::get( 'dashboard' , 'Dashboard\DashboardController@getIndex' );
});
Route::post('pass-email-data','Email\EmailController@sendData');
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
