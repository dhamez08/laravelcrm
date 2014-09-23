<?php
namespace CustomFormBuild;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFormBuildEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_forms_build';
	protected static $instance = null;

	protected $fillable = array('form_id', 'label', 'type', 'placeholder', 'value');

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

	public function form() {
		return $this->belongTo('\CustomForm\CustomFormEntity');
	}

	public function saveItem($data) {
		$build = new $this;
		$build->form_id = $data['form_id'];
		$build->label = $data['label'];
		$build->type = $data['type'];
		$build->placeholder = $data['placeholder'];
		$build->value = $data['value'];
		$build->save();
	}

}
