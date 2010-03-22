<?php
    if (isset($_REQUEST['ids'])){ ?>
        <div style="padding: 10px; background-color: gray; font-size: 12px; margin-left: 100px; width: 400px;">
            Invitation sent successfully!
        </div>
    <?php } ?>
<table border="0">
    <tr>
        <td valign="top">
            <div style="width: 610px; height: 18px;">
                <div id="photoviewer_left">
                    Latest photos by your friends
                </div>
                <div id="photoviewer_right">
                    <a href="javascript:void(0)" onclick="changePhoto('prev',''); return false;" class="prev">Previous</a> <a href="javascript:void(0)" onclick="changePhoto('next',''); return false;" class="next">Next</a>
                </div>
            </div>
            <div class="clear"></div>
            <div id="photoviewer">
                <div class="clear" style="margin-bottom: 5px"></div>
                <div id="loader" class="loading" style="display: none;">
                </div>
                <div style="text-align: center">
                    <a id="displayer_link" style="text-decoration: none;" href="<?=$albums[0]['link']?>" target="_blank">
                        <span id="ddisplayer">
                            <img id="displayer" src="<?=$albums[0]['src_big']?>" alt="" style="max-width: 500px; border: 0" />
                        </span>
                    </a>
                </div>
                <br />
                <table border="0">
                    <tr>
                        <td>
                            <div id="phototitle">

                            </div>
                            <div id="phototags">

                            </div>
                        </td>
                        <td>
                            <div id="photoinfo">

                            </div>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="clear"></div>
            <div id="photocomment">
                <br />
            </div>
        </td>
        <td valign="top">
            <div id="photoremain">
            Albums
                <div id="slider" class="slider" style="visibility: hidden;">
                    <ul>
                        <?php
                            $len     =  count($albumsThumb);
                            $counter =  0;
                        ?>
                        <?php for($i = 0; $i < $len; ) { ?>
                            <li>
                                <?php
                                    for ($j = 0; $j < 4; ++$j){
                                        $k = $i + $j;
                                    ?>
                                    <?php if (isset($albumsThumb[$k]['src_small'])) { ?>
                                        <div style="float: left; margin-left: 4px;">
                                            <img onclick="ajax('<?=$albums[$k]['aid']?>'); return false;" src="<?=$albumsThumb[$k]['src_small']?>" alt="" />
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                                <?php $i = $k+1; ?>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="clear"></div>
            <br />
            <div id="albumphotos"  style="margin-bottom: 10px;">
                <div id="loaderalbum" class="loading" style="display: none; margin-left: 138px; margin-top:136px;">
                </div>
                <div id="alphotos">
                    <?php $i = 0; ?>
                    <?php foreach($photos as $item) { ?>
                    <div class="apsingle">
                        <img onclick="changePhoto('photo', <?=$i++?>);return false;" src="<?=$item['src_small']?>" alt="" />
                    </div>
                    <?php } ?>
                </div>
            </div>
            <!--
            <div id="photoadvertise">
                <img src="<?=$config['base_url']?>/public/images/advertise.jpg" alt="advertise" />
            </div>
            -->
        </td>
    </tr>
</table>

<script type="text/javascript">
     function ajax(albumId){
         $('#alphotos').css('display', 'none');
         $('#loaderalbum').css('display', 'block');
         $.post("ajax.php", {aid: albumId}, upPhoto);
     }
     function upPhoto(data){
         $('#loaderalbum').css('display', 'none');
         $('#alphotos').css('display', 'block');

         $("#albumphotos").replaceWith(data);
        //document.getElementById('albumphotos').innerHTML = data;
     }
     $(document).ready(function(){
        $("#slider").easySlider({
		continuous: true
	});
        $("#slider").css('visibility', 'visible');
        processInfo();
    });

    
    var currentId       =   0;
    var limit           =   <?=count($photos)?>;
    var albumInfo       =   <?=json_encode($defaultAlbum);?>;
    var albumOwnerInfo  =   <?=json_encode($albumOwnerInfo)?>;
    var photos          =   new Array();
    var captions        =   new Array();
    var uids            =   new Array();
    var dates           =   new Array();
    var pids            =   new Array();
    var links           =   new Array();

    <?php
        for($i = 0; $i < count($photos); ++$i){
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
    ?>

    var photoTags   =   <?=json_encode($photoTags)?>;
    function getPhotoTagsUser(pid){
        var x, a;
        var data = '';
        var flag = 0;

        for (x in photoTags){
            a = photoTags[x].pid;

            if (a == pid){
                if (flag == 1)
                    data += ', ';
                flag = 1;
                data += '<a href="http://www.facebook.com/profile.php?id=' + photoTags[x].subject + '" target="_blank">' + photoTags[x].text + '</a>';
            }
        }
        var finalData = '';
        if (data != ''){
            finalData = '<span style="color: #777777">In this photo: </span>';
        }
        return finalData + data;
    }

    function changePhoto(pos, id){
        if (pos == 'prev'){
            currentId  =   currentId - 1;
            if (currentId < 0) currentId = limit-1;
        }
        else if (pos == 'next'){
            currentId  =   currentId + 1;
            if (currentId >= limit) currentId = 0;
        }
        else if (pos == 'photo'){
            currentId   =   id;
        }
        processInfo();
    }

    function processInfo(){
        //$("#displayer").attr("src", photos[currentId]);

        $("#ddisplayer").css('display', 'none');
        $('#loader').css('display', 'block');

        var img = new Image();
        $(img).load(function () {
            //$(this).css('display', 'none'); // .hide() doesn't work in Safari when the element isn't on the DOM already
            $('#loader').css('display', 'none');
            $("#ddisplayer").css('display', 'block');
            $(this).hide();
            //$('#loader').removeClass('loading').append(this);
            $(this).fadeIn();
        }).error(function () {
            // notify the user that the image could not be loaded
        }).attr('src', photos[currentId]);

        $("#ddisplayer").html(img);

        var aid         =   albumInfo.aid;
        var name        =   albumInfo.name;
        var link        =   albumInfo.link;
        var userName    =   albumOwnerInfo.name;
        var userId      =   albumOwnerInfo.uid;

        var info        =   "From the album: <br /><a target='_blank' href='" + link +  "'>" + name + "</a> by " + "<a target='_blank' href='http://www.facebook.com/profile.php?id=" + userId + "'>" + userName + "</a>";
        var title       =   captions[currentId];

        $("#photoinfo").html(info);
        $("#phototitle").html(title);
        var tagsInfo    =   getPhotoTagsUser(pids[currentId]);
            tagsInfo   +=   '<div style="color: #999999">Added ' +  dates[currentId] + '</div>';
        $("#phototags").html(tagsInfo);
        $("#displayer_link").attr("href", links[currentId]);
    }
</script>