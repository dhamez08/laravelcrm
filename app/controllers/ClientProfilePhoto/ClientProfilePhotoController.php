<?php
namespace ClientProfilePhoto;
/**
* ClientsProfilePhoto Controller
*
* */
use \Carbon\Carbon;

class ClientProfilePhotoController extends \BaseController {
  protected $fileFolder;

    public function __construct(){
      parent::__construct();
      $this->fileFolder 	 	=  public_path() . '/img/profile_images';
    }

    /**
    * Return an instance of this class.
    *
    *
    * @return    object    A single instance of this class.
    */
    public static function get_instance() {

      // If the single instance hasn't been set, set it now.
      if ( null == self::$instance ) {
        self::$instance = new self;
      }

      return self::$instance;
    }

    public function getChangephoto(){
      $id = \Input::get('id',0);
      $accnt = \Input::get('accnt','');

      $change = \Clients\Clients::find($accnt);
      $change->profile_image = $id;
      $change->save();

      if($id > 0){
        $photo = \CustomerProfileImages\CustomerProfileImages::where('id','=',$id)->first();
        if(count($photo) == 0){
          $profile_photo_id = 0;
          $profile_image = asset('public/img/profile_images/profile.jpg');
          $avatar = asset('public/img/profile_images/profile.jpg');
        } else {
          $profile_photo_id = $photo->id;
          $profile_image = $photo->image;
          $avatar = $photo->image_thumbnails;
        }
      } else {
        $profile_photo_id = 0;
        $profile_image = asset('public/img/profile_images/profile.jpg');
        $avatar = asset('public/img/profile_images/profile.jpg');
      }
      return \Response::json(array('status'=>'change','profile_photo_id'=>$profile_photo_id,'profile_image'=>$profile_image,'avatar'=>$avatar));
    }

    public function postUpload(){
      $url = \Input::get('url');
      $customer = \Input::get('customer_id',\Auth::id());
      $photo = \Input::file('profile-photo-upload-file');
      $extension = $photo->getClientOriginalExtension();
      $distination = $this->fileFolder;
      $filename = str_random(30).'.'.$extension;
      $ph = array();
      if ($photo->isValid())
      {
        $photo->move($distination, $filename);
        $save = new \CustomerProfileImages\CustomerProfileImages();
        $save->customer_id = $customer;
        $save->image = asset('public/img/profile_images/'.$filename);
        $save->reference_id = $customer;
        $save->reference_name = 'site';
        $save->image_thumbnails = asset('public/img/profile_images/'.$filename);
        if($save->save()){
          $change = \Clients\Clients::find($customer);
          $change->profile_image = $save->id;
          $change->save();
        }
      }
      \Session::flash('message', 'Profile Photo was successfully uploaded.');
      return \Redirect::to($url);
    }

}
