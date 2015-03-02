<?php
namespace ActivityType;
/**
 * main model for Activity Type
 * */

class ActivityType extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activity_type';

	public $timestamps = false;

	protected $fillable = array(
		'activity_group_id',
		'name',
		'log_text'
	);

	public function activity()
	{
		return $this->hasMany('\Activity\Activity','activity_type_id','id');
	}

	public function activityGroup()
	{
		return $this->hasOne('\ActivityGroup\ActivityGroup', 'id', 'activity_group_id');
	}

}
