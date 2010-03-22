
<script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
<script type="text/javascript">
    <?php if (isset($homepage)) { ?>
        FB.init("<?=$config['fb']['api_key']?>", "xd_receiver.htm", {"ifUserConnected" : fbcloggedin});
    <?php } else { ?>
        FB.init("<?=$config['fb']['api_key']?>", "xd_receiver.htm", {"ifUserNotConnected" : fbcloggedout});
    <?php } ?>
</script>