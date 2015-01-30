<?php
namespace EmailTemplate;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class EmailTemplateEntity extends \Eloquent{

	use SoftDeletingTrait;

	protected $table = 'email_templates';
	
	protected static $instance = null;

	//protected $dates = ['deleted_at'];

	public function __construct()
	{
	

	}

	/**
	 * Return an instance of this class.
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() 
	{
		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function getTemplatesByLoggedUser() {
		return $this
				->where('belongs_to', \Auth::id())
                ->where('type',1)
				->orderBy('name')
				->get();
	}

}
