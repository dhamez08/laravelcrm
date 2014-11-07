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
		$data['pageTitle'] 			= 'SMS Report';
		$data['contentClass'] 		= 'no-gutter';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Message Report';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['center_column_view'] = 'dashboard';
		$data['tag_id']				= \Input::has('tags') ? (\Input::get('tags') != 0 ) ? \Input::get('tags'):null:null;
		$data['list_customer']		= \Marketing\MarketingEntity::get_instance()->getCustomerList($data['tag_id']);
		$data['tags']			 	= \ClientTag\ClientTagEntity::get_instance()->getTagsByLoggedUser();
		$data['sms_sent']			= \SMSSent\SMSSent::userId( \Auth::id() );
		$get_credit					= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		if( $get_credit ){
			$data['sms_credit']		= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		}else{
			$data['sms_credit'] = 0;
		}
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.index', $data );
	}

	public function getSendClientSms(){
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
		$get_credit					= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		if( $get_credit ){
			$data['sms_credit']		= \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
		}else{
			$data['sms_credit'] = 0;
		}
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.send_sms', $data );
	}

	public function postSendSmsMessage(){
		\Session::forget('session_sendsms');
		\Session::forget('sms_session');
		if( count(\Input::get('sendsms')) > 0 ){
			if( \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id()) ){
				$send_sms = array();
				foreach(\Input::get('sendsms') as $key=>$val){
					if( isset($val['clientid'])){
						$send_sms[$key] = array(
							'clientid' => $val['clientid'],
							'number' => $val['number'],
							'name' => $val['name']
						);
					}
				}
				\Session::put('session_sendsms',$send_sms);
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
		$data['sms_files']			= \SMSFIles\SMSFIles::userId(\Auth::id())->orderBy('created_at','desc');
		$data['list_number']		= \Session::get('session_sendsms');
		$data 						= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.marketing.message', $data );
	}

	public function postSendSmsVerify(){
		if (trim(\Input::get('message')) == '') {
			return \Redirect::to('marketing/message-sms')->withErrors('You must enter a message');
		}else{
			// files attach
			$files = \SMSFIles\SMSFIlesEntity::get_instance()->getFileAndConvertToURL( \Input::get('attach_file') );
			$str_files = '';
			if( $files && count($files) > 0 ){
				$str_files = '';
				foreach($files as $file){
					$str_files .= $file.'<br>';
				}
				$str_files = 'Attach file : ' . $str_files;
			}
			// files attach

			$message 			= trim(\Input::get('message'));
			$message 			.= ' ' . trim($str_files);
			$personalized 		= \Input::has('personalised');
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
				$sms_count  += ceil($characters/160);
			}
			$cred = \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());
			if( $cred >= $sms_count ){
				$sms_session = array(
					'message' => $message,
					'personalised' => $personalized,
					'required_credits' => $sms_count,
					'current_credits' => $cred
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
				$client_id = $key;
				if ($sms_session['personalised']) {
					$messagetosend = 'Hi '. $val['name'] .'. '. $sms_session['message'];
				} else {
					$messagetosend = $sms_session['message'];
				}
				//send sms thru textlocal gateway
				$txt_local = \Marketing\MarketingEntity::get_instance()->sendSMS(
					$val['number'],
					$messagetosend,
					\Auth::id()
				);
				//var_dump($txt_local);
				if( $txt_local->status != 'success' ){
					//input number
					/*
					 * this will be the list of unsuccessful sent number
					 * in time we can display this
					 * */
					$number_not_success[] = $val['number'];
				}else{
					//insert in the message table
					$message_data = array(
						'customer_id' => $val['clientid'],
						'sender' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'body' => $messagetosend,
						'to' => $val['number'],
						'subject' => 'Text message sent to client - ' . $val['name'],
						'direction' => 1,
						'method' => 2,
						'ref' => 'SMS_' . time()
					);
					$msg = \Message\MessageEntity::get_instance()->createOrUpdate($message_data);

					// create data in sending sms
					$sms_sent = array(
						'textlocal_msg_id'=>$txt_local->messages[0]->id,
						'textlocal_msg_recipient'=>$txt_local->messages[0]->recipient,
						'user_id'=>\Auth::id(),
						'customer_id'=>$val['clientid'],
						'message'=>$messagetosend,
						'from' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'client_name'=>$val['name'],
					);
					$obj_sms_sent = \SMSSent\SMSSentEntity::get_instance()->createOrUpdate($sms_sent);

					// create data for report purpose
					// get the api message response
					$msg_status = \Textlocal\TextlocalEntity::get_instance()->getMsgStatusID($txt_local->messages[0]->id);
					/*$sms_report = array(
						'sms_sent_id' => $obj_sms_sent->id,
						'to' => $txt_local->messages[0]->recipient ,
						'from' => \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name,
						'client_name' => $val['name'],
						'message' => $messagetosend,
						'status' => $msg_status->message->status,
						'customer_id' => $val['clientid'],
						'user_id' => \Auth::id()
					);
					\SMSReport\SMSReportEntity::get_instance()->createOrUpdate($sms_report);*/
				}
			}
			\Session::forget('session_sendsms');
			\Session::forget('sms_session');
			\Session::flash('message', 'Successfully SMS Send Message');
			return \Redirect::to('marketing');
		}
	}

	public function getSmsReceipt(){
		/*if(
			\Input::has('number') ||
			\Input::has('status') ||
			\Input::has('customID') ||
			\Input::has('datetime')
		){*/
			/*$data = array(
				$_REQUEST['number'],
				$_REQUEST['status'],
				$_REQUEST['customID'],
				$_REQUEST['datetime']
			);
			\SMSDelivery\SMSDeliveryReceipts::get_instance()->createOrUpdate($data);*/
		//}
		\Log::info('textlocal handling receipt ' . \Input::all());
		\Log::info('textlocal handling receipt ' . print_r(\Input::all()));
	}

}
