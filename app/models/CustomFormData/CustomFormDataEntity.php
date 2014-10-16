<?php
namespace CustomFormData;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFormBuildEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_forms_data';
	protected static $instance = null;

	protected $fillable = array('form_id', 'customer_id', 'field_name', 'value');

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

}
