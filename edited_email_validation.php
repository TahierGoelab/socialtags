<?php
session_start();
include ('classes/Database.php');
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();

if($_POST['email'] == $_SESSION['login_email']){
    echo "true";
}
elseif(isset($_POST['email'])){
    if($database->validateRegistration($_POST['email'])){
        echo "false";
    }
    else{
        echo "true";
    }
}
else{
    echo "false";
}

$database->closeConnection();
?>