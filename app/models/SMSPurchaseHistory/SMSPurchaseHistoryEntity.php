<?php
namespace SMSPurchaseHistory;

class SMSPurchaseHistoryEntity extends \Eloquent{

	protected static $instance = null;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sms_purchase_history';

	protected $fillable = array(
		'user_id',
		'sms_username',
		'credits',
		'sms_ref',
		'paypal_token',
		'price',
		'status'
	);

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
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \SMSPurchaseHistory\SMSPurchaseHistory;
		}else{
			//update
			$obj = \SMSPurchaseHistory\SMSPurchaseHistory::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}

	public function updateSMSPurchaseStatus($id, $status){
		$data = array('status' => $status);
		return $this->createOrUpdate($data, $id);
	}

	public function getSmsPurchase($token){
		return \SMSPurchaseHistory\SMSPurchaseHistory::paypalToken($token)->status(0);
	}

}
