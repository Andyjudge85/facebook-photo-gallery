<h1>Open Source Facebook Photo Gallery (JQuery, FBConnect Base)</h1>
<h3>
Author: Md. Mahmud Ahsan (<a href='http://thinkdiff.net'><a href='http://thinkdiff.net'>http://thinkdiff.net</a></a>) <br />
version: 1.0<br>
</h3>

<b>Project Demo:</b><a href='http://thinkdiff.net/facebook/fblatestphotos/index.php'><a href='http://thinkdiff.net/facebook/fblatestphotos/index.php'>http://thinkdiff.net/facebook/fblatestphotos/index.php</a></a>

<b>
Description: This is a open source php, jquery, fbconnect and facebook api base photo gallery. Using this application you'll see the latest photos of your friends in facebook.<br>
Here Facebook connect is used for login purpose and facebook api is used to retrieve your friends latest photos from facebook. Jquery is used to create user friendly UI and photo gallery.<br>
</b>

# Details #

Its very easy to install the program.<br />

Requirements:<br />
1. PHP 5 supported hosting <br />
2. Basic knowledge to know how to setup an application in facebook<br /><br />

Steps:<br />
1. Visit <a href='http://www.facebook.com/developers'><a href='http://www.facebook.com/developers'>http://www.facebook.com/developers</a></a> and click setup new application. <br />
2. Provide application name, description.<br />
3. Provide the Connect URL. For my case I provide <a href='http://thinkdiff.net/facebook/fblatestphotos/'><a href='http://thinkdiff.net/facebook/fblatestphotos/'>http://thinkdiff.net/facebook/fblatestphotos/</a></a> (because here i hosted the applications code)<br />
4. Click Save Changes and you'll get api and secret key.<br />
5. Now place those api and secret keys in the config.php<br />
$config['fb']           =   array(
> 'api\_key'       =>  'xxxxxxxxxxxxxxxxxxxxxxxxxxxx', //place api key here<br />
> 'secret\_key'    =>  'yyyyyyyyyyyyyyyyyyyyyyyyyyyy', //place secret key here<br />
);<br />
6. Upload all codes of this project in your hosting.<br />
7. Now visit the gallery. In my case the url is <a href='http://thinkdiff.net/facebook/fblatestphotos/'><a href='http://thinkdiff.net/facebook/fblatestphotos'>http://thinkdiff.net/facebook/fblatestphotos</a></a> <br />