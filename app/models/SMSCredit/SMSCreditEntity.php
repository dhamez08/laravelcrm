<?php
namespace SMSCredit;

class SMSCreditEntity extends \Eloquent{

	protected static $instance = null;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sms_credits';

	protected $fillable = array(
		'user_id',
		'credits'
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
			$obj = new \SMSCredit\SMSCredit;
		}else{
			//update
			$obj = \SMSCredit\SMSCredit::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}

	public function addSMSCredits($user_id, $credits){
		// if there isnt a record for the credits we need to created on .... or we can update it
		$check_credit = \SMSCredit\SMSCredit::userId($user_id);
		if( !$check_credit->count() ){
			$data = array(
				'user_id' => $user_id,
				'credits' => $credits
			);
			$credit = $this->createOrUpdate($data);
		}else{
			$data = array(
				'credits' => ( $credits + $check_credit->first()->credits )
			);
			$credit = $this->createOrUpdate($data, $check_credit->first()->id);
		}
		return $credit;
	}

}
