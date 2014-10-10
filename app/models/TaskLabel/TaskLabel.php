<?php
namespace TaskLabel;
class TaskLabel extends \Eloquent{

	protected $table = 'task_label';

	protected $fillable = array(
		'user_id',
		'action_name',
		'icons',
		'color',
	);

	public function scopeUserID($query, $userID){
		return $query->where('user_id', '=', $userID);
	}

	public function scopeTaskLabelID($query, $ID){
		return $query->where('id', '=', $ID);
	}

	public function scopeAllTaskLabel($query, $userID){
		return $query->userID($userID)->orWhere('user_id','=',0);
	}

}
