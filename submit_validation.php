<?php
session_start();
include "classes/Database.php";

$database = new Database("localhost", "socialtags_web", "socialtags_tah",
    "?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection(); 
$_SESSION['refer'] = $_SERVER['QUERY_STRING'];
if ($_POST['submit'] == $registreer && $_SERVER['REQUEST_METHOD'] ==
    'POST' && $_SESSION['registering'] == "0") {
    header("Location: http://socialtags.gcid.nl/boards.php");

    $database->insertSocialTagsUser($_POST);
    $user = mysqli_fetch_assoc($database->selectSocialTagsUser($email));


    $_SESSION['login_email'] = $_POST['email'];
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['ingelogd'] = "1";
    $_SESSION['registering'] = "1";

} elseif ($_POST['submit'] == "Log in" && $_SESSION['ingelogd'] ==
"0") {
    header("Location: http://socialtags.gcid.nl/boards.php");
    if ($database->validateLogin($_POST['login_email'], $_POST['login_password'])) {
        $user = mysqli_fetch_assoc($database->selectSocialTagsUser($_POST['login_email']));
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['ingelogd'] = "1";
    } else {
        $_SESSION['ingelogd'] = "0";
    }
}

$database->closeConnection();
?>