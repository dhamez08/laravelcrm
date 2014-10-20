<?php
namespace Notes;
use Carbon\Carbon;
class NotesController extends \BaseController {

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

	protected $modalClass;

	protected $noteFolder;

	protected $prefixNoteFileName;

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.page.index';
		$this->data_view['include'] 	= $this->data_view['view_path'] . '.notes';
		$this->modalClass 		= 'ajaxModal';
		$this->noteFolder 	 	= public_path() . '/documents';
		//'pdf|doc|docx|gif|jpg|png'
		$this->prefixNoteFileName = \Auth::id();
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

	public function getIndex($customerId, $belongsToUser){
		$dashboard_data 		= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 					= $this->data_view;
		$belongsTo 				= \Auth::id();
		$data['notes']			= \CustomerNotes\CustomerNotesEntity::get_instance()->getNotes($customerId, $belongsTo);
		//var_dump($data['notes']->get()->toArray());
		if(!is_null($customerId)){
			$data['customerId'] = $customerId;
		}
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['include'] . '.index', $data )->render();
	}

	public function getAjaxCreateInput($customerId){
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$data['customerId'] 		= $customerId;
		$data['pageTitle'] 			= 'Add Note';
		$data['contentClass'] 		= '';
		$data['portlet_body_class']	= '';
		$data['portlet_title']		= 'Note';
		$data['fa_icons']			= 'cog';
		$data 						= array_merge($data,$dashboard_data);

		return \View::make( $data['include'] . '.create', $data )->render();
	}

	/**
	 * This is a helper to upload logo
	 *
	 * @param	$groupID	int		id of the group
	 * @see method updateLogo
	 * @return filename
	 * */
	private function _doUpload($fileName){
		// set the file name
		// prefix first
		// group id
		// time
		$file_name = $this->prefixNoteFileName . '_' . time() . '.' . \Input::file($fileName)->getClientOriginalExtension();
		// upload
		$upload_success = \Input::file($fileName)->move($this->noteFolder, $file_name);
		if($upload_success ){
			return $file_name;
		}
	}

	public function postAjaxCreateNote($clientId){
		$rules = array(
			'note' => 'required',
			'notefile' => 'mimes:pdf,doc,docx,gif,jpg,png,jpeg',
		);
		$messages = array(
			'note.required'=>'Note is required',
			'notefile.mimes'=>'File format is invalid',
		);

		$validator = \Validator::make(\Input::all(), $rules, $messages);

		if($validator->passes()){

			if( \Input::hasFile('notefile') ){
				$fileName = $this->_doUpload('notefile');
			}else{
				$fileName = '';
			}

			$data = array(
				'note' => \Input::get('note'),
				'customer_id' => \Input::get('customerid'),
				'added_by' => \Auth::id(),
				'file' => $fileName,
			);
			\CustomerNotes\CustomerNotesEntity::get_instance()->createOrUpdate($data);

			\Session::flash('message', 'Successfully Added Note' );
			if( \Input::has('redirect') ){
				return \Response::json(array('result'=>true,'redirect'=>\Input::get('redirect')));
			}else{
				return \Response::json(array('result'=>true));
			}

		}else{
			$msg = $validator->messages()->all('<li class="list-group-item list-group-item-danger">:message</li>');
			return \Response::json(array('result'=>false,'message'=>$msg));
		}
		die();
	}

	public function getDeleteNote($id, $customerid){
		$Note = \CustomerNotes\CustomerNotes::noteId($id)
		->customerId($customerid)
		->addedBy(\Auth::id());
		if($Note->count() > 0){
			\CustomerNotes\CustomerNotesEntity::get_instance()->removeNoteAttachFile($Note->pluck('file'));
			$Note->delete();
			if(\Input::has('redirect')){
				\Session::flash('message', 'Successfully Deleted Note');
				return \Redirect::to(\Input::get('redirect'));
			}else{
				\Session::flash('message', 'Successfully Deleted Note');
				return \Redirect::action('Clients\ClientsController@getClientSummary',array('clientId'=>$customerid));
			}
		}
	}

}