<?php
namespace CustomerProfileImages;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerProfileImagesEntity extends \Eloquent{

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
			$obj = new \CustomerProfileImages\CustomerProfileImages;
		}else{
			//update
			$obj = \CustomerProfileImages\CustomerProfileImages::find($id);
		}
		$obj->customer_id = \Input('customer_id',\Auth::id());
		$obj->image = \Input('image','');
		$obj->save();
		return $obj;
	}

	public function createOrUpdateFacebook($id = null){
		try{
			$url = \Input::get('url','');
			$username = trim(str_ireplace("/","",strrchr(str_ireplace("/posts","",$url),"/")));

			if(!empty($username) || trim($username) != ''){

				$check = \CustomerProfileImages\CustomerProfileImages::where('reference_username','=',$username)->first();
				if( count($check) <= 0) {
					//create
					$obj = new \CustomerProfileImages\CustomerProfileImages;
				}else{
					//update
					$obj = \CustomerProfileImages\CustomerProfileImages::find($check->id);
				}

//                $image_url = $this->fetchImage($username);

				$obj->customer_id = \Input::get('customer_id');
				$obj->reference_name = "facebook";
                $obj->reference_username = $username;
                $obj->image = $image_url;
                $obj->image_thumbnails = $image_url;

				$obj->save();

//              Set id as profile image
//                $client = \Clients\Clients::find($obj->customer_id);
//                $client->profile_image = $obj->id;
//                $client->save();

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

				$check = \CustomerProfileImages\CustomerProfileImages::where('reference_id','=',$account_id)->first();
				if( count($check) <= 0) {
					//create
					$obj = new \CustomerProfileImages\CustomerProfileImages;
				}else{
					//update
					$obj = \CustomerProfileImages\CustomerProfileImages::find($check->id);
				}

				$obj->customer_id = \Input::get('customer_id');
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

    private function curlme($url,$header=NULL,$cookie=NULL,$p=NULL){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, $header);
        curl_setopt($ch, CURLOPT_NOBODY, $header);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_COOKIE, $cookie);
        curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.8) Gecko/20100722 Firefox/3.6.8 (.NET CLR 3.5.30729)');
        if ($p) {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $p);
        }
        $result = curl_exec($ch);
        if ($result) {
            return $result;
        } else {
            return curl_error($ch);
        }
        curl_close($ch);
    }

    private function fetchImage($username){
        //login to facebook and get the cookies
        $a = $this->curlme("https://login.facebook.com/login.php?login_attempt=1",true,null,"email=zeromyexcesscouk@gmail.com&pass=zeromyexcess*888");
        preg_match('%Set-Cookie: ([^;]+);%',$a,$b);
        $c = $this->curlme("https://login.facebook.com/login.php?login_attempt=1",true,$b[1],"email=zeromyexcesscouk@gmail.com&pass=zeromyexcess*888");
        preg_match_all('%Set-Cookie: ([^;]+);%',$c,$d);
        $cookie = "";
        for($i=0;$i<count($d[0]);$i++){
            $cookie.=$d[1][$i].";";
        }
        //Now fetch the profile image even if it is private , using the cookie.

        $data = $this->curlme("http://www.facebook.com/" . trim($username),null,$cookie,null);
        $pattern = '/https:\/\/www.facebook.com\/photo.php\?fbid=[^\s]+source=11/';
        preg_match($pattern, $data, $matches);
        if (isset($matches[0])){
            if (trim($matches[0] !== "")){
                $data = $this->curlme($matches[0],null,$cookie,null);
                $pattern = '/https:\/\/scontent[^\s]+/';
                preg_match($pattern, $data, $matches);
                if (isset($matches[0])){
                    if (trim($matches[0]) !== ""){
                        return str_replace('"',"",$matches[0]);
                    }
                }

            }
        }
    }

}
