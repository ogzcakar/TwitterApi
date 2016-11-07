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

    $followers = $connectionOauth->get("followers/list" , array('count' => 200));

    echo " <h1 class='title'>Takipçiler</h1> <div class='wall'>";

    foreach ($followers->users as $follower) {
        echo "
            <div class ='data'>
                <img src='$follower->profile_image_url' alt='$follower->name' title='$follower->name' id='userImage'/>
                <h3>$follower->name</h3>
            </div>
            ";
    }

    echo "</div>";

}

include "layout/footer.php";
