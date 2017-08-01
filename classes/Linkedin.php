<?php

class Linkedin
{
    private $token, $accesstoken, $user_id;

    function __construct()
    {
    }

    function generateToken($code, $callback, $clientid, $secret)
    {
        $permissions = 'grant_type=authorization_code&code=' . $code . '&redirect_uri=' .
            $callback . '&client_id=' . $clientid . '&client_secret=' . $secret;

        $url = "https://linkedin.com/uas/oauth2/accessToken?" . $permissions;
        $this->token = json_decode(file_get_contents($url));
    }

    function insertAccount($database)
    {
        $connection = $database->getConnection();
        $this->accesstoken = $this->token->access_token;
        $url = 'https://api.linkedin.com/v1/people/~:(id,firstName,lastName,headline,pictureUrl,publicProfileUrl,location,industry,positions,email-address)?format=json&oauth2_access_token=' .
            $this->accesstoken;
        $response = json_decode(file_get_contents($url));
        $id = $response->id;
        $name = $response->firstName . " " . $response->lastName;
        $profile = $response->pictureUrl;
        $email = $response->email; //not used
        $headline = $response->headline; //not used
        $location = $response->location->name; //not used

        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $time = $timestamp + $this->token->expires_in;
        $expiration = date('Y-m-d H:i:s', $time);
        $result = $database->selectAccount('linkedin', $id);

        if (mysqli_num_rows($result) == 0) {
            $accountid = $database->insertAccount($this->accesstoken, $id, $name, 'linkedin', $profile, null, null,
                $expiration);
        } else {
            $result = mysqli_fetch_assoc($result);
            $tokenid = $result['tokenid'];
            $accountid = $result['id'];
            $database->updateUser($this->accesstoken, $tokenid, $accountid, $name, $profile, null, null,
                $expiration);
        }
        return $accountid;
    }

    function insertPages($database)
    {
        $url = 'https://api.linkedin.com/v1/people/~:(id)?format=json&oauth2_access_token=' .
            $this->accesstoken;
        $response = json_decode(file_get_contents($url));
        $id = $response->id;
        $user = mysqli_fetch_assoc($database->selectUser('linkedin', $id));
        $this->user_id = $user['id'];

        $url = 'https://api.linkedin.com/v1/companies:(id,name,description,industry,logo-url)?format=json&is-company-admin=true&oauth2_access_token=' .
            $this->accesstoken;
        $response = json_decode(file_get_contents($url));
        foreach ($response as $value) {
            foreach ($value as $page) {

                $result = $database->selectPage($page->id, $this->user_id);
                if (mysqli_num_rows($result) == 0) {
                    $page_id = $database->insertPage($page->id, $this->user_id, $page->name, $page->
                        logoUrl, $page->industry);
                    $database->insertLinkUserToPage($page_id, $this->user_id);
                } else {
                    $page_id = mysqli_fetch_assoc($result)['id'];
                    $database->updatePage($page_id, $page->id, $this->user_id, $page->name, $page->
                        logoUrl);

                    $result = $database->selectLinkUserToPage($page_id, $this->user_id);
                    if (mysqli_num_rows($result) == 0) {
                        $database->insertLinkUserToPage($page_id, $this->user_id);
                    } else {
                        $database->updateLinkUserToPage($page_id, $this->user_id, mysqli_fetch_assoc($result)['id']);
                    }

                }
            }
        }
    }

    function retrieveAllPages($database, $user_id)
    {
        $result = $database->retrievePages($user_id);
        while ($row = mysqli_fetch_assoc($result)) {
            $pages[] = $row;
        }
        return $pages;
    }

    function insertPosts($database, $page_id)
    {
        $url = "https://api.linkedin.com/v1/companies/$page_id/updates?format=json&oauth2_access_token=" .
            $this->accesstoken;
        $response = json_decode(file_get_contents($url));
        $result = $database->selectPage($page_id, $this->user_id);
        $page_id = mysqli_fetch_assoc($result)['id'];

        foreach ($response->values as $link) {
            //var_dump($link);echo "<br /><br />";
            $date = date('Y-m-d H:i:s', $link->timestamp / 1000);
            $post_id = $link->updateContent->companyStatusUpdate->share->id;
            $message = $link->updateContent->companyStatusUpdate->share->comment;

            $result = $database->selectPost($post_id, $this->user_id);
            if (mysqli_num_rows($result) == 0) {
                $postid = $database->insertPost($date, $this->user_id, $post_id, $message, null, null,
                    $page_id);
                $media = $link->updateContent->companyStatusUpdate->share->content->
                    submittedUrl;
                if ($media) {
                    if (strpos($media, 'youtube')) {
                        $type = "youtube";
                        $media = str_replace('watch?v=','embed/',$media);
                    } else {
                        $type = "photo";
                    }
                    $database->insertPostAttachment($postid, $media, $type);
                }
            }
            else{
                $postid = mysqli_fetch_assoc($result)['id'];
            }
            $database->insertStatistics($link->numLikes,0,0,$postid);
        }
    }

    function setAccesstoken($accessToken)
    {
        $this->accesstoken = $accessToken;
    }

}

?>