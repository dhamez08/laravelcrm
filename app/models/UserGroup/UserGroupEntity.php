<?php
namespace UserGroup;
/**
 * Base class for user group entity
 * */
class UserGroupEntity extends \Eloquent{

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
	 * Create User Group
	 *
	 * @param	$user_id	int		the user id to where manager it belong
	 * @return	object
	 * */
	public function createGroup($user_id){
		$userGroup = new \UserGroup\UserGroup;
		$userGroup->manager_id = $user_id;
		$userGroup->save();
		return $userGroup;
	}
}
