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

}
