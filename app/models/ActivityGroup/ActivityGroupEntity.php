<?php
namespace ActivityGroup;
/**
 * main model for Activity Type
 * */

class ActivityGroupEntity extends \Eloquent{

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

	public function getObject($groupId, $objectId)
	{
		$object = false;
		$result = new \stdClass;
		$group = \ActivityGroup\ActivityGroup::find($groupId);
		switch ($group->name) {
			case 'User':
				$object = \User\User::where('id', $objectId)->first();
				if($object) {
					$result->client_id = $object->id;
					$result->name = $object->first_name . ' ' . $object->last_name;
					$result->details = null;
					$result->icon = 'fa-user';
				}
				break;
			case 'Client':
				$object = \Clients\Clients::where('id', $objectId)->first();
				if($object) {
					$result->client_id = $object->id;
					$result->name = $object->first_name . ' ' . $object->last_name;
					$result->details = null;				
					$result->icon = 'fa-users';
				}
				break;
			case 'Note':
				$object = \CustomerNotes\CustomerNotes::where('id', $objectId)->first();
				if($object) {
					$result->client_id = $object->customer_id;
					$result->name = $object->customer->first_name . ' ' . $object->customer->last_name;
					$result->details = $object->subject;
					$result->icon = 'fa-comment';
				}
				break;
			case 'Task':
				$object = \CustomerTasks\CustomerTasks::where('id', $objectId)->first();
				if($object) {
					$result->client_id = $object->customer_id;
					if ( $object->customer_id > 0 ){
						$result->name = $object->client->first_name . ' ' . $object->client->last_name;
					}else{
						$result->name = '';
					}
					$result->details = $object->name;
					$result->icon = 'fa-tasks';
				}
				break;											
			default:
				$result = false;
				break;
		}

		return $result;
	}
}
