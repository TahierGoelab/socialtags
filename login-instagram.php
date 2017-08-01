<html>
<head>
<title>
social.gcid.nl</title>
<?php

header("Location: http://socialtags.gcid.nl/account.php#fh5co-tab-feature-vertical2");

include_once('classes/Database.php');
include_once('classes/Instagram.php');

session_start();
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();

$instagram = new Instagram();
$accountid = $instagram->insertAccount($database,'d50a6dc1ae0d4cd49b83137cb8f97421','85475e7c82c94847b5a251f31c538d3d','http://socialtags.gcid.nl/login-instagram.php',$_GET['code']);
$inserted = $database->insertLinkAccountToUser($accountid,$_SESSION['user_id']);
$_SESSION['inserted_instagram'] = '1';
?>