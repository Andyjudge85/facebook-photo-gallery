<?php
/*
 * File: config.php
 * All the configuration are stored here
 * Todo: read the install.txt
 * 1. Setup a new facebook app
 * 2. Update the base_url
 * 3. Update the api_key and secret_key in $config
 */

$config['app_title']    =   "Open Source Facebook Photo Gallery (JQuery, PHP, FBConnect Base)";
$config['base_url']     =   ""; //http://thinkdiff.net/facebook/fblatestphotos
$config['session_index']=   'homepage';

set_include_path('.' . PATH_SEPARATOR . 'library/'
         . PATH_SEPARATOR . get_include_path());

//register an app in facebook, copy the api and secret key and paste them here
$config['fb']           =   array(
    'api_key'       =>  '',
    'secret_key'    =>  '',
);


$inviteMsg                 =
"I just found <b>{$config['app_title']}</b> and using it to see the latest photos posted by my friends. I think you might be interested to see latest photos posted by your friends.
This is a open source Project, So you can use the code and derive application for your own purpose.
<fb:req-choice url='{$config['base_url']}' label='I am interested' />";

$config['feed'] =   ''; //fb feed id for

?>