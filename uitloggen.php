<?php
header('Location: http://socialtags.gcid.nl');
include 'header.php';
session_destroy();
$_SESSION['ingelogd'] = "0";

?>