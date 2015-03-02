<?php
namespace User;
/**
 * This is for the settings / user controller
 * @author APYC
 * */

class UserController extends \BaseController {

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
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Settings';
		$data['pageSubTitle'] 	= 'List of User';
		$data['contentClass'] 	= 'settings';

		$groupId 		= \UserGroup\UserGroup::managerID(\Auth::id());
		$data['groupId'] = $groupId->first()->id;
		$data['users']	= \User\UserEntity::get_instance()->getSubscribeUsersList($groupId->first()->id);

		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.users.users', $data );
	}

	public function getAddAditionalUser(){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Settings';
		$data['pageSubTitle'] 	= 'Add aditional User';
		$data['contentClass'] 	= 'settings';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Add User';
		$data['fa_icons']		= 'user';
		$data['permission']		= \UserPermission\UsersPermissionEntity::get_instance()->getPermission();
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.users.addUser', $data );
	}

	public function postAdditionalUser(){
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'email' => 'required|email|unique:users',
			'username' => 'required|min:3|unique:users',
			'password' => 'required|min:3',
		);
		$messages = array(
			'password.min' => 'Password must have more than 3 character',
			'username.min' => 'Username must have more than 3 character',
			'username.required' => 'Username is required',
			'username.unique' => 'Username is already taken',
			'email.required' => 'Email field is required.',
			'email.email' => 'Email field is invalid.',
			'email.unique' => 'Email is already taken.',
			'firstname.required'=>'First Name is required',
			'first_name.required'=>'First Name is required',
			'first_name.min'=>'First Name must have more than 3 character',
			'last_name.required'=>'Last Name is required',
			'last_name.min'=>'Last Name must have more than 3 character',
		);
		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			$user 			= \User\UserEntity::get_instance()->createOrUpdate(null,1);
			\User\UserEntity::get_instance()->updatePassword($user->id,\Input::get('password'));

			$groupId 		= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
			\UserToGroup\UserToGroupEntity::get_instance()->createUserToGroup($user->id, $groupId, 2);
			\UserPermission\UsersPermissionEntity::get_instance()->addOrUpdatePermission(
				$user->id,
				serialize( \Input::get('permission') )
			);

			// Log Activity
			\Activity\ActivityEntity::get_instance()->logActivity('New User', $user->id);

			\Session::flash('message', 'Successfully Added User');
			return \Redirect::to('settings/users');
		}else{
			\Input::flash();
			return \Redirect::to('settings/users/add-aditional-user')
			->withErrors($validator)
			->withInput();
		}
	}

	public function getAddtionalUserEdit($userId){
		$data 					= $this->data_view;
		$data['pageTitle'] 		= 'Settings';
		$data['pageSubTitle'] 	= 'List of User';
		$data['contentClass'] 	= 'settings';
		$data['user']			= \User\User::find($userId);
		$data['userPermission']	= \UserPermission\UsersPermissionEntity::get_instance()->getPermissionByUser($userId);
		$data['permission']		= \UserPermission\UsersPermissionEntity::get_instance()->getPermission();
		$data = array_merge($data,\Dashboard\DashboardController::get_instance()->getSetupThemes());
		return \View::make( $data['view_path'] . '.settings.users.editUser', $data );
	}

	public function putAdditionalUserUpdate($userId){
		$rules = array(
			'first_name' => 'required|min:3',
			'last_name' => 'required|min:3',
			'email' => 'required|email|unique:users,email,' . $userId,
			'username' => 'required|min:3|unique:users,username,' . $userId,
		);
		$messages = array(
			'username.min' => 'Username must have more than 3 character',
			'username.required' => 'Username is required',
			'username.unique' => 'Username is already taken',
			'email.required' => 'Email field is required.',
			'email.email' => 'Email field is invalid.',
			'email.unique' => 'Email is already taken.',
			'firstname.required'=>'First Name is required',
			'first_name.required'=>'First Name is required',
			'first_name.min'=>'First Name must have more than 3 character',
			'last_name.required'=>'Last Name is required',
			'last_name.min'=>'Last Name must have more than 3 character',
		);
		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			if( trim(\Input::get('password')) != ''  ){
				\User\UserEntity::get_instance()->updatePassword($userId,\Input::get('password'));
			}else{
				\Input::except('password');
			}
			$user = \User\UserEntity::get_instance()->createOrUpdate($userId,1);
			$userPermission = \UserPermission\UsersPermission::userID($userId)->first();
			\UserPermission\UsersPermissionEntity::get_instance()->addOrUpdatePermission(
				$userId,
				serialize( \Input::get('permission') ),
				$userPermission->id
			);

			// Log Activity
			\Activity\ActivityEntity::get_instance()->logActivity('Update User', $userId);

			\Session::flash('message', 'Successfully Updated User');
			return \Redirect::to('settings/users/addtional-user-edit/' . $userId);
		}else{
			\Input::flash();
			return \Redirect::to('settings/users/addtional-user-edit/' . $userId)
			->withErrors($validator)
			->withInput();
		}
	}

	public function getRemoveAdditionalUser($group_id, $user_id)
	{
		$user = \User\User::find($user_id);
		$user->delete();

		$userToGroup = \UserToGroup\UserToGroup::groupId($group_id)->userId($user_id)->limit(1);
		$userToGroup->delete();

		if($user) {

			// Log Activity
			//\Activity\ActivityEntity::get_instance()->logActivity('Remove User', $user_id);

			\Session::flash('message', 'Successfully deleted user.');
		}

		return \Redirect::to('settings/users');

	}
}
