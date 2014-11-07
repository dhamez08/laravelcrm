<?php
namespace CustomField;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFieldEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_fields';
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

	public function getFieldsByLoggedUser() {

		$fields = $this->where('user_id', '=', \Auth::id())
					->whereNull('deleted_at');

		return $fields->get();

	}

	public function saveField($data) {
		$field = new $this;
		$field->name 			= $data['name'];
		$field->label 			= $data['label'];
		$field->placeholder 	= $data['placeholder'];
		$field->user_id 			= \Auth::id();
		$field->save();
	}

}
