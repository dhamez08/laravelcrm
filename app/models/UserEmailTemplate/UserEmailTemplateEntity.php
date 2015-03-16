<?php
namespace EmailTemplate;

use \Illuminate\Database\Eloquent\SoftDeletingTrait;

class UserEmailTemplateEntity extends \Eloquent{

    use SoftDeletingTrait;

    protected $table = 'user_email_template';

    protected static $instance = null;

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
            ->where('user_id', \Auth::id())
            ->orderBy('created_at')
            ->get();
    }

}
