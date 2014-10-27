<?php
namespace Textlocal;
/**
 * main model for Clients
 * */

class TextlocalEntity extends \Eloquent{
	protected static $instance = null;

	protected $textlocal_api;

	protected $textlocal_login;

	protected $textlocal_hash;

	public function __construct(){
		$this->textlocal_login = \Config::get('crm.textlocal.api.login');
		$this->textlocal_hash = \Config::get('crm.textlocal.api.hashcode');
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

	public function apiTextlocal(){
		$this->textlocal_api = new \helpers\Textlocal($this->textlocal_login, $this->textlocal_hash);
	}

	public function getObjectResult(){
		return $this->textlocal_api;
	}

	public function getUsers(){
		 return $this->getObjectResult()->getUsers();
	}

}
