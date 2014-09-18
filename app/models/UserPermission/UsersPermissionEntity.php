<?php
namespace UserPermission;
/**
 * Base class for user permission
 * */
class UsersPermissionEntity extends \Eloquent{
	protected $table = 'user_permission';

	protected static $instance = null;

	protected $array_permission;

	public function __construct(){
		$this->array_permission = \Config::get('crm.permissions');
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

	public function getPermission(){
		return $this->array_permission;
	}

	public function addOrUpdatePermission($userId, $data, $id = null){
		if( is_null($id) ){
			$permissions = new \UserPermission\UsersPermission;
			$permissions->user_id 			= $userId;
			$permissions->permission_key 	= 'permissions';
		}else{
			$permissions = \UserPermission\UsersPermission::find($id);
		}
		$permissions->permission_value 	= $data;
		$permissions->save();
		return $permissions;
	}

}
