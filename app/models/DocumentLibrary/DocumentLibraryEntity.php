<?php
namespace DocumentLibrary;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;
use Tristan\ThumbnailGenerator\ThumbnailGenerator;

class DocumentLibraryEntity extends \Eloquent{

	use \SoftDeletingTrait;

	protected $table = 'document_library_own';
	protected static $instance = null;

	protected $fillable = array('belongs_to', 'name', 'filename', 'file_ext','active');

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

		$destination = public_path()."/document/library/own/";
		$file = \Input::file('doc');
		$ext = $file->getClientOriginalExtension();
		$file_name = \Auth::id().'_'.time().'.'.$ext;

        $document = new $this;
		$document->belongs_to = \Auth::id();
		$document->name = \Input::get('name');
		$document->filename = $file_name;
		$document->file_ext = $ext;
        $document->section_id = \Input::get('subsection_id');
		$document->active = 1;

		if($file->move($destination, $file_name)) {
            $thumbgen = new ThumbnailGenerator();
            $thumb_filename = $thumbgen->generateThumbnail('document/library/own/'.$file_name);
            $document->thumbnail = $thumb_filename;

            return $document->save() ? 1:0;

        }

		return 0;

	}

	public function documents() {
		$documents = \DB::table($this->table)->where('belongs_to', '=', \Auth::id())
					->whereNull('deleted_at');
		return $documents->get();
	}

}
