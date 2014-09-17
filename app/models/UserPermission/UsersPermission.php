<?php
namespace UserPermission;
/**
 * Base class for user permission
 * */
class UsersPermission extends \Eloquent{
	protected $table = 'users_permissions';

	public function user(){
		return $this->belongsTo('\User\User');
	}

}
