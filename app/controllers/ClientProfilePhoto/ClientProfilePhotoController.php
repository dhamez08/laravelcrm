<?php
namespace ClientProfilePhoto;
/**
* ClientsProfilePhoto Controller
*
* */
use \Carbon\Carbon;

class ClientProfilePhotoController extends \BaseController {
    public function getChangephoto(){
      $id = \Input::get('id',0);
      $accnt = \Input::get('accnt','');

      $change = \Clients\Clients::find($accnt);
      $change->profile_image = $id;
      $change->save();

      if($id > 0){
        $photo = \CustomerProfileImages\CustomerProfileImages::find($id)->first();
        if(count($photo) == 0){
          $profile_image = asset('public/img/profile_images/profile.jpg');
          $avatar = asset('public/img/profile_images/profile.jpg');
        } else {
          $profile_image = $photo->image;
          $avatar = $photo->image;
        }
      } else {
        $profile_image = asset('public/img/profile_images/profile.jpg');
        $avatar = asset('public/img/profile_images/profile.jpg');
      }
      return \Response::json(array('status'=>'change','profile_image'=>$profile_image,'avatar'=>$avatar));
    }
}
