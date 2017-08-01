<?php
session_start();
include ('classes/Database.php');
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();
if(isset($_POST['login_email'])){
    if($database->validateRegistration($_POST['login_email'])){
        $_SESSION['login_email'] = $_POST['login_email'];
        echo "true";
    }
    else{
        echo "false";
    }
}
else{
    echo "false";
}

?>