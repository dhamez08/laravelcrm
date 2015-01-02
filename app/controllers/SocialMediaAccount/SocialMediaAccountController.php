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

                    \Session::put('provider', $provider);
                    \Session::put('identifier', $userProfile->identifier);

                    $check_profile = \SocialMediaAccount\ProfileEntity::get_instance()->checkProfile($userProfile->identifier,$provider);
                    if($check_profile == FALSE){
                        $check_email = \SocialMediaAccount\ProfileEntity::get_instance()->checkProfileEmail($userProfile->email);
                        if($check_email == FALSE){
                            $newUser = \SocialMediaAccount\ProfileEntity::get_instance()->createNewUser($userProfile);
                            if($newUser != FALSE) {
                                $newProfile = \SocialMediaAccount\ProfileEntity::get_instance()->createNewProfile($newUser, $provider, $userProfile);

                                $userGroup = $this->userGroupEntity->createGroup($newUser);
                                $userToGroup = $this->userToGroupEntity->createUserToGroup($newUser, $userGroup->id);
                                $subscription = $this->SubscriptionEntity->createSubscription($newUser);

                                $user = \User\User::find($newUser);
                                \Auth::login($user);
                                $group = $user->userToGroup()->first();
                                \Session::put('group_id', $group->group_id);
                                \Session::put('role', $group->role);
                                \Session::flash('message', 'Success! You manage to loggedin using your '.ucfirst($provider).' Account. Please Update your Profile Information, Specially your credential Information for security reason.');

                                return \Redirect::to('profile#tab_account_setting');

                            } else {
                                return "ERROR 2";
                            }
                        } else {
                            $newProfile = \SocialMediaAccount\ProfileEntity::get_instance()->createNewProfile($check_email, $provider, $userProfile);
                            $user = \User\User::find($check_email);
                            \Auth::login($user);
                            $group = $user->userToGroup()->first();
                            \Session::put('group_id', $group->group_id);
                            \Session::put('role', $group->role);

                            \Session::flash('message', 'Success! You manage to loggedin using your '.ucfirst($provider).' Account.');
                            return \Redirect::intended('/');
                        }
                    } else {
                        $profileUpdate = \SocialMediaAccount\ProfileEntity::get_instance()->updateSocialProfile($check_profile->id,$userProfile);

                        $user = \User\User::find($check_profile->user_id);
                        \Auth::login($user);

                        $group = $user->userToGroup()->first();
                        \Session::put('group_id', $group->group_id);
                        \Session::put('role', $group->role);
                        \Session::flash('message', 'Success! You manage to loggedin using your '.ucfirst($provider).' Account.');

                        return \Redirect::intended('/');

                    }
                } catch(\Exeption $e){
                    return $e->getMessage();
                }
            }
        }
}
?>
