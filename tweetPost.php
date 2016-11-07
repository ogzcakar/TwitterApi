<?php
session_start();
include "config.php";

require "vendor/TwitterOAuth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$tweet = $_POST['tweet'];

if(strlen($tweet) <= 140)
{
    $accessToken = $_SESSION['access_token'];
    $connectionOauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
    $connectionOauth->setTimeouts(30, 30);

    $statues = $connectionOauth->post("statuses/update", ["status" => $tweet]);
    if ($connectionOauth->getLastHttpCode() == 200) {
        echo "Tweet Başarıyla Gönderildi";
    } else {
        echo "Tweet Gönderimi Başarısız Oldu";
    }
}else
{
    echo "140 karakter sınırını geçmemelisiniz. Şuan " . strlen($tweet) . " karakter bulunmakta.";
}