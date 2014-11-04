<?php
namespace SMSCredit;

class SMSCredit extends \Eloquent{

	protected static $instance = null;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'sms_credits';

	protected $fillable = array(
		'user_id',
		'credits'
	);

	public function __construct(){

	}

	public function user(){
		return $this->belongsTo('\User\User');
	}

	public function scopeUserId($query, $userId){
		return $query->where('user_id', '=', $userId);
	}

}
