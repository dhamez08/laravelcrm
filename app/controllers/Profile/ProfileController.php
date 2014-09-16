<?php
namespace Profile;
/**
 * This is for the Profile controller
 * @author APYC
 * */

class ProfileController extends \BaseController {

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
		/**
		 * use for the class name
		 * @var string $contentClass
		 * @see views/themes/admin/metronic/dashboard/index.blade.php
		 * line 48
		 * */
		$this->data_view['contentClass'] 	= 'profile';
		/**
		 * use for the page title
		 * @var $pageTitle string
		 * @see views/themes/admin/metronic/dashboard/index.blade.php
		 * line 42
		 * */
		$this->data_view['pageTitle'] 		= 'Profile';
		/**
		 * use for the page sub title
		 * @var $pageSubTitle string
		 * @see views/themes/admin/metronic/dashboard/index.blade.php
		 * line 42
		 * */
		$this->data_view['pageSubTitle'] 	= \Auth::user()->title.' '.\Auth::user()->first_name.' '.\Auth::user()->last_name;
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
	 * Index of settings
	 * @return View
	 * */
	public function getIndex(){
		$data 			= $this->data_view;
		$data['user']	= \User\User::find( \Auth::user()->id );
		$data 			= array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		//var_dump($data);exit();
		return \View::make( $data['view_path'] . '.profile.index', $data );
	}

	/**
	 * Update current user account
	 *
	 * @param	$userId		int		the current user id
	 * @return \Redirect
	 * */
	public function putAccount($userId){
		$rules = array(
			'title' => 'required',
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'telephone' => 'required|min:3',
			'email' => 'required|email',
			'company' => 'required|min:3',
			'address_line' => 'required|min:3',
			'address_town' => 'required|min:3',
			'address_postcode' => 'required|min:3',
			'sms' => 'required|min:3',
		);
		$messages = array(
			'email.required' => 'Email field is required.',
			'email.email' => 'Email field is invalid.',
			'firstname.required'=>'First Name is required',
			'title.required'=>'Title is required',
			'first_name.required'=>'First Name is required',
			'first_name.min'=>'First Name must have more than 3 character',
			'last_name.required'=>'Last Name is required',
			'last_name.min'=>'Last Name must have more than 3 character',
			'address_line.required'=>'Address is required',
			'address_line.min'=>'Address must have more than 3 character',
			'address_town.required'=>'Town is required',
			'address_town.min'=>'Town must have more than 3 character',
			'address_postcode.required'=>'Postcode is required',
			'address_postcode.min'=>'Postcode must have more than 3 character',
			'sms.required'=>'SMS Display Name is required',
			'sms.min'=>'SMS Display Name must have more than 3 character',
			'telephone.required'=>'Phone is required',
			'telephone.min'=>'Phone must have more than 3 character',
		);
		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			\User\UserEntity::get_instance()->updateAccount($userId);
			\Session::flash('message', 'Successfully updated account');
			return \Redirect::to('profile');
		}else{
			\Input::flash();
			return \Redirect::to('profile')
			->withErrors($validator)
			->withInput();
		}
	}

	/**
	 * Update account logo
	 * @return		\Redirect
	 * */
	public function putAccountLogo(){

	}

}
