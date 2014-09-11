<?php

class BaseController extends Controller {

	protected $admin_theme_folder;
	protected $admin_theme_name;
	protected $admin_theme_path;
	protected $theme_setup;

	public function __construct(){
		$this->beforeFilter('csrf', array('on' => array('post', 'put', 'patch', 'delete')));
		$this->admin_theme_folder 	= \Config::get('crm.themes.admin.folder');
		$this->admin_theme_path 	= \Config::get('crm.themes.admin.path');
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	public function setupThemes(){
		return $this->theme_setup = array(
			'asset_path' 	=> $this->getAdminAssets(),
			'view_path' 	=> $this->getAdminView(),
			'master_view' 	=> $this->getAdminView() . '.layout'
		);
	}

	public function getAdminAssets(){
		return \URL::asset('public/admin/'. $this->admin_theme_folder .'/assets');
	}

	public function getAdminView(){
		return $this->admin_theme_path;
	}

}
