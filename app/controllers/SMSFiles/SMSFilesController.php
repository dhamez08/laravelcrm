<?php
namespace SMSFiles;
/**
 * Clients Controller
 *
 * */

class SMSFilesController extends \BaseController {

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
		$this->data_view 					= parent::setupThemes();
		$this->data_view['client_index'] 	= $this->data_view['view_path'] . '.clients.index';
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed';
		$this->data_view['include'] 		= $this->data_view['view_path'] . '.sms';
		$this->noteFolder 	 				= public_path() . '/documents';
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

	/**
	 * get themes
	 * @return	array
	 * */
	public function getSetupThemes(){
		return \Dashboard\DashboardController::get_instance()->getSetupThemes();
	}

	public function postMediaAjaxUploadFile(){
		if( \Input::hasFile('files') ){
			if( \Input::file('files')->getSize() > 0 ){
				$mime_type = \Input::file('files')->getMimeType();
				$file_name = \Auth::id() .'_'.str_replace(' ','_',strtolower(\Input::file('files')->getClientOriginalName()));
				$upload_success = \Input::file('files')->move(public_path() . '/documents', $file_name);
				if($upload_success ){
					$data = array(
						'user_id' => \Auth::id(),
						'file' => $file_name,
						'file_mimetype' => $mime_type
					);
					\SMSFIles\SMSFIlesEntity::get_instance()->createOrUpdate($data);

					return \Response::json(
						array(
							'result'=>true,
							'message'=>'Files has been uploaded successfully, select file to attach'
						)
					);
				}else{
					$msg = '<li class="list-group-item list-group-item-danger">Fail to add file.</li>';
					return \Response::json(array('result'=>false,'message'=>$msg));
				}
			}else{
				$msg = '<li class="list-group-item list-group-item-danger">Fail to add file.</li>';
				return \Response::json(array('result'=>false,'message'=>$msg));
			}
		}else{
			$msg = '<li class="list-group-item list-group-item-danger">Please choose files to upload first.</li>';
			return \Response::json(array('result'=>false,'message'=>$msg));
		}
		die();
	}

	public function getAjaxFiles(){
		$data 				= $this->data_view;
		$data['sms_files']	= \SMSFIles\SMSFIles::userId(\Auth::id())->orderBy('created_at','desc');
		$data 				= array_merge($data,$this->getSetupThemes());
		return \View::make($data['view_path'] . '.files.partials.ajax-list-files', $data)->render();
	}

}
