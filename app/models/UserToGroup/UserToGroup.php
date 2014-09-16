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
}
