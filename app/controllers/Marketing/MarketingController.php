<?php
namespace Marketing;
/**
 * Marketing Controller
 *
 * */

class MarketingController extends \BaseController {

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
		$this->data_view['marketing_index']		= $this->data_view['view_path'] . '.page';
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

	/**
	 * get themes
	 * @return	array
	 * */
	public function getSetupThemes(){
		return \Dashboard\DashboardController::get_instance()->getSetupThemes();
	}

	public function getIndex(){
		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Send SMS';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['tag_id']				= \Input::has('tags') ? (\Input::get('tags') != 0 ) ? \Input::get('tags'):null:null;
		$data['list_customer']		= \Marketing\MarketingEntity::get_instance()->getCustomerList($data['tag_id']);
		$data['tags']			 	= \ClientTag\ClientTagEntity::get_instance()->getTagsByLoggedUser();
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.index', $data );
	}

	public function postSendSmsMessage(){
		\Session::forget('session_sendsms');
		\Session::forget('sms_session');
		if( count(\Input::get('sendsms')) > 0 ){
			\Session::put('session_sendsms',\Input::get('sendsms'));
			if( \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id()) ){
				return \Redirect::to('marketing/message-sms');
			}else{
				return \Redirect::to('marketing')->withErrors('Sorry you do not have enough credits.');
			}
		}else{
			return \Redirect::to('marketing')->withErrors('Choose customer first');
		}
	}

	public function getMessageSms(){
		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Person\'s Name and Mobile Number';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['list_number']		= \Session::get('session_sendsms');
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.message', $data );
	}

	public function postSendSmsVerify(){
		if (trim(\Input::get('message')) == '') {
			$this->session->set_flashdata('error', '<div class="alert alert-danger">You must enter a message.</div>');
			return \Redirect::to('marketing/message-sms')->withErrors('You must enter a message');
		}else{
			$message = trim(\Input::get('message'));
			$personalized = \Input::has('personalised');
			$message_characters = strlen($message);
			$sms_count = 0;
			// loop every message to total the credits needed
			$numbers = \Session::get('session_sendsms');
			foreach ($numbers as $key => $val) {
				$characters = 0;
				// get the number and the name
				if ($personalized) {
					$characters += strlen('Hi '. $message .'. ');
				}
				$characters += $message_characters;
				$sms_count += ceil($characters/160);
			}
			$cred = \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());

			if( $cred->credits >= $sms_count ){
				$sms_session = array(
					'message' => $message,
					'personalised' => $personalized,
					'required_credits' => $sms_count,
					'current_credits' => $cred->credits
				);
				\Session::forget('sms_session');
				\Session::put('sms_session',$sms_session);
				return \Redirect::to('marketing/summary');
			}else{
				\Session::forget('session_sendsms');
				\Session::forget('sms_session');
				return \Redirect::to('marketing')->withErrors('Sorry you do not have enough credits.');
			}

		}
	}

	public function getSummary(){
		$data = $this->data_view;
		$data['pageTitle'] 			= 'SMS Marketing';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Message Summary';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['index_num']			= 1;
		$data['list_number']		= \Session::get('session_sendsms');
		$data['sms_session']		= \Session::get('sms_session');
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.summary', $data );
	}

	public function postSendSms(){
		$list_number = \Session::get('session_sendsms');
		$sms_session = \Session::get('sms_session');

		$success = false;
		$number_not_success = array();

		if (count($list_number) > 0) {
			$messagetosend = "";
			foreach ($list_number as $key => $val) {
				//personalize the message
				if ($sms_session['personalised']) {
					$messagetosend = 'Hi '. $val['name'] .'. '. $sms_session['message'];
				} else {
					$messagetosend = $sms_session['message'];
				}
				//send sms thru textlocal gateway
				$txt_local = \Marketing\MarketingEntity::get_instance()->sendSMS(
					$val['number'],
					$messagetosend,
					\Auth::id(),
					true
				);

				if( !$txt_local->status == 'success' ){
					//input number
					/*
					 * this will be the list of unsuccessful sent number
					 * in time we can display this
					 * */
					$number_not_success[] = $val['number'];
				}else{
					//insert in the message table
					$message_data = array(
						'customer_id' => $key,
						'sender' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'body' => $messagetosend,
						'to' => $val['number'],
						'subject' => 'Text message sent to client - ' . $val['name'],
						'direction' => 1,
						'method' => 2,
						'ref' => 'SMS_' . time()
					);
					\Message\MessageEntity::get_instance()->createOrUpdate($message_data);
				}
			}
			//if( count($number_not_success) > 0 ){
				\Session::forget('session_sendsms');
				\Session::forget('sms_session');
				//return \Redirect::to('marketing')->withErrors('Sorry something wrong.');
			//}else{
				\Session::flash('message', 'Successfully SMS Send Message');
				return \Redirect::to('marketing');
			//}
		}
	}

}
