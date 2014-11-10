<?php
namespace File;
/**
 * Clients Controller
 *
 * */

class ClientFileController extends \BaseController {

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
		$this->fileFolder 	 	= public_path() . '/documents';
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

	public function getIndex(){
		//var_dump($data['view_path'] . '.files.index');
	}

	public function getClientFile($clientId){
		//$clientId = 1;
		$dashboard_data 			= \Dashboard\DashboardController::get_instance()->getSetupThemes();
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid page-sidebar-closed');

		$data 						= $this->data_view;
		$data['pageTitle'] 			= 'Client';
		$data['contentClass'] 		= 'main-gutter-summary';
		$data['portlet_body_class']	= 'form';
		$data['portlet_title']		= 'Client';
		$data['fa_icons']			= 'user';
		$group_id					= \User\UserEntity::get_instance()->getUserToGroup()->first()->group_id;
		$data['customer']			= \Clients\Clients::find($clientId);
		$data['currentClient']		= \Clients\ClientEntity::get_instance()->bindCustomer($data['customer']);
		$data['telephone']			= $data['customer']->telephone();
		$data['email']				= $data['customer']->emails();
		$data['url']				= $data['customer']->url();
		$data['profileImg']			= $data['customer']->profileImage();
		$data['belongToPartner']	= \Clients\ClientEntity::get_instance()->getPartnerBelong($data['customer']);
		$data['associate']			= \Clients\ClientEntity::get_instance()->setAssociateCustomer($clientId);
		$data['partner']			= \Clients\ClientEntity::get_instance()->getCustomerPartner();
        $data['customFields']       = $data['customer']->customFieldsData();
		$data['center_column_view']	= 'files';
		$data['file1']				= \Auth::user()->files_1;
		$data['file2']				= \Auth::user()->files_2;
		$data['file3']				= \Auth::user()->files_3;
		$data['file4']				= \Auth::user()->files_4;
		$data['file5']				= \Auth::user()->files_5;
		$data['file6']				= \Auth::user()->files_6;
		$data['customerId']			= $clientId;
		$data['belongsTo']			= \Auth::id();
		$data['customerFiles']		= \CustomerFiles\CustomerFiles::customerFile($clientId);
		$data['clientId']			= $clientId;
		$data 						= array_merge($data,$dashboard_data);
		return \View::make( $data['view_path'] . '.files.summary', $data );
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
		//$file_name = rand(9,99) . '_' . time() . '.' . $fileName->getClientOriginalExtension();
		$file_name = $fileName->getClientOriginalName();
		// upload
		$upload_success = $fileName->move($this->fileFolder, $file_name);
		if($upload_success ){
			return $file_name;
		}
	}

	public function postAjaxUploadFile($file_id, $customer_id){
		$belongs_to = \Auth::id();
		if( \Input::hasFile('files') ){
			foreach(\Input::file('files') as $file){
				$fileName = $this->_doUpload($file);
				$data = array(
					'customer_id' => $customer_id,
					'user_id' => \Auth::id(),
					'filename' => $fileName,
					'name' => $file->getClientOriginalName(),
					'type' => $file_id
				);
				\CustomerFiles\CustomerFilesEntity::get_instance()->createOrUpdate($data);

				return \Response::json(
					array(
						'success'=>true,
						'msg'=>'',
						'redirect'=>url('file/client-file/' . $customer_id),
					)
				);
			}
		}else{
			return \Response::json(array('success'=>false,'msg'=>'Cannot upload, file.'));
		}
	}

	public function postMediaAjaxUploadFile(){
		/*$belongs_to = \Auth::id();
		if( \Input::hasFile('files') ){
			foreach(\Input::file('files') as $file){
				$fileName = $this->_doUpload($file);
				$data = array(
					'customer_id' => $customer_id,
					'user_id' => \Auth::id(),
					'filename' => $fileName,
					'name' => $file->getClientOriginalName(),
					'type' => $file_id
				);
				\CustomerFiles\CustomerFilesEntity::get_instance()->createOrUpdate($data);

				return \Response::json(
					array(
						'success'=>true,
						'msg'=>'',
						'redirect'=>url('file/client-file/' . $customer_id),
					)
				);
			}
		}else{
			return \Response::json(array('success'=>false,'msg'=>'Cannot upload, file.'));
		}*/
	}

	public function postAjaxUpdateName(){
		$data = array(
			'name' => \Input::get('value')
		);
		\CustomerFiles\CustomerFilesEntity::get_instance()->createOrUpdate($data, \Input::get('pk'));
		return \Response::json(array('result'=>true,'message'=>'Success'));
	}

	public function getDeleteFile($id, $customerid){
		$file = \CustomerFiles\CustomerFiles::find($id);
		if( \File::exists(public_path('documents')) ){
			if( \File::isFile( public_path('documents/' . $file->filename) ) ){
				\File::delete(public_path('documents/' . $file->filename));
			}
		}
		if( $file->delete() ){
			\Session::flash('message', 'Successfully Deleted File');
			return \Redirect::to('file/client-file/' . $customerid);
		}else{
			\Session::flash('message', 'Error cannot delete file');
			return \Redirect::to('file/client-file/' . $customerid);
		}
	}

	public function getMediaWidget($user_id, $customer_id = null){
		$data 				= $this->data_view;
		$data['sms_files']	= \SMSFIles\SMSFIles::userId(\Auth::id());
		$data 				= array_merge($data,$this->getSetupThemes());
		return \View::make($data['view_path'] . '.files.partials.media', $data)->render();
	}

}
