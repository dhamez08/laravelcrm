<?php
namespace Email;

class EmailController extends \BaseController {

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
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['settings_index'] 	= $this->data_view['view_path'] . '.settings.index';
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
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
		echo "...";
	}

	private function _getClientData($clientId) {
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customer']			= \Clients\Clients::find($clientId);
		$data['currentClient']		= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['telephone']			= $data['customer']->telephone();
		$data['email']				= $data['customer']->emails();
		$data['url']				= $data['customer']->url();
		$data['profileImg']			= $data['customer']->profileImage();
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();

		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getCustomerTasks($clientId)
		->status(1)->with('label');

		return $data;
	}

	public function getClient($clientId) {
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

		$data 						= $this->_getClientData($clientId);
		$data 						= array_merge($data,$dashboard_data);
		$data['client_email'] = "";
		if($data['customer']->emails()->count() > 0) {
			$data['client_email'] = $data['customer']->emails()->first()->email;
		}
		return \View::make( $data['view_path'] . '.client-emails.index', $data );
	}

	public function postClient($clientId) {
		dd(\Input::all());
	}

}
