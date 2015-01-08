<?php
namespace SocialMediaAccount;


class ProfileEntity extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'profiles';

    protected $profile_model;

    protected static $instance = null;

    public function __construct(){

    }

    /**
     * Return an instance of this class.
     *
     * @return    object    A single instance of this class.
     */
    public static function get_instance()
    {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function checkProfile($identifier,$provider){
        if(empty($identifier) || empty($provider)) {
            return FALSE;
        }
        $check = \SocialMediaAccount\Profile::where('identifier','=',$identifier)->where('provider','=',$provider)->first();

        return (count($check) > 0 ) ? $check: FALSE;
    }

    public function checkProfileEmail($email){
        if(empty($email)){
            return FALSE;
        }

        $check = \User\User::where('email','=',$email)->first();
        return (count($check) > 0) ? $check->id: FALSE;
    }

    public function createNewUser($profile){
        $user 					= new \User\User;
        $user->first_name 		= (isset($profile->firstName)) ? $profile->firstName : "";
        $user->last_name 		= (isset($profile->lastName)) ? $profile->lastName : "";
        $user->email 			= (isset($profile->email)) ? $profile->email : "";
        $user->telephone 		= (isset($profile->phone)) ? $profile->phone : "";
        $user->address_line 	= (isset($profile->address)) ? $profile->address : "";
        $user->address_town 	= (isset($profile->city)) ? $profile->city : "";
        $user->address_county 	= (isset($profile->country)) ? $profile->country : "";
        $user->address_postcode = (isset($profile->zip)) ? $profile->zip : "";
        $user->active 			= 1;

        if($user->save()){
            return $user->id;
        } else {
            return FALSE;
        }
    }

    public function createNewProfile($user_id,$provider,$profile){
        $newProfile = new \SocialMediaAccount\Profile;
        $newProfile->user_id        = $user_id;
        $newProfile->provider       = $provider;
        $newProfile->identifier     = (isset($profile->identifier)) ? $profile->identifier : "";
        $newProfile->webSiteURL     = (isset($profile->webSiteURL)) ? $profile->webSiteURL : "";
        $newProfile->profileURL     = (isset($profile->profileURL)) ? $profile->profileURL : "";
        $newProfile->photoURL       = (isset($profile->photoURL)) ? $profile->photoURL : "";
        $newProfile->displayName    = (isset($profile->displayName)) ? $profile->displayName : "";
        $newProfile->description    = (isset($profile->description)) ? $profile->description : "";
        $newProfile->firstName      = (isset($profile->firstName)) ? $profile->firstName : "";
        $newProfile->lastName       = (isset($profile->lastName)) ? $profile->lastName : "";
        $newProfile->gender         = (isset($profile->gender)) ? $profile->gender : "";
        $newProfile->language       = (isset($profile->language)) ? $profile->language : "";
        $newProfile->age            = (isset($profile->age)) ? $profile->age : "";
        $newProfile->birthDay       = (isset($profile->birthDay)) ? $profile->birthDay : "";
        $newProfile->birthMonth     = (isset($profile->birthMonth)) ? $profile->birthMonth : "";
        $newProfile->birthYear      = (isset($profile->birthYear)) ? $profile->birthYear : "";
        $newProfile->email          = (isset($profile->email)) ? $profile->email : "";
        $newProfile->emailVerified  = (isset($profile->emailVerified)) ? $profile->emailVerified : "";
        $newProfile->phone          = (isset($profile->phone)) ? $profile->phone : "";
        $newProfile->address        = (isset($profile->address)) ? $profile->address : "";
        $newProfile->country        = (isset($profile->country)) ? $profile->country : "";
        $newProfile->region         = (isset($profile->region)) ? $profile->region : "";
        $newProfile->city           = (isset($profile->city)) ? $profile->city : "";
        $newProfile->zip            = (isset($profile->zip)) ? $profile->zip : "";
        $newProfile->username       = (isset($profile->username)) ? $profile->username : "";
        $newProfile->coverInfoURL   = (isset($profile->coverInfoURL)) ? $profile->coverInfoURL : "";

        if($newProfile->save()){
            return $newProfile->id;
        } else {
            return FALSE;
        }
    }

    public function getSocialProfile($identifier = "",$provider = ""){
        if(empty($identifier) || empty($provider)){
            if(\Session::has('identifier') && \Session::has('provider')){
                $identifier = \Session::get('identifier');
                $provider = \Session::get('provider');
            } else {
                return FALSE;
            }
        }

        $profile = \SocialMediaAccount\Profile::where('identifier','=',$identifier)
                                                ->where('provider','=',$provider)
                                                ->first();
        return (count($profile) > 0) ? $profile: FALSE;
    }

    public function updateSocialProfile($id,$profile){
        if(empty($id) || empty($profile)){
            return FALSE;
        }
        $socialProfile = \SocialMediaAccount\Profile::find($id);
        $socialProfile->webSiteURL     = (isset($profile->webSiteURL)) ? $profile->webSiteURL : "";
        $socialProfile->profileURL     = (isset($profile->profileURL)) ? $profile->profileURL : "";
        $socialProfile->photoURL       = (isset($profile->photoURL)) ? $profile->photoURL : "";
        $socialProfile->displayName    = (isset($profile->displayName)) ? $profile->displayName : "";
        $socialProfile->description    = (isset($profile->description)) ? $profile->description : "";
        $socialProfile->firstName      = (isset($profile->firstName)) ? $profile->firstName : "";
        $socialProfile->lastName       = (isset($profile->lastName)) ? $profile->lastName : "";
        $socialProfile->gender         = (isset($profile->gender)) ? $profile->gender : "";
        $socialProfile->language       = (isset($profile->language)) ? $profile->language : "";
        $socialProfile->age            = (isset($profile->age)) ? $profile->age : "";
        $socialProfile->birthDay       = (isset($profile->birthDay)) ? $profile->birthDay : "";
        $socialProfile->birthMonth     = (isset($profile->birthMonth)) ? $profile->birthMonth : "";
        $socialProfile->birthYear      = (isset($profile->birthYear)) ? $profile->birthYear : "";
        $socialProfile->email          = (isset($profile->email)) ? $profile->email : "";
        $socialProfile->emailVerified  = (isset($profile->emailVerified)) ? $profile->emailVerified : "";
        $socialProfile->phone          = (isset($profile->phone)) ? $profile->phone : "";
        $socialProfile->address        = (isset($profile->address)) ? $profile->address : "";
        $socialProfile->country        = (isset($profile->country)) ? $profile->country : "";
        $socialProfile->region         = (isset($profile->region)) ? $profile->region : "";
        $socialProfile->city           = (isset($profile->city)) ? $profile->city : "";
        $socialProfile->zip            = (isset($profile->zip)) ? $profile->zip : "";
        $socialProfile->username       = (isset($profile->username)) ? $profile->username : "";
        $socialProfile->coverInfoURL   = (isset($profile->coverInfoURL)) ? $profile->coverInfoURL : "";

        if($socialProfile->save()){
            return $socialProfile;
        } else {
            return FALSE;
        }
    }

    public function getMediaAccount(){
        $account = \SocialMediaAccount\Profile::where('user_id','=',\Auth::id())->get();
        return $account;
    }

    public function getConnectedProviders(){
        $connected = \SocialMediaAccount\Profile::where('user_id','=',\Auth::id())->select('provider')->get();
        $p = array();
        if(count($connected)){
           foreach($connected as $net => $social){
               $p[] = $social['provider'];
           }
        }
        return $p;
    }

    public function getPrimaryAvatar(){
        $check = \SocialMediaAccount\ProfilePrimary::where("user_id","=",\Auth::id())->first();
        if(count($check) > 0){
            $profile = \SocialMediaAccount\Profile::find($check->profile_id);
            return $profile->photoURL;
        } else {
            return url('public/img/profile_images/profile.jpg');
        }
    }
}
?>
