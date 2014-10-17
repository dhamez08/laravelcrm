<?php
namespace CustomTabNotesData;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class CustomTabNotesDataEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'users_custom_tabs_notes_data';
	protected static $instance = null;

	protected $fillable = array('customer_id', 'custom_id', 'section', 'entry');

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


	public function getNotesBySection_Custom_Customer($section, $custom, $customer_id) {

		return $this->where('section',$section)
					->where('custom_id',$custom)
					->where('customer_id',$customer_id)
					->whereNull('deleted_at')
					->get();

	}

}
