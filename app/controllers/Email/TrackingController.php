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
}
