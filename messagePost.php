<?php
session_start();
include "config.php";

require "vendor/TwitterOAuth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$message = $_POST['message'];
$followers = $_POST['followers'];

$accessToken = $_SESSION['access_token'];
$connectionOauth = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken['oauth_token'], $accessToken['oauth_token_secret']);
$connectionOauth->setTimeouts(30, 30);

$statues = $connectionOauth->post("direct_messages/new", ['user_id' => $followers , 'text' => $message]);
if ($connectionOauth->getLastHttpCode() == 200) {
    echo "Mesaj Başarıyla Gönderildi";
} else {
    echo "Mesaj Gönderimi Başarısız Oldu";
}
