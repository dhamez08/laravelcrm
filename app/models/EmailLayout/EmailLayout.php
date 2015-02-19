<?php
namespace EmailLayout;
/**
 * main model for Clients
 * */

class EmailLayout extends \Eloquent{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'system_email_layout';

    public function section(){
        return $this->hasMany('\EmailLayout\EmailLayoutSection','layout_id','id');
    }

}
