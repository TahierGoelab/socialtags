<?php

require_once (__dir__ . '/../Twitter/twitteroauth/autoload.php');
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter
{

    private $consumerkey, $consumersecret, $twitter_connection, $connection, $created_token,
        $accesstoken, $insert_token_id, $insert_account_id;

    function __construct($consumerkey, $consumersecret, $oauth_token, $oauth_token_secret)
    {
        $this->consumerkey = $consumerkey;
        $this->consumersecret = $consumersecret;
        $this->twitter_connection = new TwitterOAuth($this->consumerkey, $this->
            consumersecret, $oauth_token, $oauth_token_secret);
    }

    function insertAccount($accesstoken, $database)
    {
        $connection = $database->getConnection();

        $response = $this->twitter_connection->get("account/verify_credentials");
        $accountid = $response->id_str;
        $name = $response->name;
        $screen_name = $response->screen_name;
        $profile = $response->profile_image_url;

        $access_token = $accesstoken['oauth_token'];
        $access_token_secret = $accesstoken['oauth_token_secret'];

        $result = $database->selectAccount('twitter', $accountid);

        if (mysqli_num_rows($result) == 0) {
            $accountid = $database->insertAccount($accesstoken['oauth_token'], $accountid, $name, 'twitter',
                $profile, $accesstoken['oauth_token_secret'], $screen_name);;
        } else {
            $result = mysqli_fetch_assoc($result);
            $tokenid = $result['tokenid'];
            $accountid = $result['id'];
            $database->updateAccount($accesstoken['oauth_token'], $tokenid, $accountid, $name,
                $profile, $accesstoken['oauth_token_secret'], $screen_name);
        }
        return $accountid;
    }

    function searchTweets($database, $amount, $query)
    {
        /**
         * Search tweets
         * */
        $max_id = "";
        foreach (range(1, $amount) as $page) {
            $response = $this->twitter_connection->get("search/tweets", ["q" => $query,
                "tweet_mode" => "extended", "result_type" => "recent", "max_id" => "$max_id",
                "count" => "10"]);
            if (count($response->statuses) == 0) {
                break;
            }

            foreach ($response->statuses as $tweet) {
                $user_id = $tweet->user->id_str;
                $user_name = $tweet->user->name;
                $date = new DateTime($tweet->user->created_at);
                $date->setTimezone(new DateTimeZone('Europe/Amsterdam'));
                $user_created_at = $date->format('Y-m-d H:i:s');
                $screen_name = $tweet->user->screen_name;
                $profile = $tweet->user->profile_image_url;
                $result = $database->selectUser("Twitter",$user_id,TRUE);
                if (mysqli_num_rows($result) == 0) {
                    $current_user_id = $database->insertUser(null,$user_id,$user_name,'Twitter',$profile,null,$screen_name,null,TRUE);
                } else {
                    $current_user_id = mysqli_fetch_assoc($result)['id'];
                    $database->updateUser(null,null,$current_user_id,$user_name,$profile,null,$screen_name,null,TRUE);
                }

                if ($tweet->user->location) {
                    $location = $tweet->user->location;
                } else {
                    $location = null;
                }
                if ($tweet->entities->hashtags) {
                    $hashtags = "";
                    foreach ($tweet->entities->hashtags as $hashtag) {
                        if ($hashtags == "") {
                            $hashtags .= $hashtag->text;
                        } else {
                            $hashtags .= ", " . $hashtag->text;
                        }
                    }
                } else {
                    $hashtags = null;
                }
                $date = new DateTime($tweet->created_at);
                $date->setTimezone(new DateTimeZone('Europe/Amsterdam'));
                $time = $date->format('Y-m-d H:i:s');
                $tweet_id = $tweet->id_str;
                $message = $tweet->full_text;

                $max_id = (int)$tweet->id_str;
                $max_id--;

                $result = $database->selectPost($tweet_id, $current_user_id);

                if (mysqli_num_rows($result) == 0) {
                    /**
                     * Insert post if not already in the database, insert corresponding atatchments
                     * */
                    $inserted_post_id = $database->insertPost($time, $current_user_id, $tweet_id, $message, $location,
                        $hashtags, null);

                    $media = $tweet->extended_entities->media;
                    if ($media) {
                        foreach ($media as $m) {
                            if ($m->type == "video") {
                                $file = $m->video_info->variants[0]->url;
                            } else {
                                $file = $m->media_url;
                            }
                            $type = $m->type;
                            $database->insertPostAttachment($inserted_post_id, $file, $type);
                        }
                    }
                } else {
                    $inserted_post_id = mysqli_fetch_assoc($result)['id'];
                    /**
                     * Update gedeelte, niks mee doen. Posts van twitter en linkedin kunnen niet bewerkt worden.
                     * */
                }

                $retweets = $tweet->retweet_count;
                $favorited = $tweet->favorite_count;

                $database->insertStatistics($favorited, $retweets, 0, $inserted_post_id);
            }
        }
    }

    function insertTweets($database)
    {
        $response = $this->twitter_connection->get("account/verify_credentials");
        $accountid = $response->id_str;
        $response = $this->twitter_connection->get("statuses/user_timeline", ["tweet_mode" =>
            "extended"]);
        foreach ($response as $value) {
            $postId = $value->id_str;
            $datetime = $value->created_at;
            $message = $value->full_text;
            $media = $value->extended_entities->media;

            if ($value->user->location) {
                $location = $value->user->location;
            } else {
                $location = null;
            }
            if ($value->entities->hashtags) {
                $hashtags = "";
                foreach ($value->entities->hashtags as $hashtag) {
                    if ($hashtags == "") {
                        $hashtags .= $hashtag->text;
                    } else {
                        $hashtags .= ", " . $hashtag->text;
                    }
                }
            } else {
                $hashtags = null;
            }


            $result = $database->selectPost($postId, $accountid);
            if (mysqli_num_rows($result) == 0) {
                $insert_post_id = $database->insertPost($datetime, $accountid, $postId, $message,
                    $location, $hashtags);
                if ($media) {
                    foreach ($media as $m) {
                        $type = $m->type;
                        if ($type == "video") {
                            $file = $m->video_info->variants[0]->url;
                        } else {
                            $file = $m->media_url;
                        }
                        $database->insertPostAttachment($insert_post_id, $file, $type);
                    }
                }
            } else {
                $insert_post_id = mysqli_fetch_assoc($result)['id'];
            }
            $retweets = $tweet->retweet_count;
            $favorited = $tweet->favorite_count;

            $database->insertStatistics($favorited, $retweets, 0, $inserted_post_id);
        }
    }

    /**
     * Getters and setters
     * */

    function getConsumerkey()
    {
        return $this->consumerkey;
    }
    function getConsumersecret()
    {
        return $this->consumersecret;
    }
    function setTwitterConnection($twitter_connection)
    {
        $this->twitter_connection = $twitter_connection;
    }
    function getTwitterConnection()
    {
        return $this->twitter_connection;
    }
    function getAccesstoken()
    {
        return $this->accesstoken;
    }

    function setDBConnection($connection)
    {
        $this->connection = $connection;
    }
    function getDBConnection()
    {
        return $this->connection;
    }
    function setCreatedToken($created_token)
    {
        $this->created_token = $created_token;
    }
    function getCreatedToken()
    {
        return $this->created_token;
    }

}
?>