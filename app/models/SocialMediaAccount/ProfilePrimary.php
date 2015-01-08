<?php
/**
 * Created by PhpStorm.
 * User: dicklague
 * Date: 1/8/15
 * Time: 4:44 PM
 */

namespace SocialMediaAccount;


class ProfilePrimary extends \Eloquent  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_primary_profile';

    protected $fillable = array("user_id","profile_id");
}