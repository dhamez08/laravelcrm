<?php

namespace Clients;
/**
 * Clients Controller
 *
 * */

class ClientsController extends \BaseController {

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
		$this->data_view = parent::setupThemes();
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
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

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex(){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client';
		$data['contentClass'] 	= '';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']		= 'user';
		$data 					= array_merge($data,$this->getSetupThemes());

		$data['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
		$data['center_column_view'] = 'dashboard';

		return \View::make( $data['view_path'] . '.clients.index', $data );
	}

	public function getCreate(){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client';
		$data['contentClass'] 	= 'create';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Add Client';
		$data['fa_icons']		= 'user';
		$data 					= array_merge($data,$this->getSetupThemes());
		$data['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
		$data['center_column_view'] = 'dashboard';

		return \View::make( $data['view_path'] . '.clients.create', $data );
	}

	public function getFiles()
	{
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Client - Files';
		$data['contentClass'] 	= '';
		$data 					= array_merge($data,$this->getSetupThemes());

		$data['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
		$data['center_column_view'] = 'files';

		return \View::make( $data['view_path'] . '.clients.index', $data );
	}

}
