<?php

namespace Messages;

class MessagesController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $destination_path = null;

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
		$this->data_view = parent::setupThemes();		
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->destination_path = "/public/document/library/own/";
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

	private function _messageCommon() {
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		

		return $data;
	}

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex(){
		$data 							= $this->data_view;
		$data['pageTitle'] 				= 'Messages';
		$dataMessages 					= $this->_messageCommon();
		$data['portlet_title']			= 'Messages';
		$data 							= array_merge($data,$this->getSetupThemes(), $dataMessages);

		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getInbox(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Inbox';
		$data['messages'] 	= \Message\MessageEntity::get_instance()->listAllMessages();
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(),$dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getSent(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Sent';
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$data['messages'] = \Message\MessageEntity::get_instance()->listAllSentMessages();
		$data 	= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getDraft(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Draft';
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$data['messages'] = \Message\MessageEntity::get_instance()->listAllDraftMessages();
		$data 	= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getTrash(){
		$data = $this->data_view;
		$data['center_view'] = 'inbox';
		$data['message_title'] = 'Trash';
		$data['UnreadMessagesCount'] 	= \Message\MessageEntity::get_instance()->getUnreadMessagesCount();
		$data['messages'] = \Message\MessageEntity::get_instance()->listAllTrashMessages();
		$data 	= array_merge($data,$this->getSetupThemes());
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getCompose(){
		$data = $this->data_view;
		$data['center_view'] = 'compose';
		$data['message_title'] = 'Compose';
		$dataMessages 	= $this->_messageCommon();
		$data 	= array_merge($data,$this->getSetupThemes(),$dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getView(){
		$data = $this->data_view;
		$data['message'] = \Message\MessageEntity::get_instance()->getMessageDetails(\Input::get('message_id'))[0];
		$data['center_view'] = 'inbox_view';
		$data['message_title'] = 'View Message';
		$dataMessages 					= $this->_messageCommon();
		$data 							= array_merge($data,$this->getSetupThemes(), $dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}

	public function getReply(){
		$data = $this->data_view;
		$data['message'] = \Message\MessageEntity::get_instance()->getMessageDetails(\Input::get('message_id'))[0];
		$data['center_view'] = 'reply';
		$data['message_title'] = 'Reply';
		$dataMessages 					= $this->_messageCommon();
		$data 							= array_merge($data,$this->getSetupThemes(), $dataMessages);
		return \View::make( $data['view_path'] . '.messages.index', $data );
	}
}
