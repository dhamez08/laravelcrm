<?php
namespace Settings;
/**
 * This is for the settings controller
 * @author APYC
 * */

class ScreensController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;
	protected $userEntity;

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
		$this->userEntity = new \User\UserEntity;
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
	public function getIndex() {
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Screen Settings';
		$data['pageSubTitle'] 	= '';
		$data['contentClass'] 	= 'settings';
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data);exit();
		return \View::make( $data['view_path'] . '.settings.settings', $data );
	}

	public function getChangeTheme($color) {
		// if they have selected a valid theme update it
		if ( ($color=="naturalgreen") || ($color=="blue") || ($color=="bluedusk") || ($color=="purple") || ($color=="pink") || ($color=="red") || ($color=="icesteel") || ($color=="olive") || ($color=="salmon") ) {

			$icons = 0;

			// update the user record for next time
			$user = $this->userEntity->find(\Auth::id());
			
			if($user->updateTheme($color, $icons)) {
				\Session::put('theme',$color);
				\Session::flash('message', 'You have successfully changed the theme');
				return \Redirect::to('settings/screen');
			} else {
				return \Redirect::to('settings/screen')->withErrors(['There was a problem updating your theme, please try again']);
			}

			
		} else {
			return \Redirect::to('settings/screen')->withErrors(['There was a problem updating your theme, please try again']);
		}

		// redirect after
		redirect('settings/screen');
	}

}
