<?php
namespace SMS;
/**
 * Clients Controller
 *
 * */

class SMSController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * hold the view essentials like
	 * - title
	 * - view path
	 * @return array | associative
	 * */
	protected $data_view;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		$this->data_view 					= parent::setupThemes();
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
	}

	/**
	 * Return an instance of this class.
	 *
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

	public function getIndex(){
	}

	//test getHistoryAPIMsg
	public function getApiTextlocalHistoryMsg(){
		$history_msg = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
		//var_dump($users);
		var_dump($history_msg->getHistoryMSG());
	}

	//test getHistoryID
	public function getApiTextlocalHistoryId($id){
		$history_msg = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
		//var_dump($users);
		var_dump($history_msg->getMsgStatusID($id));
	}
	//test getUsers
	public function getApiTextlocalUsers(){
		$users = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
		//var_dump($users);
		var_dump($users->getUsers());
	}
	//test Inbox
	public function getApiTextlocalInbox(){
		$inbox = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
		echo '<pre>';
		print_r($inbox);
		echo '</pre>';
		//var_dump($inbox->getInboxes());
	}
	//test Sms Cost
	public function getSmsCost(){
		$sms = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
		$numbers = array('+639162604002');
		$message = 'test';
		$sender = 'allan';
		$test =  true;
		$response = $sms->getSMSCost($numbers, $message, $sender, null, $test);
		var_dump($response);
	}
	//test Send Sms
	public function getSendSmsApi(){
		$sms = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
		$numbers = array('+639162604002');
		$message = 'test';
		$sender = 'allan';
		$test =  true;
		$response = $sms->sendSMS($numbers, $message, $sender, null, $test);
		var_dump($response);
	}
	// end test

	public function getPurchaseSms($sms_credit){
		$sms_price = 0;
		$sms_name  = '';
		$sms_price_credit = \SMS\SMSEntity::get_instance()->getPurchaseSMS();

		if( array_key_exists($sms_credit,$sms_price_credit) ){
			$sms_price = array_get($sms_price_credit,$sms_credit);
			switch($sms_credit){
				case 0:
					$sms_name = "0 SMS Credits";
				break;
				case 20:
					$sms_name = "20 SMS Credits";
				break;
				case 50:
					$sms_name = "50 SMS Credits";
				break;
				case 100:
					$sms_name = "100 SMS Credits";
				break;
				case 200:
					$sms_name = "200 SMS Credits";
				break;
				default:
					return \Redirect::to('profile')->withErrors('Error processing your payment request, please contact support.');
				break;
			}

			// params to send over to paypal
			$params = array(
				'RETURNURL' => url('sms/create-sms-credit'),
				'CANCELURL' => url('profile'),
				'PAYMENTREQUEST_0_AMT' => $sms_price,
				'PAYMENTREQUEST_0_ITEMAMT' => $sms_price,
				'L_PAYMENTREQUEST_0_NAME0' => $sms_name,
				'L_PAYMENTREQUEST_0_AMT0' => $sms_price,
				'PAYMENTREQUEST_0_CURRENCYCODE' => 'GBP',
				'PAYMENTREQUEST_0_DESC' => $sms_name,
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale',
				'NOSHIPPING' => '1'
			);

			// get the response from paypal
			$response = \helpers\Paypal::request('SetExpressCheckout', $params);
			if(is_array($response) && $response['ACK'] == 'Success') { //Request successful
				$token = $response['TOKEN'];
				// save stuff in purchase table
				$group_id	= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
				$save_details = array(
					'user_id' => \Auth::id(),
					'credits' => $sms_credit,
					'sms_ref' => $sms_name,
					'paypal_token' => $token,
					'price' => $sms_price,
					'status' => 0
				);
				/**
				 * purchase history
				 * */
				$sms_purchase_history = \SMSPurchaseHistory\SMSPurchaseHistoryEntity::get_instance()->createOrUpdate($save_details);
				if( $sms_purchase_history ){
					return \Redirect::to('https://www.paypal.com/webscr?cmd=_express-checkout&token=' . urlencode($token));
				}
			}else{
				return \Redirect::to('profile')->withErrors('Error processing your payment request, please contact support.');
			}
		}else{
			return \Redirect::to('profile')->withErrors('Error processing your payment request, please contact support.');
		}
	}

	public function getCreateSmsCredit(){
		$token = \Input::get("token");
		$payer = \Input::get("PayerID");
		$purchase_details = \SMSPurchaseHistory\SMSPurchaseHistoryEntity::get_instance()->getSmsPurchase($token)->get()->first();

		if ($purchase_details) {
			// params to send over to paypal
			$params = array(
				'TOKEN' => $token,
				'PAYERID' => $payer,
				'PAYMENTREQUEST_0_AMT' => $purchase_details->price,
				'PAYMENTREQUEST_0_CURRENCYCODE' => 'GBP',
				'PAYMENTREQUEST_0_PAYMENTACTION' => 'Sale'
			);
			$response = \helpers\Paypal::request('DoExpressCheckoutPayment', $params);
			if(is_array($response) && $response['ACK'] == 'Success') {
				// add the credits to the account
				$add_sms = \SMSCredit\SMSCreditEntity::get_instance()->addSMSCredits( $purchase_details->user_id, $purchase_details->credits );
				// set history to used status
				if( $add_sms ){
					\SMSPurchaseHistory\SMSPurchaseHistoryEntity::get_instance()->updateSMSPurchaseStatus($purchase_details->id, 1);
				}
				\Session::flash('message', 'Successfully Delete Phone Customer');
				return \Redirect::to('profile');
			}else{
				return \Redirect::to('profile')->withErrors('Error processing your payment request, please contact support.');
			}
		}else{
			return \Redirect::to('profile')->withErrors('Error processing your payment request, please contact support.');
		}
	}

}
