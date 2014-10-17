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

	public function upload() {

		$destination = public_path()."/document/";
		$file = \Input::file('file');
		$ext = $file->getClientOriginalExtension();
		$file_name = \Input::get('customer_id').'_'.time().'.'.$ext;

		$document = new $this;
		$document->customer_id = \Input::get('customer_id');
		$document->custom_id = \Input::get('custom_id');
		$document->section = \Input::get('section');
		$document->name = \Input::get('name');
		$document->file_name = $file_name;
		$document->file_type = $ext;

		if($file->move($destination, $file_name)) {
			return $document->save() ? 1:0;
		}

		return 0;

	}

	public function getFilesBySection_Custom_Customer($section, $custom, $customer_id) {

		return $this->where('section',$section)
					->where('custom_id',$custom)
					->where('customer_id',$customer_id)
					->whereNull('deleted_at')
					->get();

	}

}
