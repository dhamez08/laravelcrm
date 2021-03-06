<?php
namespace User;
/**
 * A wrapper for the User Model
 * */

use \Illuminate\Auth\UserTrait;
use \Illuminate\Auth\UserInterface;
use \Illuminate\Auth\Reminders\RemindableTrait;
use \Illuminate\Auth\Reminders\RemindableInterface;

class UserEntity extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	protected $user_model;

	protected static $instance = null;

	public function __construct(){
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

	/**
	 * This is use to create user or update
	 * this is full field, mainly use in register
	 *
	 * @param 	$id		int		default null		if there is id then update, else create
	 * @param	$active	int		default 2			#2 means not active
	 * 												#1 would be active
	 * @return db last insert id
	 * */
	public function createOrUpdate($id = null, $active = 2){
		if( is_null($id) ) {
			//create
			$user 					= new \User\User;
			$user->username			= \Input::get('username','');
			$user->title 			= \Input::get('title','');
			$user->first_name 		= \Input::get('first_name','');
			$user->last_name 		= \Input::get('last_name','');
			$user->company 			= \Input::get('company','');
			$user->email 			= \Input::get('email','');
			$user->sms 				= \Input::get('sms','');
			$user->telephone 		= \Input::get('telephone','');
            $user->timezone 		= \Input::get('timezone','');
			$user->address_line 	= \Input::get('address_line','');
			$user->address_town 	= \Input::get('address_town','');
			$user->address_county 	= \Input::get('address_county','');
			$user->address_postcode = \Input::get('address_postcode','');
			$user->confirm_code 	= \Input::get('confirm_code','');
			$user->active 			= $active;

			$user->website			= \Input::get('website', '');
			$user->birthdate		= \Input::get('birthdate', '') == '' ? '' : \Carbon\Carbon::createFromFormat('d/m/Y', \Input::get('birthdate'))->toDateString();
			$user->occupation		= \Input::get('occupation', '');

		}else{
			//update
			$user 					= \User\User::find($id);
			$user->username			= \Input::get('username','');
			$user->title 			= \Input::get('title','');
			$user->first_name 		= \Input::get('first_name','');
			$user->last_name 		= \Input::get('last_name','');
			$user->company 			= \Input::get('company','');
			$user->email 			= \Input::get('email','');
			$user->sms 				= \Input::get('sms','');
			$user->telephone 		= \Input::get('telephone','');
            $user->timezone 		= \Input::get('timezone','');
			$user->address_line 	= \Input::get('address_line','');
			$user->address_town 	= \Input::get('address_town','');
			$user->address_county 	= \Input::get('address_county','');
			$user->address_postcode = \Input::get('address_postcode','');
			$user->active 			= \Input::get('active',$active);

			$user->website			= \Input::get('website', '');
			$user->birthdate		= \Input::get('birthdate', '') == '' ? '' : \Carbon\Carbon::createFromFormat('d/m/Y', \Input::get('birthdate'))->toDateString();
			$user->occupation		= \Input::get('occupation', '');			
		}
		$user->save();
		return $user;
	}

	/**
	 * Use to activate user
	 * @param	$confirm_coed	int		use to confirm code
	 * @return object
	 * */
	public function activateUser($confirm_code){
		$confirm = \User\User::confirmCode($confirm_code);
		if( $confirm->count() > 0 ){
			$user_id 		= $confirm->pluck('id');
			$user 			= \User\User::find($user_id);
			$user->active 	= 1;
			$user->save();
			return $user;
		}
	}

	/**
	 * update user account
	 * limited fields only
	 * personal fields particularly
	 *
	 * @param	$userId		int		pass user id
	 * @return object
	 * */
	public function updateAccount($userId){
		$user 					= \User\User::find($userId);
		$user->title 			= \Input::get('title');
		$user->first_name 		= \Input::get('first_name');
		$user->last_name 		= \Input::get('last_name');
		$user->company 			= \Input::get('company');
		$user->email 			= \Input::get('email');
		$user->sms 				= \Input::get('sms');
		$user->telephone 		= \Input::get('telephone');
        $user->timezone 		= \Input::get('timezone');
		$user->address_line 	= \Input::get('address_line');
		$user->address_town 	= \Input::get('address_town');
		$user->address_county 	= \Input::get('address_county');
		$user->address_postcode = \Input::get('address_postcode');

		$user->website			= \Input::get('website');
		$user->birthdate		= \Input::get('birthdate') == '' ? '' : \Carbon\Carbon::createFromFormat('d/m/Y', \Input::get('birthdate'))->toDateString();
		$user->occupation 		= \Input::get('occupation');


		$user->save();

		return $user;
	}

	/**
	 * update user password
	 *
	 * @param	$userId		int		pass user id
	 * @return object
	 * */
	public function updatePassword($userId, $password){
		$user 			= \User\User::find($userId);
		$user->password	= \Hash::make( $password );
		$user->save();

		return $user;
	}

	/**
	 * update user theme
	 *
	 * @param	$color	string
	 * @return boolean
	 * */
	public function updateTheme($color, $icon){

		$this->theme_site = $color;
		$this->theme_icons = $icon;

		return $this->save() ? 1:0;
	}

	public function getUserToGroup(){
		$account =  \User\User::find( \Auth::id() )->userToGroup();
		return $account;
	}

	public function getSubscribeUsersList($groupId, $role = 2){
		$users = \UserToGroup\UserToGroup::with('user')
		->groupID($groupId)
		->role($role)
		->orderBy('created_at','desc');
		return $users;
	}

	public function tabs() {
		return $this->hasOne('\UserTab\UserTabEntity','user_id');
	}

	public function updateCustomFiles($data) {
		$this->files_1 = $data['files_1'];
		$this->files_2 = $data['files_2'];
		$this->files_3 = $data['files_3'];
		$this->files_4 = $data['files_4'];
		$this->files_5 = $data['files_5'];
		$this->files_6 = $data['files_6'];

		return $this->save() ? 1:0;
	}

	public function getClientFiles() {
		return $this->select('files_1','files_2','files_3','files_4','files_5','files_6')->first();
	}

	public function getGoogleCalendarFeedURL(){
		$get_meta = \UserMeta\UserMetaEntity::get_instance()->getUserMeta(\Auth::id(),'google_calendar_feed', true);
		return $get_meta;
	}


}
