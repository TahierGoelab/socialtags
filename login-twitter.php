<html>
<head>
<title>
social.gcid.nl</title>
<?php
header("Location: http://socialtags.gcid.nl/account.php#fh5co-tab-feature-vertical2");

include_once('classes/Database.php');
include_once('classes/Twitter.php');
require_once (__dir__ . '/Twitter/twitteroauth/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;


session_start();
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();

$twitter = new Twitter("VqFwhKjLDgbrdJvDYTTvFUrTK","lBjk8ICagWk3ipX0BmtZMXAaTAl6HDHlsvcEOhPcYNKGDRcrNw",$_SESSION['oauth_token'],$_SESSION['oauth_token_secret']);
$accesstoken = $twitter->getTwitterConnection()->oauth("oauth/access_token", ["oauth_verifier" =>
    $_REQUEST['oauth_verifier']]);
$twitter_connection = new TwitterOAuth($twitter->getConsumerkey(),$twitter->getConsumersecret(),$accesstoken['oauth_token'],$accesstoken['oauth_token_secret']);
$twitter->setTwitterConnection($twitter_connection);
$accountid = $twitter->insertAccount($accesstoken,$database);
echo $accountid;
$inserted = $database->insertLinkAccountToUser($accountid,$_SESSION['user_id']);
$_SESSION['inserted_twitter'] = '1';

?>

</div>
</body>
</html>