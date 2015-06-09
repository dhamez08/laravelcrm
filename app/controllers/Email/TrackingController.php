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
	public function image($id = null){
		if ( $id != null ){
			$data = array('receipt'=>1);
			$message = \Message\Message::find($id);
			$message->update($data);
		}
		$image = './public/admin/metronic/assets/layout/img/logo_123crm.png';
		header('Content-type: image/png');
		readfile($image);
		exit;
	}
	public function getReadcount(){
		
	}
}
