<?php
namespace Updates;
/**
 * main model for Clients
 * */

class UpdatesEntity extends \Eloquent{
	protected static $instance = null;

	public function __construct(){

	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * This is use to create user or update
	 * this is full field, mainly use in register
	 *
	 * @param 	$id		int		default null		if there is id then update, else create
	 * @param	$active	int		default 2			#2 means not active
	 * 												#1 would be active
	 * @return db last insert id
	 * */
	public function createOrUpdate($id = null){
		if( is_null($id) ) {
			//create
			$obj = new \Updates\Updates;
		}else{
			//update
			$obj = \Updates\Updates::find($id);
		}

		$obj->belongs_to 	= \Input::get('belongs_to',\Auth::id());
		$obj->belongs_user 	= \Input::get('belongs_user','');
		$obj->customer_id 	= \Input::get('customer_id','');
		$obj->user 			= \Input::get('user','');
		$obj->title 		= \Input::get('title','');
		$obj->type 			= \Input::get('type','');
		$obj->save();
		return $obj;
	}
}
