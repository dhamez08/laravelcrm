<?php
namespace SMS;

class SMSEntity extends \Eloquent{
	protected static $instance = null;

	protected $sms_purchase;
	protected $currency;

	public function __construct(){
		$this->sms_purchase = \Config::get('crm.sms.purchase');
		$this->currency = \Config::get('crm.currency.symbol');
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

	public function getPurchaseSMS(){
		return $this->sms_purchase;
	}

	public function getCurrency(){
		return $this->currency;
	}

}
