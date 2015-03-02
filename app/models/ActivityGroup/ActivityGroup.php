<?php
namespace ActivityGroup;
/**
 * main model for Activity Type
 * */

class ActivityGroup extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activity_group';

	public $timestamps = false;

	protected $fillable = array(
		'name',
		'description',
		'date_added'
	);

	public function activityType()
	{
		return $this->hasMany('\ActivityType\ActivityType','activity_group_id','id');
	}
}
