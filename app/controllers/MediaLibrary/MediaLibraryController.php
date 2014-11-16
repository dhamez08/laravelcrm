<?php
namespace MediaLibrary;

use Carbon\Carbon;
class MediaLibraryController extends \BaseController {

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

	/**
	 * auto setup initialize object
	 * */
	public function __construct(){
		parent::__construct();
		//$this->data_view = \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$this->data_view = parent::setupThemes();
		$this->data_view['master_view'] 	= $this->data_view['view_path'] . '.page.index';
		$this->data_view['include'] 		= $this->data_view['view_path'] . '.medialibrary';
		$this->modalClass = 'mediaModalLibrary';
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

	public function getIndex(){

	}

	public function getDisplay($customer_id = 0, $belongsToUser = null, $options = array()){
		if( is_null($belongsToUser) ){
			$belongsToUser = \Auth::id();
		}
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		$data 						= $this->data_view;
		$belongsTo 					= \Auth::id();
		$data['options']			= \MediaLibrary\MediaLibraryEntity::get_instance()->displayOptions();
		$data['customer_id']		= $customer_id;
		$data['modal']				= $this->_mediaLibraryModal($data);
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['include'] . '.display', $data )->render();
	}

	private function _mediaLibraryUpload($data){
		return \View::make( $data['include'] . '.upload.upload', $data )->render();
	}

	private function _mediaLibraryDropBox($data){
		return \View::make( $data['include'] . '.integration.dropbox', $data )->render();
	}

	private function _mediaLibraryModal($data){
		$data['upload']	= $this->_mediaLibraryUpload($data);
		$data['dropbox']	= $this->_mediaLibraryDropBox($data);
		return \View::make( $data['include'] . '.modal.modal', $data )->render();
	}

}

