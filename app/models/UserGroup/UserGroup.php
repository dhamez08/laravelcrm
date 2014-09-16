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

}
