<?php

class RegisterController extends \BaseController {
	protected static $instance = null;
	protected $data_view;
	protected $userEntity;
	protected $userGroupEntity;
	protected $userToGroupEntity;
	protected $SubscriptionEntity;

	public function __construct(){
		parent::__construct();
		$this->data_view = parent::setupThemes();
		$this->userEntity 			= new \User\UserEntity;
		$this->userGroupEntity 		= new \UserGroup\UserGroupEntity;
		$this->userToGroupEntity 	= new \UserToGroup\UserToGroupEntity;
		$this->SubscriptionEntity 	= new \Subscription\SubscriptionEntity;
	}

	/**
	 * Return an instance of this class.
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
		return \View::make( $data['view_path'] . '.index.register', $data );
	}

	public function postStore(){
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
			'username' => 'required|min:3',
			'password' => 'min:3|confirmed',
			'sms' => 'required|min:3',
		);
		$messages = array(
			'password.min' => 'Password must have more than 3 character',
			'password.confirmed' => 'Confirm Password',
			'username.min' => 'Username must have more than 3 character',
			'username.required' => 'Username is required',
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
			$user = $this->userEntity->createOrUpdate();
			$userGroup = $this->userGroupEntity->createGroup($user->id);
			$userToGroup = $this->userToGroupEntity->createUserToGroup($user->id, $userGroup->id);
			$subscription = $this->SubscriptionEntity->createSubscription($user->id);

			//\Session::flash('message', 'Success! Please check your email for verification.');
			//return \Redirect::to('register');
		}else{
			\Input::flash();
			return \Redirect::to('register')
			->withErrors($validator)
			->withInput();
		}
	}

}
