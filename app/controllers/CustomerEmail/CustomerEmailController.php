<?php
namespace CustomerEmail;
/**
 * Clients Controller
 *
 * */

class CustomerEmailController extends \BaseController {

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
	* I call this postEmailWrapper cause it is call in another controller
	* the $data is for \Input::all()
	* each $data is defined
  	* @param 	$clientId 	 	integer
	* - the id of the client, foreign key
	* @param 	$number 	 	alphanumeric
	* - actual email
	* @param 	$type 	 		string
	* - what is the email for
	* @param 	$id 			integer or null
	* - the current database id of the phone
	* - if null then create, else update
	* @return eloquent orm
	 * */
	public function postEmailWrapper($clientId, $email, $type, $id = null){
		\Input::merge(
			array(
				'customer_id'=>$clientId,
				'email'=>$email,
				'type'=>$type,
			)
		);
		if( is_null($id) ){
			return \CustomerEmail\CustomerEmailEntity::get_instance()->createOrUpdate();
		}else{
			return \CustomerEmail\CustomerEmailEntity::get_instance()->createOrUpdate($id);
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
	public function iterateEmailInput( 
		$arrayInput ,
		$clientId
	){
		if( count( $arrayInput ) > 0 ){
			foreach( $arrayInput as $key => $val ){
				if( trim($val['mail']) != '' ){
					$this->postEmailWrapper(
						$clientId,
						$val['mail'],
						$val['for'],
						isset($val['id']) ? $val['id']:null
					);
				}
			}
		}else{
			return false;			
		}
	}

}
