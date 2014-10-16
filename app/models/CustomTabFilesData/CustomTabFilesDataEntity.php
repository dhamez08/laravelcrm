<?php
namespace CustomTabFilesData;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomTabFilesDataEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_tabs_files_data';
	protected static $instance = null;

	protected $fillable = array('customer_id', 'custom_id', 'section', 'name', 'file_name', 'file_type');

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
