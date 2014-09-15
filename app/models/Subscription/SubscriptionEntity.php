<?php
namespace Subscription;
/**
 * base model entity class for subscription
 * */
class SubscriptionEntity extends \Eloquent{

	protected static $instance = null;

	protected $expireDate;

	public function __construct(){
		$this->expireDate = '2030-01-01';
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
	 * Create subscription
	 *
	 * @param	$user_id	int		the user id to subscribe
	 * @return	object
	 * */
	public function createSubscription($user_id){
		$Subscription 			= new \Subscription\Subscription;
		$Subscription->user_id 	= $user_id;
		$Subscription->expiry 	= $this->expireDate;
		$Subscription->save();
		return $Subscription;
	}
}
