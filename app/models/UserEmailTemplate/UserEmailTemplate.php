<?php
namespace UserEmailTemplate;

class UserEmailTemplate extends \Eloquent {

    protected $table = 'user_email_template';

    public function user()
    {
        return $this->belongsTo('\User\User', 'id', 'user_id');
    }

}