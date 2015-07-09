<?php
namespace DocumentLibrary;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class DocumentSection extends \Eloquent{
    use \SoftDeletingTrait;
	protected $table = 'doc_sections';
	protected static $instance = null;
	
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
	public function doc_sections(){
		$doc_sections = \DB::table($this->table)
					->where('user_id', '=', \Auth::id())
					->where('parent_id','=',0)
                    ->where('deleted_at','=',null);
		return $doc_sections->get();
	}
	public function doc_subsections($section_id = NULL){
		$sub = array();
		if ( $section_id !== NULL ){
			$doc_subsections = \DB::table($this->table)
                ->where('parent_id', '=', (int)$section_id)
                ->where('deleted_at','=',null);
			$sub = $doc_subsections->get();
		}
		return $sub;
	}
	public function update_section($section_id = NULL, $field_array = NULL){
		if ( $section_id === NULL OR $field_array === NULL){
			return FALSE;
		}
		\DB::table($this->table)
            ->where('id', (int)$section_id)
            ->update($field_array);
	}

    public function documents(){
        return $this->hasMany('\DocumentLibrary\DocumentLibrary','section_id','id');
    }
}
