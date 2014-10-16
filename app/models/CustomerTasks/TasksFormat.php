<?php
namespace CustomerTasks;
/**
 * Class for binding data clients
 * */
use Illuminate\Support\Facades\Facade;
use Carbon\Carbon;

class TasksFormat extends Facade{

	protected $task_data;

	/**
	 * Bind a Property taken from API to this object
	 */
	public function bind( $taskData )
	{
		foreach( get_object_vars( $taskData )  as $k => $v ){
			$this->$k = $v;
		}
		return $this;
	}

	public function displayName(){
		return $this->name;
	}

}
