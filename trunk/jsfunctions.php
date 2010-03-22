<script type='text/javascript'>
    /* All the javascript functions should be here */
    function fbcloggedout(){
        FB.ensureInit(function() {
              FB.Connect.logout(function() {
                    window.location     =   "<?=$config['base_url']?>";
              });
        });
    }
    function fbcloggedin(){
        window.location     =   "<?=$config['base_url']?>/home.php";
    }
    
</script>