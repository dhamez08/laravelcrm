<?php
namespace CustomerURL;
/**
 * Clients Controller
 *
 * */

class CustomerURLController extends \BaseController {

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
	* I call this postAddressWrapper cause it is call in another controller
	* the $data is for \Input::all()
	* each $data is defined
   	* @param 	$clientId 	 	integer
	* - the id of the client, foreign key
	* @param 	$url 	 	alphanumeric
	* - actual url
	* @param 	$type 	 		string
	* - what is the url for
	* @param 	$id 			integer or null
	* - the current database id of the phone
	* - if null then create, else update
	* @return eloquent orm
	 * */
	public function postURLWrapper($clientId, $url, $website, $type, $id = null){
		if ($url != "") {
			if ((substr($url,0,7)!="http://") && (substr($url,0,8)!="https://")) {
				$url = "http://".$url;
			}
		}
		\Input::merge(
			array(
				'customer_id'=>$clientId,
				'url'=>$url,
				'website'=>$website,
				'type'=>$type,
			)
		);
		if( is_null($id) ){
			if($website == "Facebook"){
				$image = \CustomerProfileImages\CustomerProfileImagesEntity::get_instance()->createOrUpdateFacebook();
			}
			return \CustomerUrl\CustomerUrlEntity::get_instance()->createOrUpdate();
		}else{
			if($website == "Facebook"){
				$image = \CustomerProfileImages\CustomerProfileImagesEntity::get_instance()->createOrUpdateFacebook($id);
			}
			return \CustomerUrl\CustomerUrlEntity::get_instance()->createOrUpdate($id);
		}

	}

	/**
	* This is use to iterate phone input,
	* when adding phone.
	*
	* @param 	$arrayInput 	array
	* - this is the name of the input array
	* @param 	$clientId 	 	integer
	* - the id of the client, foreign key
	* @param 	$id 			integer or null
	* - the current database id of the phone
	* - if null then create, else update
	* @return 	false | eloquent resource 	if $arrayInput is zero,
	*										else return as eloquent resource
	*/
	public function iterateURLInput(
		$arrayInput ,
		$clientId
	){
		if( count( $arrayInput ) > 0 ){
			foreach( $arrayInput as $key => $val ){
				if( trim($val['url']) != '' ){
					$this->postURLWrapper(
						$clientId,
						$val['url'],
						$val['for'],
						$val['is'],
						isset($val['id']) ? $val['id']:null
					);
				}
			}
		}else{
			return false;
		}
	}

}
