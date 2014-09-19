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

}
