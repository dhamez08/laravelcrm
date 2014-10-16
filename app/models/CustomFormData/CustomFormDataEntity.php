<?php
namespace CustomFormData;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFormDataEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_forms_data';
	protected static $instance = null;

	protected $fillable = array('form_id', 'customer_id', 'field_name', 'value', 'ref_id');

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

	public function getData($id, $customer_id) {
		$sql = "SELECT users_custom_forms.name, 
						users_custom_forms.desc, 
						users_custom_forms_data.form_id, 
						users_custom_forms_data.ref_id,
						users_custom_forms_data.customer_id, 
						users_custom_forms_data.created_at, 
						users_custom_forms_data.updated_at 
				FROM users_custom_forms,users_custom_forms_data 
				WHERE users_custom_forms.id = users_custom_forms_data.form_id 
						AND users_custom_forms_data.form_id=? 
						AND users_custom_forms_data.customer_id=? 
						AND users_custom_forms_data.deleted_at IS NULL 
				group by users_custom_forms_data.ref_id";

		$query = \DB::select($sql, array($id, $customer_id));	
		return $query;
	}

}
