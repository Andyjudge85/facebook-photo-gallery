<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://www.facebook.com/2008/fbml">
    <head>
        <title>
            Open Source Facebook Photo Gallery (JQuery, FBConnect Base)
        </title>
        <?php if (isset($homepage)) { ?>
            <script type="text/javascript" src="http://static.ak.connect.facebook.com/js/api_lib/v0.4/FeatureLoader.js.php"></script>
            <script type="text/javascript">
                FB.init("<?=$config['fb']['api_key']?>", "xd_receiver.htm", {"ifUserConnected" : fbcloggedin});
                
                var baseUrl =   "<?=$config['base_url']?>";
            </script>
        <?php } ?>
        <meta name="keywords" lang="en" content="facebook, photos, friends, facebook friends, facebook photos">
        <meta name="description" content="This is a open source php, jquery, fbconnect base photo gallery. You'll see the latest photos of your friends in facebook. Project By: Md. Mahmud Ahsan (http://thinkdiff.net)" />
        <LINK REL=StyleSheet HREF="public/css/style.css?nc=11" TYPE="text/css" MEDIA=screen>
        <LINK REL=StyleSheet HREF="public/js/lightbox/jquery.lightbox-0.5.css" TYPE="text/css" MEDIA=screen>
        <link rel="shortcut icon" type="image/x-icon" href="<?=$config['base_url']?>/public/images/icon.jpg" />
        <link rel="icon" type="image/x-icon" href="<?=$config['base_url']?>/public/images/icon.jpg" />

        <script type="text/javascript" src="public/js/jquery-1.3.2.min.js"></script>
        <script type="text/javascript" src="public/js/easySlider.js?nc=1"></script>
        <script type="text/javascript" src="public/js/lightbox/jquery.lightbox-0.5.min.js?nc=1"></script>
    </head>
    <body>
        <?php
            include_once "header.php";
            echo '<br />';
            echo '<div align="center">';
            include_once $page;
            echo '</div>';
            include_once "footercore.php";
        ?>
    </body>
</html>
