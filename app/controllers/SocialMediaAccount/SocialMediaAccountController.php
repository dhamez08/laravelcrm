<?php
namespace SocialMediaAccount;

class SocialMediaAccountController extends \BaseController{
        public function __construct(\Hybrid_Auth $hybridAuth)
        {
            parent::__construct();

            $this->hybridAuth = $hybridAuth;

            $this->userGroupEntity 		= new \UserGroup\UserGroupEntity;
            $this->userToGroupEntity 	= new \UserToGroup\UserToGroupEntity;
            $this->SubscriptionEntity 	= new \Subscription\SubscriptionEntity;
        }

        public function getAuth($action = ""){
            $provider = $action;

            if($action == "auth"){
                try {
                    \Hybrid_Endpoint::process();
                } catch (\Exception $e) {
                    return $e->getMessage();
                }
            } else {
                try{
                    $adapter = $this->hybridAuth->authenticate($provider);
                    $userProfile = $adapter->getUserProfile();

                    if(\Auth::check()) {
                        $check_profile = \SocialMediaAccount\ProfileEntity::get_instance()->checkProfile($userProfile->identifier, $provider);
                        if ($check_profile == FALSE) {
                            $saveSocialProfile = \SocialMediaAccount\ProfileEntity::get_instance()->createNewProfile(\Auth::id(), $provider, $userProfile);
                            \Session::flash('alertClass','success');
                            \Session::flash('message', 'Success! You manage to linked your ' . ucfirst($provider) . ' Account.');
                        } else {
                            \Session::flash('alertClass','danger');
                            \Session::flash('message', 'Error! '. ucfirst($provider) . ' Account was already in used.');
                        }

                        \Session::flash('profile','account-settings');
                        \Session::flash('account-settings','social-profile');

                        return \Redirect::to('profile');
                    } else {

                        \Session::put('provider', $provider);
                        \Session::put('identifier', $userProfile->identifier);

                        $check_profile = \SocialMediaAccount\ProfileEntity::get_instance()->checkProfile($userProfile->identifier, $provider);
                        if ($check_profile == FALSE) {
                            $check_email = \SocialMediaAccount\ProfileEntity::get_instance()->checkProfileEmail($userProfile->email);
                            if ($check_email == FALSE) {
                                $newUser = \SocialMediaAccount\ProfileEntity::get_instance()->createNewUser($userProfile);
                                if ($newUser != FALSE) {
                                    $newProfile = \SocialMediaAccount\ProfileEntity::get_instance()->createNewProfile($newUser, $provider, $userProfile);

                                    $ch = \SocialMediaAccount\ProfilePrimary::where("user_id",'=',$newUser)->first();
                                    if(count($ch) > 0){
                                        $setPrimary = \SocialMediaAccount\ProfilePrimary::find($ch->id);
                                        $setPrimary->profile_id = $newProfile;
                                        $setPrimary->save();
                                    } else {
                                        $setPrimary = new \SocialMediaAccount\ProfilePrimary;
                                        $setPrimary->user_id = $newUser;
                                        $setPrimary->profile_id = $newProfile;
                                        $setPrimary->save();
                                    }

                                    $userGroup = $this->userGroupEntity->createGroup($newUser);
                                    $userToGroup = $this->userToGroupEntity->createUserToGroup($newUser, $userGroup->id);
                                    $subscription = $this->SubscriptionEntity->createSubscription($newUser);

                                    $user = \User\User::find($newUser);
                                    \Auth::login($user);

                                    $group = $user->userToGroup()->first();
                                    \Session::put('group_id', $group->group_id);
                                    \Session::put('role', $group->role);
                                    \Session::flash('message', 'Success! You manage to loggedin using your ' . ucfirst($provider) . ' Account. Please Update your Profile Information, Specially your credential Information for security reason.');

                                    return \Redirect::to('profile#tab_account_setting');

                                } else {
                                    return "ERROR 2";
                                }
                            } else {
                                $newProfile = \SocialMediaAccount\ProfileEntity::get_instance()->createNewProfile($check_email, $provider, $userProfile);
                                $user = \User\User::find($check_email);
                                \Auth::login($user);

                                $ch = \SocialMediaAccount\ProfilePrimary::where("user_id",'=',$user->id)->first();
                                if(count($ch) > 0){
                                    $setPrimary = \SocialMediaAccount\ProfilePrimary::find($ch->id);
                                    $setPrimary->profile_id = $newProfile;
                                    $setPrimary->save();
                                } else {
                                    $setPrimary = new \SocialMediaAccount\ProfilePrimary;
                                    $setPrimary->user_id = $user->id;
                                    $setPrimary->profile_id = $newProfile;
                                    $setPrimary->save();
                                }

                                $group = $user->userToGroup()->first();
                                \Session::put('group_id', $group->group_id);
                                \Session::put('role', $group->role);

                                \Session::flash('message', 'Success! You manage to loggedin using your ' . ucfirst($provider) . ' Account.');
                                return \Redirect::intended('/');
                            }
                        } else {
                            $profileUpdate = \SocialMediaAccount\ProfileEntity::get_instance()->updateSocialProfile($check_profile->id, $userProfile);

                            $user = \User\User::find($check_profile->user_id);
                            \Auth::login($user);

                            $ch = \SocialMediaAccount\ProfilePrimary::where("user_id",'=',$check_profile->user_id)->first();
                            if(count($ch) > 0){
                                $setPrimary = \SocialMediaAccount\ProfilePrimary::find($ch->id);
                                $setPrimary->profile_id = $check_profile->id;
                                $setPrimary->save();
                            } else {
                                $setPrimary = new \SocialMediaAccount\ProfilePrimary;
                                $setPrimary->user_id = $check_profile->user_id;
                                $setPrimary->profile_id = $check_profile->id;
                                $setPrimary->save();
                            }

                            $group = $user->userToGroup()->first();
                            \Session::put('group_id', $group->group_id);
                            \Session::put('role', $group->role);
                            \Session::flash('message', 'Success! You manage to loggedin using your ' . ucfirst($provider) . ' Account.');

                            return \Redirect::intended('/');

                        }
                    }
                } catch(\Exeption $e){
                    return $e->getMessage();
                }
            }
        }

    public function getSetPrimary(){
        $profile = \Input::get('id','');
        if(empty($profile)){
            return \Response::json(array("status" => FALSE));
        }

        $chck = \SocialMediaAccount\Profile::where("id","=",$profile)->where("user_id","=",\Auth::id())->first();
        if(count($chck) > 0){
            $primary = \SocialMediaAccount\ProfilePrimary::where("user_id","=",\Auth::id())->first();
            if(count($primary) > 0){
                $setPrimary = \SocialMediaAccount\ProfilePrimary::find($primary->id);
                $setPrimary->profile_id = $profile;
                $setPrimary->save();
            } else {
                $setPrimary = new \SocialMediaAccount\ProfilePrimary;
                $setPrimary->profile_id = $profile;
                $setPrimary->user_id = \Auth::id();
                $setPrimary->save();
            }

            return \Response::json(array("status" => TRUE,"profile"=>$chck));
        } else {
            return \Response::json(array("status" => FALSE));
        }
    }
}
?>
