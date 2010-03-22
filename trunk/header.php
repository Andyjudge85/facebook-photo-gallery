<div class="headertop">
    <div style="float: left">
        <a href="<?=$config['base_url']?>">
            <span class="headerboldtitle">
                Open Source Facebook Photo Gallery (JQuery, PHP, FBConnect Base)
            </span>
        </a>
        <span class="headertitle">
            ...see the latest photos from your friends, everytime you get online!
        </span>
    </div>
    
    <div class="headertitleright">
        <?php if (!isset($homepage)) { ?>
            <div style="float: left">
                <a style="margin-left: 6px;" href="<?=$config['base_url']?>/invite.php">Invite</a>
                <a style="margin-left: 6px;" href="#" onclick="fbcloggedout()">Logout</a>
            </div>
        <?php } ?>
    </div>
</div>
<div class="clear"></div>
<br />