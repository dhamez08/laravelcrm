<?php
namespace UserMeta;

class UserMetaEntity extends \Eloquent {

	protected static $instance = null;

	protected $guarded = array('id');

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
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \UserMeta\UserMeta;
		}else{
			//update
			$obj = \UserMeta\UserMeta::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}else{
			return false;
		}
	}

	/*
	 * This get user meta
	 *
	 * @param int $user_id required
	 *
	 * @param string|mix @meta_key
	 *
	 * @param boolean $single whether to display it as single or Associative Array
	 * - If the $meta_key is empty default to Array
	 *
	 * @return Associative Array | String
	 * */
	public function getUserMeta($user_id, $meta_key = '', $single = false)
	{
		$data = '';

		$user_meta = \UserMeta\UserMeta::userId($user_id);

		if( $meta_key != '' )
		{
			$user_meta = \UserMeta\UserMeta::userId($user_id)->metaKey($meta_key);
		}
		if( $user_meta->count() > 0 ){
			if( $single && $meta_key != '')
			{
				$data = $user_meta->pluck('meta_value');
			}else{
				$get = $user_meta->get()->toArray();

				if( $meta_key == '' ){
					$data = $get;
				}else{
					$data = $get[0];
				}

			}
			return $data;
		}else{
			return false;
		}
	}
}
