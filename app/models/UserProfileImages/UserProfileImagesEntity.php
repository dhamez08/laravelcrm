<?php
namespace UserProfileImages;
/**
 * A wrapper for the UserProfileImages Model
 * */
use Carbon\Carbon;
class UserProfileImagesEntity extends \Eloquent{

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

	/**
	 * This is use to create user or update
	 * this is full field, mainly use in register
	 *
	 * @param 	$id		int		default null		if there is id then update, else create
	 * @param	$active	int		default 2			#2 means not active
	 * 												#1 would be active
	 * @return db last insert id
	 * */
	public function createOrUpdate($id = null){
		if( is_null($id) ) {
			//create
			$obj = new \UserProfileImages\UserProfileImages;
		}else{
			//update
			$obj = \UserProfileImages\UserProfileImages::find($id);
		}
		$obj->user_id = \Input('user_id',\Auth::id());
		$obj->image = \Input('image','');
		$obj->save();
		return $obj;
	}

	public function createOrUpdateFacebook($id = null){
		try{
			$url = \Input::get('url','');
			$username = trim(str_ireplace("/","",strrchr(str_ireplace("/posts","",$url),"/")));
			if(is_numeric($username)){
				$account_id = $username;
			} else {
				$account = $this->_get_content("https://graph.facebook.com/v1.0/".$username."?fields=id,name");
				$account_id = (isset($account['id'])) ? $account['id'] : '';
			}

			if(!empty($account_id) || trim($account_id) != ''){
				$photo_200 = $this->_get_content("https://graph.facebook.com/v2.2/".$account_id."/picture?redirect=0&height=200&type=normal&width=200");
				$photo_100 = $this->_get_content("https://graph.facebook.com/v2.2/".$account_id."/picture?redirect=0&height=100&type=normal&width=100");

				$check = \UserProfileImages\UserProfileImages::where('reference_id','=',$account_id)->first();
				if( count($check) <= 0) {
					//create
					$obj = new \UserProfileImages\UserProfileImages;
				}else{
					//update
					$obj = \UserProfileImages\UserProfileImages::find($check->id);
				}

				$obj->user_id = \Input::get('user_id');
				$obj->reference_name = "facebook";
				$obj->reference_id = $account_id;
				$obj->image = $photo_200['data']['url'];
				$obj->image_thumbnails = $photo_100['data']['url'];

				$obj->save();

				return $obj;
			} else {
				return -1;
			}
		} catch(Exception $e){
			return -1;
		}
	}

	public function createOrUpdateTwitter($id = null){
		try{
			$url = \Input::get('url','');
			$username = trim(str_ireplace("/","",strrchr(str_ireplace("/posts","",$url),"/")));
			if(is_numeric($username)){
				$account_id = $username;
			} else {
				$account = \Twitter\Twitter::get_instance()->getProfile($username);
				$account_id = (isset($account->id)) ? $account->id : '';
			}

			if(!empty($account_id) || trim($account_id) != ''){
				$photo_200 = str_ireplace("_normal","",$account->profile_image_url);
				$photo_100 = $account->profile_image_url;

				$check = \UserProfileImages\UserProfileImages::where('reference_id','=',$account_id)->first();
				if( count($check) <= 0) {
					//create
					$obj = new \UserProfileImages\UserProfileImages;
				}else{
					//update
					$obj = \UserProfileImages\UserProfileImages::find($check->id);
				}

				$obj->user_id = \Input::get('user_id');
				$obj->reference_name = "twitter";
				$obj->reference_id = $account_id;
				$obj->image = $photo_200;
				$obj->image_thumbnails = $photo_100;

				$obj->save();

				return $obj;
			} else {
				return -1;
			}
		} catch(Exception $e){
			return -1;
		}
	}

	protected function _get_content($url){

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_SSLVERSION, 4);
		curl_setopt($ch, CURLOPT_SSL_CIPHER_LIST, 'SSLv3');

		$exec = curl_exec($ch);

		return json_decode($exec,TRUE);
	}

}
