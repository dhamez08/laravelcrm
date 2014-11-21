<?php
namespace CustomerFiles;
/**
 * A wrapper for the Clients Model
 * */
use Carbon\Carbon;
class CustomerFilesEntity extends \Eloquent{

	protected static $instance = null;

	protected $table = 'customer_files';

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
	public function createOrUpdate($arrayData = array(), $id = null){
		if( is_null($id) ) {
			//create
			$obj = new \CustomerFiles\CustomerFiles;
		}else{
			//update
			$obj = \CustomerFiles\CustomerFiles::find($id);
		}
		if( count($arrayData) > 0 ){
			foreach($arrayData as $key=>$val){
				$obj->$key = $val;
			}
			$obj->save();
			return $obj;
		}
	}

	public function getFilesByClient($client_id) {
		return $this
				->where('customer_id', $client_id)
				->whereNull('deleted_at')
				->orderBy('created_at')
				->get();
	}

	public function saveFormDataFromCustomTab() {

		$form = new $this;

		$form->customer_id = \Input::get('customer_id');
		$form->filename = \Input::get('filename');
		$form->name = \Input::get('name');
		$form->type = 1;
		$form->save();

		return $form;
	}


	public function copyRemoteFile($remote_file, $destination){
		copy($remote_file, $destination);
	}

	public function _copyRemoteFile($remote_file, $destination){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $remote_file);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

		$data = curl_exec($ch);
		curl_close($ch);

		if ($data) {
			$fp = fopen($destination, 'wb');

			if ($fp) {
				fwrite($fp, $data);
				fclose($fp);
			} else {
				fclose($fp);
				return false;
			}
		} else {
			return false;
		}

		return true;
	}

}
