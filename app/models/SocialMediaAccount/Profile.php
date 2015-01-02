<?php
namespace SocialMediaAccount;

class Profile extends \Eloquent  {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    protected $fillable = array(
        'user_id',
        'provider',
        'identifier',
        'webSiteURL',
        'profileURL',
        'photoURL',
        'displayName',
        'description',
        'firstName',
        'lastName',
        'gender',
        'language',
        'age',
        'birthDay',
        'birthMonth',
        'birthYear',
        'email',
        'emailVerified',
        'phone',
        'address',
        'country',
        'region',
        'city',
        'zip',
        'username',
        'coverInfoURL'
    );

    public function user() {
        return $this->belongsTo('User');
    }
}
?>
