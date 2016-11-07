<?php
include "layout/header.php";

require "vendor/TwitterOAuth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

if (!isset($_SESSION['access_token'])) {
    include 'login.php';
}
else
{
    $accessToken = $_SESSION['access_token'];
    $connectionOauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
    $connectionOauth->setTimeouts(30, 30);
    $accountCredentials = $connectionOauth->get("account/verify_credentials");

    echo"
        <div id ='leftColumn'>
            <img src='$accountCredentials->profile_banner_url' alt='$accountCredentials->name' title='$accountCredentials->name' id='profileBanner' />
            <img src='$accountCredentials->profile_image_url' alt='$accountCredentials->name' title='$accountCredentials->name' id='profileImage' />
            <hroup>
                <h6>$accountCredentials->name <span>(@$accountCredentials->screen_name)</span></h6>
                <h6> Tweetler :<span> $accountCredentials->statuses_count </span></h6>
                <h6> Takip Edilen :<span> $accountCredentials->friends_count </span></h6>
                <h6> Takipçiler :<span> $accountCredentials->followers_count </span></h6>
            </hroup>
            <div class='clear'></div>
            <span> $accountCredentials->description </span>
        </div>

        <div id ='rightColumn'>
            Tweet Gönder (140 Karakter) <br/><br/>
            <textarea class='tweet' id='tweet'> </textarea>
            <br/><br/>
            <input type='button' value='Tweet Gönder' onclick='tweetPost()'/>
            <div id='resultTweet'></div>
            <div class='clear'></div>
            <br/>
            Mesaj Gönder <br/><br/>
            <textarea class='message' id='message'> </textarea>
            <select name='followers' id='followers'>
            ";
                $followers = $connectionOauth->get("followers/list" , array('count' => '100'));
                foreach ($followers->users as $follower) {
                    echo "<option value='$follower->id'>$follower->name</option>";
                }
            echo"
            </select>
            <br/><br/>
            <input type='button' value='Mesaj Gönder' onclick='messagePost()'/>
            <div id='resultMessage'></div>
        </div>
        <div class='clear'></div>
        <hr/>
        <h1 class='title'>Ana Sayfadaki Son 50 Tweet</h1>
        ";

    $homeTimeline = $connectionOauth->get("statuses/home_timeline");

    echo "<div class='wall'>";

    foreach ($homeTimeline as $timeLine) {
        $userName = $timeLine->user->name;
        $userImg = $timeLine->user->profile_image_url;
        @$Image = $timeLine->entities->media['0']->media_url;
        echo "
            <div class ='data'>
                <img src='$userImg' alt='$userName' title='$userName' id='userImage'/>
                <h3>$userName</h3>
                <div class='clear'></div>
                <h2>$timeLine->text</h2>
                <br/>
                <img src='$Image' alt=''/>
            </div>
            ";
    }

    echo "</div>";
}

include "layout/footer.php";
