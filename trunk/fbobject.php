<?php
/*
 * file: fbobject.php
 * On the backend this code first runs and retrive latest albums, photos, information
 */
include_once "facebook.php";
include_once "helper.php";

$facebook       =   new Facebook($config['fb']['api_key'], $config['fb']['secret_key']);
$user           =   $facebook->user;

if (!$user){
    header("Location: " . $config['base_url']);
    exit;
}

$friends        =   getFriendList($facebook);

//retrieving latest albums
$query1         =   "SELECT cover_pid, name, aid, owner, created, link FROM album WHERE owner in ($friends) AND cover_pid != 0 AND size >= 4 ORDER BY modified_major desc limit 100";
$albums         =   $facebook->api_client->fql_query($query1);
$defaultAlbum   =   $albums[0];

$coverPids      =   '';
$flag           =   false;
foreach($albums as $item){
    if ($flag){
        $coverPids  .=   ',';
    }
    $coverPids      .=   "'".$item['cover_pid']."'";
    $flag = true;
}

$query2         =   "SELECT pid, src_small FROM photo WHERE pid in ($coverPids)";
$albumsThumb    =   $facebook->api_client->fql_query($query2);

//retrive photos for the first albums by album id
$defaultPhotos      =   '';
if (count($albums) > 0){
    $aid            =   $albums[0]['aid'];
    $query1         =   "SELECT pid, aid, owner, link, src_big, src_small, caption, created, modified FROM photo WHERE aid='$aid' ORDER BY modified desc";
    $photos         =   $facebook->api_client->fql_query($query1);

    //collect pids as comman separated string
    $flag           =   false;
    $pids           =   '';
    foreach($photos as $item){
        if ($flag){
            $pids  .=   ',';
        }
        $pids      .=   "'". $item['pid'] . "'";
        $flag       =   true;
    }
    //retrive default info for photos, owner name...
    $query3         =   "SELECT uid, name from user where uid=" . $albums[0]['owner'];
    $query4         =   "SELECT pid, subject, text from photo_tag where pid in ($pids)";

    $queries        =   '{
                           "query3": "' . $query3 . '",
                           "query4": "' . $query4 . '"
                         }';
    $result         =   $facebook->api_client->fql_multiquery($queries);

    $albumOwnerInfo =   $result[0]['fql_result_set'][0];
    $photoTags      =   $result[1]['fql_result_set'];
} else{
    echo "There is no album by your or your friend!";
    exit;
}
?>