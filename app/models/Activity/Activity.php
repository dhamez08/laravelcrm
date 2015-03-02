<?php
namespace Activity;
/**
 * main model for Activity
 * */

class Activity extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'activity';

	public $timestamps = false;

	protected $fillable = array(
		'belongs_to',
		'belongs_user',
		'date_added',
		'activity_type_id',
		'object_id'
	);

	public function user(){
		return $this->hasOne('\User\User','belongs_user','id');
	}

}
