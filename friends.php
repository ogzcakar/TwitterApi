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

    $friends = $connectionOauth->get("friends/list" , array('count' => 200));

    echo " <h1 class='title'>Takip Edilen</h1> <div class='wall'>";

    foreach ($friends->users as $friend) {
        echo "
            <div class ='data'>
                <img src='$friend->profile_image_url' alt='$friend->name' title='$friend->name' id='userImage'/>
                <h3>$friend->name</h3>
            </div>
            ";
    }

    echo "</div>";

}

include "layout/footer.php";
