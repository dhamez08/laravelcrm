<?php
namespace CustomerTasks;
/**
 * main model for Clients
 * */

class CustomerTasks extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_tasks';

	public function scopeCustomerID($query,$customerID){
		return $query->where('customer_id', '=', $customerID);
	}

	public function scopeBelongsToUser($query,$belongsto){
		return $query->where('belongs_to', '=', $belongsto);
	}

	public function scopeStatus($query, $status){
		return $query->where('status', '=', $status);
	}

	public function scopeTaskID($query, $taskid){
		return $query->where('id', '=', $taskid);
	}

	public function scopeStartDate($query, $startDate){
		return $query->where('date', '>=', $startDate);
	}

	public function scopeEndDate($query, $endDate){
		return $query->where('date', '<=', $endDate);
	}

	public function label(){
		return $this->hasOne('\TaskLabel\TaskLabel','id','task_setting');
	}


	public function client(){
		return $this->belongsTo('\Clients\Clients','customer_id','id');
	}

	public function note()
	{
		return $this->hasOne('\CustomerNotes\CustomerNotes', 'note_id', 'id');
	}

	public function notes()
	{
		return $this->hasMany('\CustomerNotes\CustomerNotes', 'task_id', 'id');
	}

}
