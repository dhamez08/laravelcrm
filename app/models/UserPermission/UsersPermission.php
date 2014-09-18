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

	public function scopeUserID($query, $userID){
		return $query->where('user_id', '=', $userID);
	}

	public function scopePermissionKey($query, $key){
		return $query->where('permission_key', '=', $key);
	}

}
