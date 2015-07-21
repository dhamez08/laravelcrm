<?php

namespace DocumentLibraries;

use DocumentLibrary\DocumentLibraryEntity;
use Tristan\ThumbnailGenerator\ThumbnailGenerator;


class DocumentLibrariesController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $destination_path = null;

	/**
	 * hold the view essentials like
	 * - title
	 * - view path
	 * @return array | associative
	 * */
	protected $data_view;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();		
		$this->data_view = parent::setupThemes();		
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.dashboard.index';
		$this->destination_path = url("public/document/library/own/");
	}

	/**
	 * Return an instance of this class.
	 *
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

	/**
	 * get themes
	 * @return	array
	 * */
	public function getSetupThemes(){
		return \Dashboard\DashboardController::get_instance()->getSetupThemes();
	}

	/**
	 * Index of settings
	 * @return View
	 * */
	public function getIndex(){
		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Document Libraries';
		$data['portlet_title']		= 'Document Libraries';
		$data['path']				= $this->destination_path;
		$data['icons']				= \Config::get('crm.document_file_type_class');
		$data['documents']			= \DocumentLibrary\DocumentLibraryEntity::get_instance()->documents();
		$data 						= array_merge($data,$this->getSetupThemes());
		
		//FOR THE SUBSECTIONS
		$data['sections']			= \DocumentLibrary\DocumentSection::get_instance()->doc_sections();
		foreach($data['sections'] as $section){
			$data['subsections'][$section->id] = \DocumentLibrary\DocumentSection::get_instance()->doc_subsections($section->id);
			foreach($data['subsections'][$section->id] as $subsection){
				$data['documents'][$subsection->id] = \DocumentLibrary\DocumentSection::find($subsection->id)->documents()->get();
			}
		}
		//END SUBSECTIONS
		
		return \View::make( $data['view_path'] . '.document-libraries.index', $data );
	}

	public function postUpload() {
		$rules = array(
			'name' => 'required',
			'doc'  => 'required|max:10000|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,jpg,jpeg,rar,bmp,gif,tif,txt,xml,csv,png'
		);

		$messages = array(
			'name.required' => 'Name is required.',
			'doc.required'=>'Please select a Document',
			'doc.mimes'=>'The supported Document file types are : pdf, doc, docx, xls, xlsx, ppt, pptx, zip, jpg, jpeg, rar, bmp, gif, tif, txt, xml, csv and png',
			'doc.max'=>'Document maximum file size is 10mb',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			if(\DocumentLibrary\DocumentLibraryEntity::get_instance()->upload()) {
				\Session::flash('message', 'Document was successfully uploaded');
				return \Redirect::back();
			} else {
				return \Redirect::back()->withErrors(['There was a problem uploading your document, please try again']);
			}
		} else {
			\Input::flash();
			return \Redirect::back()
			->withErrors($validator)
			->withInput();
		}
	}

    public function postAjaxUpload(){
        $belongs_to = \Auth::id();
        $section_id = \Input::get('subsection_id');

        if( \Input::hasFile('files') ){
            foreach(\Input::file('files') as $file){
                $this->fileUpload($file, $section_id);


                return \Response::json(
                    array(
                        'success'=>true,
                        'msg'=>'',
                        'redirect'=>url('document-library'),
                        'files' => array(
                            array(
                                'name'=> $file->getClientOriginalName(),
                            )
                        )
                    )
                );
            }
        }else{
            return \Response::json(array('success'=>false,'msg'=>'Cannot upload, file.'));
        }
    }

	public function getDelete($id) {
		$document = \DocumentLibrary\DocumentLibraryEntity::get_instance()->find($id);
		if($document) {
			$img = $document->filename;
			if(\File::delete(public_path().'/document/library/own/'.$img)) {
				$document->delete();
				\Session::flash('message', 'Document was successfully deleted');
				return \Redirect::back();
			} else {
				return \Redirect::back()->withErrors(['There was a problem deleting your document, please try again']);
			}
		} else {
			return \Redirect::back()->withErrors(['There was a problem deleting your document, please try again']);
		}
	}
	public function postSection(){
		$section = new \DocumentLibrary\DocumentSection();
		//if id has value then edit the content
		if ( (int)\Input::get('id') ){
			$field_array = array('description'=>\Input::get('description'));
			$section->update_section((int) \Input::get('id'), $field_array);
		}else{
			//create it
			$section->user_id = \Auth::id();
			$section->status_id = 1;
			$section->description = \Input::get('description');
			$section->parent_id = \Input::get('parent_id');
			$section->save();
		}
		
		return \Redirect::back();
	}

    public function getBulkDelete(){
        $files_ids = \Input::get('file_ids');

        if(!empty($files_ids)){
            foreach($files_ids as $file_id){
                $document = \DocumentLibrary\DocumentLibraryEntity::get_instance()->find($file_id);
                if($document->belongs_to == \Auth::id()){
                    $document->delete();
                } else {
                    return \Redirect::back()->withErrors(['There was a problem deleting your document, please try again']);
                }
            }
            \Session::flash('message', 'Document was successfully deleted');
            return \Redirect::back();
        } else {
            return \Redirect::back()->withErrors(['There was a problem deleting your document, please try again']);
        }
    }

    public function getDeleteSection($section_id){
        $section = \DocumentLibrary\DocumentSection::find($section_id);

        if($section->user_id == \Auth::id()){
            $section->delete();
            foreach($section->documents()->get() as $document){
                $document->delete();
            }
            \Session::flash('message', 'Section was successfully deleted');
            return \Redirect::back();
        } else {
            return \Redirect::back()->withErrors(['There was a problem deleting this section, please try again']);
        }
    }

    public function fileUpload($file, $section_id){
        $destination = public_path()."/document/library/own/";
        $ext = $file->getClientOriginalExtension();
        $file_name = \Auth::id().'_'.time().'.'.$ext;
        $display_name = $file->getClientOriginalName();

        $document = new \DocumentLibrary\DocumentLibrary();
        $document->belongs_to = \Auth::id();
        $document->name = $display_name;
        $document->filename = $file_name;
        $document->file_ext = $ext;
        $document->section_id = $section_id;
        $document->active = 1;

        if($file->move($destination, $file_name)) {
            $thumbgen = new ThumbnailGenerator();
            $thumb_filename = $thumbgen->generateThumbnail('document/library/own/'.$file_name);
            $document->thumbnail = $thumb_filename;

            return $document->save() ? 1:0;
        } else {
            return 0;
        }
    }

}
