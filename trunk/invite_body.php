<style type="text/css">
    #fb_multi_friend_selector h2{
        font-size: 13px !important;
    }
</style>

<?php
    if (isset($_REQUEST['ids'])){ ?>
    <div style="padding: 10px; background-color: gray; font-size: 12px; margin-left: 100px;">
        Invitation sent successfully!
    </div>
<?php } ?>

<div style="text-align: center; width: 610px; padding: 10px; margin-left: 100px;">

    <div style="margin-left: 10px; text-align: left; font-size: 16px; font-weight: bold; font-family:'ucida grande',tahoma,verdana,arial,sans-serif;">
            Tell 2+ of your friends and have your photos seen more often
    </div>
    <div style="margin-left: 10px; text-align: left; font-size: 12px; font-family:'ucida grande',tahoma,verdana,arial,sans-serif;">
            <b><?=$config['app_title'] ?></b> is great for your friends to see the latest photos posted by friends.
            Invite your friends to use this open source project.
    </div>

    <div style="text-align: left">
        <fb:serverfbml style="width: 776px;">
            <script type="text/fbml">
            <fb:fbml>
            <fb:request-form action="<?=$config['base_url']?>/home.php"
                    method="POST"
                    invite="true"
                    type="<?=$config['app_title']?>"
                    content="<?=$inviteMsg?>">
                    <fb:multi-friend-selector
                            showborder="false"
                            actiontext="<?=$config['app_title']?> Invitation"
                            cols="4"    />
            </fb:request-form>
            </fb:fbml>
            </script>
        </fb:serverfbml>
    </div>
</div>