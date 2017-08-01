<?php
require_once (__dir__ . '/../Facebook/autoload.php');

class Facebook
{
    private $app_id, $app_secret, $accesstoken, $user_id, $facebook_connection;

    function __construct()
    {
    }

    function insertAccount($accesstoken, $database)
    {
        $connection = $database->getConnection();
        $this->facebook_connection->setDefaultAccessToken($accesstoken);
        $response = $this->facebook_connection->get('/me?fields=id,name,picture');
        $userNode = $response->getGraphUser();
        $userId = $userNode->getProperty("id");
        $userName = $userNode->getProperty("name");
        $profile = $userNode->getProperty("picture")['url'];

        $result = $database->selectAccount('facebook', $userId);
        if (mysqli_num_rows($result) == 0) {
            $accountid = $database->insertAccount($accesstoken, $userId, $userName, 'facebook', $profile);
        } else {
            $result = mysqli_fetch_assoc($result);
            $tokenid = $result['token_id'];
            $accountid = $result['id'];

            $database->updateAccount($accesstoken, $tokenid, $accountid, $userName, $profile);
        }
        return $accountid;
    }
    
    function debugToken($accesstoken){
        $response = $this->facebook_connection->get("debug_token?input_token=".$accesstoken);
        $user = $response->getGraphObject();
        var_dump($user);echo "<br /><br />";var_dump($response);
    }
    
    function insertPages($database, $accountid)
    {
        $pageRequest = $this->facebook_connection->get('/me/accounts?fields=name,id,access_token,category,picture');
        $pageNode = $pageRequest->getGraphEdge();

        foreach ($pageNode as $page) {
            $pageId = $page->getProperty("id");

            /**
             * Check if page already exists to decide whether to insert or update
             * */
             $result = $database->selectPage($pageId);
            if (mysqli_num_rows($result) == 0) {
                $page_id = $database->insertPage($pageId,$page);
                mail("goelab@lingaweb.nl","pageid",$page_id);
                $database->insertLinkAccountToPage($page_id, $accountid);
                //$this->insertTaggedPosts($database,$pageId);
            } else {
                 $pages = mysqli_fetch_assoc($result);
                 $page_id = $pages['id'];
                 $database->updatePage($page_id,$pageId,$page);
                 
                 $result = $database->selectLinkAccountToPage($page_id,$accountid);
                 if(mysqli_num_rows($result) == 0){
                    $database->insertLinkAccountToPage($page_id,$accountid);
                 }
                 else{
                    $database->updateLinkAccountToPage($page_id,$accountid,mysqli_fetch_assoc($result)['id']);
                 }
            }      
        }
    }

