<?php
namespace UserPermission;
/**
 * Base class for user permission
 * */
class UsersPermission extends \Eloquent{
	protected $table = 'user_permission';

	public function user(){
		return $this->belongsTo('\User\User');
	}

}
