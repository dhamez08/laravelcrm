<?php
namespace Twitter;

class Twitter{
  protected static $instance = null;

  public function __construct(){

  }

  /**
  * Return an instance of this class.
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

  public function Authenticate(){
    $consumerkey = \Config::get('twitter.consumerkey');
    $consumersecret = \Config::get('twitter.consumersecret');
    //$accesstoken = (\Session::has('access_token') && !empty(\Session::get('access_token')))? \Session::get('access_token')['oauth_token'] : \Config::get('twitter.accesstoken');
    //$accesstokensecret = (\Session::has('access_token') && !empty(\Session::get('access_token')))? \Session::get('access_token')['oauth_token_secret'] : \Config::get('twitter.accesstokensecret');
    $accesstoken = \Config::get('twitter.accesstoken');
    $accesstokensecret = \Config::get('twitter.accesstokensecret');

    $connection = new \Twitter\TwitterOAuth($consumerkey, $consumersecret, $accesstoken, $accesstokensecret);

    return $connection;
  }

  public function getProfile($name){
    $lastId = '';
    $connection = $this->Authenticate();
    $profile = $connection->get("https://api.twitter.com/1.1/users/show.json?screen_name=".$name);

    if(isset($profile->errors)){
      return NULL;
    }
    return $profile;
  }

  public function getFeeds($name){
    $lastId = '';
    $connection = $this->Authenticate();
    $tweets = $connection->get("https://api.twitter.com/1.1/favorites/list.json?screen_name=".$name);
    $testimonial = array();
    $x = 0;
    $error = false;
    foreach($tweets as $feeds){
      $r = $connection->get("https://api.twitter.com/1.1/statuses/oembed.json?id=".$feeds->id_str);
      $r->id_str = $feeds->id_str;
      $error = (isset($feeds->id_str)) ? true : $error ;
      $testimonial[$x] = $r;
      $x++;
    }

    if(isset($tweets->errors)){
      return NULL;
    }

    if(!isset($tweets->errors)) {
      \Session::put('testimonial',$testimonial);
      return $testimonial;
    } else if(\Session::has('testimonial') && !empty(\Session::get('testimonial'))){
      return \Session::get('testimonial');
    }
  }

  public function getTwitterUsername($customer_id){
    $username = '';
    $url = \CustomerUrl\CustomerUrl::where('customer_id','=',$customer_id)->where('website','=','Twitter')->first();
    if(count($url) > 0){
      $username = trim(str_ireplace("/","",strrchr(str_ireplace("/posts","",$url->url),"/")));
    }
    return $username;
  }
}
