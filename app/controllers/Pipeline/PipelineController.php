<?php

namespace Pipeline;

class PipelineController extends \BaseController {

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
		$this->destination_path = "/public/document/library/own/";
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

}
