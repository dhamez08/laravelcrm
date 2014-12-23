<?php
namespace CustomForm;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFormEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_forms';
	protected static $instance = null;

	protected $dates = ['deleted_at'];

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

	public function getFormsByLoggedUser() {

		$forms = \DB::table($this->table)->where('user_id', '=', \Auth::id())
					->whereNull('deleted_at');

		return $forms->get();

	}

	public function saveForm($data) {
		$this->name 	= $data['form_name'];
		$this->desc 	= $data['form_description'];
		$this->ref 		= rand(1,9) . time();
		$this->user_id 	= \Auth::id();
		$this->save();
	}

	public function builds() {
		return $this->hasMany('\CustomFormBuild\CustomFormBuildEntity','form_id');
	}

}