    function insertTaggedPosts($database, $page_id)
    {
        $result = $database->selectPage($page_id);
        if (mysqli_num_rows($result) == 0) {

        } else {
            $response = $this->facebook_connection->get($page_id .
                "/photos/tagged?fields=id,from,link,place,message,picture,created_time,attachments,source,shares");
            $pagePostEdge = $response->getGraphEdge()->asArray();
            foreach ($pagePostEdge as $post){
                //var_dump($post);echo("<br /><br />");
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
        $response = $this->facebook_connection->get("/" . $page_id .
            "/posts?fields=message,picture,id,created_time,attachments,source,likes.summary(true),shares,comments.summary(true),place,is_hidden,link");

        $pagePostEdge = $response->getGraphEdge();
        foreach ($pagePostEdge as $post) {
            
            $page_post_id = $post->getProperty("id");
            $page_post_time = get_object_vars($post->getProperty("created_time"))['date'];
            $page_post_message = $post->getProperty("message");
            if($post->getProperty("place")){
                $location = $post->getProperty("place")->getProperty("location")->getProperty("city");
            }            

            $result = $database->selectPage($page_id);
            while ($row = mysqli_fetch_assoc($result)) {
                $user_id = $row['accountid'];
                $page_id = $row['id'];
            }

            $result = $database->selectPost($page_post_id, $user_id);

            if (mysqli_num_rows($result) == 0) {
                $inserted_post_id = $database->insertPost($page_post_time, $user_id, $page_post_id,
                    $page_post_message, $location, null, $page_id);
                $this->insertPostAttachments($database, $post, $inserted_post_id);
            } //Beginning update
            else {
                while ($row = mysqli_fetch_assoc($result)) {
                    $database->updatePost($page_post_time, $page_post_id, $page_post_message, $inserted_post_id,
                        $page_id,$location);
                    $database->deletePostAttachments($inserted_post_id);
                    $this->insertPostAttachments($database, $post, $inserted_post_id);
                }
            }
            $this->insertStatistics($database, $post, $inserted_post_id);
        }
    }

    function insertPostAttachments($database, $post, $inserted_post_id)
    {
        $attachments = $post->asArray();
        $youtube = $attachments['attachments'][0]['target']['url'];
        if ($post->getProperty("source")) {
            $source = $post->getProperty("source");
            if (strpos($source, "youtube")) {
                if (strpos($source, "autoplay")) {
                    $source = str_replace("autoplay", "", $source);
                }
                $database->insertPostAttachment($inserted_post_id, $source, 'youtube');
            } else {
                /**
                 * check if source is video
                 * */
                $database->insertPostAttachment($inserted_post_id, $source, 'video');
            }
        } elseif (strpos($youtube, "youtube")) {
            $youtube = urldecode($youtube);
            $position = strpos($youtube, 'https://www.youtube.com');
            $youtube = substr($youtube, $position);
            $youtube = str_replace('watch?v=', 'embed/', $youtube);
            $position = strpos($youtube, '&');
            $youtube = substr($youtube, 0, $position);
            $database->insertPostAttachment($inserted_post_id, $youtube, 'youtube');
            $this->insertPictures($database, $post, $inserted_post_id);
        } else {
            $this->insertPictures($database, $post, $inserted_post_id);
        }
    }

    function insertPictures($database, $post, $inserted_post_id)
    {
        if ($post->getProperty("picture")) {
            /**
             * retrieve pictures
             * */
            $post_pictures = $this->facebook_connection->get($post->getProperty("id") .
                "/attachments");
            $post_picturesEdge = $post_pictures->getGraphEdge();
            $post_picturesArray = $post_picturesEdge->asArray()[0];

            foreach ($post_picturesArray as $key => $value) {
                /**
                 * Check if there are more then one picture in the node
                 * */
                if ($key == "subattachments") {
                    foreach ($value as $picturesrc) {
                        if ($picturesrc['media']['image']['src']) {
                            $picture = $picturesrc['media']['image']['src'];
                            if (strpos($picture, 'safe_image.php')) {
                            } else {
                                $database->insertPostAttachment($inserted_post_id, $picture, 'photo');
                            }
                        }
                    }
                }
                /**
                 * Check if there is only one picture in the node
                 * */  elseif ($key == "media") {
                    $picture = $value['image']['src'];

                    $database->insertPostAttachment($inserted_post_id, $picture, 'photo');
                }
            }
        }
    }

    function insertStatistics($database, $post, $postid)
    {
        $status = json_decode($post);
        $id = $status->id;
        if ($status->shares->count) {
            $shares = $status->shares->count;
        } else {
            $shares = 0;
        }
        if ($status->likes >= 0) {
            $likes = count($status->likes);
        } else {
            $likes = 0;
        }
        if ($status->comments >= 0) {
            $comments = count($status->comments);
        } else {
            $comments = 0;
        }
        $database->insertStatistics($likes, $shares, $comments, $postid);
    }

    function retrieveAllPagePosts($database, $page_id)
    {
        $result = $database->retrievePagePosts($page_id);
        while ($row = mysqli_fetch_assoc($result)) {
            $posts[] = $row;
        }
        return $posts;
    }

    function insertPost($connection, $time, $post_id, $post_text)
    {
        $user_id = $this->user_id;
        $sql = "INSERT INTO posts(datetime,accountid,postid,text)
                    VALUES('$time','$user_id','$post_id','$post_text')";
        $result = mysqli_query($connection, $sql);
        $insert_post_id = mysqli_insert_id($connection);

    }

    function retrieveStatistics($post_id)
    {
        $response = $this->facebook_connection->get("$post_id?fields=likes.summary(true),shares,comments.summary(true)");
        $feed = $response->getGrapEdge();
        foreach ($feed as $status) {
            $status = json_decode($status);
            $id = $status->id;
            if ($status->shares->count) {
                $shares = $status->shares->count;
            } else {
                $shares = 0;
            }
            if ($status->likes >= 0) {
                $likes = count($status->likes);
            } else {
                $likes = 0;
            }
            if ($status->comments >= 0) {
                $comments = count($status->likes);
            } else {
                $comments = 0;
            }
            insertStatistics($connection, $id, $likes, $shares, $comments);
        }
    }

    /**
     * Getters and Setters
     * */

    function getFacebookConnection()
    {
        return $this->facebook_connection;
    }

    function setFacebookConnection($facebook_connection)
    {
        $this->facebook_connection = $facebook_connection;
    }

    function setAccesstoken($accesstoken)
    {
        $this->accesstoken = $accesstoken;
        $this->facebook_connection->setDefaultAccessToken($accesstoken);
    }
}



?>