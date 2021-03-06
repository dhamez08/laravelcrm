<?php
namespace CustomFieldTabData;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomFieldTabDataEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_tabs_data';
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

}
