<?php
namespace SMSReport;

class SMSReportEntity extends \Eloquent{

	protected static $instance = null;

	protected $status;

	public function __construct(){
		$this->status = array(
			'D' => 'Delivered',
			'U' => 'Undelivered',
			'I' => 'Phone number is Invalid',
			'?' => 'Unknown',
		);
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

	public function getStatus(){
		return $this->status;
	}

	public function getMsgStatus($msg_status){
		if( isset($this->status[$msg_status]) ){
			return $this->status[$msg_status];
		}else{
			return 'Unknown';
		}
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
			$obj = new \SMSReport\SMSReport;
		}else{
			//update
			$obj = \SMSReport\SMSReport::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}

}
