<?php

class Instagram
{
    private $accesstoken;

    function __construct()
    {

    }

    function insertAccount($database, $client_id, $client_secret, $redirect, $code)
    {
        $fields = array(
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $redirect,
            'code' => $code);
        $url = 'https://api.instagram.com/oauth/access_token';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result);
        $accesstoken = $result->access_token;
        $user_id = $result->user->id;
        $name = $result->user->full_name;
        $screen_name = $result->user->username;
        $profile = $result->user->profile_picture;
        $result = $database->selectAccount('instagram', $user_id);
        if (mysqli_num_rows($result) == 0) {
            $accountid = $database->insertAccount($accesstoken, $user_id, $name, 'instagram', $profile, null,
                $screen_name);
        } else {
            $row = mysqli_fetch_assoc($result);
            $accountid = $row['id'];
            $database->updateUser($accesstoken, $row['tokenid'], $row['id'], $name, $profile, null,
                $screen_name);
        }
        return $accountid;
    }

    function insertPosts($database)
    {
        $request = "https://api.instagram.com/v1/users/self/media/recent?access_token=" .
            $this->accesstoken;
        $result = json_decode(file_get_contents($request));

        foreach ($result->data as $post) {
            $location = "";
            $message = "";
            $instagram_user_id = $post->user->id;
            $postid = $post->id;
            $created_at = date('Y-m-d H:i:s', $post->created_time);
            if ($post->location) {
                $location = $post->location->name;
            }
            if ($post->caption->text) {
                $message = $post->caption->text;
            }
            $result = $database->selectUser('instagram', $instagram_user_id);
            if (mysqli_num_rows($result) == 0) {

            } else {
                $account_id = mysqli_fetch_assoc($result)['id'];
                $result = $database->selectPost($postid, $account_id);
                if (mysqli_num_rows($result) == 0) {
                    $inserted_post_id = $database->insertPost($created_at, $account_id, $postid, $message,
                        $location);
                    if ($post->type == "image") {
                        $image = $post->images->standard_resolution->url;
                        $database->insertPostAttachment($inserted_post_id, $image, 'photo');
                    } elseif ($post->type == "video") {
                        $video = $post->videos->standard_resolution->url;
                        $database->insertPostAttachment($inserted_post_id, $video, 'video');
                    } elseif ($post->type == "carousel") {
                        foreach ($post->carousel_media as $media) {
                            if ($media->type == "image") {
                                $image = $media->images->standard_resolution->url;
                                $database->insertPostAttachment($inserted_post_id, $image, 'photo');
                            } elseif ($media->type == "video") {
                                $video = $media->videos->standard_resolution->url;
                                $database->insertPostAttachment($inserted_post_id, $video, 'video');
                            }
                        }
                    }
                } else {
                    $inserted_post_id = mysqli_fetch_assoc($result)['id'];
                    $database->updatePost($created_at, $postid, $message, $inserted_post_id);
                }
                $database->insertStatistics($post->likes->count,0,$post->comments->count,$inserted_post_id);
            }
        }
    }
    
    function getRecentTags($database,$query){
        $request = "https://api.instagram.com/v1/tags/".$query."/media/recent?access_token=".$this->accesstoken;
        $response = json_decode(file_get_contents($request));
    }
    
    function searchTags($database,$query){
        $request = "https://api.instagram.com/v1/tags/".$query."/media/recent?access_token=".$this->accesstoken;
        $response = json_decode(file_get_contents($request));
    }

    function getFollows()
    {
        $request = "https://api.instagram.com/v1/users/self/follows?access_token=" . $this->
            accesstoken;
            echo $request;
        $result = json_decode(file_get_contents($request));
        var_dump($result);
    }
    
    function getFollowers(){
        $request = "https://api.instagram.com/v1/users/self/followed-by?access_token=".$this->
            accesstoken;
            $result = json_decode(file_get_contents($request));
            var_dump($result);
    }

    function setAccesstoken($accesstoken)
    {
        $this->accesstoken = $accesstoken;
    }
}

?>