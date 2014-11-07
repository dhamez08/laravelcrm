<?php
namespace SMSFIles;

class SMSFIles extends \Eloquent{

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sms_files';

	protected $fillable = array(
		'user_id',
		'file',
		'file_mimetype',
	);

	public function __construct(){

	}

	public function user(){
		return $this->belongsTo('\User\User');
	}

	public function scopeUserId($query, $userId){
		return $query->where('user_id', '=', $userId);
	}

	public function scopeFileInId($query, $array_id){
		return $query->whereIn('id', $array_id);
	}

}
