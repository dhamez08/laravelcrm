<?php
namespace DocumentLibrary;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class DocumentLibraryEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'document_library_own';
	protected static $instance = null;

	protected $fillable = array('belongs_to', 'name', 'filename', 'active');

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
