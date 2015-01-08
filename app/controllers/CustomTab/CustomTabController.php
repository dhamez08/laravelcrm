<?php
namespace CustomTab;

class CustomTabController extends \BaseController {

	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;



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
		$this->fileFolder 	 	= public_path() . '/document';
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

	public function postAddNote() {
		$notesObj = new \CustomTabNotesData\CustomTabNotesData;

		if($notesObj->create(\Input::all())) {
			\Session::flash('message', 'Successfully Added!');
			return \Redirect::to('clients/custom/'.\Input::get('customer_id').'?custom='.\Input::get('custom_id'));
		} else {
			return \Redirect::to('clients/custom/'.\Input::get('customer_id').'?custom='.\Input::get('custom_id'))
					->withErrors(['There was a problem, please try again']);
		}
	}

	public function getDeleteNote($id, $customer_id, $custom_id) {
		$notesObj = \CustomTabNotesData\CustomTabNotesDataEntity::where('id',$id)->where('customer_id', $customer_id)->first();
		if($notesObj) {
			$notesObj->delete();

			\Session::flash('message', 'Successfully Deleted!');
			return \Redirect::to('clients/custom/'.$customer_id.'?custom='.$custom_id);

		} else {
			return \Redirect::to('clients/custom/'.$customer_id.'?custom='.$custom_id)
					->withErrors(['There was a problem, please try again']);
		}
	}

	public function postBulkDeleteNote($customer_id, $custom_id)
	{
		$noteIds = \Input::get('notes_to_delete');
		if(count($noteIds) > 0) {
			$notesDeleted = \CustomTabNotesData\CustomTabNotesDataEntity::whereIn('id', $noteIds)->delete();
			\Session::flash('message', 'Notes deleted successfully');			
		} else {
			\Session::flash('message', 'No selected notes to delete');
		}
		return \Redirect::to('clients/custom/'.$customer_id.'?custom='.$custom_id);		
	}

	public function postAddFile() {
		$rules = array(
			'name' => 'required',
			'file'  => 'required|max:10000|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,jpg,jpeg,rar,bmp,gif,tif,txt,xml,csv,png'
		);

		$messages = array(
			'name.required' => 'Name is required.',
			'file.required'=>'Please select a File',
			'file.mimes'=>'The supported file types are : pdf, doc, docx, xls, xlsx, ppt, pptx, zip, jpg, jpeg, rar, bmp, gif, tif, txt, xml, csv and png',
			'file.max'=>'File maximum file size is 10mb',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);
		if ( $validator->passes() ) {
			if(\CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->upload()) {
				\Session::flash('message', 'file was successfully uploaded');
				return \Redirect::back();
			} else {
				return \Redirect::back()->withErrors(['There was a problem uploading your file, please try again']);
			}
		} else {
			\Input::flash();
			return \Redirect::back()
			->withErrors($validator)
			->withInput();
		}
	}

	// added by rjosephporter - 01.05.2014
	public function postAjaxUploadFile($file_type, $customer_id, $page = "") {
		$belongs_to = \Auth::id();
		if( \Input::hasFile('files') ){
			$file_id = \Input::get('file_type');
			foreach(\Input::file('files') as $file){
				$fileName = $this->_doUpload($file);
				$data = array(
					'customer_id' 	=> $customer_id,
					'custom_id'		=> \Input::get('custom_id'),
					'section'		=> \Input::get('section'),
					'file_name'		=> $fileName,
					'file_type'		=> $file->getClientOriginalExtension(),
				);		

				\CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->createOrUpdate($data);

				return \Response::json(
					array(
						'success'=>true,
						'msg'=>'',
						'redirect'=>url('clients/custom/' . $customer_id . '?custom=' . \Input::get('custom_id')),
					)
				);
			}
		}else{
			return \Response::json(array('success'=>false,'msg'=>'Cannot upload, file.'));
		}
	}

	// added by rjosephporter - 01.05.2015
	private function _doUpload($fileName){
		// set the file name
		// prefix first
		// group id
		// time
		$file_name = $fileName->getClientOriginalName();
		// upload
		$upload_success = $fileName->move($this->fileFolder, $file_name);
		if($upload_success ){
			return $file_name;
		}
	}		

	public function getDeleteFile($id, $customer_id, $custom_id = null) {
		$file = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->where('id',$id)->where('customer_id', $customer_id)->first();
		if($file) {
			$img = $file->file_name;
			if(\File::delete(public_path().'/document/'.$img)) {
				$file->delete();
				\Session::flash('message', 'File was successfully deleted');
				return \Redirect::back();
			} else {
				return \Redirect::back()->withErrors(['There was a problem deleting the file, please try again']);
			}
		} else {
			return \Redirect::back()->withErrors(['There was a problem deleting the file, please try again']);
		}
	}

	public function postBulkDeleteFile($customer_id, $custom_id)
	{
		$fileIds = \Input::get('files_to_delete');
		$filesDeletedCount = 0;
		if(count($fileIds) > 0) {
			foreach($fileIds as $fileId) {
				$file = \CustomTabFilesData\CustomTabFilesDataEntity::get_instance()->where('id', $fileId)->where('customer_id', $customer_id)->first();
				if($file) {
					$img = $file->file_name;
					if(\File::delete(public_path().'/document/'.$img)) {
						$file->delete();
						$filesDeletedCount++;
					}					
				}
			}
			if($filesDeletedCount == count($fileIds)) {
				\Session::flash('message', 'Files deleted successfully.');
			} else {
				\Session::flash('message', 'There was an error when try to delete files. Please try again.');
			}
		} else {
			\Session::flash('message', 'No selected files to delete.');
		}
		return \Redirect::to('clients/custom/' . $customer_id . '?custom=' . $custom_id);		
	}


}
