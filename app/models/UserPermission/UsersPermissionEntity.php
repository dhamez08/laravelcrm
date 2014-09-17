<?php
namespace UserPermission;
/**
 * Base class for user permission
 * */
class UsersPermissionEntity extends \Eloquent{
	protected $table = 'users_permissions';

	protected static $instance = null;

	protected $array_permission = array(
		'Client - Edit Details' => 'client_edit',
		'Client - Delete' => 'client_delete',
		'Client - Notes' => 'client_notes',
		'Client - Files' => 'client_files',
		'Client - Opportunities' => 'client_opportunities',
	);

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

	public function getPermission(){
		return $this->array_permission;
	}

	//public function addPermission($userId,$per

}
