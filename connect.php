<?php
include('classes/Database.php');
include('classes/Facebook.php');
session_start();

    $database = new Database("localhost", "socialtags_web", "socialtags_tah",
        "?QiY5i0;3u;vu_vu.K-rL!B2mg971OY?");
    $database->establishConnection();
    $accounts = $database->selectLinkedAccounts($_SESSION['user_id']);
    foreach($accounts as $account){
        if($account['network'] == "facebook"){
            $network_facebook = $account;
        }
        elseif($account['network'] == "twitter"){
            $network_twitter = $account;
        }
        elseif($account['network'] == "linkedin"){
            $network_linkedin = $account;
        }
        elseif($account['network'] == "instagram"){
            $network_instagram = $account;
        }
    }    

if(isset($_POST['connect']) && $_POST['connect'] == "connecting"){
    $connected_networks;
    if(isset($network_facebook)){
        $connected_networks[] = "connected_facebook";
    }
    if(isset($network_twitter)){
        $connected_networks[] = "connected_twitter";
    }
    if(isset($network_linkedin)){
        $connected_networks[] = "connected_linkedin";
    }
    if(isset($network_instagram)){
        $connected_networks[] = "connected_instagram";
    }
    echo json_encode($connected_networks);
}
elseif(isset($_POST['disconnect']) && $_POST['disconnect']=="facebook"){
    $database->deleteAccount($network_facebook['id']);
    echo "facebook_disconnect";
}
elseif(isset($_POST['disconnect']) && $_POST['disconnect']=="twitter"){
    $database->deleteAccount($network_twitter['id']);
    echo "twitter_disconnect";
}
elseif(isset($_POST['disconnect']) && $_POST['disconnect']=="linkedin"){
    $database->deleteAccount($network_linkedin['id']);
    echo "linkedin_disconnect";
}
elseif(isset($_POST['disconnect']) && $_POST['disconnect']=="instagram"){
    $database->deleteAccount($network_instagram['id']);
    echo "instagram_disconnect";
}
else{
    http_response_code(404);
}
?>