<?php
session_start();
include "config.php";
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Twitter Api</title>
    <base href="<?php echo $baseUrl;?>" />
    <link rel="stylesheet" href="css/twitter.css"/>

</head>
<body>

<header>
    <div class="container">
        <div id="logo">
            <h2><a href="index"> Twitter Api </a></h2>
        </div>
    </div>
</header>

<nav>
    <ul>
        <li><a href="#"> Ana Sayfa </a> </li>
        <li><a href="profile"> Profilim </a> </li>
        <li><a href='friends'>Takip Edilen</a></li>
        <li><a href='followers'>Takipçiler</a></li>
        <li><a href='logout'>Çıkış</a></li>
    </ul>
</nav>


<div class="container">

