<?php
/*
Project: Open Source Facebook Photo Gallery (JQuery, FBConnect Base)
Author: Md. Mahmud Ahsan (http://thinkdiff.net)
version: 1.0
Description: This is a open source php, jquery, fbconnect and facebook api base photo gallery.
             Using this application you'll see the latest photos of your friends in facebook.
             Here Facebook connect is used for login purpose and facebook api is used to retrieve your friends
             latest photos from facebook. Jquery is used to create user friendly UI and photo gallery.

Copyright (C) 2010  Md. Mahmud Ahsan (mahmud@thinkdiff.net)

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.

*/
    include_once "config.php";

    //check if user already logged in redirect him to home page
    include_once "facebook.php";
    try{
        $facebook       =   new Facebook($config['fb']['api_key'], $config['fb']['secret_key']);
        $user           =   $facebook->user;
    }
    catch(Exception $o){
        print_r($o);
        exit;
    }
    
    include_once "jsfunctions.php";
    $page       =   "index_body.php";
    $homepage   =   true;
    include_once "template.php";
?>