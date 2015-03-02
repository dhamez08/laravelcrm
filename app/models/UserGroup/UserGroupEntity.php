<?php
namespace UserGroup;
/**
 * Base class for user group entity
 * */
class UserGroupEntity extends \Eloquent{

	protected static $instance = null;
	/**
	 * The folder destination of the company logo
	 * @var	string
	 * @return	string
	 * */
	protected $companyLogoFolder;
	/**
	 * the prefix of the new company logo name
	 * after upload
	 * */
	protected $prefixCompanyLogoName;

	public function __construct(){
		$this->companyLogoFolder 	 = public_path() . '/img/company_logos';
		$this->prefixCompanyLogoName = 'logo_';
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
	/**
	 * Create User Group
	 *
	 * @param	$user_id	int		the user id to where manager it belong
	 * @return	object
	 * */
	public function createGroup($user_id, $otherData = array()){
		$userGroup = new \UserGroup\UserGroup;
		$userGroup->manager_id = $user_id;

		if(count($otherData) > 0) {
			foreach($otherData as $odKey => $odVal) {
				$userGroup->$odKey = $odVal;
			}
		}

		$userGroup->save();
		return $userGroup;
	}

	/**
	 * get the destination folder for company logo
	 * @return	string
	 * */
	public function getDestinationFolderCompanyLogo(){
	 return $this->companyLogoFolder;
	}

	/**
	 * get the logo prefix name
	 * @return	string
	 * */
	public function getPrefixCompanyLogoName(){
	 return $this->prefixCompanyLogoName;
	}

	/**
	 * get the logo of the user group
	 * @param	$manager_id		int 	the owner of the group
	 * @return 	object | query
	 * */
	public function getLogo($manager_id){

	}

	/**
	 * This is a helper to upload logo
	 *
	 * @param	$groupID	int		id of the group
	 * @see method updateLogo
	 * @return filename
	 * */
	private function _uploadLogo($groupID){
		// set the file name
		// prefix first
		// group id
		// time
		$file_name = $this->getPrefixCompanyLogoName() . $groupID . '_' . time() . '.' . \Input::file('logo')->getClientOriginalExtension();
		// upload
		$upload_success = \Input::file('logo')->move($this->getDestinationFolderCompanyLogo(), $file_name);
		if($upload_success ){
			return $file_name;
		}
	}

	/**
	 * this will update the logo of the group
	 * @return boolean
	 * */
	public function updateLogo(){
		//we get the group of the current user
		$group = \User\User::find( \Auth::user()->id )->userToGroup()->first();
		$fileName = $this->_uploadLogo($group->group_id);
		if( $fileName ) {
			$userGroup = \UserGroup\UserGroup::find($group->group_id);
			$userGroup->logo = $fileName;
			$userGroup->save();
			return $userGroup;
		}
	}

	public function createVMDAccount($company, $notification = null)
	{
		if(is_null($notification)) {
			$notification = url('api/vmd-shared');
		}

		// send over request
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,"http://www.viewmydocuments.co.uk/api/providerCreate");
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "provider_company=". $company ."&provider_notification=". $notification ."");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		\Debugbar::info($response);
		curl_close($ch);
		if ($response) {
			$results = json_decode($response, true);
			return $results;
		} else {
			return false;			
		}	
	}

}
