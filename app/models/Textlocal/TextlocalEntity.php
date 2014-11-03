<?php
namespace Textlocal;
/**
 * main model for Clients
 * */

class TextlocalEntity extends \Eloquent{
	protected static $instance = null;

	public $textlocal_api;

	protected $textlocal_login;

	protected $textlocal_hash;

	protected $textlocal_sendsms_test;

	public function __construct(){
		$this->textlocal_login = \Config::get('crm.textlocal.api.login');
		$this->textlocal_hash = \Config::get('crm.textlocal.api.hashcode');
		$this->textlocal_sendsms_test = \Config::get('crm.textlocal.api.test');
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

	public function setSendSmsTest($test = null){
		if( is_null( $test ) ){
			return $this->textlocal_sendsms_test;
		}else{
			return $test_send_sms;
		}
	}

	public function getSendSmsTest(){
		return $this->textlocal_sendsms_test;
	}

	public function apiTextlocal(){
		$this->textlocal_api = new \helpers\Textlocal($this->textlocal_login, $this->textlocal_hash);
		return $this;
	}

	public function getObjectResult(){
		return $this->textlocal_api;
	}

	public function getUsers(){
		 return $this->getObjectResult()->getUsers();
	}

	/**
	 * Send an SMS to one or more comma separated numbers
	 * @param $numbers
	 * @param $message
	 * @param $sender
	 * @param null $sched
     * @param false $test
     * @param null $receiptURL
     * @param numm $custom
     * @param false $optouts
     * @param false $simpleReplyService
	 * @return array|mixed
	 * @throws Exception
	 */
	public function getSMSCost(
		$numbers,
		$message,
		$sender,
		$sched=null,
		$test = true,
		$receiptURL=null,
		$custom=null,
		$optouts=false,
		$simpleReplyService=false
	){
		$get_costs = $this->sendSms(
			$numbers,
			$message,
			$sender,
			$sched,
			$test,
			$receiptURL,
			$custom,
			$optouts,
			$simpleReplyService
		);
		if( $get_costs->status == 'success' ){
			return $get_costs->cost;
		}else{
			return false;
		}
	}

	/**
	 * Send an SMS to one or more comma separated numbers
	 * @param $numbers
	 * @param $message
	 * @param $sender
	 * @param null $sched
     * @param false $test
     * @param null $receiptURL
     * @param numm $custom
     * @param false $optouts
     * @param false $simpleReplyService
	 * @return array|mixed
	 * @throws Exception
	 */
	public function sendSMS(
		$numbers,
		$message,
		$sender,
		$sched = null,
		$test = $this->getSendSmsTest(),
		$receiptURL=null,
		$custom=null,
		$optouts=false,
		$simpleReplyService=false
	){
		 return $this->getObjectResult()->sendSms(
			$numbers,
			$message,
			$sender,
			$sched,
			$test,
			$receiptURL,
			$custom,
			$optouts,
			$simpleReplyService
		);
	}

}
