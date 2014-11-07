<?php
namespace SMSFIles;

class SMSFIlesEntity extends \Eloquent{

	protected static $instance = null;

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
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \SMSFIles\SMSFIles;
		}else{
			//update
			$obj = \SMSFIles\SMSFIles::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}
	/*
	 * get the file via id
	 * - if the id is not array then its just single data
	 * - if its array then we call the whereIn
	 *
	 * @param		$id		int | array
	 * return URL
	 * */
	public function getFileAndConvertToURL($id){
		$url = array();
		if( is_array($id) ){
			$files = \SMSFIles\SMSFIles::fileInId( $id );
			foreach($files->get() as $file){
				$url[] = url('/public/documents/' . $file->file);
			}
		}else{
			$files = \SMSFIles\SMSFIles::find( $id );
			$url[] = url('/public/documents/' . $files->file);
		}
		return $url;
	}

}
