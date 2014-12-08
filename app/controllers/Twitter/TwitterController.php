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

  public function getTweets() {
    $twitter = \Input::get('screen_name');
    $tweets = '';

    $url = "https://twitter.com/i/profiles/show/". $twitter ."/timeline?count=3";
    // get tweets
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_REFERER, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
    $result = curl_exec($curl);
    curl_close($curl);
    // decode stuff
    $decoded = json_decode($result, true);
    $decoded = $decoded['items_html'];

    return \Response::json($decoded);
  }

  public function getRecent(){
    $name = \Input::get('screen_name');
    $feeds = \Twitter\Twitter::get_instance()->getRecent($name);
    return \Response::json($feeds);
  }
}
