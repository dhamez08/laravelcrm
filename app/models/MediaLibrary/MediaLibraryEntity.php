<?php
namespace MediaLibrary;
/**
 * main model for Clients
 * */

class MediaLibraryEntity extends \Eloquent{
	/**
	 * Instance of this class.
	 *
	 * @var      object
	 */
	protected static $instance = null;

	protected $modal_options;

	public function __construct(){

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
	 * Options display
	 * - this is usefull for the tab
	 * - more info later
	 * */
	public function displayOptions(){
		$options = array(
			'show_files_tab' => true
		);
		return (object)$options;
	}
}
