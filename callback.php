<?php
include "layout/header.php";

require "vendor/TwitterOAuth/autoload.php";

use Abraham\TwitterOAuth\TwitterOAuth;

if (isset($_REQUEST['oauth_verifier'], $_REQUEST['oauth_token']) && $_REQUEST['oauth_token'] == $_SESSION['oauth_token']) {
    $requestToken['oauth_token'] = $_SESSION['oauth_token'];
    $requestToken['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

    $connectionOauth = new TwitterOAuth($consumerKey, $consumerSecret, $requestToken['oauth_token'], $requestToken['oauth_token_secret']);
    $accessToken = $connectionOauth->oauth("oauth/access_token", array("oauth_verifier" => $_REQUEST['oauth_verifier']));
    $_SESSION['access_token'] = $accessToken;

    header('Location: ./');
}

include "layout/footer.php";



