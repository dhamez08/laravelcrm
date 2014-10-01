<?php

class AuthController extends BaseController {
	protected static $instance = null;
	protected $data_view;

	public function __construct(){
		parent::__construct();
		$this->data_view = parent::setupThemes();
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

	public function getSetupThemes(){
		$this->data_view['html_body_class'] = 'login';
		return $this->data_view;
	}

	public function getIndex()
	{
		$data = $this->getSetupThemes();
		return \View::make( $data['view_path'] . '.index.login', $data );
	}

	public function postAuth(){
		$credentials = array(
			'username' 	=> Input::get('username'),
			'password' 	=> Input::get('password'),
			'active' => 1
		);

		if ( Auth::attempt($credentials) ){
		  $user = \User\User::find(\Auth::id());
		  $group = $user->userToGroup()->first();
		  \Session::put('group_id', $group->group_id);
		  \Session::put('role', $group->role);
		  return Redirect::intended('/');
		}

		return Redirect::to('login')
				->withInput()
				->with('login_errors', true);
	}

	public function getLogout(){
		Auth::logout();
	    return Redirect::to('/');
	}

	public function getConfirmAuthCode($confirm_code){
		$activate = \User\UserEntity::get_instance()->activateUser($confirm_code);
		if( $activate ){
			\Session::flash('message', 'Success! You have activated your account, please log-in to start using the CRM.');
			return \Redirect::to('login');
		}
	}

}
