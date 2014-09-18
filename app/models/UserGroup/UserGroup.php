<?php
namespace UserGroup;
/**
 * Base class for user group
 * */
class UserGroup extends \Eloquent{
	protected $table = 'users_groups';

	public function userToGroup(){
		return $this->hasMany('\UserToGroup\UserToGroup','group_id');
	}

	public function user(){
		return $this->belongsTo('\User\User','id','manager_id');
	}
	/**
	 * Query scope to get manager ID column
	 * @param 	$query	laravel default
	 * @param	$groupID	int		manager_id column
	 * @return 	query
	 * */
	public function scopeManagerID($query, $managerID){
		return $query->where('manager_id', '=' , $managerID);
	}
}
