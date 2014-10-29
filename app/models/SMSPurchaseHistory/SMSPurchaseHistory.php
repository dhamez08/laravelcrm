<?php
namespace SMSPurchaseHistory;

class SMSPurchaseHistory extends \Eloquent{

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
}
