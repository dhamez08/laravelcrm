<?php
return array(

    'base_url' => 'http://laravelcrm.dev.com/social/auth',

    'providers' => array (

        "Google" => array (
            "enabled" => true,
            "keys"    => array ( "id" => "747850498079-3afig7460f76vjauokpob6379g8atpae.apps.googleusercontent.com", "secret" => "aWaPvE6SLlMF6GG056-m6o9T" ),
            "scope"   => "https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/userinfo.profile"
        ),

        'Facebook' => array (
            'enabled' => true,
            "trustForwarded" => true,
            "allowSignedRequest" => false,
            'keys'    => array ( 'id' => '1584405875104925', 'secret' => '8e72d1140d3d76241bce9953269e42f8' ),
            "scope"   => "email, user_about_me, user_birthday, user_hometown, user_website, offline_access, read_stream, publish_stream, read_friendlists", // optional
        ),

        'Twitter' => array (
            'enabled' => true,
            'keys'    => array ( 'key' => 'gEdQVY186smTFysosKOoPAS7X', 'secret' => 'CY5ES6feuYiwlrBNoFBi3HZx4m5MbMD3BJaAi1kBkiebGPv0rT' )
        ),

        'LinkedIn' => array (
            'enabled' => true,
            'keys'    => array ( 'key' => '75xhc2ei1ql2e4', 'secret' => 'aeH7AQXsxW8U0bq1' )
        ),
    )







);
