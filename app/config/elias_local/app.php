<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application Debug Mode
	|--------------------------------------------------------------------------
	|
	| When your application is in debug mode, detailed error messages with
	| stack traces will be shown on every error that occurs within your
	| application. If disabled, a simple generic error page is shown.
	|
	*/

	'debug' => true,

	'providers' => array(
	    'Nitmedia\Wkhtml2pdf\Wkhtml2pdfServiceProvider',
	),

	'aliases' => array(
	    'PDF'    => 'Nitmedia\Wkhtml2pdf\Facades\Wkhtml2pdf',
	),

);
