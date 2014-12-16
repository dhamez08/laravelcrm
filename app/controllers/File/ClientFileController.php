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
		$this->data_view['html_body_class'] = 'page-header-fixed page-quick-sidebar-over-content page-container-bg-solid';
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
		array_set($dashboard_data,'html_body_class','page-header-fixed page-quick-sidebar-over-content page-container-bg-solid');

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
		$data['customerFiles']		= \CustomerFiles\CustomerFiles::customerFile($clientId)->orderBy('created_at', 'desc');
		$data['clientId']			= $clientId;
		$data['tasks']				= \CustomerTasks\CustomerTasksEntity::get_instance()->getTaskUser($data['customerId'], $data['belongsTo']);
		$data['files_count']		= \CustomerFiles\CustomerFiles::CustomerFile($data['clientId'])->count();
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

	public function postAjaxAddFileIntegration(){
		// copy file from file integration
		$dropbox_file = \Input::get('filename');
		$dropbox_base_file_name = basename($dropbox_file);
		$file = strtolower($dropbox_base_file_name);
		$file = preg_replace('/\s+/', '_', $file);
		$rep_array = array('%20','%28','%27','%29');
		$file = str_replace($rep_array, '_', $file);
		$new_file_name = \Auth::id() . '_' . $file;
		$destination = $this->fileFolder . '/' . preg_replace('/\s+/', '_', $new_file_name);

		\CustomerFiles\CustomerFilesEntity::get_instance()->copyRemoteFile($dropbox_file, $destination);

		// save file
		$data = array(
			'customer_id' => \Input::get('customer_id'),
			'user_id' => \Auth::id(),
			'filename' => $new_file_name,
			'name' => $new_file_name,
			'type' => \Input::get('file_type'),
			'integration' => \Input::get('integrate')
		);
		\CustomerFiles\CustomerFilesEntity::get_instance()->createOrUpdate($data);
		return \Response::json(
			array(
				'success'=>true,
				'msg'=>'',
				'redirect'=>url('file/client-file/' . \Input::get('customer_id')),
			)
		);
		die();
	}

	public function postAjaxUploadFile($file_type, $customer_id, $page = ""){
		$belongs_to = \Auth::id();
		if( \Input::hasFile('files') ){
			$file_id = \Input::get('file_type');
			foreach(\Input::file('files') as $file){
				$fileName = $this->_doUpload($file);
				$data = array(
					'customer_id' => $customer_id,
					'user_id' => \Auth::id(),
					'filename' => $fileName,
					'name' => $file->getClientOriginalName(),
					'type' => $file_type
				);
				\CustomerFiles\CustomerFilesEntity::get_instance()->createOrUpdate($data);

				if(!empty($page) && $page == "client_summary"){
					return \Response::json(
						array(
							'success'=>true,
							'msg'=>'',
							'redirect'=>url('clients/client-summary/' . $customer_id),
						)
					);
				}

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

	public function postOnAjaxUploadFile($file_id, $customer_id, $page = ""){
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

				if(!empty($page) && $page == "client_summary"){
					return \Response::json(
						array(
							'success'=>true,
							'msg'=>'',
							'redirect'=>url('clients/client-summary/' . $customer_id),
						)
					);
				}

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
		die();
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

	public function getSearch($client){
		$input = \Input::get('file_search_value');
		$sql = \CustomerFiles\CustomerFiles::CustomerFile($client);
		if(!empty($input) && $input != ''){
			$sql = $sql->where("filename","like","%$input%");
		}
		$sql = $sql->orderBy('id','desc')->get();

		return \Response::json($sql);
	}

	public function getDeleteFileSummary($id, $customerid){
		$file = \CustomerFiles\CustomerFiles::find($id);

		if( \File::exists(public_path('documents')) ){
			if( \File::isFile( public_path('documents/' . $file->filename) ) ){
				\File::delete(public_path('documents/' . $file->filename));
			}
		}
		if( $file->delete() ){
			\Session::flash('message', 'Successfully Deleted File');
			return \Redirect::to('clients/client-summary/' . $customerid);
		}else{
			\Session::flash('message', 'Error cannot delete file');
			return \Redirect::to('clients/client-summary/' . $customerid);
		}
	}
}
