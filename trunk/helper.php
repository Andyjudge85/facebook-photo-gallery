<?php
/*
 * Some helpful functions those are used in the project
 */

function getFriendList($facebook, $appAdd=false) {
    $sql     = "";

    if ($appAdd) {
        $sql = "SELECT uid FROM user WHERE is_app_user = 1 AND uid IN (SELECT uid2 FROM friend WHERE uid1 = {$facebook->user})";
    }
    else {
        $sql = "SELECT uid FROM user WHERE uid IN (SELECT uid2 FROM friend WHERE uid1 = {$facebook->user})";
    }
    $result = $facebook->api_client->fql_query($sql);

    $exfriends      =   "";
    $flag           =   false;

    if (!empty($result)) {
        foreach($result as $item) {
            if ($flag) $exfriends .= ',';
            $exfriends .= $item['uid'];
            $flag     = true;
        }
    }
    $excludes   =   $exfriends;

    return $excludes;
}

function getImageLink($name) {
    global $config;
    return $config['base_url'] . '/public/images/' . $name;
}

function debug($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}
?>
