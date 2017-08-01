<html>
<head>
<title>
social.gcid.nl</title>
<?php
header("Location: http://socialtags.gcid.nl/account.php#fh5co-tab-feature-vertical2");

include_once('classes/Database.php');
include_once('classes/Linkedin.php');

session_start();
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();

$linkedin_callback = "http://socialtags.gcid.nl/login-linkedin.php";
$linkedin_clientid = "78hp5f7zqto4b1";
$linked_secret = "9jDtwtckA47a7IH0";

$linkedin = new Linkedin();
$linkedin->generateToken($_GET['code'],$linkedin_callback,$linkedin_clientid,$linked_secret);
$accountid = $linkedin->insertAccount($database);
$inserted = $database->insertLinkAccountToUser($accountid,$_SESSION['user_id']);
$_SESSION['inserted_linkedin'] = '1';
?>
</html>