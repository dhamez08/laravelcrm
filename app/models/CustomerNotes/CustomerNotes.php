<?php
namespace CustomerNotes;
/**
 * main model for Clients
 * */

class CustomerNotes extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'customer_notes';

	protected $fillable = array(
		'customer_id',
		'note',
		'file',
		'added_by',
		'task_id',
	);

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::createFromTimestamp(strtotime($value))
            ->timezone(\Config::get('crm.timezone'))
            ->toDateTimeString()
        ;
    }	

	public function user(){
		return $this->hasOne('\User\User','id','added_by');
	}

	public function customer(){
		return $this->hasOne('\Clients\Clients','id','customer_id');
	}

	public function scopeCustomerId($query, $customerId){
		return $query->where('customer_id','=',$customerId);
	}

	public function scopeAddedBy($query, $addedBy){
		return $query->where('added_by','=',$addedBy);
	}

	public function scopeNoteId($query, $id){
		return $query->where('id','=',$id);
	}

	public function scopeNoTasks($query, $includeNoteIds = array()) 
	{
		$query = $query->where(function($query) use ($includeNoteIds)
		{
			$query->whereNull('task_id');
			if(count($includeNoteIds) > 0)
				$query->orWhereIn('id', $includeNoteIds);
		});

		/*
		$query = $query->whereNull('task_id');
		if(count($includeNoteIds) > 0)
			$query = $query->orWhereIn('task_id', $includeNoteIds);
		*/

		return $query;
	}

}
