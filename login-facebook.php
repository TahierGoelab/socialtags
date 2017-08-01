<html>
<head>
<title>
social.gcid.nl</title>
<?php
header("Location: http://socialtags.gcid.nl/account.php#fh5co-tab-feature-vertical2");
include_once('classes/Database.php');
include_once('classes/Facebook.php');
require_once (__dir__ . '/Facebook/autoload.php');

session_start();
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();

/**
 * Establish facebook app
 * */
$fb = new Facebook\Facebook(['app_id' => '769049933272707', 'app_secret' =>
    'b2ca086583262bb5ab6106144ca76384', 'default_graph_version' => 'v2.8', ]);
$helper = $fb->getRedirectLoginHelper();
try {
    $accessToken = $helper->getAccessToken();
    $fb->setDefaultAccessToken($accessToken);
}
catch (Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
}
catch (Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

/**
 * Check if user already in database
 * */
$facebook = new Facebook();
$facebook->setFacebookConnection($fb);
$accountid = $facebook->insertAccount($accessToken,$database);
$facebook->insertPages($database,$accountid);
$inserted = $database->insertLinkAccountToUser($accountid,$_SESSION['user_id']);
$_SESSION['inserted_facebook'] = '1';
//$facebook->debugToken("EAAK7cmQWVoMBACZBVAxjxYUTZCtdD9tY0jG4hZCUklW7kM8cEZClfV3mGFUZCv16yDGDSSTRDlWlRXXGtHYfRr7QLwdjtvx3oQ6yW1ysoPe1XIkZCCfud6OWwx4w9mZBRgxrA94ppIxSwSUVvnisaZCxqEZBhvMYQKK0T6BFvBAgySBwZCWlQ868du5dh5ZCCUF48nXjUktp4BZBRIKZAmAQvnicL");


?>


</div>
</body>
</html>