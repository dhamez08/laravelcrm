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
		$this->data_view['include'] 		= $this->data_view['view_path'] . '.sms';
		$this->noteFolder 	 				= public_path() . '/documents';
		//'pdf|doc|docx|gif|jpg|png'
		$this->prefixNoteFileName = \Auth::id();
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
		var_dump($id);
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

	public function getAjaxIndividualSendSms($customerId, $mobile_number){
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$data['customerFiles']		= \CustomerFiles\CustomerFiles::customerFile($customerId);
		$data['customerId'] 		= $customerId;
		$data['mobile_number'] 		= $mobile_number;
		$data['pageTitle'] 			= 'Send SMS';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= '';
		$data['portlet_title']		= 'SMS';
		$data['fa_icons']			= 'cog';
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['include'] . '.partials.modal-create', $data )->render();
	}

	public function postAjaxUploadFile(){
		if( \Input::hasFile('smsfile') ){
			if( \Input::file('smsfile')->getSize() > 0 ){
				$file_name 			= \Auth::id() .'_'.str_replace(' ','_',strtolower(\Input::file('smsfile')->getClientOriginalName()));
				$orignal_file_name 	= str_replace(' ','_',strtolower(\Input::file('smsfile')->getClientOriginalName()));
				$upload_success 	= \Input::file('smsfile')->move(public_path() . '/documents', $file_name);
				if($upload_success ){
					$data = array(
						'customer_id' => \Input::get('customerid'),
						'user_id' => \Auth::id(),
						'filename' => $file_name,
						'name' => \Input::file('smsfile')->getClientOriginalName(),
						'type' => 4
					);
					\CustomerFiles\CustomerFilesEntity::get_instance()->createOrUpdate($data);
					return \Response::json(
						array(
							'result'=>true,
							'message'=>'Files has been uploaded successfully, select file to attach'
						)
					);
				}else{
					$msg = '<li class="list-group-item list-group-item-danger">Fail to add file.</li>';
					return \Response::json(array('result'=>false,'message'=>$msg));
				}
			}else{
				$msg = '<li class="list-group-item list-group-item-danger">Fail to add file.</li>';
				return \Response::json(array('result'=>false,'message'=>$msg));
			}
		}else{
			$msg = '<li class="list-group-item list-group-item-danger">Fail to add file.</li>';
			return \Response::json(array('result'=>false,'message'=>$msg));
		}
		die();
	}

	public function getAjaxFiles($customer_id){
		$data 					= $this->data_view;
		$data['customerFiles']	= \CustomerFiles\CustomerFiles::customerFile($customer_id)->orderBy('created_at','desc');
		$data 					= array_merge($data,$this->getSetupThemes());
		return \View::make($data['view_path'] . '.sms.partials.ajax-list-files', $data)->render();
	}

	public function postAjaxSendIndividualSms($client_id){
		$rules = array(
			'note' => 'required',
			'notefile' => 'mimes:pdf,doc,docx,gif,jpg,png,jpeg',
		);
		$messages = array(
			'note.required'=>'Message is required',
			'notefile.mimes'=>'File format is invalid',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if($validator->passes()){
			$sms_count = 0;
			$cred = \SMSCredit\SMSCreditEntity::get_instance()->getSMSCredit(\Auth::id());

			//var_dump( \Input::all() );
			$sms_client_file = '';
			// grab the client files
			if( \Input::get('attach_file') != 0 ){
				$client_file = \CustomerFiles\CustomerFiles::find(\Input::get('attach_file'));
				//$sms_client_file = "\n\n ". "<a href=".url('/public/documents/' . $client_file->filename).">".$client_file->filename."</a>";
				$sms_client_file = url('/public/documents/' . $client_file->filename);

				// shorten the url
				$tinyurl = \helpers\TinyURL::tinyurl(url('/public/documents/' . $client_file->filename));
				if( $tinyurl && $tinyurl->state == 'ok' ){
					$sms_client_file = $tinyurl->shorturl;
				}
			}

			// re-structure the message body
			// include the attachment link
			$sms_msg = trim( \Input::get('note') );
			$sms_msg .= "\n";
			$sms_msg .= "Attach file \n";
			//$sms_msg .= "<a href=".$fileName.">".$orignal_file_name."</a>";
			//$sms_msg .= $fileName;
			$sms_msg .= "\n".$sms_client_file;

			$message_characters = strlen($sms_msg);

			$characters = $message_characters;
			$sms_count  = ceil($characters/160);

			if( $cred >= $sms_count ){
				if( \SMSCredit\SMSCreditEntity::get_instance()->spendCredit(\Auth::id(), $sms_count) ){
					$sms = \Textlocal\TextlocalEntity::get_instance()->apiTextlocal();
					$numbers = array(\Input::get('mobile_number'));
					$message = $sms_msg;
					$sender = \Auth::user()->sms;
					$response = $sms->sendSMS($numbers, $message, $sender, null);
					//return $response;
					$client = \Clients\Clients::find(\Input::get('customerid')	);
					// insert into msg database
					$msg = array(
						'customer_id' => \Input::get('customerid'),
						'sender'=>\Auth::user()->title . ' ' . \Auth::user()->first_name . ' ' .\Auth::user()->last_name,
						'to' => \Input::get('mobile_number'),
						'subject' => 'Text message sent to client - ' . $client->title.' '.$client->first_name.' '.$client->last_name,
						'body' => $sms_msg,
						'direction' => 1,
						'method' => 2,
						'ref' => $response->messages[0]->id,
						'read_status' => 0
					);
					\Message\MessageEntity::get_instance()->createOrUpdate($msg);

					\Session::flash('message', 'Successfully Send SMS');
					return \Response::json(array('result'=>true,'redirect'=>\Input::get('redirect')));
				}else{
					$msg = '<li class="list-group-item list-group-item-danger">Sorry you do not have enough credits.</li>';
					return \Response::json(array('result'=>false,'message'=>$msg));
				}

			}else{
				$msg = '<li class="list-group-item list-group-item-danger">Sorry you do not have enough credits.</li>';
				return \Response::json(array('result'=>false,'message'=>$msg));
			}
		}else{
			$msg = $validator->messages()->all('<li class="list-group-item list-group-item-danger">:message</li>');
			return \Response::json(array('result'=>false,'message'=>$msg));
		}
		die();
	}

}
