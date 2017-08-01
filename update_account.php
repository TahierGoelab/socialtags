<?php
session_start();
if(isset($_SERVER['HTTP_REFERER'])){
    
include('classes/Database.php');
$database = new Database("localhost","socialtags_web","socialtags_tah","?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
$database->establishConnection();

$database->updateSocialTagsUser($_POST,$_SESSION['user_id']);
$database->closeConnection();
}
else{
    echo "eror";
}
?>