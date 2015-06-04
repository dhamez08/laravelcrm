<?php namespace Email;

class TrackingController extends \Controller  {
	/**
	 * Create a new controller instance.
	 *
	 */
	protected static $instance = null;
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	public function __construct()
	{
	}

	public function image($ref = null){
		if ( $ref != null ){
			//update messages table
			//set receipt to 1
		}
		$image = 'key.png';
		header('Content-type: image/png');
		readfile($image);
		exit;
	}
	public function hdr(){
		//test on mail 
	\Mail::send('users/mails/welcome', ['firstname'=>'PrimeJohnz'], function($message) {
		$message->to('prime.dionson@gmail.com', 'Prime')->subject('Welcome to the Laravel 4 Auth App!');
		$message->getHeaders()->addTextHeader('MSG-REF', 101);
		$message->getHeaders()->addTextHeader('Read-Receipt-To','primejohnz@gmail.com>');
		$message->getHeaders()->addTextHeader('Return-Receipt-Requested',1);
		$message->getHeaders()->addTextHeader('X-Confirm-Reading-To','primejohnz@gmail.com');
		$message->getHeaders()->addTextHeader('Disposition-Notification-To','<prime@dionson.me>');
	});
	}
}
