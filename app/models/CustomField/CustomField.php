<?php
namespace CustomField;

//use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomField extends \Eloquent{

	//use SoftDeletingTrait;

	//protected $dates = ['deleted_at'];

	protected $table = 'users_custom_fields';

	public function user() {
		return $this->belongsTo('\User\User','user_id','id')->whereNull('deleted_at');
	}
}
