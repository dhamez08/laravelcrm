<?php
return array(
    'index' => 'login',
    'login' => 'social/{action?}',
    'loginredirect' => '',   // set this if you want a default redirect after login, else it will use back()
    'logout' => 'social/logout',
    'logoutredirect' => 'login',
    'authfailed' => 'login',
    'endpoint' => 'login', // set this if you want a default redirect after logout, else it will use back()
);