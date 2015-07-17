<?php
/**
 * A wrapper for the Activity Model
 * */
namespace Activity;

use Carbon\Carbon;

class ActivityEntity extends \Eloquent {

	protected static $instance = null;

	public function __construct(){

	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	 * Logs Activity
	 *
	 * @return activity_id
	 */
	public function logActivity($typeText, $objectId, $user = null)
	{
		if(is_null($user)) {
			$belongsTo 		= \Session::get('group_id');
			$belongsUser 	= \Auth::id(); 
		} else {
			$belongsTo 		= \User\User::find($user)->userToGroup()->first()->group_id;
			$belongsUser 	= $user;
		}

		$typeId = \ActivityType\ActivityType::where('name', $typeText)->first()->id;

		$activity = new \Activity\Activity;
		$activity->belongs_to		= $belongsTo;
		$activity->belongs_user		= $belongsUser;
		$activity->date_added		= date('Y-m-d H:i:s');
		$activity->activity_type_id	= $typeId;
		$activity->object_id		= $objectId;
		$activity->save();

		return $activity->id;
	}

	public function getActivities($userId = null, $otherFilters = array())
	{
		\Debugbar::info($userId);
		if(is_null($userId)) {
			\Debugbar::info('is_null');
			$userId = \Auth::id();
			$activities = \User\User::find($userId)->activity()->orderBy('date_added','desc')->get();
		} elseif(is_numeric($userId)) {
			\Debugbar::info('is_int');
			$activities = \User\User::find($userId)->activity()->orderBy('date_added','desc')->get();
		} else {
			\Debugbar::info('all');
			$activities = \Activity\Activity::where('belongs_to', \Session::get('group_id'))->orderBy('date_added','desc')->get();
		}

		return $activities;
	}

	public function listActivities($activitiesCollection)
	{
		$list = array();

		foreach($activitiesCollection as $activity) {
			$user = \User\User::find($activity->belongs_user);
			$activityType = \ActivityType\ActivityType::find($activity->activity_type_id);
			$activityGroup = $activityType->activityGroup;

			$sourceUser = '<strong>' . $user->first_name . ' ' . $user->last_name . '</strong>';
			$objectDetails = \ActivityGroup\ActivityGroupEntity::get_instance()->getObject($activityGroup->id, $activity->object_id);
			if(!isset($objectDetails->client_id)) continue;

			$clientLink = '<a href="'.url('clients/client-summary/'.$objectDetails->client_id).'">'.$objectDetails->name.'</a>';

			$log = str_replace('YYY', $clientLink, str_replace('XXX', $sourceUser, $activityType->log_text));
			if ( $objectDetails->client_id === 0 ){
				$log = str_replace("for","",$log);
				
			}
			if(!empty($objectDetails->details))	$log .= '<br/><br/><blockquote class="blockquote-dashboard">' . $objectDetails->details . '</blockquote>';

			$list[] = array(
				'icon' 	=> $objectDetails->icon,
				'log' 	=> $log,
				'date' 	=> Carbon::parse($activity->date_added)->format('d/m/Y H:i')
			);
		}

		return $list;
	}
}