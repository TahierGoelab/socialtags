<?php

class Database
{
    private $server, $db_name, $db_user, $db_password, $connection;

    function __construct($server, $db_name, $db_user, $db_password)
    {
        $this->server = $server;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_password = $db_password;
    }

    function establishConnection()
    {
        $this->connection = new mysqli($this->server, $this->db_user, $this->
            db_password, $this->db_name);
    }
    
    function closeConnection(){
        mysqli_close($this->connection);
    }

    function retrieveCurrentDatabase()
    {
        $sql = "SELECT DATABASE()";
        $result = mysqli_query($this->connection, $sql);
        $row = mysqli_fetch_row($result);
        return $row[0];
    }

    function selectToken($accesstoken)
    {
        $accesstoken = mysqli_real_escape_string($this->connection, $accesstoken);
        $sql = "SELECT * FROM accesstokens JOIN account ON account.tokenid=accesstokens.id WHERE accesstokens.accesstoken='$accesstoken'";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function retrieveAllTokens()
    {
        $sql = "SELECT * FROM accesstokens";
        $result = mysqli_query($this->connection, $sql);
        if (mysqli_num_rows($result)) {
            while ($row = mysqli_fetch_assoc($result)) {
                $tokens[] = $row;
            }
        }
        return $tokens;
    }
    
    function validateRegistration($email){
        $email = mysqli_real_escape_string($this->connection,$email);
        $sql = "SELECT email FROM user WHERE email='$email'";
        $result = mysqli_query($this->connection,$sql);
        if(mysqli_num_rows($result)==0){
            return false;
        }
        else{
            return true;
        }
    }
    
    function validateLogin($email,$password){
        $email = mysqli_real_escape_string($this->connection,$email);
        $password = mysqli_real_escape_string($this->connection,$password);
        $sql = "SELECT * from user WHERE email='$email'";
        $result = mysqli_query($this->connection,$sql);
        if(mysqli_num_rows($result)==0){
            return false;
        }
        else{
            $row = mysqli_fetch_assoc($result);
            
            if(password_verify($password,$row['password'])){ 
                return true;
            }
            else{
                return false;
            }
        }
    }
    
    function selectSocialTagsUser($email){
        $email = mysqli_real_escape_string($this->connection,$email);
        $sql = "SELECT * FROM user WHERE email='$email'";
        $result = mysqli_query($this->connection,$sql);
        return $result;
    }

    function insertSocialTagsUser($gegevens)
    {
        $voornaam = ucwords(strtolower(mysqli_real_escape_string($this->connection, $_POST['voornaam'])));
        $achternaam = ucwords(strtolower(mysqli_real_escape_string($this->connection, $_POST['achternaam'])));
        $straat = ucwords(strtolower(mysqli_real_escape_string($this->connection, $_POST['straat'])));
        $postcode = mysqli_real_escape_string($this->connection, $_POST['postcode']);
        $huisnr = mysqli_real_escape_string($this->connection, $_POST['huisnr']);
        $plaats = ucwords(strtolower(mysqli_real_escape_string($this->connection, $_POST['plaats'])));
        $land = mysqli_real_escape_string($this->connection, $_POST['land']);
        $email = mysqli_real_escape_string($this->connection, $_POST['email']);
        $wachtwoord = mysqli_real_escape_string($this->connection, password_hash($_POST['password'], PASSWORD_DEFAULT));
        $bedrijfsnaam = ucwords(strtolower(mysqli_real_escape_string($this->connection, $_POST['bedrijfsnaam'])));
        $kvk = mysqli_real_escape_string($this->connection, $_POST['kvk']);
        $btw = mysqli_real_escape_string($this->connection, $_POST['btw']);
        $provincie = ucwords(strtolower(mysqli_real_escape_string($this->connection, $_POST['provincie'])));
        $tel = mysqli_real_escape_string($this->connection, $_POST['tel']);
        $mobiel = mysqli_real_escape_string($this->connection, $_POST['mobiel']);

        $sql = "INSERT INTO user VALUES(null,'$voornaam','$achternaam','$bedrijfsnaam','$kvk','$btw','$straat','$huisnr','$postcode','$plaats','$land','$provincie','$tel','$mobiel','$email','$wachtwoord','Nederlands',now())";
        mysqli_query($this->connection,$sql);
    }
    
    function updateSocialTagsUser($user,$user_id){
        $voornaam = ucwords(strtolower(mysqli_real_escape_string($this->connection,$user['voornaam'])));
        $achternaam = ucwords(strtolower(mysqli_real_escape_string($this->connection,$user['achternaam'])));
        $straat = ucwords(strtolower(mysqli_real_escape_string($this->connection,$user['straat'])));
        $postcode = mysqli_real_escape_string($this->connection,$user['postcode']);
        $huisnr = mysqli_real_escape_string($this->connection,$user['huisnr']);
        $plaats = ucwords(strtolower(mysqli_real_escape_string($this->connection,$user['plaats'])));
        $land = mysqli_real_escape_string($this->connection,$user['land']);
        $tel = mysqli_real_escape_string($this->connection,$user['tel']);
        $email = mysqli_real_escape_string($this->connection,$user['email']);
        $taal = ucwords(strtolower(mysqli_real_escape_string($this->connection,$user['taal'])));
        $user_id = mysqli_real_escape_string($this->connection,$user_id);
        
        $sql = "UPDATE user SET first_name='$voornaam',last_name='$achternaam',zip_code='$postcode',address='$straat',housenumber='$huisnr',place='$plaats',phone='$tel',email='$email',language='$taal',country='$land',modified=now() WHERE id='$user_id'";
        mysqli_query($this->connection,$sql);
    }

    function selectAccount($network, $accountid, $searched = null)
    {
        $network = mysqli_real_escape_string($this->connection, $network);
        $accountid = mysqli_real_escape_string($this->connection, $accountid);
        if ($searched) {
            $sql = "SELECT * FROM account WHERE accountid='$accountid' AND searched=TRUE AND network='$network'";
        } else {
            $sql = "SELECT * FROM accesstoken JOIN account ON account.token_id=accesstoken.id WHERE account.account_id='$accountid' AND account.network='$network'";
        }
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function insertAccount($accesstoken = null, $accountid, $name, $network, $profile,
        $accesstoken_secret = null, $screen_name = null, $expiration = null, $searched = null)
    {
        $accesstoken = mysqli_real_escape_string($this->connection, $accesstoken);
        $accountid = mysqli_real_escape_string($this->connection, $accountid);
        $name = mysqli_real_escape_string($this->connection, $name);
        $network = mysqli_real_escape_string($this->connection, $network);
        $profile = mysqli_real_escape_string($this->connection, $profile);
        $accesstoken_secret = mysqli_real_escape_string($this->connection, $accesstoken_secret);
        $screen_name = mysqli_real_escape_string($this->connection, $screen_name);
        $expiration = mysqli_real_escape_string($this->connection, $expiration);
        $searched = mysqli_real_escape_string($this->connection, $searched);

        if ($accesstoken) {
            $sql = "INSERT INTO accesstoken(accesstoken,accesstoken_secret,expiration,type) VALUES('$accesstoken','$accesstoken_secret','$expiration','user')";
            mysqli_query($this->connection, $sql);
            $inserted_accesstoken = mysqli_insert_id($this->connection);
        } 
        $sql = "INSERT INTO account(account_id,token_id,name,screen_name,network,searched,profile) VALUES('$accountid','$inserted_accesstoken','$name','$screen_name','$network','$searched','$profile')";
        mysqli_query($this->connection, $sql);
        return mysqli_insert_id($this->connection);
    }

    function updateAccount($accesstoken = null, $tokenid = null, $accountid, $name, $profile,
        $accesstoken_secret = null, $screen_name = null, $expiration = null, $searched = null)
    {
        $accesstoken = mysqli_real_escape_string($this->connection, $accesstoken);
        $tokenid = mysqli_real_escape_string($this->connection, $tokenid);
        $accountid = mysqli_real_escape_string($this->connection, $accountid);
        $name = mysqli_real_escape_string($this->connection, $name);
        $profile = mysqli_real_escape_string($this->connection, $profile);
        $accesstoken_secret = mysqli_real_escape_string($this->connection, $accesstoken_secret);
        $screen_name = mysqli_real_escape_string($this->connection, $screen_name);
        $expiration = mysqli_real_escape_string($this->connection, $expiration);
        $searched = mysqli_real_escape_string($this->connection, $searched);
        if ($accesstoken) {
            $sql = "UPDATE accesstoken SET accesstoken='$accesstoken',accesstoken_secret='$accesstoken_secret',expiration='$expiration',modified=now() WHERE id='$tokenid'";
            mysqli_query($this->connection, $sql);
        }

        $sql = "UPDATE account SET name='$name',profile='$profile',screen_name='$screen_name',searched='$searched', modified=now() WHERE id='$accountid'";
        mysqli_query($this->connection, $sql);
    }
    
    function deleteAccount($accountid){
        $accountid = mysqli_real_escape_string($this->connection,$accountid);
        
        $sql = "SELECT * FROM account WHERE id='$accountid'";
        $result = mysqli_query($this->connection,$sql);
        $row = mysqli_fetch_assoc($result);
        $tokenid = $row['token_id'];
        
        $sql = "DELETE FROM accesstoken WHERE id='$tokenid'";
        mysqli_query($this->connection,$sql);
    }
    
    function selectLinkedAccounts($user_id){
        $user_id = mysqli_real_escape_string($this->connection,$user_id);
        
        $sql = "SELECT * FROM account_to_user WHERE user_id='$user_id'";
        $result = mysqli_query($this->connection,$sql);
        
        if(mysqli_num_rows($result)>0){
            while($row = mysqli_fetch_assoc($result)){
                $accountid = $row['account_id'];
                $sql = "SELECT * FROM account WHERE id='$accountid'";
                $account = mysqli_query($this->connection,$sql);
                $account = mysqli_fetch_assoc($account);
                $accounts[] = $account;
            }
            return $accounts;
        }
        else{
            return false;
        }
    }
    
    function selectLinkAccountToUser($account_id,$user_id){
        $account_id = mysqli_real_escape_string($this->connection,$account_id);
        $user_id = mysqli_real_escape_string($this->connection,$user_id);
        
        $sql = "SELECT * FROM account_to_user WHERE account_id='$account_id' AND user_id='$user_id'";
        $result = mysqli_query($this->connection,$sql);   
        return $result;
    }
    
    function insertLinkAccountToUser($account_id,$user_id){
        $account_id = mysqli_real_escape_string($this->connection,$account_id);
        $user_id = mysqli_real_escape_string($this->connection,$user_id);
        
        $link = $this->selectLinkAccountToUser($account_id,$user_id);
        if(mysqli_num_rows($link)==0){
            $sql = "INSERT INTO account_to_user(account_id,user_id) VALUES('$account_id','$user_id')";
            mysqli_query($this->connection,$sql);
        }else{
            $link_id = mysqli_fetch_assoc($link)['id'];
            $sql = "UPDATE account_to_user SET modified=now() WHERE id='$link_id'";
            mysqli_query($this->connection,$sql);
        }            
    }

    function selectPage($page_id){
        $page_id = mysqli_real_escape_string($this->connection,$page_id);
        $sql = "SELECT * FROM page WHERE page_id='$page_id'";
        $result = mysqli_query($this->connection,$sql);
        return $result;
    }

    function selectAccountPages($accountid)
    {
            $accountid = mysqli_real_escape_string($this->connection, $accountid);
            $sql = "SELECT * FROM page_to_account WHERE account_id='$accountid'";
            $result = mysqli_query($this->connection,$sql);
            echo $sql;
            
            if(mysqli_num_rows($result)==0){
                return false;
            }
            else{
                while($row = mysqli_fetch_assoc($result)){
                    $pages[] = $row;
                }
                foreach($pages as $page){
                    $page_id = $page['page_id'];
                    $sql = "SELECT * FROM page WHERE id='$page_id'";
                    $result = mysqli_query($this->connection,$sql);
                    $account_pages[] = mysqli_fetch_assoc($result);
                }
                return $account_pages;
            }
            $sql = "SELECT * FROM pages WHERE pageid='$page_id' AND accountid='$accountid'";        
    }

    function insertPage($page_id, $page)
    {        
        $page_name = $page->getProperty("name");
        $page_pic = $page->getProperty("picture")['url'];
        $industry = $page->getProperty("category");
        $page_token = $page->getProperty("access_token");
        
        $page_id = mysqli_real_escape_string($this->connection, $page_id);

        $sql = "INSERT INTO page VALUES(NULL,'$page_id','$page_name','$industry','$page_pic',now())";
        mysqli_query($this->connection, $sql);
        $page_id = mysqli_insert_id($this->connection);
        return $page_id;
    }

    function updatePage($db_page_id, $fb_page_id, $page)
    {
        $page_name = $property->getProperty("name");
        $page_pic = $property->getProperty("picture")['url'];
        $industry = $property->getProperty("category");
        
        $db_page_id = mysqli_real_escape_string($this->connection, $db_page_id);
        $fb_page_id = mysqli_real_escape_string($this->connection, $fb_page_id);

        $sql = "UPDATE page SET page_id='$fb_page_id',name='$page_name',profile='$page_pic',industry='$industry',modified=now() WHERE id='$db_page_id'";
        mysqli_query($this->connection, $sql);
    }

    function selectLinkAccountToPage($page_id, $accountid)
    {
        $page_id = mysqli_real_escape_string($this->connection, $page_id);
        $accountid = mysqli_real_escape_string($this->connection, $accountid);

        $sql = "SELECT * FROM page_to_account WHERE page_id='$page_id' AND account_id='$accountid'";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function insertLinkAccountToPage($page_id, $accountid)
    {
        $page_id = mysqli_real_escape_string($this->connection, $page_id);
        $accountid = mysqli_real_escape_string($this->connection, $accountid);

        $sql = "INSERT INTO page_to_account VALUES(NULL,'$page_id','$accountid',now())";
        mysqli_query($this->connection, $sql);
    }

    function updateLinkAccountToPage($page_id, $accountid, $link_id)
    {
        $page_id = mysqli_real_escape_string($this->connection, $page_id);
        $accountid = mysqli_real_escape_string($this->connection, $accountid);
        $link_id = mysqli_real_escape_string($this->connection, $link_id);

        $sql = "UPDATE page_to_account SET page_id='$page_id',account_id='$accountid',modified=now() WHERE id='$link_id'";
        mysqli_query($this->connection, $sql);
    }

    function retrievePages($user_id)
    {
        $user_id = mysqli_real_escape_string($this->connection, $user_id);
        $sql = "SELECT * FROM pages WHERE accountid='$user_id'";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function updatePost($post_time, $post_id, $post_message, $inserted_post_id, $page_id = null,
        $location = null)
    {
        $page_id = mysqli_real_escape_string($this->connection, $page_id);
        $post_time = mysqli_real_escape_string($this->connection, $post_time);
        $post_id = mysqli_real_escape_string($this->connection, $post_id);
        $post_message = mysqli_real_escape_string($this->connection, $post_message);
        $inserted_post_id = mysqli_real_escape_string($this->connection, $inserted_post_id);
        $location = mysqli_real_escape_string($this->connection, $location);

        $sql = "UPDATE posts SET pageid='$page_id',datetime='$post_time',postid='$post_id',text='$post_message',location='$location',modified=now() WHERE id='$inserted_post_id'";
        $result = mysqli_query($this->connection, $sql);
    }

    function retrievePagePosts($page_id)
    {
        $page_id = mysqli_real_escape_string($this->connection, $page_id);

        $sql = "SELECT * FROM pages_posts WHERE pageid='$page_id'";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function deletePostAttachments($post_id)
    {
        $post_id = mysqli_real_escape_string($this->connection, $post_id);

        $sql = "DELETE FROM posts_attachments WHERE postid='$post_id'";
        mysqli_query($this->connection, $sql);
    }

    function selectSearchAccount($user_id)
    {
        $user_id = mysqli_real_escape_string($this->connection, $user_id);

        $sql = "SELECT * FROM twitter_search_account WHERE user_id='$user_id'";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function insertSearchAccount($user_id, $user_name, $user_created_at, $screen_name,
        $profile)
    {
        $user_id = mysqli_real_escape_string($this->connection, $user_id);
        $user_name = mysqli_real_escape_string($this->connection, $user_name);
        $user_created_at = mysqli_real_escape_string($this->connection, $user_created_at);
        $screen_name = mysqli_real_escape_string($this->connection, $screen_name);
        $profile = mysqli_real_escape_string($this->connection, $profile);

        $sql = "INSERT INTO twitter_search_account VALUES(NULL,'$user_id','$user_name','$user_created_at','$screen_name','$profile',now())";
        mysqli_query($this->connection, $sql);
        $id = mysqli_insert_id($this->connection);
        return $id;
    }

    function selectPost($postid, $user_id = null)
    {
        $postid = mysqli_real_escape_string($this->connection, $postid);
        $user_id = mysqli_real_escape_string($this->connection, $user_id);

        $sql = "SELECT * FROM posts WHERE postid='$postid' and accountid='$user_id'";
        $result = mysqli_query($this->connection, $sql);
        return $result;
    }

    function insertPost($time, $user_id, $postid, $message, $location = null, $hashtags = null,
        $page_id = null)
    {
        $time = mysqli_real_escape_string($this->connection, $time);
        $user_id = mysqli_real_escape_string($this->connection, $user_id);
        $postid = mysqli_real_escape_string($this->connection, $postid);
        $message = mysqli_real_escape_string($this->connection, $message);
        $location = mysqli_real_escape_string($this->connection, $location);
        $hashtags = mysqli_real_escape_string($this->connection, $hashtags);
        $page_id = mysqli_real_escape_string($this->connection, $page_id);

        $sql = "INSERT INTO posts(datetime,accountid,postid,text,location,hashtags,pageid) VALUES('$time','$user_id','$postid','$message','$location','$hashtags','$page_id')";
        mysqli_query($this->connection, $sql);
        $id = mysqli_insert_id($this->connection);
        return $id;
    }

    function insertPostAttachment($postid, $file, $type)
    {
        $postid = mysqli_real_escape_string($this->connection, $postid);
        $file = mysqli_real_escape_string($this->connection, $file);
        $type = mysqli_real_escape_string($this->connection, $type);

        $sql = "INSERT INTO posts_attachments(postid,file,type) VALUES('$postid','$file','$type')";
        mysqli_query($this->connection, $sql);
    }

    function insertStatistics($likes, $shares, $comments, $postid)
    {
        $time = date('Y-m-d H:i:s', time());
        $likes = mysqli_real_escape_string($this->connection, $likes);
        $shares = mysqli_real_escape_string($this->connection, $shares);
        $comments = mysqli_real_escape_string($this->connection, $comments);
        $time = mysqli_real_escape_string($this->connection, $time);
        $postid = mysqli_real_escape_string($this->connection, $postid);

        $sql = "INSERT INTO statistics SET likes='$likes',shares='$shares',comments=$comments,time='$time',postid='$postid'";
        mysqli_query($this->connection, $sql);
    }

    /**
     * Getters and Setters
     * */

    function setServer($server)
    {
        $this->server = $server;
    }

    function setName($db_name)
    {
        $this->db_name = $db_name;
    }

    function setUser($db_user)
    {
        $this->db_user = $db_user;
    }

    function setPassword($db_password)
    {
        $this->db_password = $db_password;
    }

    function getServer()
    {
        return $this->server;
    }
    function getConnection()
    {
        return $this->connection;
    }

}

?>