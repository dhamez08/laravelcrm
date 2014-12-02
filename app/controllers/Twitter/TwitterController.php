<?php
namespace Twitter;

class TwitterController extends \BaseController{
  public function getProfile(){
    $name = \Input::get('screen_name');
    $profile = \Twitter\Twitter::get_instance()->getProfile($name);
    echo $profile->id;
    echo $profile->profile_image_url;
    echo '<pre>',print_r($profile),'</pre>';
  }

  public function getFeeds(){
    $name = \Input::get('screen_name');
    $feeds = \Twitter\Twitter::get_instance()->getFeeds($name);
    return \Response::json($feeds);
  }
}
