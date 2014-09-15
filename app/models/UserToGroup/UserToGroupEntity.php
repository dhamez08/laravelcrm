<?php
namespace UserToGroup;
/**
 * base model entity class for user to group
 * */
class UserToGroupEntity extends \Eloquent{

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
	 * Create User To Group
	 *
	 * @param	$user_id	int		the user id to where it belong
	 * @param	$group_id	int		the group id to where it belong
	 * @return	object
	 * */
	public function createUserToGroup($user_id, $group_id){
		$UserToGroup = new \UserToGroup\UserToGroup;
		$UserToGroup->group_id 	= $group_id;
		$UserToGroup->user_id 	= $user_id;
		$UserToGroup->role	  	= 1;
		$UserToGroup->save();
		return $UserToGroup;
	}
}
