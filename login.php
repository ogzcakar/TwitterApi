<?php

require "vendor/TwitterOAuth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth($consumerKey, $consumerSecret);
$requestToken = $connection->oauth('oauth/request_token', array('oauth_callback' => $oauthCallback));

$_SESSION['oauth_token'] = $requestToken['oauth_token'];
$_SESSION['oauth_token_secret'] = $requestToken['oauth_token_secret'];

$url = $connection->url('oauth/authorize', array('oauth_token' => $requestToken['oauth_token']));
echo "<a href = '$url'> <img src='images/signIn.png' style='width: 200px'> </a>";