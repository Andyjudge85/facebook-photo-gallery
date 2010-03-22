<?php
/*
 * file: ajax.php
 * This file's code are used to dynamically retrieve albums, photos, information.
 */
include_once "config.php";
include_once "facebook.php";
include_once "helper.php";

$facebook       =   new Facebook($config['fb']['api_key'], $config['fb']['secret_key']);
$user           =   $facebook->user;

$aid            =   isset($_REQUEST['aid']) ? $_REQUEST['aid']  : '';

if (empty($aid)){
    exit;
}

$query1         =   "SELECT cover_pid, name, aid, owner, created, link FROM album WHERE aid='" . $aid . "'";
$albums         =   $facebook->api_client->fql_query($query1);
$defaultAlbum   =   $albums[0];
//retrive photos for the first albums by album id
$defaultPhotos      =   '';

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

    echo '<div id="albumphotos"  style="margin-bottom: 10px;">';
    echo '<div id="loaderalbum" class="loading" style="display: none; margin-left: 138px; margin-top:136px;"></div>';

    echo "<div id='alphotos'>";
    $i = 0;
    foreach($photos as $item) {
        echo "
                <div class=\"apsingle\">
                    <img onclick=\"changePhoto('photo', $i);return false;\" src=\"{$item['src_small']}\" alt='' />
                </div>
             ";
        ++$i;
    }
    echo "</div>";
    
    echo "<script type='text/javascript'>";
    echo "albumOwnerInfo  = " . json_encode($albumOwnerInfo) . ";";
    echo "albumInfo       = " . json_encode($defaultAlbum) . ";";
    echo "limit           = " . count($photos). ";";
    
    for($i = 0; $i < count($photos); ++$i) {
        echo "photos[$i]='{$photos[$i]['src_big']}';";
        $convertText    =   htmlentities($photos[$i]['caption'],ENT_QUOTES);
        $convertText    =   preg_replace('/[^a-zA-Z0-9\-]/', ' ', $convertText);
        echo "captions[$i]=\"$convertText\";";
        echo "uids[$i]='{$photos[$i]['owner']}';";
        $dat        =   date("F j, Y", $albums[$i]['created']);
        echo "dates[$i]='{$dat}';";
        echo "pids[$i]='{$photos[$i]['pid']}';";
        echo "links[$i]='{$photos[$i]['link']}';";
    }
    echo "photoTags   =   " . json_encode($photoTags) . ";";
    echo "</script>";
    
    echo "<script type='text/javascript'>";
    echo "currentId=0;";
    echo "processInfo();";
    echo "</script>";
    echo "</div>";
?>