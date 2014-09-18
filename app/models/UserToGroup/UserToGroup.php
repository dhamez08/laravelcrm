<?php
namespace UserToGroup;
/**
 * Base class for user to group
 * */
class UserToGroup extends \Eloquent{
	protected $table = 'users_to_groups';

	public function user(){
		return $this->belongsTo('\User\User');
	}

	public function userGroup(){
		return $this->belongsTo('\UserGroup\UserGroup');
	}

	/**
	 * Query scope to get group ID column
	 * @param 	$query	laravel default
	 * @param	$groupID	int		group_id column
	 * @return 	query
	 * */
	public function scopeGroupID($query, $groupID){
		return $query->where('group_id', '=' , $groupID);
	}

	/**
	 * Query scope to get role column
	 * @param 	$query	laravel default
	 * @param	$role	int		role column
	 * @return 	query
	 * */
	public function scopeRole($query, $role){
		return $query->where('role', '=' , $role);
	}

	/**
	 * Query scope to get user id column
	 * @param 	$query	laravel default
	 * @param	$userID	int		role column
	 * @return 	query
	 * */
	public function scopeUserID($query, $userID){
		return $query->where('user_id', '=' , $userID);
	}
}
